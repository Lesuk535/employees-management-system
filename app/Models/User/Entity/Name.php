<?php

declare(strict_types=1);

namespace App\Models\User\Entity;

use Webmozart\Assert\Assert;

class Name
{
    private string $name;

    public function __construct(string $first)
    {
        Assert::notEmpty($first);
        $this->name = $first;
    }

    public function getValue()
    {
        return $this->name;
    }
}
