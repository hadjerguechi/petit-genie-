<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\JobSearch;
use App\form\JobSearchType;
use App\Form\JobType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class JobController extends AbstractController
{
  /**
   * @Route("/offres", name="offres")
   */
  public function readall(Request $request, PaginatorInterface $paginator):Response{
   
    // $search= new JobSearch();
    // $form=$this->createForm(JobSearchType::class,$search);
    // $form->handleRequest($request);
    $donnees= $this->getDoctrine()->getRepository(Job::class)->findAll();
    $jobs=  $paginator->paginate(
      $donnees,
      $request->query->getInt('page',1),
      4
    );

    return $this->render("job/readAll.html.twig",["jobs"=>$jobs,]
                         );

  }
    /**
     * @Route("/job", name="job")
     */
    public function index(Request $request): Response
    {

      
        if($this->getUser()){
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository("App\Entity\Recruteur")->findOneBy(array("id_user" => $id));
        $job= new Job();
        $job->setDate(new \DateTime('now'));
        $job->setIdRecruteur($recruteur);
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();
            return $this->redirectToRoute("app-recruteur-update");
        }
         }else {
        return $this->redirectToRoute("home");
       }
        return $this->render('job/index.html.twig', [
            'form' => $form->createView(), "job" => $job
        ]);
      }
      /**
       * @Route("/job/annonce", name="annonce")
       */
      public function readAnnonce():Response{
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository("App\Entity\Recruteur")->findOneBy(array("id_user" => $id));
        $id_recruteur=$recruteur->getId();
        $job = $em->getRepository("App\Entity\Job")->findBy(array("id_recruteur" =>$id_recruteur));
        return $this->render("/job/readAnnonce.html.twig",["annonces"=>$job]);
      }
}
