<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Intl\Intl;

/**
 * @ORM\Entity(repositoryClass=PlatRepository::class)
 */
class Plat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CategoriePlat::class, inversedBy="plats")
     */
    private $idCategorie;

    /**
     * @ORM\OneToMany(targetEntity=PlatCommande::class, mappedBy="idPlat")
     */
    private $platCommandes;

    /**
     * @ORM\Column(type="bigint")
     */
    private int $prix;

    public function __construct()
    {
        $this->platCommandes = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdCategorie(): ?CategoriePlat
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?CategoriePlat $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @return Collection|PlatCommande[]
     */
    public function getPlatCommandes(): Collection
    {
        return $this->platCommandes;
    }

    public function addPlatCommande(PlatCommande $platCommande): self
    {
        if (!$this->platCommandes->contains($platCommande)) {
            $this->platCommandes[] = $platCommande;
            $platCommande->setIdPlat($this);
        }

        return $this;
    }

    public function removePlatCommande(PlatCommande $platCommande): self
    {
        if ($this->platCommandes->removeElement($platCommande)) {
            // set the owning side to null (unless already changed)
            if ($platCommande->getIdPlat() === $this) {
                $platCommande->setIdPlat(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
