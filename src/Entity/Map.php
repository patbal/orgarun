<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 */
class Map
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
    private $lat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lng;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Postes", mappedBy="map", cascade={"persist", "remove"})
     */
    private $poste;

    public function getId()
    {
        return $this->id;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(?string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getPoste(): ?Postes
    {
        return $this->poste;
    }

    public function setPoste(?Postes $poste): self
    {
        $this->poste = $poste;

        // set (or unset) the owning side of the relation if necessary
        $newMap = $poste === null ? null : $this;
        if ($newMap !== $poste->getMap()) {
            $poste->setMap($newMap);
        }

        return $this;
    }
}
