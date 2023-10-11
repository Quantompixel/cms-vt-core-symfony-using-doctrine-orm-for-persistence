<?php

namespace App\Controller;

use App\Entity\MovieQuote;
use App\Form\Type\MovieQuoteType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/create-quote', name: 'create_quote')]
    public function createQuote(EntityManagerInterface $entityManager): Response
    {
        $movieQuote = new MovieQuote();
        $movieQuote->setQuote("test");
        $movieQuote->setCharacter("Daniel Pillwein");

        $form = $this->createForm(MovieQuoteType::class, $movieQuote);

        return $this->render('quote/create_quote.html.twig', [
            'form' => $form,
        ]);
    }
}