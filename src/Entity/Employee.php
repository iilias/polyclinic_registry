<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", uniqueConstraints={@ORM\UniqueConstraint(name="id_specialty", columns={"id_specialty"}), @ORM\UniqueConstraint(name="id_account", columns={"id_account"})})
 * @ORM\Entity
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


}
