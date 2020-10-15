<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Destination
 *
 * @ORM\Table(name="destination", uniqueConstraints={@ORM\UniqueConstraint(name="id_reception", columns={"id_reception"}), @ORM\UniqueConstraint(name="id_medicines", columns={"id_medicines"})})
 * @ORM\Entity
 */
class Destination
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
     * @var \Medicines
     *
     * @ORM\ManyToOne(targetEntity="Medicines")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medicines", referencedColumnName="id")
     * })
     */
    private $idMedicines;

    /**
     * @var \Reception
     *
     * @ORM\ManyToOne(targetEntity="Reception")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reception", referencedColumnName="id")
     * })
     */
    private $idReception;


}
