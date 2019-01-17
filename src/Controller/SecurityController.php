<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use App\Form\ProfileType;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }




                    // AFFICHAGE DU PROFIL //

   /**
   * @Route("/login/infos", name="userInfo")
   */

    public function showConnectedUser(Request $request){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

     return $this->render('security/index.html.twig', ['user'=>$user]);

    }


                    

                // MODIFICATION DU PROFIL //

    /**
    * @Route("/login/update/{id}", name="updateProfile", requirements={"id"="\d+"})
    */
    public function updateProfile(Request $request, User $user, FileUploader $fileuploader){

        $filename = $user->getPicture();

        if ($user->getPicture()) {
            $user->setPicture(new File($this->getParameter('upload_directory') . $this->getParameter('user_image_directory') . '/' . $filename ));
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            if ($user->getPicture()) { 

                $file = $user->getPicture();

            $filename = $fileuploader->upload($file, $this->getParameter('user_image_directory'), $filename);
            }

            $user->setPicture($filename);

            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->flush();


            $this->addFlash('warning', 'Votre profil a bien été modifié');
        }
        return $this->render('security/add.html.twig', ['user'=>$user, 'form' => $form->createView()]);
    }
}