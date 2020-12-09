<?php

declare(strict_types=1);

namespace App\Models\User\Entity;

use Webmozart\Assert\Assert;

class Role
{
    public const ROLE_MANAGER = 'manager';
    public const ROLE_ADMIN = 'admin';

    private string $role;

    public function __construct(string $role)
    {
        Assert::oneOf($role, [
            self::ROLE_MANAGER,
            self::ROLE_ADMIN
        ]);
        $this->role = $role;
    }

    public static function manager(): self
    {
        return new self(self::ROLE_MANAGER);
    }

    public static function admin(): self
    {
        return new self(self::ROLE_ADMIN);
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function getValue(): string
    {
        return $this->role;
    }
}
