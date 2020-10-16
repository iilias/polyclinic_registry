<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quarter
 *
 * @ORM\Table(name="quarter")
 * @ORM\Entity(repositoryClass="App\Repository\QuarterRepository")
 */
class Quarter
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
     * @ORM\Column(name="Number", type="string", length=11, nullable=false)
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
