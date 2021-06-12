<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidat;
use App\Form\CandidatType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CandidatController extends AbstractController 
{
    /**
     * @Route("/candidat", name="candidat")
     */
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {  
        $candidat= new Candidat($passwordHasher);
       
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($candidat);
            $photo = $form->get('photofile')->getData();
             $fichier = md5(uniqid()) . '.' . $photo->guessExtension();
             $photo->move(
                 $this->getParameter('images_directory'),
                 $fichier
             
             );
            if ($this->getUser()) {
            $idUser =$this->getUser();

            $candidat->setIdUser($idUser);
            $candidat->setPhoto($fichier);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($candidat);
            $em->flush();
            }
        }
            
        return $this->render('candidat/index.html.twig', [
            'form' => $form->createView(), "candidat" => $candidat
        ]);
    }
}
