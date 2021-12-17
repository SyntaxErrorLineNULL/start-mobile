<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Book;

class BooksCollection
{
    /**
     * @var Book[]
     */
    public array $items;

    /**
     * @param Book[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

}