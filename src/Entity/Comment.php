<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @ORM\Column(type="string", length=100)
     * @Length(
     * min=3,
     * max=100,
     * minMessage = "Your author name must be at least {{ limit }} characters long",
     * maxMessage = "Your author name cannot be longer than {{ limit }} characters")
     */
    private $author;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Length(
     * min=10,
     * max=255,
     * minMessage = "Your description must be at least {{ limit }} characters long",
     * maxMessage = "Your description cannot be longer than {{ limit }} characters")
     */
    private $description;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     * @ORM\Column(type="string", length=255)
     * @Length(
     * min=10,
     * max=100,
     * minMessage = "Your comment body must be at least {{ limit }} characters long",
     * maxMessage = "Your comment body cannot be longer than {{ limit }} characters")
     */
    private $corps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
