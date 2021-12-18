<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\EventSubscriber;

interface HeaderExistsMessageException
{
    public function getMessage();
}