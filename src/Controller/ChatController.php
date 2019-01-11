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
     * @Route("/chat", name="chat")
     */
    public function index(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $form = $this->createForm(ChatFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $message = $form->getData();
            //l'auteur de l'article est l'utilisateur connecté
            $message->setUserSender(this);
            $message->setUserGetter(2);
            //je fixe la date de publication de l'article
            $message->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

            $entityManager->persist($message);

            $entityManager->flush();

        }
            return $this->render('chat/index.html.twig', [
                'form'=> $form->createView(),
            ]);
    }
}
