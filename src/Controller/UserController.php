<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use App\Form\ProfileType;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
    	$repository = $this->getDoctrine()->getRepository(User::class);
    	$users = $repository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/add", name="addProfile")
     */

    public function addProfile(Request $request, FileUploader $fileuploader)
    {
    	//seul un utilisteur connecté peut créer un profil

    	$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$entityManager = $this->getDoctrine()->getManager();

    	$profile = new User();

    	$profile = $this->getUser();

    	$form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        	$profile = $form->getData();
        	$file = $profile->getPicture(); 

        	$filename = $file ? $fileuploader->upload($file, $this->getParameter('user_image_directory')) : '';

        	$profile->setPicture($filename);

            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a bien été créé !');
            return $this->redirectToRoute('home');
    }

    	return $this->render('user/add.html.twig', ['form' => $form->createView()]);
   }
    
}
