<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
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
     * @ORM\OneToMany(targetEntity=Codepostal::class, mappedBy="villes",cascade={"persist"})
     */
    private $codepostale;

    public function __construct()
    {
        $this->codepostale = new ArrayCollection();
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

    /**
     * @return Collection<int, Codepostal>
     */
    public function getCodepostale(): Collection
    {
        return $this->codepostale;
    }

    public function addCodepostale(Codepostal $codepostale): self
    {
        if (!$this->codepostale->contains($codepostale)) {
            $this->codepostale[] = $codepostale;
            $codepostale->setVilles($this);
        }

        return $this;
    }

    public function removeCodepostale(Codepostal $codepostale): self
    {
        if ($this->codepostale->removeElement($codepostale)) {
            // set the owning side to null (unless already changed)
            if ($codepostale->getVilles() === $this) {
                $codepostale->setVilles(null);
            }
        }

        return $this;
    }
}
