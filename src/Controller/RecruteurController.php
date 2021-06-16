<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recruteur;
use App\Form\EditRecruteurType;
use App\Form\RecruteurType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

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
            if ($this->getUser()) {
                $idUser = $this->getUser();
            $recruteur->setIdUser($idUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($recruteur);
            $em->flush();
            return $this->redirectToRoute('home');
            }
        }
        return $this->render('recruteur/index.html.twig', [
            'form'=>$form->createView(),
            'recruteur' => $recruteur
            ]);
    }
    /**
     * @Route("/recruteur/profil" , name="profil-recruteur")
     */
    public function readRecruteur(): Response
    {

        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository("App\Entity\Recruteur")->findOneBy(array("id_user" => $id));
        return $this->render("recruteur/profilRecruteur.html.twig", ["recruteur" => $recruteur]);
    }
    /**
     * @Route("/recruteur/delete" , name="app-recruteur-delete")
     */
    public function delitRecruteur()
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository("App\Entity\Recruteur")->findOneBy(array("id_user" => $id));
        $em->remove($recruteur);
        $em->flush();
        $session = new Session();
        $session->invalidate();
        //  $this->addFlash('success', 'Votre compte utilisateur a bien été supprimé !'); 
        return $this->redirectToRoute("app_logout");
    }

    /**
     * @Route("/recruteur/update" , name="app-recruteur-update")
     */
    public function updateRecruteur(Request $request)
    {
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository("App\Entity\Recruteur")->findOneBy(array("id_user" => $id));
        $form = $this->createForm(EditRecruteurType::class, $recruteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->persist($recruteur);
            $em1->flush();
            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('profil-recruteur');
        }

        return $this->render("recruteur/edit.html.twig", ['form' => $form->createView(), "candidat" => $recruteur]);
    }


}
