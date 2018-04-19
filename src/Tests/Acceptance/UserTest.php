<?php
declare(strict_types=1);

namespace App\Tests\Acceptance;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testShouldReturnAllUsers()
    {
        $response = $this->request('GET', '/v1/users', [], []);

        $responseBody = json_decode($response->getContent(), true);

        $this->assertEquals(1, count($responseBody));
        $this->assertEquals(1, $response->headers->get('x-items-count'));
    }
}
