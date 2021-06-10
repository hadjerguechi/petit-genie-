<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CandidatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


// @Assert\Choice({"PHP", "JavaScript", "JQuery" , "Wordpress", "Sql", "React","Java","Symfony","Vue.js","C++" , "C#", "Python"})

/**
 * @ORM\Entity(repositoryClass=CandidatRepository::class)
 * @UniqueEntity(
 *  fields={"email"},
 * message="Ce compte existe déja.")

 */
class Candidat
{
    const  EXPERIENCE = [
        '- de 6 mois' => "- de 6 mois",
        '12 mois' => "12 mois",
        '+ de 12 mois' => '+ de 12 mois'
    ];
    const  LANGAGES = [
        "PHP" => "PHP",
        "JavaScript" => "JavaScript",
        "JQuery" => "JQuery",
        "WordPress" => "WordPress",
        "SQL" => "SQL",
        "React" => "React",
        "Java" => "Java",
        "Symfony" => "Symfony",
        "Vue.js" => "Vue.js",
        "C++" => "C++",
        "C#" => "C#",
        "Python" => "Python",
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @Assert\NotBlank(message = "Merci de rentrer votre nom!")
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Le nom de candidat ne peut être inferieur à 2 caractères",
     *      maxMessage = "Le nom de l'entreprise ne peut être superieur à 30 caractères",
     * )
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @Assert\NotBlank(message = "Merci de rentrer votre prénom!")
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Le prénom de candidat ne peut pas être inferieur à 2 caractères",
     *      maxMessage = "Le prénom de candidat ne peut pas être superieur à 30 caractères",
     * )
     * @ORM\Column(type="string", length=80)
     */
    private $firstname;

    /** 
     * @Assert\NotBlank(message = "Merci de rentrer votre email!")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "L'e-mail ne peut pas être  inferieur à 5 caractères",
     *      maxMessage = "L'e-mail  ne peut pas être superieur à 100 caractères",
     * )
     * @Assert\Email(
     *     message = "  cet eamil '{{ value }}' invalide."
     * )
     * 
     * @ORM\Column(type="string", length=100 , unique=true )
     */
    private $email;

    /**
     * @Assert\Regex(
     *       pattern="/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", 
     *       message="Format invalide"
     * )
     * @ORM\Column(type="string", length=20)
     */
    private $tel;

    /**
     * 
     *
     * @Assert\Choice({"- de 6 mois","12 mois","+ de 12 mois"})
     * @ORM\Column(type="string", length=255  )
     */
    private $experience;

    /**
     * 
     * @ORM\Column(type="string", length=255 )
     *
     */
      private $photo;


    /**
     * @Assert\NotBlank(message = "Merci de rentrer votre adresse!")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = " L'adresse ne peut pas être  inferieur à 5 caractères",
     *      maxMessage = " L'adresse  ne peut pas être superieur à 100 caractères",
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $openwork;

    /**
     * 
     * 
     * 
     *
     * @ORM\Column(type="json" )
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

    public function setPhoto( $photo): self
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


    public function getLangages(): ?array
    {
        return $this->langages;
    }

    public function setLangages(array $langages): self
    {
        $this->langages = $langages;

        return $this;
    }

    
   

  
}
