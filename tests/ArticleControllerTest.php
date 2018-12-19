<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex() : Client
    {
        $client = static::createClient();
        $client->request('GET', '/article');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        return $client;
    }

    /**
     * @depends testIndex
     * @param Client $client
     * @return void
     */
    public function testCreate(Client $client)
    {
        $client->request('GET', '/admin/article');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $client->submitForm('Enregistrer', [
            'article[title]' => 'Mon super titre',
            'article[body]' => 'Mon super contenu',
            'article[published]' => 1,
            'article[author]' => 3,
            ]);

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();

        $this->assertSame(
            '/article',
            $client->getRequest()->getPathInfo()
        );

    }


}
