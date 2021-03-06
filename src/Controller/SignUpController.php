<?php

namespace App\Controller;

//use http\Env\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Patient;
use App\Entity\Account;
use App\Entity\Role;
use App\Entity\Address;

class SignUpController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/sign/up", name="SignUp")
     */
    public function index()
    {
        return $this->render('sign_up/index.html.twig', [
            'controller_name' => 'SignUpController',
            'Title' => 'Регистрация',
            'Address' => $this->getAddress(),
        ]);
    }

    /**
     * @Route("/sign/up/post", name="SignUpPost", methods={"POST"})
     */
    public function postSignUp(Request $req, ValidatorInterface $validator)
    {
        $submittedToken = $req->request->get('token');
        // Check form validation
        if($this->isCsrfTokenValid('signupme', $submittedToken))
        {
            // Check email contains
            $email_check = $this->getDoctrine()
                        ->getRepository(Account::class)
                        ->findOneByEmail($req->get('email'));
            if(isset($email_check))
                return $this->redirect('/sign/up/get?error=Введенная почта уже занята');


            $entityManager = $this->getDoctrine()->getManager();

            $account = new Account();
            $patient = new Patient();
            $role = $this->getDoctrine()
                ->getRepository(Role::class)
                ->findOneByTitle('Пациент');
            $address = $this->getDoctrine()
                ->getRepository(Address::class)
                ->findOneById($req->get('address'));

            $account->setEmail($req->get('email'));
            $account->setPassword(password_hash($req->get('password'), PASSWORD_DEFAULT));
            $account->setIdRole($role);

            $AccountError = $validator->validate($account);


            $patient->setSurname($req->get('surname'));
            $patient->setName($req->get('name'));
            $patient->setPassport($req->get('passport'));
            $patient->setPolicy($req->get('policy'));
            $patient->setBirth(new \DateTime($req->get('birth')));
            $patient->setIdAddress($address);
            $patient->setIdAccount($account);

            $PatientError = $validator->validate($patient);
            $errors = $AccountError;
            if(count($PatientError) > 0)
                $errors = $PatientError;
            if(count($errors) > 0)
                return $this->render('sign_up/index.html.twig', [
                    'controller_name' => 'SignUpController',
                    'Title' => 'Регистрация',
                    'Address' => $this->getAddress(),
                    'ValidateError' => $errors
                ]);

            $entityManager->persist($account);
            $entityManager->flush();
            $entityManager->persist($patient);
            $entityManager->flush();

            $this->session->set('Account', [$account, $patient]);
            return $this->redirect('/profile');
        }
        return $this->redirect('/sign/up/get?error=Csrf token invalid');
    }

    /**
     * @Route("/sign/up/get", name="SignUpGet", methods={"GET"})
     */
    public function getSignUp(Request $req, ValidatorInterface $validator)
    {
        $errors = $req->get('error');
        return $this->render('sign_up/index.html.twig', [
            'controller_name' => 'SignUpController',
            'Title' => 'Регистрация',
            'Address' => $this->getAddress(),
            'Error' => $errors,
        ]);
    }

    private function getAddress()
    {
        return $this->getDoctrine()
            ->getRepository(Address::class)
            ->findAll();
    }
}
