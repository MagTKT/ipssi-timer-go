<?php

namespace App\Form;

use App\Entity\{User, Timer, Project, Team};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('DateTime_Debut')
            //->add('DateTime_Fin')
            ->add('idProject', EntityType::class, [
                'class' => Project::class,
                'multiple' => false,
                'choice_label' => function(Project $idProject) {
                    return $idProject->getNameProject();
                }, 'label'=>'Project '
            ])
            //->add('Cumul_s')
            ->add('TimerComment')
            /*->add('idUser', EntityType::class, [
                'class' => User::class,
                'multiple' => false,
                'choice_label' => function(User $idUser) {
                    return $idUser->getName().' '.$idUser->getLastName();
                }, 'label'=>'Utilisateur '
            ])*/
            /*->add('idTeam', EntityType::class, [
                'class' => Team::class,
                'multiple' => false,
                'choice_label' => function(Team $idTeam) {
                    return $idTeam->getName();
                }, 'label'=>'Team '
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timer::class,
        ]);
    }
}
