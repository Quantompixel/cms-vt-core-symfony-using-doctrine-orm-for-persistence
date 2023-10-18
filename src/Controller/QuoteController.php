<?php

namespace App\Controller;

use App\Entity\MovieQuote;
use App\Form\Type\MovieQuoteType;
use App\Repository\MovieQuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/all-quotes', name: 'all_quotes')]
    public function allQuotes(MovieQuoteRepository $movieQuoteRepository): Response
    {
        $quotes = $movieQuoteRepository->findAll();

        return $this->render('quote/all_quotes.html.twig', [
            'quotes' => $quotes
        ]);
    }

    #[Route('/create-quote', name: 'create_quote')]
    public function createQuote(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movieQuote = new MovieQuote();

        $form = $this->createForm(MovieQuoteType::class, $movieQuote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movieQuote = $form->getData();

            $entityManager->persist($movieQuote);
            $entityManager->flush();

            return $this->redirectToRoute('all_quotes');
        }

        return $this->render('quote/create_quote.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/remove-quote/{id}', name: 'remove_quote')]
    public function removeQuote(int $id, EntityManagerInterface $entityManager, MovieQuoteRepository $movieQuoteRepository): Response
    {
        $quote = $movieQuoteRepository->find($id);

        if ($quote == null) {
            return new Response("Quote with ID " . $id . " does not exist");
        }

        $entityManager->remove($quote);
        $entityManager->flush();

        return $this->redirectToRoute('all_quotes');
    }
}