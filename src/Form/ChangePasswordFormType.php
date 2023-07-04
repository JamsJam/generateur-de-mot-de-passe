<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPassword', RepeatedType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
            
            'options' => [
                'attr' => [                    'placeholder' => 'Mot de passe',
                ]],
            'first_options'  => ['label' => false],

            'second_options' => [
                'label' => false,
                'attr' => ['placeholder' => 'Écrivez à nouveau votre mot de passe']
            ],

            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Mot de passe'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Entrer un mot de passe',
                ]),
                new Length([
                    'min' => 10,
                    'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
                new Regex([
                    'pattern'=> '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                    'htmlPattern'=> '^[a-zA-Z]+$',
                    'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.'
                ])
            ],
        ]);
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                // 'mapped' => false,
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
