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

        $error = $authenticationUtils->getLastAuthenticationError();

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

        $imgBgProfile = [];
        for ($i=1; $i<=5; $i++) {
            $imgBgProfile[] = 'backgroundprofile'.$i;
        }

        $entityManager->flush();

    return $this->render('security/index.html.twig', ['user'=>$user, 'imgBgProfile'=>$imgBgProfile]);

    }
    /**
     * @Route("/reset/password", name="resetPassword")
     */
    public function showFormResetPassword(Request $request){


    return $this->render('security/resetPassword.html.twig', []);
    }

    /**
     * @Route("/reset/password/token", name="createToken")
     */

}