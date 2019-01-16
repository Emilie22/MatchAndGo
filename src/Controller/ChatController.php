<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Chat;
use App\Entity\Salon;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/add/{idUser}", name="Addchat", requirements={"idUser"="\d+"})
     */
    public function addChat($idUser)
    {
        $i = 0;
        $i++;
        $entityManager = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $this->getUser();
        
        $invite = $repository->findById($idUser);
        foreach ($invite as $key=>$value) {
            $inviteId = $value;
        }
                
        $chat1 = new Chat();
        $chat1 ->setUser($this->getUser());
        $chat1 ->setMessage('Vous avez inviter à parler');
        $chat1 ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $salon1 = new Salon();
        $salon1->setName('salon' . ' ' . $i);

        $chat1 ->setSalon($salon1);

// Début de la liaison des users :

        $chat = new Chat();
        $chat ->setUser($inviteId);
        $chat ->setMessage('Vous avez été inviter à parler avec');
        $chat ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $chat ->setSalon($salon1);

        $entityManager->persist($chat1);
        $entityManager->persist($salon1);
        $entityManager->persist($chat);


            $entityManager->flush();
        return $this->redirectToRoutes('chat');
    }

    /**
     * @Route("/chat", name="chat")
     */
    public function index() {
        
        return $this->render('chat/test.html.twig', ['user'=>$user]);
    }
}
