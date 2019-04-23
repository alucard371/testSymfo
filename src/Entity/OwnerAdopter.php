<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerAdopterRepository")
 */
class OwnerAdopter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="adopter")
     * @ORM\JoinColumn(name="adopter_id", referencedColumnName="id")
     */
    private $adopter_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerId(): ?int
    {
        return $this->owner_id;
    }

    public function setOwnerId(int $owner_id): self
    {
        $this->owner_id = $owner_id;

        return $this;
    }

    public function getAdopterId(): ?int
    {
        return $this->adopter_id;
    }

    public function setAdopterId(int $adopter_id): self
    {
        $this->adopter_id = $adopter_id;

        return $this;
    }
}
