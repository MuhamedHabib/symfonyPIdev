<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FileRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * File
 *
 * @ORM\Table(name="file", indexes={@ORM\Index(name="fkey", columns={"id"})})
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_file", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFile;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=111, nullable=true)
     */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var UploadedFile
     */
    private $myFile;

    /**
     * @ORM\ManyToOne(targetEntity=Myformation::class, inversedBy="files")
     * @ORM\JoinColumn(name="id" , nullable=false)
     */
    private $id;



    public function getIdFile(): ?int
    {
        return $this->idFile;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getMyFile(): UploadedFile
    {
        return $this->myFile;
    }

    /**
     * @param UploadedFile $myFile
     */
    public function setMyFile(UploadedFile $myFile): void
    {
        $this->myFile = $myFile;
    }


    public function getId(): ?Myformation
    {
        return $this->id;
    }

    public function setId(?Myformation $id): self
    {
        $this->id = $id;

        return $this;
    }




}
