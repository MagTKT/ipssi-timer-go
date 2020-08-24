<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\ProjectRepository;

class ProjectToTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name_project', EntityType::class, [
                'class' => Project::class,
                'multiple' => false,
                'query_builder' => function (ProjectRepository $pro) {
                    return $pro->createQueryBuilder('u')
                          ->where('u.Team IS  NULL');
                },
                'choice_label' => function ($project) {
                    return $project->getNameProject();
                    
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
