<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Answer;

class MatchController extends AbstractController
{
    /**
     * @Route("/match", name="match")
     */
    public function index()
    {
    	// $answers = $this->getUser()->getAnswers();
    	$repository = $this->getDoctrine()->getRepository(User::class);
    	$users = $repository->myFindAll();


    	// $answers = [];
    	// foreach ($users as $user) {
    	// 	// $user = new User();
    	// 	$answers = $user->getAnswers();

			// $idAnswers = [];
    		
   //  		foreach ($answers as $key=>$value) {
   //  			$idAnswers[] = $value;
   //  		}
    	// }

        return $this->render('match/index.html.twig', [
            'users'=>$users
        ]);
    }
}
