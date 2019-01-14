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
        //utilisation de la méthode custom qui fait une jointure
        $blogs = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'blogs' => $blogs,
        ]);


    }
}
