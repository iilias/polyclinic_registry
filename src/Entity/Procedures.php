<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procedures
 *
 * @ORM\Table(name="procedures")
 * @ORM\Entity
 */
class Procedures
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


}