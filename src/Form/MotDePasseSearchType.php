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
                'label' => 'false',
                'attr' => [
                    'placeholder' => 'Veuillez rentrer un nom d\'utilisateur ou un mot de passe',
                ],
                'help' => 'aucun site ou nom d\'utilisateur trouvé'
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Rechercher'
            ])
            ->setMethod('GET')
            ->getForm();
        ;
    }
}