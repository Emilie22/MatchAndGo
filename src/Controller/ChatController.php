<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Chat;
use App\Entity\Salon;
use App\Form\ChatFormType;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/add/{idUser}", name="addChat", requirements={"idUser"="\d+"})
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
        $chat1 ->setMessage('Vous avez invité à parler');
        $chat1 ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $salon1 = new Salon();
        $salon1->setName('salon' . ' ' . $i);

        $chat1 ->setSalon($salon1);

// Début de la liaison des users :

        $chat = new Chat();
        $chat ->setUser($inviteId);
        $chat ->setMessage('Vous avez été invité(e) à parler avec');
        $chat ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $chat ->setSalon($salon1);

        $entityManager->persist($chat1);
        $entityManager->persist($salon1);
        $entityManager->persist($chat);


            $entityManager->flush();
        return $this->redirectToRoute('chat');
    }

    /**
     * @Route("/chat", name="chat")
     */
    public function index(Request $request) {

        $repository = $this->getDoctrine()->getRepository(Chat::class);

        $user = $this->getUser();
        $userId = $user->getId();
        dump($userId);

        $chat = $repository->findWithChat($userId);
        dump($chat);

        $form = $this->createForm(ChatFormType::class);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){ 
        //     $profile = $form->getData();
        //     $entityManager->persist($profile);
        //     $entityManager->flush();
        // };


        // $viewMessage = $repository->viewMessage($userId);
        return $this->render('chat/index.html.twig', ['chat'=>$chat, 'form' => $form->createView()]);
    }

    /**
     * @Route("/chat/changeSalon", name="changeSalon")
     */
    public function changeSalon(Request $request){
        dump($request);
        $idSalon = $request->request->get('idSalon', null);
        $idUser = $request->request->get('idUser', null);
        
        $repository = $this->getDoctrine()->getRepository(Chat::class);
        $message = $repository->viewMessage($idSalon, $idUser);

        return $this->render('chat/message.html.twig', ['messages'=>$message]);
    }
}
