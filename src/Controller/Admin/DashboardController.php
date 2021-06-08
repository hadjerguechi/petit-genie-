<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use App\Controller\Admin\CandidatCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
   public function index(): Response
    {
       // return parent::index();
       $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
       $url = $routeBuilder->setController(CandidatCrudController::class)->generateUrl();

      return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('je suis admin :)');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Back to the website', 'fa fa-home','home');
        yield MenuItem::linkToCrud('candidat', 'fas fa-user-friends', Candidat::class);
    }
}
