<?php

namespace App\Form;

use App\Entity\{Team, User, UserTeam};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\{UserRepository, UserTeamRepository, TeamRepository};

class UserTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idUser', EntityType::class, [
                'class' => User::class,
                'multiple' => false,
                'choice_label' => function(User $idUser) {
                    return $idUser->getName().' '.$idUser->getLastName();
                }, 'label'=>'Utilisateur '
            ])
        ;
    }
/*
ne fonctionne pas à revoir
'query_builder' => function (UserRepository $user) {
    return $user->createQueryBuilder('u')
            ->Join('u.userTeams', 'ut')
            ->Join('ut.idTeam','t')
            ->where('t.id  != :id' )
            ->setParameter('id', $GLOBALS['idTeam']);
},
*/
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTeam::class,
        ]);
    }
}
