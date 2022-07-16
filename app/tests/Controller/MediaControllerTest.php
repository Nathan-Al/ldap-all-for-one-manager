<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

class MediaControllerTest extends AuthenticatedWebTestCase
{
    /**
     * @var KernelBrowser
     */
    private $client = null;

    public function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();
    }

    public function testGetAll()
    {
        $this->client->request('GET', '/api/admin/media', ['page'=>0, 'size'=>0]);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $responseContent = $this->client->getResponse()->getContent();
        $content = json_decode($responseContent, true);
        $this->assertSame(1, $content['total']);
    }

    public function testGetAllPaginated()
    {
        $this->client->request('GET', '/api/admin/media', ['page'=>1, 'size'=>20]);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $responseContent = $this->client->getResponse()->getContent();
        $content = json_decode($responseContent, true);
        $this->assertSame(1, $content['total']);
    }
}
