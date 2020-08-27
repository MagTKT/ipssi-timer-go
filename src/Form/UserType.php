<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{EmailType, PasswordType, RepeatedType, SubmitType, TextType};
use Symfony\Component\Validator\Constraints\{IsTrue, Length, NotBlank};

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => "Prénom : "])
            ->add('lastName', TextType::class, ['label' => "Nom : "])
            ->add('email', EmailType::class, ['label' => "Mail : "])
            ->add('password', RepeatedType::class, [
                'type' =>PasswordType::class,
                'first_options' => [
                    'label' => "Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),                    
                    ],
                ],
                'second_options' => [
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
