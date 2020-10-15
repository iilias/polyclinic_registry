<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnosis
 *
 * @ORM\Table(name="diagnosis", uniqueConstraints={@ORM\UniqueConstraint(name="id_classification", columns={"id_classification"})})
 * @ORM\Entity
 */
class Diagnosis
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
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \ClassificationDiagnosis
     *
     * @ORM\ManyToOne(targetEntity="ClassificationDiagnosis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_classification", referencedColumnName="id")
     * })
     */
    private $idClassification;


}
