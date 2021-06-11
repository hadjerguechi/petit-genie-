<?php

namespace App\Controller;

use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Candidat::class);
        $candidats = $rep->findBy(array(), null, 3, NULL);
        return $this->render('home/index.html.twig', [
        'candidats' => $candidats,
        ]);
    }
}
