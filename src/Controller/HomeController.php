<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('home/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/term/Of/Use", name="termOfUse")
     */
    public function termOfUse()
    {
        return $this->render('home/term_of_use.html.twig');
    }
    /**
     * @Route("/sign/Up", name="signUp")
     */
    public function signUp()
    {
        return $this->render('home/sign_up.html.twig');
    }

    /**
     * @Route("/sign/In", name="signIn")
     */
    public function signIn()
    {
        return $this->render('home/sign_in.html.twig');
    }
}
