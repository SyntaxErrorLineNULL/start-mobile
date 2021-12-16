<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\DtoMapper;

use App\Dto\Author;
use App\Entity\Author as AuthorEntity;

class AuthorMapper
{
    public function map(AuthorEntity $entity): Author {
        return new Author(
            $entity->id,
            $entity->name
        );
    }
}