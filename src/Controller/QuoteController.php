<?php

namespace App\Controller;

use App\Entity\MovieQuote;
use App\Form\Type\MovieQuoteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    #[Route('/create-quote', name: 'create_quote')]
    public function createQuote(Request $request): Response
    {
        $movieQuote = new MovieQuote();

        $form = $this->createForm(MovieQuoteType::class, $movieQuote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $movieQuote = $form->getData();
            echo $movieQuote->getQuote();
            echo $movieQuote->getMovie()->getName();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('task_success');
        }

        return $this->render('quote/create_quote.html.twig', [
            'form' => $form,
        ]);
    }
}