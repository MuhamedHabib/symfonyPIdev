<?php

namespace App\Entity;
use App\Repository\EventsRespository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Events
 *
 * @ORM\Table(name="events")
 *  @ORM\Entity(repositoryClass=EventsRespository::class)
 */
class Events
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")

     */
    private $idEvent;

    /**
     * @var string
     * @ORM\Column(name="nom_event", type="string", length=99, nullable=false)

     */
    private $nomEvent;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_deb", type="date", nullable=false)

     */
    private $dateDeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)

     */
    private $dateFin;

    /**
     * @var int
     * @ORM\Column(name="nbr_place", type="integer", nullable=false)
     *  @Assert\NotBlank(message="Remplir le nbr de place")
     */
    private $nbrPlace;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="events",cascade={"persist"})
     *


     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="events",cascade={"All"},orphanRemoval=true)

     */
    private $participations;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="events")
     *  @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     */
    private $personnes;

    /**
     * @ORM\Column(type="string", length=255)

     */
    private $image;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setEvents($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getEvents() === $this) {
                $participation->setEvents(null);
            }
        }

        return $this;
    }

    public function getPersonnes(): ?Personne
    {
        return $this->personnes;
    }

    public function setPersonnes(?Personne $personnes): self
    {
        $this->personnes = $personnes;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }




}
