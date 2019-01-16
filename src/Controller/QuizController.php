<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;
use App\Entity\Answer;
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

    	$imgQuiz = [];
    	for ($i=1; $i<=22; $i++) {
    		$imgQuiz[] = 'carousel'.$i;
    	}
    	// $imgQuiz = ['carousel1', 'carousel2', 'carousel3', 'carousel4', 'carousel5', 'carousel6', 'carousel7', 'carousel8', 'carousel9', 'carousel10', 'carousel11', 'carousel12'];

		$post = $request->request->all();

		if (!empty($post)) {

		$user = new User();
		$user = $this->getUser();

		$oldAnswers = $user->getAnswers();
		foreach ($oldAnswers as $key => $value) {
			$user->removeAnswer($value);
		}
		
    	$repositoryAnswer = $this->getDoctrine()->getRepository(Answer::class);

    	$answerObj = new Answer();
		
		$answerObj = [];
		foreach ($post as $key => $value){
			$answerObj[] = $repositoryAnswer->find($value);
			foreach ($answerObj as $key => $value) {
				$user->addAnswer($value);
			}
		}

		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->flush();

		return $this->redirectToRoute('match');

		}

    return $this->render('quiz/index.html.twig', ['questions' => $questions, 'imgQuiz'=>$imgQuiz]);

    }



}

