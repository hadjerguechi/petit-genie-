<?php

namespace App\Form;

use App\Entity\Recruteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyname', TextType::class, ['label' => "Nom de l'entreprise"])
            ->add('description')
            ->add('contactname')
            ->add('contactemail')
            ->add('phonenumber')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recruteur::class,
        ]);
    }
}
