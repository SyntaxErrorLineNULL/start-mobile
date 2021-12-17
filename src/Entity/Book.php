<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", length=65, nullable=true)
     */
    public string $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public string $description;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     * @var Author
     */
    public Author $author;

    /**
     * @param string $name
     * @param string $title
     * @param string $description
     * @param Author $author
     */
    public function __construct(string $name, string $title, string $description, Author $author)
    {
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
    }

    public function changeTitle(string $title): void {
        $this->title = $title;
    }

    public function changeDescription(string $description): void {
        $this->description = $description;
    }
}
