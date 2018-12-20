<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $bob = new User();
        $bob
            ->setEmail('bob@gmail.com')
            ->setPassword($this->encoder->encodePassword($bob, 'obo'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($bob);
        $this->addReference('admin-bob', $bob);

        $andy = new User();
        $andy
            ->setEmail('andy@gmail.com')
            ->setPassword($this->encoder->encodePassword($andy, 'pirate75'))
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($andy);
        $this->addReference('user-andy', $andy);

        $manager->flush();
    }
}
