<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChatFormType;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat", name="chat")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ChatFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $article = $form->getData();
            //l'auteur de l'article est l'utilisateur connecté
            $article->setUserSender($this->getUser());
            //je fixe la date de publication de l'article
            $article->setDatePubli(new \DateTime(date('Y-m-d H:i:s')));

            $entityManager->persist($article);

            $entityManager->flush();


        return $this->render('chat/index.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}
