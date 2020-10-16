<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", indexes={@ORM\Index(name="id_specialty", columns={"id_specialty"}), @ORM\Index(name="id_account", columns={"id_account"})})
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
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
     * @var string
     *
     * @ORM\Column(name="Surname", type="string", length=25, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=25, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Patronymic", type="string", length=25, nullable=false)
     */
    private $patronymic;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="text", length=65535, nullable=false)
     */
    private $phone;

    /**
     * @var \Account
     *
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_account", referencedColumnName="id")
     * })
     */
    private $idAccount;

    /**
     * @var \Specialty
     *
     * @ORM\ManyToOne(targetEntity="Specialty")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_specialty", referencedColumnName="id")
     * })
     */
    private $idSpecialty;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getIdAccount(): ?Account
    {
        return $this->idAccount;
    }

    public function setIdAccount(?Account $idAccount): self
    {
        $this->idAccount = $idAccount;

        return $this;
    }

    public function getIdSpecialty(): ?Specialty
    {
        return $this->idSpecialty;
    }

    public function setIdSpecialty(?Specialty $idSpecialty): self
    {
        $this->idSpecialty = $idSpecialty;

        return $this;
    }


}
