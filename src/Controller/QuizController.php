<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;
use App\Form\QuizType;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function showQuiz(Request $request)
    {

    	$repository = $this->getDoctrine()->getRepository(Question::class);
    	$questions = $repository->findAll();

        return $this->render('quiz/index.html.twig', ['questions' => $questions]);
    }
}
