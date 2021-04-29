<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ParticipationRespository;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 *  @ORM\Entity(repositoryClass=ParticipationRespository::class)

 */
class Participation
{
    /**
     * @ORM\Column(name="id_participation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipation;

    /**
     * @ORM\ManyToOne(targetEntity=Events::class, inversedBy="participations",cascade={"persist"})
     *  @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     */
    private $events;

    /**
     * @ORM\ManyToOne(targetEntity=Personne::class, inversedBy="participations")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     */
    private $personnes;


    public function getEvents(): ?Events
    {
        return $this->events;
    }

    public function setEvents(?Events $events): self
    {
        $this->events = $events;

        return $this;
    }
    public function getIdParticipation(): ?int
    {
        return $this->idParticipation;
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

}
