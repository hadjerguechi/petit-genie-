<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr'=>['placeholder' => 'Ton nom']])
            -> add('firstname', TextType::class, ['attr' => ['placeholder' => 'Ton prénom']] )
            
            ->add('tel', TextType::class, ['attr'=>['placeholder' => '0234...']])
            ->add('experience', ChoiceType::
            class,   ['label' => "Experience professionnelle",
            'placeholder' => "indique ton expérience",
            'choices' => Candidat::EXPERIENCE,])
            ->add('photofile',FileType::class , ['label' => "Une petite photo" , 'label_attr' => [
            'data-browse' => 'Parcourir'
            ],
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
            ]
            // 'constraints' => [
            //     new File([
            //         //'maxSize' => '1024k',
            //         'mimeTypes' => [
                        
            //             'application/jpg',
            //             'application/png',
            //         ],
            //         'mimeTypesMessage' => 'Le format invalide',
            //     ])
            //     ],
            ])
            ->add('address', TextType::class,['attr' => [
                'class' => 'form-control',
            ]])
            ->add('openwork', CheckboxType::class,['label' => "À l'écoute du marché"]) 
            ->add('langages', ChoiceType::class, [
                'placeholder' => 'tu sais parler quoi ?',
                'choices'=> Candidat::LANGAGES,
                'multiple'=>true,
            'attr' => [
                'class' => 'form-select',]
        ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
