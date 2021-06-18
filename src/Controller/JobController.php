<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\JobSearch;
use App\Form\ContactType;
use App\form\JobSearchType;
use App\Form\JobType;
use App\Repository\JobRepository;
use App\Repository\RecruteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mailer\MailerInterface;

class JobController extends AbstractController
{
  /**
   * @Route("/offres", name="offres")
   */
  public function readall(Request $request, PaginatorInterface $paginator):Response{
   
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
   *@Route("/offre/read/{id}", name="offre-read")
   */
   public function readJob(Job $job , Request $request, MailerInterface $mailer , RecruteurRepository $repositoryrecruteur):Response
   {
    if(! $job){
      throw new NotFoundHttpException('Pas d\'annonce trouvée');

    }
   $idrec= $job->getIdRecruteur();
    $recruteur= $repositoryrecruteur->findOneBy(['id'=> $idrec]);
    $form =  $this->createForm(ContactType::class);
    $contact = $form->handleRequest($request);
   
    if($form->isSubmitted() && $form->isValid())
    {
      $email= (new TemplatedEmail())
        ->from($contact->get('email')->getData())
        ->to($recruteur->getContactemail())
        ->subject('Contact au sujet de votre offre"' . $job->getMissiontitle() . '"')
        ->htmlTemplate('emails/contact_job.html.twig')
        ->context([
          'job'=> $job,
           'mail'=> $contact->get('email')->getData(),
           'message'=> $contact->get('message')->getData()
        ]);
        $mailer->send($email);
        $this->addFlash('message', 'Votre e-mail a bien été envoyé ');
        // return $this->redirectToRoute("");
    }
    return $this->render("job/annonce.html.twig", [
      "job"=>$job ,
      "form" => $form->createView()]);
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


      /**
       *@Route("/job/delete/{id}/" , name="delete-annonce")
       */
      public function delitAnnonce(Job $job){
  
        $em= $this->getDoctrine()->getManager();
        $em->remove($job);
        $em->flush();
        return $this->redirectToRoute("annonce");
      }
}
