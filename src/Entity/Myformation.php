<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MyformationRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * Myformation
 *
 * @ORM\Table(name="myformation")
 * @ORM\Entity(repositoryClass=MyformationRepository::class)
 *
 */
class Myformation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups ({"show_formation"})
     */
    private $id;

    /**
     * @var string
     *@Assert\Length (
     * min="7",
     * minMessage="doit contenir au moins {{limit}} caractères"
     * )
     * @ORM\Column(name="libelle", type="string", length=100, nullable=false)
     * @Groups ({"show_formation"})
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     * @Assert\NotBlank (message="doit etre n'est pas vide, veuilllez remplir ce champ")
     * @Groups ({"show_formation"})
     */
    private $description;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     * @Groups ({"show_formation"})
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=99, nullable=false)
     * @Groups ({"show_formation"})
     */
    private $type;

    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Upload your image")
     * @Assert\File(mimeTypes={ "image/png", "image/jpeg" })
     * @Groups ({"show_formation"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=File::class, mappedBy="myformation" ,cascade={"persist"})
     */
    private $brochureFilename;

    public function __construct()
    {
        $this->brochureFilename = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
     * @return DateTime
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    /**
     * @param DateTime $dateCreation
     */
    public function setDateCreation(DateTime $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }



    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    /**
     * @return Collection|File[]
     */
    public function getBrochureFilename(): Collection
    {
        return $this->brochureFilename;
    }

    public function addBrochureFilename(File $brochureFilename): self
    {
        if (!$this->brochureFilename->contains($brochureFilename)) {
            $this->brochureFilename[] = $brochureFilename;
            $brochureFilename->setMyformation($this);
        }

        return $this;
    }

    public function removeBrochureFilename(File $brochureFilename): self
    {
        if ($this->brochureFilename->removeElement($brochureFilename)) {
            // set the owning side to null (unless already changed)
            if ($brochureFilename->getMyformation() === $this) {
                $brochureFilename->setMyformation(null);
            }
        }

        return $this;
    }










}
