<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="username already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull()
     * @Assert\Length(min=3)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     * @Length(
     * min=5,
     * max=100,
     * minMessage = "Your email must be at least {{ limit }} characters long",
     * maxMessage = "Your email cannot be longer than {{ limit }} characters")
     * @Assert\Email()
     */
    private $email;

    /**
     * This password length works well with bcrypt
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(min=6)
     */
    private $password;

    /**
     * @Assert\Date
     * @ORM\Column(type="datetime")
     */
    private $create_time;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=3)
     * @Length(
     * min=3,
     * max=100,
     * minMessage = "Your name must be at least {{ limit }} characters long",
     * maxMessage = "Your name cannot be longer than {{ limit }} characters")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(min=3)
     * @Length(
     * min=3,
     * max=100,
     * minMessage = "Your speciality name must be at least {{ limit }} characters long",
     * maxMessage = "Your speciality name cannot be longer than {{ limit }} characters")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please, upload the product brochure as a png pic.")
     * @Assert\File(mimeTypes={ "image/png" })
     */
    private $avatar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Length(min=1)
     */
    private $age;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * One user can be adopter
     * @ORM\OneToOne(targetEntity="Adopter", mappedBy="user")
     */
    private $adopter;

    // /**
    //  * One user can be owner
    //  * @ORM\OneToOne(targetEntity="Owner", mappedBy="user")
    //  */
    private $owner;
    
    public function getAdopter()
    {
        return $this->adopter;
    }

    public function setAdopter($adopter)
    {
        $this->adopter = $adopter;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->create_time;
    }

    public function setCreateTime(\DateTimeInterface $create_time): self
    {
        $this->create_time = $create_time;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsernameSecurity(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
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

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
