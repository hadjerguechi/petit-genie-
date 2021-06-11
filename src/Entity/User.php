<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    private $passwordHasher;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
     /**
     * @Assert\NotBlank(message = "Merci de rentrer votre e-mail!")
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "L'e-mail ne peut pas être inferieur à 5 caractères",
     *      maxMessage = "L'e-mail ne peut pas être superieur à 100 caractères",
     * )
     * @Assert\Email(
     *     message = "  Cet e-mail '{{ value }}' invalide."
     * )
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

     /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json", nullable=true )
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    public function __construct(UserPasswordHasher $passwordHasher)
    {
        $this->passwordHasher= $passwordHasher;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

   

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $this->passwordHasher->hashPassword($this, $password);

        return $this;
    }
   
    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt()
    {
        // return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Get min = 5,
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set min = 5,
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
}
