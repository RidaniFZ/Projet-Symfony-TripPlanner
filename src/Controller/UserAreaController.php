<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserAreaController extends AbstractController
{
    /**
     * @Route("/user/area", name="user_area")
     */
    public function index()
    {
        return $this->render('user_area/index.html.twig', [
            'controller_name' => 'UserAreaController',
        ]);
    }
}
