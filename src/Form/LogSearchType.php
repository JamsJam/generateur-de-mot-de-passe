<?php

namespace App\Form;

use App\Entity\Log;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = null): void
    {
        $builder
            ->add('Categorie', ChoiceType::class,[
                
                'choices'=>[
                    //'label' => 'value'
                    'Toutes catégories'=>'all',
                    'Log' =>'Log',
                    'Connexion Admin'=>'Connexion Admin',
                    'Connexion'=>'Connexion',
                    'Déconnexion'=>'Déconnexion',
                    'Lien Généré'=>'Lien Généré',
                    'Envoi Lien'=>'Envoi Lien',
                    'Modify mot de passe'=>'Modify mot de passe',
                    'Delete user'=>'Delete user',
                    'Add mot de passe'=>'Add mot de passe',
                    'Modify mot de passe'=>'Modify mot de passe',
                    'Delete mot de passe'=>'Delete mot de passe'
                ]
                
            ])
            ->add('texte', TextType::class,[
                'required' =>false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Message',
                ],
            ])
            ->add('debut',DateTimeType::class,[
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('fin',DateTimeType::class,[
                'widget'=>'single_text',
                'required' => false,
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