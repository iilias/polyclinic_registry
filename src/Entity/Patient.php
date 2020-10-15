<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table(name="patient", uniqueConstraints={@ORM\UniqueConstraint(name="id_address", columns={"id_address"}), @ORM\UniqueConstraint(name="id_account", columns={"id_account"})})
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
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
     * @ORM\Column(name="Passport", type="text", length=65535, nullable=false)
     */
    private $passport;

    /**
     * @var string
     *
     * @ORM\Column(name="Policy", type="text", length=65535, nullable=false)
     */
    private $policy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Birth", type="date", nullable=false)
     */
    private $birth;

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
     * @var \Address
     *
     * @ORM\ManyToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_address", referencedColumnName="id")
     * })
     */
    private $idAddress;

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

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(string $passport): self
    {
        $this->passport = $passport;

        return $this;
    }

    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    public function setPolicy(string $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    public function getBirth(): ?\DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(\DateTimeInterface $birth): self
    {
        $this->birth = $birth;

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

    public function getIdAddress(): ?Address
    {
        return $this->idAddress;
    }

    public function setIdAddress(?Address $idAddress): self
    {
        $this->idAddress = $idAddress;

        return $this;
    }


}
