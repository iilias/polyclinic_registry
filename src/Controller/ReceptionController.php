<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Employee;
use App\Entity\Specialty;
use App\Entity\Days;
use App\Entity\Timetable;

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
            'Specialtys' => $this->getSpecialty(),
        ]);
    }

    /**
     * @Route("/reception/find", name="ReceptionFind", methods={"POST"})
     */
    public function findEmployee(Request $req, ValidatorInterface $validator)
    {
        $submittedToken = $req->request->get('token');
        if($this->isCsrfTokenValid('findempl', $submittedToken))
        {
            if (!isset($this->session->get('Account')[0]))
                return $this->redirect('/sign/in/');


            $empl = $this->getDoctrine()
                ->getRepository(Employee::class)
                ->findMatchesBySpecialty($req->get('spc'), $req->get('empl-data'));

            // Если специальность не задана и
            // дополнительные данные не введены -> поиск всех сотрудников,
            // Иначе -> поиск сотрудников по совпадениям
            if ($req->get('spc') == 'Все специальности' and empty($req->get('empl-data')))
                $empl = $this->getEmployees();
            else if(!empty($req->get('empl-data')))
                $empl = $this->getDoctrine()
                    ->getRepository(Employee::class)
                    ->findMatches($req->get('empl-data'));


            return $this->render('reception/index.html.twig', [
                'controller_name' => 'ReceptionController',
                'Title' => 'Запись на прием',
                'Employees' => $empl,
                'Specialtys' => $this->getSpecialty(),
            ]);
        }
        return $this->redirect('/');
    }

    /**
     * @Route("/reception/date/{id}", name="ReceptionDate")
     */
    public function receptDate($id)
    {
        if (!isset($this->session->get('Account')[0]))
            return $this->redirect('/sign/in/');

        $empl = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findById($id);

        $days = $this->getDoctrine()
            ->getRepository(Days::class)
            ->findAll();

        $timetables = $this->getDoctrine()
            ->getRepository(Timetable::class)
            ->findByIdEmployee($id);

        $timelist = array();
        foreach ($timetables as $time)
        {
            $arr_of_time = $this->getArrayTime(
                $time->getBegin()->format('H:i'),
                $time->getEnd()->format('H:i'));
            $timelist = [$time->getIdDays()->getId() => $arr_of_time];
        }

        return $this->render('reception/recept.html.twig', [
            'controller_name' => 'ReceptionController',
            'Title' => 'Выбор времени приема',
            'Employee' => $empl,
            'Days' => $days,
            'TimeList' => $timelist,
        ]);
    }

    public function getArrayTime($beg, $end)
    {
        $array_of_time = array ();
        $start_time    = strtotime ($beg);
        $end_time      = strtotime ($end);

        $fifteen_mins  = 15 * 60;

        while ($start_time <= $end_time)
        {
            $array_of_time[] = date ("H:i", $start_time);
            $start_time += $fifteen_mins;
        }

        return $array_of_time;
    }

    private function getEmployees()
    {
        return $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findAll();
    }

    public function getSpecialty()
    {
        return $this->getDoctrine()
            ->getRepository(Specialty::class)
            ->findAll();
    }
}
