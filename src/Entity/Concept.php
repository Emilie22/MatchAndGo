<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConceptRepository")
 */
class Concept
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleConcept;

    /**
     * @ORM\Column(type="text")
     */
    private $contentConcept;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pictureConcept;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleConcept(): ?string
    {
        return $this->titleConcept;
    }

    public function setTitleConcept(string $titleConcept): self
    {
        $this->titleConcept = $titleConcept;

        return $this;
    }

    public function getContentConcept(): ?string
    {
        return $this->contentConcept;
    }

    public function setContentConcept(string $contentConcept): self
    {
        $this->contentConcept = $contentConcept;

        return $this;
    }

    public function getPictureConcept(): ?string
    {
        return $this->pictureConcept;
    }

    public function setPictureConcept(string $pictureConcept): self
    {
        $this->pictureConcept = $pictureConcept;

        return $this;
    }
}
