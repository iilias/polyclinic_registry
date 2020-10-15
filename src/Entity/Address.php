<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", uniqueConstraints={@ORM\UniqueConstraint(name="id_quarter", columns={"id_quarter"})})
 * @ORM\Entity
 */
class Address
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
     * @ORM\Column(name="Title", type="string", length=25, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="Number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var \Quarter
     *
     * @ORM\ManyToOne(targetEntity="Quarter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quarter", referencedColumnName="id")
     * })
     */
    private $idQuarter;


}
