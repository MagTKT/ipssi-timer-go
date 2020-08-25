<?php

namespace App\Form;

use App\Entity\{Team, User, UserTeam};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('Date_creation')
            //->add('idUser')
            //->add('idTeam')
            //->add('idStatus')
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'multiple' => false,
                'choice_label' => function(User $idUser) {
                    return $idUser->getUsername();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTeam::class,
        ]);
    }
}
