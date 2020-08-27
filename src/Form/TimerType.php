<?php

namespace App\Form;

use App\Entity\{User, Timer, Project, Team};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ProjectRepository;

class TimerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idProject', EntityType::class, [
                'class' => Project::class,
                'multiple' => false,
                'query_builder' => function (ProjectRepository $pro) {
                    return $pro->createQueryBuilder('u')
                          ->Join('u.userProjects', 'up')
                          ->where('up.idUser= :ID')
                          ->setParameter('ID', $GLOBALS['idUser']);
                },
                'choice_label' => function(Project $idProject) {
                    return $idProject->getNameProject();
                }, 'label'=>'Project '
            ])
            ->add('TimerComment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Timer::class,
        ]);
    }
}
