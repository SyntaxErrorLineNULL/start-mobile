<?php

namespace App\Controller\Admin;

use App\Common\DtoMapper\BookMapper;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Service\Flusher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books')]
class BooksController extends AbstractController
{
    public function __construct(private BookRepository $bookRepository, private Flusher $flusher, private BookMapper $mapper) {}

    #[Route('/', name: 'books_index', methods: ['GET'])]
    public function index(): Response
    {
        $books = $this->bookRepository->findAll();
        $item = array_map([$this->mapper, 'map'], $books);
        //var_dump($item);
        return $this->render('books/index.html.twig', [
            'books' => $item,
        ]);
    }

    #[Route('/new', name: 'books_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->bookRepository->add($book);
            $this->flusher->flush();

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('books/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'books_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('books/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'books_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->flusher->flush();

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('books/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'books_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $this->bookRepository->remove($book);
            $this->flusher->flush();
        }

        return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
    }
}
