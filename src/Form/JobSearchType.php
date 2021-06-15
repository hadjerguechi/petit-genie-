<?php

namespace App\Form;

use App\Entity\JobSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('missiontitle',TextType::class,[
                "required"=>false,
                "label"=>false,
                "attr"=>[
                    "placeholder"=>"Intitulé de poste"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobSearch::class,
            'method'=>'get',
             'csrf_protection'=>false
        ]);
    }
}
