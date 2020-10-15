<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table(name="patient", uniqueConstraints={@ORM\UniqueConstraint(name="id_address", columns={"id_address"}), @ORM\UniqueConstraint(name="id_account", columns={"id_account"})})
 * @ORM\Entity
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


}
