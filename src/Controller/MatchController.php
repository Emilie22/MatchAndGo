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
    	$users = $repository->myFindAll($this->getUser()->getId());

    	$userAnswers = [];

        dump($users);

    	foreach ($users as $user) {
            // dump($user);
    		$userAnswers[] = implode(" ", $user);
            // foreach($user as $key=>$value) {
            //     $city = $repository->findById($value)->getCity();
            //     dump($city);
            // }
            // $url = "https://maps.googleapis.com/maps/api/geocode/json?address={".urlencode($user->getCity())."}&key=AIzaSyBjslA2cbupRwG-dJvPAKcfZp0ruzEFM38";
            // dump($url);
            // $userCoord[] = 
    	}

    	$test = array_count_values($userAnswers);

    	$userMatch = [];
    	foreach ($test as $key=>$value) {
    		if ($value > 2) {
    			$userMatch[] = $repository->findById($key);
    		}
    	}

        $userCity = $repository->findById($user)->getCity();
        dump($userCity);

        $cityTab = [];
        foreach ($userMatch as $userCity) {
            // dump($userCity);
            foreach ($userCity as $keyobj=>$obj) {
                // dump($keyobj);
                // dump($obj);
                // dump($obj->getCity());
                if ($keyobj = 'city') {
                    $cityTab[] = $obj->getCity();
                }
            }
        }
        // dump($cityTab);


        $moi = $this->getUser();

        // $url = "https://maps.googleapis.com/maps/api/geocode/json?address={".$testCity."}&key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA";

        // $resultat = json_decode(file_get_contents($url), true);

        // dump($resultat);

        // $lat = $resultat['results'][0]['geometry']['location']['lat'];
        // $lng = $resultat['results'][0]['geometry']['location']['lng'];

        // dump($lat);
        // dump($lng);

        return $this->render('match/index.html.twig', [
            'users'=>$users, 'userAnswers'=>$userAnswers, 'userMatch'=>$userMatch, 'test'=>$test, 'moi'=>$moi, 'cityTab'=>$cityTab
        ]);


    }

}
