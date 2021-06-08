<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CandidatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 */
class Candidat
{
    const  EXPERIENCE =[
            '0-6'=> '0-6',
            '6-12'=> '6-12',
            '12 >' => '12 >'
    ];
  
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * //2lettres
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * 2
     * @ORM\Column(type="string", length=80)
     */
    private $firstname;

    /** 
     * validation email
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * validation regx
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    /**
     * 
     *
     * not null
     * @ORM\Column(type="string", length=255  )
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255 )
     */
    private $photo;

    /**
     * not null ville APi
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $openwork;

    /**
     * select plusieur choix
     * @ORM\Column(type="string", length=50 )
     * 
     */
    private $langages;

   
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        
        $this->experience = $experience;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getOpenwork(): ?bool
    {
        return $this->openwork;
    }

    public function setOpenwork(bool $openwork): self
    {
        $this->openwork = $openwork;

        return $this;
    }

    public function getLangages(): ?string
    {
        return $this->langages;
    }

    public function setLangages(string $langages): self
    {
        $this->langages = $langages;

        return $this;
    }

   
   
}
