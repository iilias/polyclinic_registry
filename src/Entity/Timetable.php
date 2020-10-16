<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetable
 *
 * @ORM\Table(name="timetable", indexes={@ORM\Index(name="id_employee", columns={"id_employee"}), @ORM\Index(name="id_days", columns={"id_days"}), @ORM\Index(name="id_cabinet", columns={"id_cabinet"})})
 * @ORM\Entity(repositoryClass="App\Repository\TimetableRepository")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBegin(): ?\DateTimeInterface
    {
        return $this->begin;
    }

    public function setBegin(\DateTimeInterface $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getIdCabinet(): ?Cabinet
    {
        return $this->idCabinet;
    }

    public function setIdCabinet(?Cabinet $idCabinet): self
    {
        $this->idCabinet = $idCabinet;

        return $this;
    }

    public function getIdDays(): ?Days
    {
        return $this->idDays;
    }

    public function setIdDays(?Days $idDays): self
    {
        $this->idDays = $idDays;

        return $this;
    }

    public function getIdEmployee(): ?Employee
    {
        return $this->idEmployee;
    }

    public function setIdEmployee(?Employee $idEmployee): self
    {
        $this->idEmployee = $idEmployee;

        return $this;
    }


}
