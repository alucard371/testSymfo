<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
 */
class Animal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=50)
     * @Length(
     * min=2,
     * max=50,
     * minMessage = "Your name must be at least {{ limit }} characters long",
     * maxMessage = "Your name cannot be longer than {{ limit }} characters")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $health;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $location_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $caract_animal_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $conditions_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $animal_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getLocationId(): ?int
    {
        return $this->location_id;
    }

    public function setLocationId(?int $location_id): self
    {
        $this->location_id = $location_id;

        return $this;
    }

    public function getCaractAnimalId(): ?int
    {
        return $this->caract_animal_id;
    }

    public function setCaractAnimalId(int $caract_animal_id): self
    {
        $this->caract_animal_id = $caract_animal_id;

        return $this;
    }

    public function getConditionsId(): ?int
    {
        return $this->conditions_id;
    }

    public function setConditionsId(int $conditions_id): self
    {
        $this->conditions_id = $conditions_id;

        return $this;
    }

    public function getAnimalId(): ?int
    {
        return $this->animal_id;
    }

    public function setAnimalId(int $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }
}
