<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reception
 *
 * @ORM\Table(name="reception", uniqueConstraints={@ORM\UniqueConstraint(name="id_diagnosis", columns={"id_diagnosis"}), @ORM\UniqueConstraint(name="id_patient", columns={"id_patient"}), @ORM\UniqueConstraint(name="id_employee", columns={"id_employee"})})
 * @ORM\Entity(repositoryClass="App\Repository\ReceptionRepository")
 */
class Reception
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
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var \Diagnosis
     *
     * @ORM\ManyToOne(targetEntity="Diagnosis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diagnosis", referencedColumnName="id")
     * })
     */
    private $idDiagnosis;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_employee", referencedColumnName="id")
     * })
     */
    private $idEmployee;

    /**
     * @var \Patient
     *
     * @ORM\ManyToOne(targetEntity="Patient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patient", referencedColumnName="id")
     * })
     */
    private $idPatient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getIdDiagnosis(): ?Diagnosis
    {
        return $this->idDiagnosis;
    }

    public function setIdDiagnosis(?Diagnosis $idDiagnosis): self
    {
        $this->idDiagnosis = $idDiagnosis;

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

    public function getIdPatient(): ?Patient
    {
        return $this->idPatient;
    }

    public function setIdPatient(?Patient $idPatient): self
    {
        $this->idPatient = $idPatient;

        return $this;
    }


}
