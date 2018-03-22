<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipesRepository")
 */
class Equipes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Postes", mappedBy="equipe")
     */
    private $compositionEquipe;

    public function __construct()
    {
        $this->compositionEquipe = new ArrayCollection();
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

    /**
     * @return Collection|Postes[]
     */
    public function getCompositionEquipe(): Collection
    {
        return $this->compositionEquipe;
    }

    public function addCompositionEquipe(Postes $compositionEquipe): self
    {
        if (!$this->compositionEquipe->contains($compositionEquipe)) {
            $this->compositionEquipe[] = $compositionEquipe;
            $compositionEquipe->setEquipe($this);
        }

        return $this;
    }

    public function removeCompositionEquipe(Postes $compositionEquipe): self
    {
        if ($this->compositionEquipe->contains($compositionEquipe)) {
            $this->compositionEquipe->removeElement($compositionEquipe);
            // set the owning side to null (unless already changed)
            if ($compositionEquipe->getEquipe() === $this) {
                $compositionEquipe->setEquipe(null);
            }
        }

        return $this;
    }
}
