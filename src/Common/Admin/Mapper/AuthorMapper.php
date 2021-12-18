<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Common\Admin\Mapper;

use App\Common\Admin\Dto\Author;
use App\Entity\Author as AuthorEntity;
use App\Repository\BookRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class AuthorMapper
{

    public function __construct(private BookRepository $bookRepository) {}

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function map(AuthorEntity $entity): Author {
        $countBook = $this->bookRepository->countBook($entity->getId());
        return new Author(
            $entity->getId(),
            $entity->getName(),
            $countBook
        );
    }
}