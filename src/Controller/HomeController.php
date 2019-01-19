<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        
        $repository = $this->getDoctrine()->getRepository(Blog::class);
        $blogs = $repository->showThreeRecents();

        return $this->render('home/index.html.twig', [
            'blogs' => $blogs,
        ]);


    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function cgu(){
        return $this->render('home/cgu.html.twig');
    }
    
}