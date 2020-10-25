<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Entity\Reception;
use App\Entity\Timetable;
use App\Entity\Days;
use App\Entity\Results;
use App\Entity\Destination;

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
        if($this->session->get('Account')[0]->getIdRole()->getTitle() == 'Врач')
            return $this->redirect('/profile/employee/');

        $receptions = $this->getDoctrine()
            ->getRepository(Reception::class)
            ->findByPatientId($this->session->get('Account')[1]->getId());


        $days = $this->getDoctrine()
            ->getRepository(Days::class)
            ->findAll();


        $daysTitles = [];
        // Список дней из бд
        foreach ($days as $day)
            array_push($daysTitles, $day->getTitle());


        $recordsCount = 0;
        $visitsCount = 0;
        $cabinets = [];
        $results = [];
        $destinations = [];
        foreach ($receptions as $key => $recept)
        {
            if ($recept->getDate()->format('Y-m-d') < date('Y-m-d'))
            {
                $this->getDoctrine()
                    ->getRepository(Reception::class)
                    ->updateVisitStatus($recept->getId(), true);
                $receptions[$key]->setVisited(true);
            }
            if($recept->getVisited())
                $visitsCount++;
            else
                $recordsCount++;

            // Номер дня из бд по дате приема
            $dayId = $this->getDoctrine()
                ->getRepository(Days::class)
                ->findOneByTitle($daysTitles[ date('w', strtotime($recept->getDate()->format('Y-m-d') ) - 1) ]);
            // Поиск кабинета по номеру дня и сотруднику
            $current_cabinet = $this->getDoctrine()
                ->getRepository(Timetable::class)
                ->findByIdDayEmployee($recept->getIdEmployee()->getId(), $dayId->getId());
            // номер приема -> кабинет
            $cabinets += [$recept->getId() => $current_cabinet[0]->getIdCabinet()->getNumber()];


            $results +=
                [
                    $recept->getId() =>
                    $this->getDoctrine()
                         ->getRepository(Results::class)
                         ->findAllByIdReception($recept->getId())
                ];


            $destinations +=
                [
                    $recept->getId() =>
                    $this->getDoctrine()
                         ->getRepository(Destination::class)
                         ->findAllByIdReception($recept->getId())
                ];
        }


        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'Title' => 'Личный кабинет',
            'Account' => $this->session->get('Account'),
            'Receptions' => $receptions,
            'Cabinets' => $cabinets,
            'Visits' => $visitsCount,
            'Records' => $recordsCount,
            'Results' => $results,
            'Destinations' => $destinations
        ]);
    }

    /**
     * @Route("/profile/employee", name="ProfileEmployee")
     */
    public function employeeProfile()
    {
        if(!isset($this->session->get('Account')[0]))
            return $this->redirect('/sign/in/');
        if($this->session->get('Account')[0]->getIdRole()->getTitle() == 'Пациент')
            return $this->redirect('/profile/');


        $receptions = $this->getDoctrine()
            ->getRepository(Reception::class)
            ->findByEmployeeId($this->session->get('Account')[1]->getId());

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'Title' => 'Личный кабинет сотрудника',
            'Account' => $this->session->get('Account'),
            'Receptions' => $receptions,
        ]);
    }

    /**
     * @Route("/profile/report/{id}/{cabinet}", name="ReceptionTicket")
     */
    public function getTicket($id, $cabinet)
    {
        $reception = $this->getDoctrine()
            ->getRepository(Reception::class)
            ->findById($id);



        $f = fopen('tmp.csv', "w");
        fputs($f, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($f, ["ОГБУЗ", "'Магнитогорская'"], ';');
        fputcsv($f, ["Городская", "поликлиника", "№1"], ';');
        fputcsv($f, [""], ';');
        fputcsv($f, ['Дата приема:', $reception->getDate()->format('d.m.Y')], ';');
        fputcsv($f, ['Время приема:', $reception->getTime()->format('H:i')], ';');
        fputcsv($f, ['ФИО:', $reception->getIdPatient()->getSurname(), $reception->getIdPatient()->getName(), $reception->getIdPatient()->getPatronymic()], ';');
        fputcsv($f, ["Услуга:", "Прием врача", $reception->getIdEmployee()->getIdSpecialty()->getTitle().'a'], ';');
        fputcsv($f, ["Врач:", $reception->getIdEmployee()->getSurname(), $reception->getIdEmployee()->getName(), $reception->getIdEmployee()->getPatronymic()], ';');
        fputcsv($f, ["Кабинет:", $cabinet], ';');

        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type('tmp.csv'));
        $response->headers->set('Content-Disposition', 'attachment; filename="tmp.csv";');
        $response->headers->set('Content-length', filesize('tmp.csv'));

        $response->sendHeaders();
        $response->setContent(file_get_contents('tmp.csv'));
        fclose($f);
        return $response;
    }

    /**
     * @Route("/profile/report/all", name="ReceptionReport")
     */
    public function getReport()
    {
        $id = $this->getDoctrine()
            ->getRepository(Reception::class)
            ->findByPatientId($this->session->get('Account')[1]->getId());

        $f = fopen('tmp.csv', "w");
        fputs($f, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($f, ["ОГБУЗ", "'Магнитогорская'"], ';');
        fputcsv($f, ["Городская", "поликлиника", "№1"], ';');
        fputcsv($f, [""], ';');
        fputcsv($f, ["", "Отчет"], ';');
        fputcsv($f, [""], ';');
        foreach ($id as $reception)
        {
            fputcsv($f, [""], ';');
            fputcsv($f, ['Дата приема:', $reception->getDate()->format('d.m.Y')], ';');
            fputcsv($f, ['Время приема:', $reception->getTime()->format('H:i')], ';');
            fputcsv($f, ['ФИО:', $reception->getIdPatient()->getSurname(), $reception->getIdPatient()->getName(), $reception->getIdPatient()->getPatronymic()], ';');
            fputcsv($f, ["Услуга:", "Прием врача", $reception->getIdEmployee()->getIdSpecialty()->getTitle().'a'], ';');
            fputcsv($f, ["Врач:", $reception->getIdEmployee()->getSurname(), $reception->getIdEmployee()->getName(), $reception->getIdEmployee()->getPatronymic()], ';');


            $results = $this->getDoctrine()
                ->getRepository(Results::class)
                ->findAllByIdReception($reception->getId());
            $analyzesText = '';
            $proceduresText = '';
            foreach ($results as $result)
            {
                $analyzesText .= $result->getIdAnalyzes()->getTitle() . ', ';
                $proceduresText .= $result->getIdProcedures()->getTitle() . ', ';
            }
            fputcsv($f, ["Анализы:", $analyzesText], ';');
            fputcsv($f, ["Процедуры:", $proceduresText], ';');


            $destination = $this->getDoctrine()
                ->getRepository(Destination::class)
                ->findAllByIdReception($reception->getId());
            $medicinesText = "";
            foreach ($destination as $dest)
            {
                $medicinesText .= $dest->getIdMedicines()->getTitle() . ', ';
            }
            fputcsv($f, ["Лекарства:", $medicinesText], ';');
        }
        
        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type('tmp.csv'));
        $response->headers->set('Content-Disposition', 'attachment; filename="tmp.csv";');
        $response->headers->set('Content-length', filesize('tmp.csv'));

        $response->sendHeaders();
        $response->setContent(file_get_contents('tmp.csv'));
        fclose($f);
        return $response;
    }
}
