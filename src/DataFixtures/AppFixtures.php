<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 5 project
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();
            $project->setNameProject('project '.$i);
            $manager->persist($project);
        }
        // create 5 user
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setName('user '.$i);
            $user->setEmail('user '.$i);
            $user->setPassword('user '.$i);
            $manager->persist($user);
        }
        // create 5 team
        for ($i = 0; $i < 5; $i++) {
            $team = new Team();
            $team->setName('team '.$i);
            $team->setTeamAdmin('team '.$i);
            $manager->persist($team);
        }
        
        $manager->flush();
    }
}
