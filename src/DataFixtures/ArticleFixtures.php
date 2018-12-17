<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Article();
        $a2 = new Article();
        $a3 = new Article();

        $a1
            ->setTitle('Mon super titre')
            ->setBody('Mon super article');

        $manager->persist($a1);

        $a2
            ->setTitle('Super titre 2')
            ->setBody('Super article 2');

        $manager->persist($a2);

        $a3
            ->setTitle('Super titre 3')
            ->setBody('Super article 3')
            ->setPublished(true);


        $manager->persist($a3);

        $manager->flush();
    }
}
