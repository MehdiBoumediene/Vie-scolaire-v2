<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NotesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NotesRepository::class)
 */
class Notes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=false)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etudiantid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moduleid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intervenantid;





    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getEtudiantid(): ?string
    {
        return $this->etudiantid;
    }

    public function setEtudiantid(?string $etudiantid): self
    {
        $this->etudiantid = $etudiantid;

        return $this;
    }

    public function getModuleid(): ?string
    {
        return $this->moduleid;
    }

    public function setModuleid(?string $moduleid): self
    {
        $this->moduleid = $moduleid;

        return $this;
    }

    public function getIntervenantid(): ?string
    {
        return $this->intervenantid;
    }

    public function setIntervenantid(?string $intervenantid): self
    {
        $this->intervenantid = $intervenantid;

        return $this;
    }



    
}
