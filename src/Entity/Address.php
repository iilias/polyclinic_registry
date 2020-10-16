<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="id_quarter_2", columns={"id_quarter"})})
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIdQuarter(): ?Quarter
    {
        return $this->idQuarter;
    }

    public function setIdQuarter(?Quarter $idQuarter): self
    {
        $this->idQuarter = $idQuarter;

        return $this;
    }


}
