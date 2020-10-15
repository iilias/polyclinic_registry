<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Table(name="results", uniqueConstraints={@ORM\UniqueConstraint(name="id_procedures", columns={"id_procedures"}), @ORM\UniqueConstraint(name="id_reception", columns={"id_reception"}), @ORM\UniqueConstraint(name="id_analyzes", columns={"id_analyzes"})})
 * @ORM\Entity(repositoryClass="App\Repository\ResultsRepository")
 */
class Results
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
     * @var \Analyzes
     *
     * @ORM\ManyToOne(targetEntity="Analyzes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_analyzes", referencedColumnName="id")
     * })
     */
    private $idAnalyzes;

    /**
     * @var \Procedures
     *
     * @ORM\ManyToOne(targetEntity="Procedures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_procedures", referencedColumnName="id")
     * })
     */
    private $idProcedures;

    /**
     * @var \Reception
     *
     * @ORM\ManyToOne(targetEntity="Reception")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reception", referencedColumnName="id")
     * })
     */
    private $idReception;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnalyzes(): ?Analyzes
    {
        return $this->idAnalyzes;
    }

    public function setIdAnalyzes(?Analyzes $idAnalyzes): self
    {
        $this->idAnalyzes = $idAnalyzes;

        return $this;
    }

    public function getIdProcedures(): ?Procedures
    {
        return $this->idProcedures;
    }

    public function setIdProcedures(?Procedures $idProcedures): self
    {
        $this->idProcedures = $idProcedures;

        return $this;
    }

    public function getIdReception(): ?Reception
    {
        return $this->idReception;
    }

    public function setIdReception(?Reception $idReception): self
    {
        $this->idReception = $idReception;

        return $this;
    }


}
