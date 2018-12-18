<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bob = new Author();

        $bob
            ->setName('Bob')
            ->setJob('editor')
            ->setBirth(new \DateTime('1976-05-09'));
        $manager->persist($bob);
        $this->addReference('author-bob', $bob);


        $andy = new Author();

        $andy
            ->setName('Andy')
            ->setJob('freelance')
            ->setBirth(new \DateTime('1983-11-15'));
        $manager->persist($andy);
        $this->addReference('author-andy', $andy);

        $manager->flush();
    }
}