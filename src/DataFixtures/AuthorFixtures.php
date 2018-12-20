<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bob = new Author();

        $bob
            ->setName('Bob')
            ->setJob('editor')
            ->setBirth(new \DateTime('1976-05-09'))
            ->setUser($this->getReference('admin-bob'))
        ;
        $manager->persist($bob);
        $this->addReference('author-bob', $bob);


        $andy = new Author();

        $andy
            ->setName('Andy')
            ->setJob('freelance')
            ->setBirth(new \DateTime('1983-11-15'))
            ->setUser($this->getReference('user-andy'))
        ;

        $manager->persist($andy);
        $this->addReference('author-andy', $andy);

        $manager->flush();
    }


    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}