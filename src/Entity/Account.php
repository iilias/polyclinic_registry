<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Account
 *
 * @ORM\Table(name="account", indexes={@ORM\Index(name="id_role", columns={"id_role"})})
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
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
     * @ORM\Column(name="Email", type="string", length=55, nullable=false)
     * @Assert\Email(
     *      message = "Почта '{{ value }}' не является настоящей."
     * )
     * @Assert\NotBlank(message="Email: значение не должно быть пустым")
     * @Assert\Length(
     *     min = 5,
     *     max = 55,
     *     minMessage = "Email должнен содержать минимум 1 символ",
     *     maxMessage = "Email должнен содержать максимум 55 символов",
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id")
     * })
     */
    private $idRole;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdRole(): ?Role
    {
        return $this->idRole;
    }

    public function setIdRole(?Role $idRole): self
    {
        $this->idRole = $idRole;

        return $this;
    }


}
