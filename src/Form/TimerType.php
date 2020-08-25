<?php

namespace App\Form;

use App\Entity\Timer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateTime_Debut')
            ->add('DateTime_Fin')
            ->add('Cumul_s')
            ->add('TimerComment')
            ->add('idUser')
            ->add('idTeam')
            ->add('idProject')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timer::class,
        ]);
    }
}
