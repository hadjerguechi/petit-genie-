<?php

namespace App\Controller;

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
        return $this->render('job_list/index.html.twig', [
            'controller_name' => 'JobListController',
        ]);
    }
}
