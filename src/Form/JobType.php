<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('missiontitle', TextType::class, ['label' => "Titre de la mission"])
            ->add('description', TextType::class, ['label' => "Description de la mission"])
            ->add('companyname', TextType::class, ['label' => "Nom de la société"])
            ->add('type', ChoiceType::class,   ['label' => "Type de contrat",
            'choices' => Job::TYPE,])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
