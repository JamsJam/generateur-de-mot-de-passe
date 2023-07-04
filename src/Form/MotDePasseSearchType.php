<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MotDePasseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null): void
    {
        $builder
            ->add('texte', TextType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'nom d\'utilisateur, mot de passe ou site',
                ],
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Rechercher',
                'attr' =>[
                    'class' => 'btn btn-navi-primary'
                ]
            ])
            ->setMethod('GET')
            ->getForm();
        ;
    }
}