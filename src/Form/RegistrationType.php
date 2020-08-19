<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\Form\Extension\Core\Type\{CheckboxType,PasswordType, RepeatedType, SubmitType, TextType, EmailType};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\{IsTrue, Length, NotBlank};

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => "Prénom : "])
            ->add('last_name', TextType::class, ['label' => "Nom : "])
            ->add('email', EmailType::class, ['label' => "Mail : "])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => "Mot de passe : ",
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saisir un Mot de passe',
                    ]),
                ],
            ])
            ->add("register", SubmitType::class, ['label' => "S'inscrire"])
            ->add('password', RepeatedType::class, ['type' =>PasswordType::class,
                'first_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),                    
                    ],
                ],
                'second_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Confirmation de Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer une confirmation',
                        ]),
                    ],
                ],   
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
