<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Employee;

class ReceptionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    /**
     * @Route("/reception", name="Reception")
     */
    public function index()
    {
        if(!isset($this->session->get('Account')[0]))
            return $this->redirect('/sign/in/');

        return $this->render('reception/index.html.twig', [
            'controller_name' => 'ReceptionController',
            'Title' => 'Запись на прием',
            'Employees' => $this->getEmployees(),
        ]);
    }

    private function getEmployees()
    {
        return $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findAll();
    }
}
