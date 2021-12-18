<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Common\Admin\Dto;

class Author
{
    public int $id;

    public string $name;

    public int $countBook;

    /**
     * @param int $id
     * @param string $name
     * @param int $countBook
     */
    public function __construct(int $id, string $name, int $countBook)
    {
        $this->id = $id;
        $this->name = $name;
        $this->countBook = $countBook;
    }

}