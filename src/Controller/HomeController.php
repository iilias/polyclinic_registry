<?php

namespace App\Controller;

use mysql_xdevapi\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Specialty;

class HomeController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="HomePage")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'Title' => 'Главная',
            'specialtys' => $this->getSpecialty(),
        ]);
    }

    public function getSpecialty()
    {
        return $this->getDoctrine()
        ->getRepository(Specialty::class)
        ->findAll();
    }
}
