<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recruteur;
use App\Form\RecruteurType;
use Symfony\Component\HttpFoundation\Request;

class RecruteurController extends AbstractController
{
    /**
     * @Route("/recruteur", name="recruteur")
     */
    public function index(Request $request): Response
    {
     $recruteur= new Recruteur();
        $form = $this->createForm(RecruteurType::class, $recruteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recruteur);
            $em->flush();
        }
        return $this->render('recruteur/index.html.twig', [
            'form'=>$form->createView(),
            'recruteur' => $recruteur
            ]);
    }
}
