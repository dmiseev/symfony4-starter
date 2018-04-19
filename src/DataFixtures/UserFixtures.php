<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [
            User::register('Alex Clare', 'alex.clare@test.com'),
            User::register('Jack Green', 'jack.green@test.com')
        ];

        foreach ($users as $user) {
            $manager->persist($user);
        }

        $manager->flush();
    }
}