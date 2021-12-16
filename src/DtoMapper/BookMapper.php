<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\DtoMapper;

use App\Dto\Book;
use App\Entity\Book as BookEntity;

class BookMapper
{
    private AuthorMapper $authorMapper;

    /**
     * @param AuthorMapper $authorMapper
     */
    public function __construct(AuthorMapper $authorMapper)
    {
        $this->authorMapper = $authorMapper;
    }

    public function map(BookEntity $entity): Book {
        return new Book(
            $entity->id,
            $entity->title,
            $entity->description,
            $this->authorMapper->map($entity->author)
        );
    }
}