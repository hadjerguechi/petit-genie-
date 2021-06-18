<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'disabled'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> 'Votre e-mail',
               'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('message', CKEditorType::class, [
                'label' => 'Votre message',
                // 'attr' => [
                //     'class' => 'form-control'
                // ]
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
