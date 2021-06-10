<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use App\Controller\Admin\CandidatCrudController;
use App\Entity\Job;
use App\Entity\Recruteur;
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
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-home','home');
        yield MenuItem::linkToCrud('Candidat', 'fas fa-user-friends', Candidat::class);
        yield MenuItem::linkToCrud('Recruteur', 'fas fa-user-tie', Recruteur::class);
        yield MenuItem::linkToCrud('Job', 'fas fa-briefcase', Job::class);
    }
}
