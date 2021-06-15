<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidat::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add(BooleanFilter::new('openwork'))
        ;
   }
 
    
    // public function configureFields(string $pageName): iterable
    // {
    //     return[
    //     yield TextField::new('name'),
    //     yield TextField::new('firstname'),
    //         yield TextField::new('langages'),
    //     yield EmailField::new('email'),
    //     ];

      
      
    //  }
        // return [
        //     IdField::new('id'),
        //     TextField::new('title'),
        //     TextEditorField::new('description'),
        // ];
    
    
}
