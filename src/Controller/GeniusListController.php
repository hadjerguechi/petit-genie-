<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Candidat;
use App\Form\SearchJobType;
use App\Repository\CandidatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class GeniusListController extends AbstractController
{
    /**
     * @Route("/geniuses", name="genius_list")
     */
    public function index(Request $request, PaginatorInterface $paginator, CandidatRepository $candidatRepository): Response
    {
       // $rep = $this->getDoctrine()->getRepository(Candidat::class);
        $candidats  = $candidatRepository->findBy(array(), ['id' => "DESC"], NULL, NULL);
        // $candidats = $rep->findBy(array(), null, 6, NULL);
        $form = $this->createForm(SearchJobType::class);
        $search = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $candidats = $candidatRepository->search(
                    $search->get('mots')->getData()

                );
        }

            $candidats =  $paginator->paginate(
                $candidats,
                $request->query->getInt('page', 1),
                4
            );
        
        return $this->render('genius_list/index.html.twig', [
            'candidats' => $candidats, 'form' => $form->createView()
        ]);
    }
}
