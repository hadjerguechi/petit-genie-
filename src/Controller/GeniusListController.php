<?php

namespace App\Controller;

use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeniusListController extends AbstractController
{
    /**
     * @Route("/geniuses", name="genius_list")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Candidat::class);
        $candidats = $rep->findBy(array(), null, 6, NULL);
        return $this->render('genius_list/index.html.twig', [
            'candidats' => $candidats,
        ]);
    }
}
