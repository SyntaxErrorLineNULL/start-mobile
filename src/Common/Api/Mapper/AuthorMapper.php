<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Common\Api\Mapper;

use App\Common\Api\Dto\Author;
use App\Entity\Author as AuthorEntity;

class AuthorMapper
{
    public function map(AuthorEntity $entity): Author {
        return new Author(
            $entity->getId(),
            $entity->getName()
        );
    }
}