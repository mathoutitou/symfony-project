<?php

namespace App\Tests;

use App\Entity\Article;
use App\Entity\Author;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testCreate(): Article
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
     * @param Article $article
     * @return Article
     * @throws \Exception
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

        return $article;
    }

    /**
     * @dataProvider provideArticles
     * @param $title
     * @param $body
     * @param $published
     */
    public function testManyArticles($title, $body, $published)
    {
        $article = new Article();

        $article
            ->setTitle($title)
            ->setBody($body)
            ->setPublished($published);

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

    /**
     * @depends testFill
     * @param Article $article
     */
    public function testSetAuthor(Article $article)
    {
        $author = $this->createMock(Author::class);

        $article->setAuthor($author);

        $this->assertInstanceOf(Author::class, $article->getAuthor());

    }
}
