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

class EditCandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => "Nom"])
            ->add('firstname', TextType::class, ['label' => "Prénom"])

            ->add('tel', TextType::class, ['label' => "Téléphone"])
            ->add('experience', ChoiceType::class,   [
                'label' => "Experience professionnelle",
                'placeholder' => "indique ton expérience",
                'choices' => Candidat::EXPERIENCE,
            ])
            ->add('photofile', FileType::class, [
                'label' => "Photo", 'label_attr' => [
                    'data-browse' => 'Parcourir'
                ],
                'mapped' => false,
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
            ->add('address')
            ->add('openwork')
            ->add('langages', ChoiceType::class, [
                'placeholder' => 'tu sais parler quoi ?',
                'choices' => Candidat::LANGAGES,
                'multiple' => true,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
