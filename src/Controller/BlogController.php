<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog")
     */ 

    public function addArticle(Request $request, FileUploader $fileuploader){

    	//pour pouvoir sauvegarder un objet = insérer les infos dans la table, on utilise l'entity manager
    	$entityManager = $this->getDoctrine()->getManager();
    	
        $form = $this->createForm(BlogType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $article = $form->getData();

            // $article->getImage() contient un objet qui représente le fichier image envoyé
            $file = $article->getPictureBlog();

            $filename = $fileuploader->upload($file, $this->getParameter('article_image_directory'));

            // je remplace l'attribut image qui contient toujours le fichier par le nom du fichier
            $article->setPictureBlog($filename);

            //je fixe la date de publication de l'article
            $article->setDatePost(new \DateTime(date('Y-m-d H:i:s')));

            $entityManager->persist($article);

            $entityManager->flush();

            $this->addFlash('success', 'article ajouté');

            return $this->redirectToRoute('blog');

        }

    	return $this->render('blog/index.html.twig', ['form' => $form->createView()]);

    }


}
