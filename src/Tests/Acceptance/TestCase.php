<?php
declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\DataFixtures\UserFixtures;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class TestCase extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @throws DBALException
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();

        $this->truncateTables();
        $this->loadFixtures();
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

    protected function entityManager(): EntityManager
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

        return $entityManager;
    }

    /**
     * @throws DBALException
     */
    protected function truncateTables()
    {
        $connection = $this->entityManager()->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);

        foreach ($connection->getSchemaManager()->listTableNames() as $tableNames) {

            if ($tableNames === 'migration_versions') {
                continue;
            }

            $connection->prepare("TRUNCATE TABLE {$tableNames}")->execute();
            $connection->prepare("ALTER SEQUENCE {$tableNames}_id_seq RESTART WITH 1")->execute();
        }
    }

    protected function loadFixtures()
    {
        $entityManager = $this->entityManager();

        /** @var UserPasswordEncoderInterface $encoder */
        $encoder = $this->client->getContainer()->get('security.password_encoder');

        $fixture = new UserFixtures($encoder);
        $fixture->load($entityManager);
    }
}
