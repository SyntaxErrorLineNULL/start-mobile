<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Dto;

class Book
{
    public int $id;

    public string $title;

    public string $description;

    public ?Author $author;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param Author|null $author
     */
    public function __construct(int $id, string $title, string $description, ?Author $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
    }

}