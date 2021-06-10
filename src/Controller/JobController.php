<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Recruteur;
use App\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/job", name="job")
     */
    public function index(Request $request): Response
    {
        $job= new Job();
        $job->setDate(new \DateTime('now'));
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();
        }
        return $this->render('job/index.html.twig', [
            'form' => $form->createView(), "job" => $job
        ]);
    }
}
