<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request): Response
    {
        $session = new Candidat();
        $form = $this->createForm(LoginType::class, $session);
        $form->handleRequest($request);
        
        return $this->render('login/index.html.twig', [
            'form'=>$form->createView(),
            'session' => $session
        ]);
    }
}
