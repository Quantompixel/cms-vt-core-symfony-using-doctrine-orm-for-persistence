<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route(path: [
        'en' => '/create-movie',
        'de' => '/film-erstellen'
    ], name: 'create_movie')]
    public function createQuote(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie = new Movie();

        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('all_quotes');
        }

        return $this->render('movie/create_movie.html.twig', [
            'form' => $form,
        ]);
    }
}