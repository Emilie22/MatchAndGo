<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use App\Form\ProfileType;
use App\Entity\User;
use App\Entity\ResetPassword;

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
    public function showFormResetPassword(Request $request, \Swift_Mailer $mailer){
        if(isset($request)){
            $post = $request->request->all();
        }

            $errors = [];
        if(!empty($post)){
            if(empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email invalide';
            }
            if($post['email'] !== $post['verifEmail']){
                $errors[] = 'Les emails ne sont pas identique';
            }
            if(empty($errors)){
                $repository = $this->getDoctrine()->getRepository(User::class);
                $users = $repository->findByEmail($post['email']);
                
                
                if(count($users)){
                    function random($var){
                        $string = "";
                        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
                        srand((double)microtime()*1000000);
                        for($i=0; $i<$var; $i++){
                            $string .= $chaine[rand()%strlen($chaine)];
                        }
                        return $string;
                    }
                        $token = random(25);
                        foreach ($users as $key=>$value) {
                            $users = $value;
                        }


                        $resetPassword = new ResetPassword();
                        $resetPassword ->setUser($users);
                        $resetPassword ->setToken($token);

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($resetPassword);
                        $entityManager->flush();

                        
                    $message = (new \Swift_Message('Hello Email'))
                        ->setFrom('MatchAndGo@gmx.fr')
                        ->setTo('ghghk@gmail.com')
                        ->setBody('<a href={{path("valideToken")}}?token=' . $token . '&id='.$users->getId().'>Cliquez ici pour changez votre mot de passe<a>');
                                $mailer->send($message);

                        return $this->redirectToRoute('valideToken');
                    }
                }
            }
    return $this->render('security/resetPassword.html.twig', ['errors'=>$errors]);
    }

    /**
     * @Route ("/login/valideToken/{token}", name="valideToken")
     */
    public function valideToken(Request $request){
        $get = $request->query->all();

        if(!empty($get)){
            $errors = [];
        if(!empty($get)){
            $token = strip_tags($get['token']);
            $id = strip_tags($get['id']);

            if(empty($id) && !is_numeric($id)){
                $errors[] = 'lien incorrect';
            }

            if(empty($token)){
                $errors[]= 'lien token incorrect';
            }

            $repository = $this->getDoctrine()->getRepository(ResetPassword::class);
            $users = $repository->findByToken($token);

            if(count($users) === 1){

                return $this->redirectToRoute('formPassword', ['id'=>$id, 'token'=>$token]);
                }
            }   
        }
    }
    /**
     * @Route ("/login/formPassword/{id}/{token}", name="formPassword", requirements={"id"="\d", "token"="\w"})
     */
        public function changePassword(Request $request, $id, $token){
            $post = $request->request->all();

            if(!empty($post)){

                    $select = $connexion ->query('SELECT id_user, motDePasse FROM reset_password INNER JOIN users ON reset_password.id_user = users.id');
                    $password = $select ->fetchAll();
            
                        if(($post['password'] === $post['verifPassword']) && strlen($_POST['newPassword']) > 4 && strlen($_POST['newPassword']) < 10 ){
            
                            $newMdp = password_hash(trim(strip_tags($post['password']), PASSWORD_DEFAULT));

                            $repository = $this->getDoctrine()->getRepository(ResetPassword::class);
                            $tokens = $repository->findByToken($token);

                        if(!empty($tokens)){
                            $repository = $this->getDoctrine()->getRepository(User::class);
                            $UserPassword = $repository->changePassword($newMdp, $id);
                            
                            echo 'Mot de passe changer ! ';
                
                        }
                    }
                }
            return $this->render('formPassword.html.twig');
        }
}


