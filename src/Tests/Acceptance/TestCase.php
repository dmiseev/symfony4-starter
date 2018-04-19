<?php
declare(strict_types=1);

namespace App\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Client;

abstract class TestCase extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
        // TODO: use test DB for testing
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $body
     * @param array $headers
     *
     * @return null|Response
     */
    protected function request(string $method, string $url, array $body = [], array $headers = []): ?Response
    {
        $this->client->request($method, $url, $body, [], $headers);

        return $this->client->getResponse();
    }
}
