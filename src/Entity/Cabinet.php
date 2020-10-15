<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cabinet
 *
 * @ORM\Table(name="cabinet")
 * @ORM\Entity
 */
class Cabinet
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
     * @ORM\Column(name="Number", type="integer", nullable=false)
     */
    private $number;


}
