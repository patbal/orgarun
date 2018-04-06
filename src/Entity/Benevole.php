<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BenevoleRepository")
 */
class Benevole
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $numeroPermisConduire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Postes", inversedBy="membres")
     */
    private $affectation;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Postes", inversedBy="chefDePoste")
     */
    private $postesEnCharge;


    /**
     * Benevole constructor.
     */
    public function __construct()
    {
        $this->dateInscription = new \DateTime();
        $this->nom = 'Doe';
        $this->prenom = 'John';
        $this->postesEnCharge = new ArrayCollection();
    }


    /**
     * @return mixed
     */
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumeroPermisConduire(): ?string
    {
        return $this->numeroPermisConduire;
    }

    public function setNumeroPermisConduire(?string $numeroPermisConduire): self
    {
        $this->numeroPermisConduire = $numeroPermisConduire;

        return $this;
    }

    public function getAffectation(): ?Postes
    {
        return $this->affectation;
    }

    public function setAffectation(?Postes $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Postes[]
     */
    public function getPostesEnCharge(): Collection
    {
        return $this->postesEnCharge;
    }

    public function addPostesEnCharge(Postes $postesEnCharge): self
    {
        if (!$this->postesEnCharge->contains($postesEnCharge)) {
            $this->postesEnCharge[] = $postesEnCharge;
        }

        return $this;
    }

    public function removePostesEnCharge(Postes $postesEnCharge): self
    {
        if ($this->postesEnCharge->contains($postesEnCharge)) {
            $this->postesEnCharge->removeElement($postesEnCharge);
        }

        return $this;
    }


}
