<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocRepository")
 */
class Doc
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Postes", mappedBy="docs")
     */
    private $poste;

    public function __construct()
    {
        $this->poste = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Postes[]
     */
    public function getPoste(): Collection
    {
        return $this->poste;
    }

    public function addPoste(Postes $poste): self
    {
        if (!$this->poste->contains($poste)) {
            $this->poste[] = $poste;
            $poste->addDoc($this);
        }

        return $this;
    }

    public function removePoste(Postes $poste): self
    {
        if ($this->poste->contains($poste)) {
            $this->poste->removeElement($poste);
            $poste->removeDoc($this);
        }

        return $this;
    }
}
