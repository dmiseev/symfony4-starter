<?php
declare(strict_types=1);

namespace App\Infrastructure\Domain\Doctrine;

use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Domian\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[]
     */
    public function all()
    {
        return $this->createQueryBuilder('u')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFound|NonUniqueResultException
     */
    public function byId(int $id)
    {
        try {
            return $this->createQueryBuilder('u')
                ->where('u.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getSingleResult();

        } catch (NoResultException $e) {
            throw UserNotFound::fromId($id);
        }
    }

    /**
     * @param User $user
     * @throws ORMException|OptimisticLockException
     */
    public function store(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);
    }

    /**
     * @param User $user
     * @throws ORMException|OptimisticLockException
     */
    public function delete(User $user): void
    {
        $user->delete();
        $this->getEntityManager()->flush();
    }
}