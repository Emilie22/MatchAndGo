<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\QuizType;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function findMatch(Request $request)
    {
    	$form = $this->createForm(QuizType::class);
        $form->handleRequest($request);
        return $this->render('quiz/index.html.twig', [
            'form' => $form->createView()]);
    }
}
