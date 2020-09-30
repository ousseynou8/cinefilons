<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const USER_COUNT = 20;

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder= $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('cinefilons@gmail.com');
        $admin->setFirstname('cinefilons');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('cinefilons');
        $admin->setLastname('Cinefilons');
        $admin->setPassword($this->encoder->encodePassword($admin,'root'));
        $manager->persist($admin);

        $faker = Factory::create('fr_FR');

        for($i = 0; $i < self::USER_COUNT; $i++){

            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setUsername($faker->userName);
            $passwd = $this->encoder->encodePassword($user, 'user');
            $user->setPassword($passwd);
            $user->setEmail($faker->email);
            $this->addReference('user'. $i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
