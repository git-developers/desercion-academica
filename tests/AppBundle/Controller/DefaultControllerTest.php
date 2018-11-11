<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    protected $client;
    protected $container;

    public function setUp()
    {

        $this->client = static::createClient();
        $this->container = $this->client->getContainer();

        parent::setUp();
    }

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testRoute()
    {
        $urls = $this->getBackendUrls();

        foreach ($urls as $url) {
            $crawler = $this->client->request('GET', '/');
            $statusCode = (int)$this->client->getResponse()->getStatusCode();

            $this->assertTrue($this->client->getResponse()->isOk(), 'URL probado: ' . $url);
        }

    }

    private function getBackendUrls()
    {
        $prefix = '/bat';

        return [
            $this->container->get('router')->generate('backend_user_index', [], false),
            $this->container->get('router')->generate('backend_product_index', [], false),
        ];
    }



}
