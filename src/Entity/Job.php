<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    const TYPE = [
        "CDI" => "CDI",
        "CDD" => "CDD",
        "Stage" => "Stage",
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice({"CDD","CDI","Stage"})
     * @Assert\NotBlank(message = "Merci de renseigner un type de mission")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Le titre ne peut être inferieur à 5 caractères",
     *      maxMessage = "Le titre ne peut être superieur à 100 caractères",
     * )
     * @Assert\NotBlank(message = "Merci de renseigner un titre de mission")
     */
    private $missiontitle;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min = 5,
     *      max = 300,
     *      minMessage = "La description ne peut être inferieure à 5 caractères",
     *      maxMessage = "La description ne peut être superieure à 300 caractères",
     * )
     * @Assert\NotBlank(message = "Merci de renseigner une description")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 300,
     *      minMessage = "Le nom de société ne peut être inferieure à 2 caractères",
     *      maxMessage = "La nom de société ne peut être superieure à 300 caractères",
     * )
     * @Assert\NotBlank(message = "Merci de renseigner un nom de société")
     */
    private $companyname;

    /**
     * @ORM\ManyToOne(targetEntity=Recruteur::class, inversedBy="jobs")
     */
    private $id_recruteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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

    public function getMissiontitle(): ?string
    {
        return $this->missiontitle;
    }

    public function setMissiontitle(string $missiontitle): self
    {
        $this->missiontitle = $missiontitle;

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

    public function getCompanyname(): ?string
    {
        return $this->companyname;
    }

    public function setCompanyname(string $companyname): self
    {
        $this->companyname = $companyname;

        return $this;
    }

    public function getIdRecruteur(): ?Recruteur
    {
        return $this->id_recruteur;
    }

    public function setIdRecruteur(?Recruteur $id_recruteur): self
    {
        $this->id_recruteur = $id_recruteur;

        return $this;
    }
}
