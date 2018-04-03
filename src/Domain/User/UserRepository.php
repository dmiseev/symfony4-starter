<?php
declare(strict_types=1);

namespace App\Domian\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFound;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function all();

    /**
     * @param int $id
     *
     * @return User
     * @throws UserNotFound
     */
    public function byId(int $id);

    /**
     * @param User $user
     */
    public function store(User $user): void;

    /**
     * @param User $user
     */
    public function delete(User $user): void;
}