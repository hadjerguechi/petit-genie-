<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Form\EditCandidatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
    /**
     * @Route("/candidats" , name="candidats")
     */
    public function readAllCandidat():Response{
      $repository= $this->getDoctrine()->getRepository(Candidat::class);
      $candidats= $repository->findAll();
      return $this->render("candidat/all.html.twig",["candidats"=>$candidats]);
    }
    /**
     * @Route("/candidat/profil" , name="profil")
     */
    
     public function readCandidat():Response{

        $id= $this->getUser()->getId();
        // $repository = $this->getDoctrine()->getRepository(Candidat::class);
        $em = $this->getDoctrine()->getManager();
       // $candidat = $em->find("App\Entity\Candidat",3);
        $candidat = $em->getRepository("App\Entity\Candidat")->findOneBy( array("id_user"=>$id));
    
      return $this->render("candidat/profil.html.twig",["candidat"=>$candidat]);
     }
     /**
      * @Route("/candidat/delete" , name="app-candidat-delete")
      */
     public function delitCandidat(){

        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository("App\Entity\Candidat")->findOneBy(array("id_user" => $id));
        $em->remove($candidat);
        $em->flush();
        $session = new Session();
        $session->invalidate();
      //  $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !'); 
         return $this->redirectToRoute("app_logout");
     }
    /**
     * @Route("/candidat/update" , name="app-candidat-update")
      */
     public function updateCandidat(Request $request){
         $id = $this->getUser()->getId();
         $em = $this->getDoctrine()->getManager();
         $candidat = $em->getRepository("App\Entity\Candidat")->findOneBy(array("id_user" => $id));
         dump($candidat);
         $form= $this->createForm(EditCandidatType::class, $candidat);
         $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid()){
             $em1= $this->getDoctrine()->getManager();
             $em1->persist($candidat);
             $em1->flush();
             $this->addFlash('message','Profil mis à jour');
              return $this->redirectToRoute('profil');
          }
          
         return $this->render("candidat/edit.html.twig",['form' => $form->createView(),"candidat"=>$candidat]);
     }
}
