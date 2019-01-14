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
    	
    	$repository = $this->getDoctrine()->getRepository(User::class);
    	$users = $repository->myFindAll();

    	$userAnswers = [];

    	foreach ($users as $user) {
    		$userAnswers[] = implode(" ", $user);
    	}

    	$test = array_count_values($userAnswers);

    	$userMatch = [];
    	foreach ($test as $key=>$value) {
    		if ($value > 2) {
    			$userMatch[] = $repository->findById($key);
    		}
    	}

        return $this->render('match/index.html.twig', [
            'users'=>$users, 'userAnswers'=>$userAnswers, 'user'=>$userMatch, 'test'=>$test
        ]);
    }
}
