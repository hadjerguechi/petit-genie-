<?php 
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ChoicePageController extends AbstractController {

    /**
     * @Route("choice", name="choice")
     */
      public function index():Response{
        //   if(! $this->getUser()->getIdCandidat())
        //   {

        //   }

    return $this->render("choicepage/index.html.twig"

    );
    }

}