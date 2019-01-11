<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;
use App\Entity\Answer;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function showQuiz(Request $request)
    {

    	$repository = $this->getDoctrine()->getRepository(Question::class);
    	$questions = $repository->findAll();

    	$repositoryResponse = $this->getDoctrine()->getRepository(Answer::class);

		$get = $request->query->all();
		$answerObj=[];
		foreach ($get as $key => $value){
			$answerObj[] = $repositoryResponse->find($value);
		}

		$userAnswer = new User();
		foreach ($answerObj as $key => $value){
			$userAnswer->addAnswer($value);
		}

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($userAnswer);
		$entityManager->flush();




        return $this->render('quiz/index.html.twig', ['questions' => $questions]);
    }



}
