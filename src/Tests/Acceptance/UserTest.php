<?php
declare(strict_types=1);

namespace App\Tests\Acceptance;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testShouldReturnAllUsersList()
    {
        $response = $this->request('GET', '/v1/users', [], []);
        $responseBody = json_decode($response->getContent(), true);

        $this->assertEquals(2, count($responseBody));
        $this->assertEquals(2, $response->headers->get('x-items-count'));
    }

    /**
     * @test
     */
    public function testShouldReturnUserById()
    {
        $response = $this->request('GET', '/v1/users/1', [], []);
        $responseBody = json_decode($response->getContent(), true);

        $this->assertEquals([
            'id' => 1,
            'name' => 'Alex Clare',
            'email' => 'alex.clare@test.com'
        ], $responseBody);
    }
}
