<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Core\EntityNotFound;

final class UserNotFound extends EntityNotFound
{
    /**
     * @param int $id
     * @return UserNotFound
     */
    public static function fromId(int $id): self
    {
        return new UserNotFound("User with ID #{$id} not found.");
    }

    /**
     * @param string $email
     * @return UserNotFound
     */
    public static function fromEmail(string $email): self
    {
        return new UserNotFound("User with email {$email} not found.");
    }
}