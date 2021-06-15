<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\RecruteurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @UniqueEntity("contactemail")
 * @ORM\Entity(repositoryClass=RecruteurRepository::class)
 */
class Recruteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message = "Merci de renseigner le nom de l'entreprise")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Le nom de l'entreprise ne peut être inferieur à 2 caractères",
     *      maxMessage = "Le nom de l'entreprise ne peut être superieur à 100 caractères",
     * )
     */

    private $companyname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Merci de renseigner la description de l'entreprise")
     * @Assert\Length(
     *      min = 20,
     *      max = 255,
     *      minMessage = "La description de l'entreprise ne peut être inferieur à 20 caractères",
     *      maxMessage = "La description de l'entreprise ne peut être superieur à 255 caractères",
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = "Merci de renseigner le nom du contact au sein de l'entreprise")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "La description de l'entreprise ne peut être inferieur à 2 caractères",
     *      maxMessage = "La description de l'entreprise ne peut être superieur à 100 caractères",
     * )
     */
    private $contactname;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email(
     *     message = "L'e-mail '{{ value }}' n'est pas valide."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "L'e-mail ne peut être inferieur à 5 caractères",
     *      maxMessage = "L'e-mail ne peut être superieur à 100 caractères",
     * )
     * @Assert\NotBlank(message = "Merci de renseigner un e-mail")
     */
    private $contactemail;

    /**
     * @ORM\Column(type="string", length=20)     
     * @Assert\Length(
     *      min = 10,
     *      max = 20,
     *      minMessage = "Le numero de téléphone ne peut être inferieur à 10 caractères",
     *      maxMessage = "Le numero de téléphone ne peut être superieur à 20 caractères",
     * )
     * 
     * @Assert\NotBlank(message = "Merci de renseigner un numéro de téléphone")
     */
    private $phonenumber;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="id_recruteur")
     */
    private $jobs;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContactname(): ?string
    {
        return $this->contactname;
    }

    public function setContactname(string $contactname): self
    {
        $this->contactname = $contactname;

        return $this;
    }

    public function getContactemail(): ?string
    {
        return $this->contactemail;
    }

    public function setContactemail(string $contactemail): self
    {
        $this->contactemail = $contactemail;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setIdRecruteur($this);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        if ($this->jobs->removeElement($job)) {
            // set the owning side to null (unless already changed)
            if ($job->getIdRecruteur() === $this) {
                $job->setIdRecruteur(null);
            }
        }

        return $this;
    }

}
