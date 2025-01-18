<?php

namespace App\Tests\Feature\Controller\Api;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class ApiWebTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function sendApiRequest(string $method, string $url, array $data): void
    {
        $this->client = static::createClient();
        $this->client->request(
            $method,
            $url,
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
            ],
            json_encode($data, JSON_THROW_ON_ERROR)
        );
    }
}
