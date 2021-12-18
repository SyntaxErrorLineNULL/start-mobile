<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HeaderExistsException extends \Exception implements HttpExceptionInterface
{

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getHeaders(): array
    {
        return [];
    }
}