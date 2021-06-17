<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Candidat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class GeniusListController extends AbstractController
{
    /**
     * @Route("/geniuses", name="genius_list")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $rep = $this->getDoctrine()->getRepository(Candidat::class);
        $candidats = $rep->findBy(array(), null, 6, NULL);
        return $this->render('genius_list/index.html.twig', [
            'candidats' => $candidats,
        ]);
    }
}
