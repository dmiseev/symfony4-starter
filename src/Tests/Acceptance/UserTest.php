<?php
declare(strict_types=1);

namespace App\Tests\Acceptance;


class UserTest extends TestCase
{
    /**
     * @test
     */
    public function should_return_user_bu_uuid()
    {
        $this
            ->json('GET', '/api/users/28135446-3c11-4d6c-bebb-51ee22de47bf', [], []
            )
            ->assertStatus(200)
            ->assertJsonStructure([
                'uuid',
                'facebookSocial',
                'passport',
                'selfie',
            ]);
    }
}
