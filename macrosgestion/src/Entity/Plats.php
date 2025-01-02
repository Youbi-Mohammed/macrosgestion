<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatsRepository::class)]
class Plats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_du_plat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_repas = null;

    #[ORM\ManyToOne(inversedBy: 'Plats')]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, Recette>
     */
    #[ORM\OneToMany(targetEntity: Recette::class, mappedBy: 'Plats')]
    private Collection $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    /**
     * @var Collection<int, Ingredient>
     */
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuPlat(): ?string
    {
        return $this->nom_du_plat;
    }

    public function setNomDuPlat(string $nom_du_plat): static
    {
        $this->nom_du_plat = $nom_du_plat;

        return $this;
    }

    public function getDateRepas(): ?\DateTimeInterface
    {
        return $this->date_repas;
    }

    public function setDateRepas(\DateTimeInterface $date_repas): static
    {
        $this->date_repas = $date_repas;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->setPlats($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getPlats() === $this) {
                $recette->setPlats(null);
            }
        }

        return $this;
    }
    
}
