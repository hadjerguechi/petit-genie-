<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidat;
use App\Form\CandidatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class CandidatController extends AbstractController
{
    /**
     * @Route("/candidat", name="candidat")
     */
    public function index(Request $request): Response
    { 
        $candidat= new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photofile')->getData();
        
           
            
             $fichier = md5(uniqid()) . '.' . $photo->guessExtension();
            dump($fichier);
             $photo->move(
                 $this->getParameter('images_directory'),
                 $fichier
             
             
             );

            
            $candidat->setPhoto($fichier);

            $em = $this->getDoctrine()->getManager();
            $em->persist($candidat);
            $em->flush();
    
            
        }
            
        return $this->render('candidat/index.html.twig', [
            'form' => $form->createView(), "candidat" => $candidat
        ]);
    }
}
