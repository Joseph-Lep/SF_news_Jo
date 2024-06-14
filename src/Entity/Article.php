<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['articles:read', 'article:read'])] // attribute
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['articles:read', 'article:read'])] // Je défini ici a quel groupe appartient ma proprieté de classe pour que API controller sache quoi attraper ou non
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['articles:read'])]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['articles:read', 'article:read'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'd/m/Y'])] // Je peux ajouter un contexte de formatage de ma date dès que je veux sérialiser 
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    #[Groups(['articles:read'])]
    private ?bool $visible = null;


    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['articles:read'])] // Ici dans ma relation. Je défini aussi le groupe. Et doit aussi le définir dans mon Entity en relation. Et y définir aussi le group dans son id et sa colonne que je veux remonter correspondant à l'id
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): static
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
