<?php

namespace App\Tests\Feature\Controller\Api;

class CalculatorControllerTest extends ApiWebTestCase
{
    public function testCalculateSuccess(): void
    {
        $this->sendApiRequest('POST', '/api/calculate', [
            'operation' => 'addition',
            'a' => 5,
            'b' => 3,
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('result', $responseData);
        $this->assertEquals(8, $responseData['result']);
    }

    public function testCalculateValidationError(): void
    {
        $this->sendApiRequest('POST', '/api/calculate', [
            'operation' => 'addition',
            'a' => 'invalid',
            'b' => 3,
        ]);

        $this->assertEquals(422, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('violations', $responseData);
    }

    public function testCalculateServerError(): void
    {
        $this->sendApiRequest('POST', '/api/calculate', [
            'operation' => 'division',
            'a' => 5,
            'b' => 0,
        ]);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('error', $responseData);
    }
}