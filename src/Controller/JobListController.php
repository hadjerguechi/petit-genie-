<?php

namespace App\Controller;

use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobListController extends AbstractController
{
    /**
     * @Route("/jobs", name="job_list")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Job::class);
        $jobs = $rep->findBy(array(), ['id' => "DESC"], NULL, NULL);
        return $this->render('job_list/index.html.twig', [
        'jobs' => $jobs,
        ]);
    }
}
