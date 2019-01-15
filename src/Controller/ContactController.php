<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Form\Contact;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
    	$form = $this->createForm(ContactType::class);
        return $this->render('contact/index.html.twig',
            ['form' => $form->createView()]);
    }

    /**
     * @Route("/contact/add", name="addContact")
     */

    public function addContact(Request $request)
    {
    	//seul un utilisteur connecté peut envoyer un message

    	$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$entityManager = $this->getDoctrine()->getManager();

    	$profile = new Contact();

    	$profile = $this->getContact();

    	$form = $this->createForm(ContactType::class, $profile);
        $form->handleRequest($request);
dump($form);
        if($form->isSubmitted() && $form->isValid()){ 

        	$entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('home');
    }

    	return $this->render('contact/index.html.twig', ['form' => $form->createView()]);
   }
}
