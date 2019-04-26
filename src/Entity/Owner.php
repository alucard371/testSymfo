<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerRepository")
 */
class Owner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank
     */
    private $seniority;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(min=3)
     * @Length(
     * min=3,
     * max=10,
     * minMessage = "Your fee name name must be at least {{ limit }} characters long",
     * maxMessage = "Your fee name name cannot be longer than {{ limit }} characters")
     */
    private $fee;

    /**
     * An Owner is One User.
     * @ORM\OneToOne(targetEntity="User")
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

    public function getId()
    {
        return $this->id;
    }

    public function getSeniority()
    {
        return $this->seniority;
    }

    public function setSeniority(int $seniority): self
    {
        $this->seniority = $seniority;

        return $this;
    }

    public function getFee(): ?string
    {
        return $this->fee;
    }

    public function setFee(?string $fee): self
    {
        $this->fee = $fee;

        return $this;
    }
}
