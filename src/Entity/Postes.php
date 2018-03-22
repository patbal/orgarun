<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostesRepository")
 */
class Postes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Benevole", mappedBy="affectation")
     */
    private $membres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipes", inversedBy="compositionEquipe")
     */
    private $equipe;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * @return Collection|Benevole[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Benevole $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
            $membre->setAffectation($this);
        }

        return $this;
    }

    public function removeMembre(Benevole $membre): self
    {
        if ($this->membres->contains($membre)) {
            $this->membres->removeElement($membre);
            // set the owning side to null (unless already changed)
            if ($membre->getAffectation() === $this) {
                $membre->setAffectation(null);
            }
        }

        return $this;
    }

    public function getEquipe(): ?Equipes
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipes $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
}
