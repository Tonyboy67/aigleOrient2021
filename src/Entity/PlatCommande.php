<?php

namespace App\Entity;

use App\Repository\PlatCommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatCommandeRepository::class)
 */
class PlatCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Plat::class, inversedBy="platCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPlat;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="platCommandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommande;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $assaisonnement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuisson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPlat(): ?Plat
    {
        return $this->idPlat;
    }

    public function setIdPlat(?Plat $idPlat): self
    {
        $this->idPlat = $idPlat;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commande $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAssaisonnement(): ?string
    {
        return $this->assaisonnement;
    }

    public function setAssaisonnement(?string $assaisonnement): self
    {
        $this->assaisonnement = $assaisonnement;

        return $this;
    }

    public function getCuisson(): ?string
    {
        return $this->cuisson;
    }

    public function setCuisson(?string $cuisson): self
    {
        $this->cuisson = $cuisson;

        return $this;
    }
}
