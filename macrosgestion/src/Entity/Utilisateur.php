<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?int $poid = null;

    #[ORM\Column]
    private ?int $taille = null;

    /**
     * @var Collection<int, Plats>
     */
    #[ORM\OneToMany(targetEntity: Plats::class, mappedBy: 'utilisateur')]
    private Collection $Plats;

    public function __construct()
    {
        $this->Plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getPoid(): ?int
    {
        return $this->poid;
    }

    public function setPoid(int $poid): static
    {
        $this->poid = $poid;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Plats>
     */
    public function getPlats(): Collection
    {
        return $this->Plats;
    }

    public function addPlat(Plats $plat): static
    {
        if (!$this->Plats->contains($plat)) {
            $this->Plats->add($plat);
            $plat->setUtilisateur($this);
        }

        return $this;
    }

    public function removePlat(Plats $plat): static
    {
        if ($this->Plats->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getUtilisateur() === $this) {
                $plat->setUtilisateur(null);
            }
        }

        return $this;
    }
}
