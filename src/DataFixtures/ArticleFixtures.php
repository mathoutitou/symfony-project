<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Article();
        $a2 = new Article();
        $a3 = new Article();

        $a1
            ->setTitle('Un chasseur abat le Père Noël par erreur')
            ->setBody('Une nouvelle erreur a été commise par un chasseur aujourd’hui vers 8h du matin. Jean Claude viandart est allé au bistrot ce matin car l’happy hour proposait 50% de réduction entre 6h et 9H du matin. En sortant du bar Jean Claude a confondu un sanglier avec le père Noël. Il s’est expliqué : << Fait chier, la semaine dernière j’avais déjà confondu un mammouth avec ma femme. J’aurais du faire attention le mammouth est moins imposant que ma femme. On m’a expliqué que les mammouths avaient disparu de la surface de la terre, ce qui fait un point commun avec ma femme ceci dit…>> Jean Claude veut rattraper sa maladresse. Il a décidé de ne pas garder la tête du père Noël qu’il voulait mettre en trophée au dessus de sa cheminée. Il a décidé de la mettre en vente sur le bon coin.')
            ->setAuthor($this->getReference('author-andy'));

        $manager->persist($a1);

        $a2
            ->setTitle(' Le petit Grégory a été retrouvé en vie')
            ->setBody('Le petit Grégory, né le 21 juin 1955 à Jœuf (Meurthe-et-Moselle), est un joueur de football international français, qui évoluait au poste de milieu de terrain offensif, avant d’ensuite devenir entraîneur puis dirigeant. Meneur de jeu emblématique de l’équipe de France de 1976 à 1987, et en club, de l’AS Nancy-Lorraine, de l’AS Saint-Étienne, puis de la Juventus FC, et auteur de 356 buts durant sa carrière, il est considéré comme un des meilleurs joueurs de football de l’histoire1. Le magazine France Football le désigne meilleur footballeur français du xxe siècle, devant Zinédine Zidane et Raymond Kopa, tandis que la Juventus l’a élu meilleur Bianconero de tous les temps. Il est le premier footballeur à remporter le Ballon d’or trois fois consécutivement2. Il fait partie de l’équipe mondiale du xxe siècle. Avec l’équipe de France, dont il est le deuxième meilleur buteur de l’histoire (41 buts) et cinquante fois le capitaine de 1979 à 1987, il soulève son premier trophée international à l’issue de l’Euro 1984 remporté en finale face à l’Espagne 2-0, et est deux fois demi-finaliste de la Coupe du monde, en 1982 et en 1986. Lors de l’Euro 1984, il établit un record de 9 buts marqués durant ce seul tournoi. Le petit Grégory met un terme à sa carrière de joueur sous le maillot de la Juventus de Turin à la fin de la saison 1987, à l’âge de 32 ans. Il devient ensuite sélectionneur de l’équipe de France de football de 1988 à 1992, puis coorganisateur avec Fernand Sastre de la Coupe du monde de football de 1998 en France. Il est, à partir du 26 janvier 2007, président de l’UEFA, succédant à Lennart Johansson. Il est réélu pour un deuxième mandat en 2011, et pour un troisième en 2015. Dans un premier temps candidat à la présidence de la FIFA, Il est suspendu de ses fonctions en octobre 2015 et, deux mois plus tard, la Commission d’éthique de la FIFA, qui le soupçonne d’avoir reçu un « paiement déloyal » de la part de Sepp Blatter, le prive de toute activité en relation avec le football durant huit ans. Le 24 février 2016, la cour d’appel de la FIFA réduit la suspension à six ans. Le 9 mai 2016, une nouvelle décision du tribunal arbitral du sport réduit la suspension à quatre ans.')
            ->setAuthor($this->getReference('author-andy'));

        $manager->persist($a2);

        $a3
            ->setTitle('SCANDALE : Une petite fille meurt dans d’atroces souffrances parce qu’elle n’a pas eu les 500.000 « likes » attendus par son médecin sur Facebook')
            ->setBody('Un médecin lillois pourrait être radié de l’ordre des médecins pour avoir refusé de soigner une petite fille atteinte d’une maladie orpheline et décédée depuis. Pour cause, il a posté sa photo sur Facebook en écrivant : « 500.000 likes avant le 31 décembre pour que cette petite fille soit guérie ! ». Au 1er janvier, elle n’en avait reçu que 20.000. Le médecin a alors décidé d’interrompre les soins au grand désespoir de ses parents. Le week-end dernier, elle est décédée dans d’atroces souffrances, dans l’indifférence complète du médecin qui encourt jusque 2 ans de prison avec sursis.')
            ->setAuthor($this->getReference('author-bob'))
            ->setPublished(true);


        $manager->persist($a3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [AuthorFixtures::class];
    }

}
