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

                    // CREATION DU PROFIL //

    /**
     * @Route("/user/add", name="addProfile")
     */

    public function addProfile(Request $request, FileUploader $fileuploader)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();
            $file = $user->getPicture(); 

            $filename = $file ? $fileuploader->upload($file, $this->getParameter('user_image_directory')) : '';

            $user->setPicture($filename);

            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a bien été créé !');
            return $this->redirectToRoute('userInfo');
    }

        return $this->render('user/add.html.twig', ['form' => $form->createView()]);
   }



                        // MODIFICATION DU PROFIL //

    /**
    * @Route("/login/update", name="updateProfile")
    */
    public function updateProfile(Request $request, FileUploader $fileuploader){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

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


            $this->addFlash('success', 'Votre profil a bien été modifié');
            
            return $this->redirectToRoute('userInfo');
        }
        return $this->render('user/add.html.twig', ['user'=>$user, 'form' => $form->createView()]);
    }

   /**
   * @Route ("/user/show/{id}", name="showProfile", requirements={"id"="\d+"})
   */
   public function showProfile(User $user) {
        return $this->render('security/index.html.twig', [ 'user' => $user ]);
   }


}