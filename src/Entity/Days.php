<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Days
 *
 * @ORM\Table(name="days")
 * @ORM\Entity
 */
class Days
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


}
