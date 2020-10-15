<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassificationDiagnosis
 *
 * @ORM\Table(name="classification_diagnosis")
 * @ORM\Entity
 */
class ClassificationDiagnosis
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
     * @var int
     *
     * @ORM\Column(name="Title", type="integer", nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;


}
