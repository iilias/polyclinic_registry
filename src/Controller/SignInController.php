<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Patient;
use App\Entity\Employee;
use App\Entity\Account;
use App\Entity\Role;
use App\Entity\Address;

class SignInController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/sign/in", name="SignIn")
     */
    public function index()
    {
        return $this->render('sign_in/index.html.twig', [
            'controller_name' => 'SignInController',
            'Title' => 'Вход',
        ]);
    }

    /**
     * @Route("/sign/in/post", name="SignInPost", methods={"POST"})
     */
    public function postSignIn(Request $req, ValidatorInterface $validator)
    {
        // Check form validation
        $submittedToken = $req->request->get('token');
        if($this->isCsrfTokenValid('signinme', $submittedToken))
        {
            $account = $this->getDoctrine()
                    ->getRepository(Account::class)
                    ->findOneByEmail($req->get('email'));

            if(!isset($account))
                return $this->redirect('/sign/in/get?error=Неверная почта или пароль');

            $user = $this->getDoctrine()
                ->getRepository(Patient::class)
                ->findOneByAccountId($account->getId());

            if($account->getIdRole()->getTitle() == 'Врач')
            {
                $user = $this->getDoctrine()
                    ->getRepository(Employee::class)
                    ->findOneByAccountId($account->getId());
            }

            $entityManager = $this->getDoctrine()->getManager();

            $password = $req->get('password');
            if(password_verify($password, $account->getPassword()))
            {
                $this->session->set('Account', [$account, $user]);
                return $this->redirect('/profile');
            }
            return $this->redirect('/sign/in/get?error=Неверная почта или пароль');       
        }
        return $this->redirect('/sign/in/get?error=Csrf token invalid');
    }

    /**
     * @Route("/sign/in/get", name="SignInGet", methods={"GET"})
     */
    public function getSignIn(Request $req, ValidatorInterface $validator)
    {
        $errors = $req->get('error');
        return $this->render('sign_in/index.html.twig', [
            'controller_name' => 'SignInController',
            'Title' => 'Вход',
            'Error' => $errors,
        ]);
    }
}
