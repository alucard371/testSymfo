<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AdopterRepository")
 */
class Adopter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $kids;

    /**
     * @ORM\Column(type="integer")
     */
    private $married;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="text", length=100)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your description must be at least {{ limit }} characters long",
     * maxMessage = "Your description cannot be longer than {{ limit }} characters")
     */
    private $description;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="text", length=100)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your presentation must be at least {{ limit }} characters long",
     * maxMessage = "Your presentation cannot be longer than {{ limit }} characters")
     */
    private $presentation;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="text", length=100)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your motivation must be at least {{ limit }} characters long",
     * maxMessage = "Your motivation cannot be longer than {{ limit }} characters")
     */
    private $motivation;

     /**
     * An Adopter is One User.
     * @ORM\OneToOne(targetEntity="User", inversedBy="adopter")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKids(): ?int
    {
        return $this->kids;
    }

    public function setKids(int $kids): self
    {
        $this->kids = $kids;

        return $this;
    }

    public function getMarried(): ?int
    {
        return $this->married;
    }

    public function setMarried(int $married): self
    {
        $this->married = $married;

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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }
}
