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
    #[Route(path: [
        'en' => '/all-quotes',
        'de' => '/alle-zitate'
    ], name: 'all_quotes')]
    public function allQuotes(Request $request, MovieQuoteRepository $movieQuoteRepository): Response
    {
        $quotes = $movieQuoteRepository->findAll();

        $quotes = $this->sortQuotes($quotes);

        return $this->render('quote/all_quotes.html.twig', [
            'quotes' => $quotes,
            "_locale" => $request->getLocale()
        ]);
    }

    #[Route(path: [
        'en' => '/create-quote',
        'de' => '/zitat-erstellen'
    ], name: 'create_quote')]
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

    #[Route(path: [
        'en' => '/remove-quote/{id}',
        'de' => 'zitate-loeschen/{id}'
    ], name: 'remove_quote')]
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

    private function sortQuotes($quotes): array
    {
        usort($quotes, function (MovieQuote $a, MovieQuote $b) {
            if (strcmp($a->getMovie()->getName(), $b->getMovie()->getName()) != 0) {
                return strcmp($a->getMovie()->getName(), $b->getMovie()->getName());
            }

            if ($a->getMovie()->getReleaseYear() != $b->getMovie()->getReleaseYear()) {
                return ($a->getMovie()->getReleaseYear() < $b->getMovie()->getReleaseYear()) ? -1 : 1;
            }

            if (strcmp($a->getQuote(), $b->getQuote()) != 0) {
                return strcmp($a->getQuote(), $b->getQuote());
            }

            return strcmp($a->getCharacter(), $b->getCharacter());
        });

        return $quotes;
    }
}