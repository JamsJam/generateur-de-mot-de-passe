<?php

namespace App\Form;

use App\Entity\Motdepasse;
use PhpParser\Node\Stmt\Label;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotdepasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('website', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Site ou application'
                ]
            ])
            ->add('username', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Identifiant'
                ]
            ])
            ->add('password', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Mot de passe'
                ]
            ])
            ->add('access', EntityType::class, [
                'class' => 'App\Entity\Confidentialite',
                'choice_label' => 'acces',
                'label' => false,
                'label_attr' => [
                    
                ],
                //  checkbox 
                'multiple' => true,
                'expanded' => true,
            ])
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Motdepasse::class,
        ]);
    }
}
