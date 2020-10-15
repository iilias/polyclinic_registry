<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetable
 *
 * @ORM\Table(name="timetable", uniqueConstraints={@ORM\UniqueConstraint(name="id_employee", columns={"id_employee"}), @ORM\UniqueConstraint(name="id_days", columns={"id_days"}), @ORM\UniqueConstraint(name="id_cabinet", columns={"id_cabinet"})})
 * @ORM\Entity
 */
class Timetable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Begin", type="time", nullable=false)
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="End", type="time", nullable=false)
     */
    private $end;

    /**
     * @var \Cabinet
     *
     * @ORM\ManyToOne(targetEntity="Cabinet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cabinet", referencedColumnName="id")
     * })
     */
    private $idCabinet;

    /**
     * @var \Days
     *
     * @ORM\ManyToOne(targetEntity="Days")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_days", referencedColumnName="id")
     * })
     */
    private $idDays;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_employee", referencedColumnName="id")
     * })
     */
    private $idEmployee;


}
