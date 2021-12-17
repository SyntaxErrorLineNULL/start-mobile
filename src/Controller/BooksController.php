<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace App\Controller;

use App\DtoMapper\BookMapper;
use App\HTTP\Request\RequestSchema;
use App\Repository\BookRepository;
use App\Service\Flusher;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/books')]
class BooksController extends AbstractController
{

    public function __construct(
        private BookRepository $bookRepository,
        private BookMapper $mapper,
        private Flusher $flusher,
        private RequestSchema $requestSchema
    ){}

    #[Route('/list', name: 'bookList', methods: ['GET'])]
    public function booksList(): JsonResponse {
        $books = $this->bookRepository->findAll();
        $item = array_map([$this->mapper, 'map'], $books);
        return new JsonResponse(new BooksCollection($item), Response::HTTP_OK);
    }

    #[Route('/by-id/{id}', name: 'singleBook', methods: ['GET'])]
    public function singleBook(int $id): JsonResponse {
        $book = $this->bookRepository->findById($id);
        return new JsonResponse($this->mapper->map($book), Response::HTTP_OK);
    }

    #[Route('/update/{id}', name: 'updateBook', methods: ['POST'])]
    public function updateBook(Request $request, int $booId): JsonResponse {
        $requestSchema = $this->requestSchema->getRequestProperty(UpdateBookSchema::class, $request);
        $book = $this->bookRepository->findById($booId);

        $book->changeTitle($requestSchema->title);
        $book->changeDescription($requestSchema->description);
        $this->flusher->flush();

        return new JsonResponse(['message' => 'success update book'], Response::HTTP_CREATED);
    }

    /**
     * @throws ORMException
     */
    #[Route('/remove/{id}', name: 'removeBook', methods: ['DELETE'])]
    public function removeBook(int $booId) {
        $book = $this->bookRepository->findById($booId);
        $this->bookRepository->remove($book);
        $this->flusher->flush();
    }
}