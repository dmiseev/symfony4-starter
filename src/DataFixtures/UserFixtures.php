<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    const DEFAULT_PASSWORD = 'testpass';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            User::register('Alex Clare', 'alex.clare@test.com'),
            User::register('Jack Green', 'jack.green@test.com')
        ];

        $encoder = $this->container->get('security.password_encoder');

        foreach ($users as $user) {
            $user->setPassword($encoder->encodePassword($user, self::DEFAULT_PASSWORD));
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}