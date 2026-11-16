<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{   public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
     

        $user = new User();
        $user->setUsername('testuser');
        $user->setPassword($this->hasher->hashPassword($user, 'password'));
        $user->setRoles(['ROLE_HOST']);

        $user2 = new User();
        $user2->setUsername('testuser2');
        $user2->setPassword($this->hasher->hashPassword($user2, 'password'));
        $user2->setRoles(['ROLE_MANAGER']);


        $manager->persist($user);
        $manager->persist($user2);
        $manager->flush();
    }
}
