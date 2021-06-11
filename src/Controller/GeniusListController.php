<?php

namespace App\Controller;

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
        return $this->render('genius_list/index.html.twig', [
        ]);
    }
}
