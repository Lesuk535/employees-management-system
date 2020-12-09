<?php

declare(strict_types=1);

namespace App\Models\User\Entity;

use Webmozart\Assert\Assert;

class Status
{
    private const STATUS_INACTIVE = 'inactive';
    private const STATUS_ACTIVE = 'active';

    private string $status;

    public function __construct(string $status)
    {
        Assert::oneOf($status, [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ]);
        $this->status = $status;
    }

    public static function active(): self
    {
        return new self(self::STATUS_ACTIVE);
    }

    public static function inactive(): self
    {
        return new self(self::STATUS_INACTIVE);
    }

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getValue()
    {
        return $this->status;
    }
}
