<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\SearchJobType;
use App\Repository\JobRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobListController extends AbstractController
{
    /**
     * @Route("/jobs", name="job_list")
     */
    public function index(Request $request, PaginatorInterface $paginator , JobRepository $jobrepository): Response
    {
        $jobs  = $jobrepository->findBy(array(), ['id' => "DESC"], NULL, NULL);
        
        $form = $this->createForm(SearchJobType::class);
        $search= $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $jobs = $jobrepository->search(
                    $search->get('mots')->getData()
                  
                );
          
                  }
       
             $jobs =  $paginator->paginate(
                $jobs,
                $request->query->getInt('page', 1),
                4
            );
        
           
        return $this->render('job_list/index.html.twig', [
        'jobs' => $jobs, 'form'=>$form->createView()
        ]);
    }
}
