<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRespository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 *  @ORM\Entity(repositoryClass=CategorieRespository::class)
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nomcategorie", type="string", length=30, nullable=false)
     * @Assert\NotBlank(message="Remplir le nom de catgeorie")
     */
    private $nomcategorie;

    /**
     * @var string
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     * @Assert\NotBlank(message="Remplir la description")
     * @Assert\Length(
     *     min="10",
     *     max="100",
     *     minMessage="Doit contenir {{ limit }} caractéres",
     *     maxMessage="Ne doit pas dépasser {{ limit }} caractéres",
     *     )
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Events::class, mappedBy="categorie" ,cascade={"All"},orphanRemoval=true)

     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomcategorie(string $nomcategorie): self
    {
        $this->nomcategorie = $nomcategorie;

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

    /**
     * @return Collection|Events[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Events $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCategorie($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCategorie() === $this) {
                $event->setCategorie(null);
            }
        }

        return $this;
    }

}