<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HealthProRepository")
 */
class HealthPro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=2)
     * @ORM\Column(type="string", length=100)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your speciality name must be at least {{ limit }} characters long",
     * maxMessage = "Your speciality name cannot be longer than {{ limit }} characters")
     */
    private $speciality;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your seniority must be at least {{ limit }} characters long",
     * maxMessage = "Your seniority name cannot be longer than {{ limit }} characters")
     * 
     */
    private $seniority;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100)
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your location name must be at least {{ limit }} characters long",
     * maxMessage = "Your location name cannot be longer than {{ limit }} characters")
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fee;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $comments_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $means_of_payment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getSeniority(): ?string
    {
        return $this->seniority;
    }

    public function setSeniority(?string $seniority): self
    {
        $this->seniority = $seniority;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function setFee(int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getCommentsId(): ?int
    {
        return $this->comments_id;
    }

    public function setCommentsId(int $comments_id): self
    {
        $this->comments_id = $comments_id;

        return $this;
    }

    public function getMeansOfPayment(): ?int
    {
        return $this->means_of_payment;
    }

    public function setMeansOfPayment(?int $means_of_payment): self
    {
        $this->means_of_payment = $means_of_payment;

        return $this;
    }
}
