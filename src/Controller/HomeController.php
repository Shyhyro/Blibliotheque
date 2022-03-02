<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\Rack;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'Home', methods: ['GET'])]
    public function home(EntityManagerInterface $em) : Response
    {
        $book = $em->getRepository(Book::class)->findAll();
        $category = (new Category());
        $rack = (new Rack());
        return $this->render("./home/home.html.twig", [
            'books' => $book,
        ]);
    }
}