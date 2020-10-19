<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReceptionController extends AbstractController
{
    /**
     * @Route("/reception", name="Reception")
     */
    public function index()
    {
        return $this->render('reception/index.html.twig', [
            'controller_name' => 'ReceptionController',
            'Title' => 'Запись на прием',
        ]);
    }
}
