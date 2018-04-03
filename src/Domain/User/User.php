<?php
declare(strict_types=1);

namespace App\Domain\User;

use Carbon\Carbon;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var Carbon|null
     */
    private $deletedAt;

    /**
     * @param string $name
     * @param string $email
     */
    private function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @param string $name
     * @param string $email
     *
     * @return User
     */
    public static function register(string $name, string $email): User
    {
        return new User($name, $email);
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Carbon|null
     */
    public function deletedAt(): ?Carbon
    {
        return $this->deletedAt;
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->deletedAt = new Carbon;
    }
}