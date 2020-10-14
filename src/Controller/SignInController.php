<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
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
}
