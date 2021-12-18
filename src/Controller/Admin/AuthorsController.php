<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use App\Service\Flusher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/authors')]
class AuthorsController extends AbstractController
{

    public function __construct(private AuthorRepository $authorRepository, private Flusher $flusher) {}

    #[Route('/', name: 'authors_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('authors/index.html.twig', [
            'authors' => $this->authorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'authors_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->authorRepository->add($author);
            $this->flusher->flush();

            return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('authors/new.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'authors_show', methods: ['GET'])]
    public function show(Author $author): Response
    {
        return $this->render('authors/show.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/{id}/edit', name: 'authors_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Author $author): Response
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->flusher->flush();

            return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('authors/edit.html.twig', [
            'author' => $author,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'authors_delete', methods: ['POST'])]
    public function delete(Request $request, Author $author): Response
    {
        if ($this->isCsrfTokenValid('delete'.$author->getId(), $request->request->get('_token'))) {
            $this->authorRepository->remove($author);
            $this->flusher->flush();
        }

        return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
    }
}
