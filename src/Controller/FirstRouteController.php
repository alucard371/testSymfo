<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FirstRouteController extends AbstractController
{
    /**
     * @Route("/hello/world", name="hello_twig")
     */
    public function index()
    {
        return $this->render('hello/hello.html.twig');
    }

    /**
     * @Route("/section/home", name="home")
     */
    public function home()
    {
        return $this->render('section/home.html.twig');
    }

    /**
     * @Route("/section/mentions", name="mentions")
     */
    public function mentions_leg()
    {
        return $this->render('section/mentions_legale.html.twig');   
    }

    /**
     * @Route("/section/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('section/contact.html.twig');   
    }
}
