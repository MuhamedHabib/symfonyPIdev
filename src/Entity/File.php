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
     * @ORM\Column(type="string")
     */
    private $myFile;

    /**
     * @ORM\ManyToOne(targetEntity=Myformation::class, inversedBy="brochureFilename")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $myformation;





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



    public function getMyformation(): ?Myformation
    {
        return $this->myformation;
    }

    public function setMyformation(?Myformation $myformation): self
    {
        $this->myformation = $myformation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMyFile()
    {
        return $this->myFile;
    }

    /**
     * @param mixed $myFile
     */
    public function setMyFile($myFile): void
    {
        $this->myFile = $myFile;
    }







}
