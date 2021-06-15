<?php

namespace App\Form;

use App\Entity\Recruteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditRecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyname', TextType::class, ['label' => "Nom de l'entreprise"])
            ->add('description', TextType::class, ['label' => "Description de l'entreprise"])
            ->add('contactname',  TextType::class, ['label' => "Nom du contact"])
            ->add('contactemail',  EmailType::class, ['label' => "E-mail du contact"])
            ->add('phonenumber', TelType::class, ['label' => "Téléphone du contact"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recruteur::class,
        ]);
    }
}
