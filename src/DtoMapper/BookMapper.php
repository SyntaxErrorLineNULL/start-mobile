<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\DtoMapper;

use App\Dto\Book;
use App\Entity\Book as BookEntity;
use App\Repository\AuthorRepository;

class BookMapper
{
    /**
     * @param AuthorMapper $authorMapper
     * @param AuthorRepository $authorRepository
     */
    public function __construct(private AuthorMapper $authorMapper, private AuthorRepository $authorRepository) {}

    public function map(BookEntity $entity): Book {
        $author = $this->authorRepository->findById($entity->getAuthorId());

        return new Book(
            $entity->getId(),
            $entity->getTitle(),
            $entity->getDescription(),
            $author ? $this->authorMapper->map($author) : null
        );
    }
}