<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
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
        $cityTab = [];
        $userCoord = [];
        foreach ($userMatch as $userCity) {
            foreach ($userCity as $keyobj=>$obj) {
                $firstname = $obj->getFirstname();
                $picture = $obj->getPicture();
                if ($keyobj = 'city') {
                    $cityTab[] = $obj->getCity();
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={".urlencode(strip_tags($obj->getCity()))."}&key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA";
                    dump($url);
                    $resultat = json_decode(file_get_contents($url, false), true);
    
                    $lat = $resultat['results'][0]['geometry']['location']['lat'];
                    $lng = $resultat['results'][0]['geometry']['location']['lng'];

                    $userCoord[] = ['firstname'=>$firstname, 'picture'=>$picture, 'lat'=>$lat, 'lng'=>$lng];

                }

            }
        }

        $moi = $this->getUser();

        return $this->render('match/index.html.twig', [
            'users'=>$users, 'userAnswers'=>$userAnswers, 'userMatch'=>$userMatch, 'test'=>$test, 'moi'=>$moi,  'userCoord'=>$userCoord, 'cityTab'=>$cityTab,
        ]);

    }

}
