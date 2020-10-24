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
use App\Entity\Reception;
use App\Entity\Patient;

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
    public function receptDate($id, Request $req)
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

        $day = date('w');
        // Получаю дату предыдущего
        // воскресенья
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        // Дата предыдущего воскресенья
        // + 1 день ( Дата текущего понедельника )
        $next_date = date("Y-m-d", strtotime($week_start.'+ 1 days'));

        // Если тек. день суббота или воскресенье ->
        // расписание на следующую неделю
        if(date('w') == 6 || date('w') == 7)
        {
            $date = strtotime("next monday");
            $next_date = date('Y-m-d', $date);
        }

        $days_array = array();
        foreach ($days as $day)
        {

            $days_array += [$day->getId() => $next_date];
            // Увеличить дату на 1 день
            $next_date = date("Y-m-d", strtotime($next_date.'+ 1 days'));
        }


        $timelist = array();
        foreach ($timetables as $time)
        {
            // Разбдробить промежуток из бд
            // на каждые 15 минут
            $arr_of_time = $this->getArrayTime(
                $time->getBegin()->format('H:i'),
                $time->getEnd()->format('H:i'));

            if(
                ($days_array[$time->getIdDays()->getId()]
                    <
                    date('Y-m-d')
                )
            )
                continue;

            // Для каждого времени записи
            // если в бд уже есть записть на это
            // время -> удалить элемент
            foreach ($arr_of_time as $key => $currentTime)
            {
                $currentDateReception = $this->getDoctrine()
                    ->getRepository(Reception::class)
                    ->findOneByDateTime(
                        $days_array[$time->getIdDays()->getId()],
                        $currentTime,
                        $empl->getId());
                if(isset($currentDateReception))
                    unset($arr_of_time[$key]);
            }


            // Список из номера дня и списка
            // промежутков
            $timelist += [$time->getIdDays()->getId() => $arr_of_time];
        }


        $editMode = false;
        $idEdit = 0;
        if(!empty($req->get('Edit')))
        {
            $editMode = true;
            $idEdit = $req->get('Edit');
        }


        return $this->render('reception/recept.html.twig', [
            'controller_name' => 'ReceptionController',
            'Title' => 'Выбор времени приема',
            'Employee' => $empl,
            'Days' => $days,
            'TimeList' => $timelist,
            'DaysArray' => $days_array,
            'EditMode' => $editMode,
            'ToEdit' => $idEdit
        ]);
    }

    /**
     * @Route("/reception/date/{date}/time/{time}/empl/{empl}", name="Recept")
     */
    public function receptPatient($date, $time, $empl, Request $req)
    {
    	if (!isset($this->session->get('Account')[0]))
            return $this->redirect('/sign/in/');

        if($req->get('Edit') == true)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $reception = $this->getDoctrine()
                ->getRepository(Reception::class)
                ->findById($req->get('ReceptId'));
            $entityManager->remove($reception);
            $entityManager->flush();
        }

        $employee = $this->getDoctrine()
            ->getRepository(Employee::class)
            ->findById($empl);


        $entityManager = $this->getDoctrine()->getManager();
        $reception = new Reception();
        $reception->setDate(new \DateTime($date));
        $reception->setTime(\DateTime::createFromFormat('H:i', $time));
        $reception->setIdPatient($this->getDoctrine()
            ->getRepository(Patient::class)
            ->findOneByAccountId($this->session->get('Account')[1]->getIdAccount()));
        $reception->setIdEmployee($employee);
        $reception->setVisited(0);
        $entityManager->persist($reception);
        $entityManager->flush();
    	return $this->redirect('/profile/');
    }

    /**
     * @Route("/reception/delete/{id}", name="ReceptionDelete")
     */
    public function deleteReception($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reception = $this->getDoctrine()
            ->getRepository(Reception::class)
            ->findById($id);
        $entityManager->remove($reception);
        $entityManager->flush();
        return $this->redirect('/profile/');
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
