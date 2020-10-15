<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cabinet
 *
 * @ORM\Table(name="cabinet")
 * @ORM\Entity(repositoryClass="App\Repository\CabinetRepository")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }


}
