<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotNull
     * @Length(
     * min=2,
     * max=100,
     * minMessage = "Your author name must be at least {{ limit }} characters long",
     * maxMessage = "Your author name cannot be longer than {{ limit }} characters")
     *
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *@Length(
     * min=2,
     * max=255,
     * minMessage = "Your article body must be at least {{ limit }} characters long",
     * maxMessage = "Your article body cannot be longer than {{ limit }} characters")
     * 
     */
    private $corps;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $creation_date;

    /**
     * @ORM\Column(type="string", length=45)
     * @ASSERT\NotBlank
     * @Length(
     * min=2,
     * max=45,
     * minMessage = "Your title must be at least {{ limit }} characters long",
     * maxMessage = "Your title cannot be longer than {{ limit }} characters")
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article", orphanRemoval=true)
     */
    private $comments;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=10)
     * @Length(
     * min=0,
     * max=10,
     * minMessage = "Your category name must be at least {{ limit }} characters long",
     * maxMessage = "Your category name cannot be longer than {{ limit }} characters")
     */
    private $categorie;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): self
    {
        $this->corps = $corps;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
