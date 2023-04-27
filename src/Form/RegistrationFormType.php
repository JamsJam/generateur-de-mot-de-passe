<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

// use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                "required" => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom'
                ],
                ])

            ->add('prenom', TextType::class,[
                "required" => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prenom',
                    ]
                    ])

            ->add('email',EmailType::class,[
                "required" => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                    ]
                    ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                
                'options' => [
                    'attr' => [
                        'placeholder' => 'Mot de passe',
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
                        'message' => 'Please enter a password',
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
