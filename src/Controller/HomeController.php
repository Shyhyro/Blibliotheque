<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Rack;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home', methods: ['GET'])]
    public function home(EntityManagerInterface $em, TranslatorInterface $translator) : Response
    {
        $book = $em->getRepository(Book::class)->findAll();
        $category = (new Category());
        $rack = (new Rack());


        return $this->render("./home/home.html.twig", [
            'books' => $book,
        ]);
    }

    #[Route('/addBook', name: 'Add Book' )]
    public function addBook(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();
        }

        return $this->render('./book/add.twig', [
            'form' => $form->createView(),
        ]);
    }
}