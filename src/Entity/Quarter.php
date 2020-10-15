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
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=25, nullable=false)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


}
