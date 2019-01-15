<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChatFormType;
use App\Entity\User;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/{salon}", name="chat", requirements={"salon"="\d+"})
     */
    public function creationSalon($salon)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	//pour pouvoir sauvegarder un objet = insérer les infos dans la table, on utilise l'entity manager
    	$entityManager = $this->getDoctrine()->getManager();
        $salon = addSalon();
        return $this->render('chat/index.html.twig', ['user' => $this->getUser()]);
    }
}
