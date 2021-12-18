<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Common\DtoMapper;

use App\Common\Dto\Author;
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