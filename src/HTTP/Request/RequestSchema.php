<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\HTTP\Request;

use App\HTTP\RequestValidator\RequestValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RequestSchema
{
    const TYPE = 'json';

    private Serializer $serializer;
    private RequestValidator $requestValidator;

    /**
     * @param RequestValidator $requestValidator
     */
    public function __construct(RequestValidator $requestValidator)
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer(null, null, null, new ReflectionExtractor()), new ArrayDenormalizer()],
            ['json' => new JsonEncoder()]
        );
        $this->requestValidator = $requestValidator;
    }

    public function getRequestProperty(string $schema, Request $request): object
    {
        $schema = $this->serializer->deserialize($request->getContent(), $schema, self::TYPE);
        $this->requestValidator->validate($schema);
        return $schema;
    }
}