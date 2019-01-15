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
        $salon = addSalon();
        return $this->render('chat/index.html.twig', ['user' => $this->getUser()]);
    }
}
