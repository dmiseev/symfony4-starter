<?php
declare(strict_types=1);

namespace App\Domain\User;

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
     * @param string $email
     *
     * @return User
     * @throws UserNotFound
     */
    public function byEmail(string $email);

    /**
     * @param User $user
     */
    public function store(User $user): void;

    /**
     * @param User $user
     */
    public function delete(User $user): void;
}