<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProfileController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/profile", name="Profile")
     */
    public function index()
    {
        if(!isset($this->session->get('Account')[0]))
            return $this->redirect('/sign/in/');
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'Title' => 'Личный кабинет',
            'Account' => $this->session->get('Account'),
        ]);
    }
}
