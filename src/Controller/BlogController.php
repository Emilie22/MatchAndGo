<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentType;

class BlogController extends AbstractController
{

   
     /**
     * @Route("/blog", name="blog")
     */ 

      public function blog()    {

        //récupération de la liste des articles
        // $articleDB = new ArticleDB();
        //$articles = $articleDB->findAll()
        $repository = $this->getDoctrine()->getRepository(Blog::class);
        //utilisation de la méthode custom qui fait une jointure
        $blogs = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }

   /**
    * Route qui va afficher les détails d'un article grâce au slug 
    * @Route("/blog/{slug}", name="showBlogWithSlug", requirements={"slug"="[a-z0-9]+(?:-[a-z0-9]+)*"})
    */
        public function showBlogWithSlug(Request $request, Blog $blog){

            if(!$blog){
            throw $this->createNotFoundException('No article found');
        }

        return $this->render('blog/blog.html.twig',
                                        ['blog' => $blog ]
        );

            
        }


}
