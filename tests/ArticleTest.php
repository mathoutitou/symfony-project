<?php

namespace App\Tests;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testCreate() : Article
    {
        $article = new Article();

        $this->assertNull($article->getId());
        $this->assertInstanceOf(\DateTime::class, $article->getCreation());
        $this->assertInstanceOf(\DateTime::class, $article->getLastUpdate());
        $this->assertFalse($article->getPublished());

        return $article;
    }

    /**
     * @depends testCreate
     */
    public function testFill(Article $article)
    {
        $article
            ->setTitle('Bonjour')
            ->setBody('Coucou')
            ->setPublished(true)
            ->setLastUpdate(new \DateTime());

        $this->assertEquals('Bonjour', $article->getTitle());
        $this->assertEquals('Coucou', $article->getBody());
        $this->assertTrue($article->getPublished());
        $this->assertInstanceOf(\DateTime::class, $article->getLastUpdate());
    }

    /**
     * @dataProvider provideArticles
     */
    public function testManyArticles($title, $body, $published)
    {
        $article = new Article();

        $article
            ->setTitle($title)
            ->setBody($body)
            ->setPublished($published)
            ;

        $this->assertEquals($title, $article->getTitle());
        $this->assertEquals($body, $article->getBody());
        $this->assertEquals($published, $article->getPublished());
    }

    public function provideArticles(): array
    {
        return [
            ['Hourra', 'Hop', true],
            ['Mon joli titre', 'Re-hop', false],
        ];
    }

}
