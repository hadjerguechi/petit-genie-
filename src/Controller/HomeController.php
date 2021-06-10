<?php

namespace App\Controller;

use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
       // $candidats = $this->getDoctrine()
         //   ->getRepository('App:Candidat')->findAll();
        return $this->render('home/index.html.twig', [
         //   'candidats' => $candidats,
        ]);
    }
}
