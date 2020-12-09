<?php

declare(strict_types=1);

namespace App\Models\Employee\Entity;

use Webmozart\Assert\Assert;

class Phone
{
    private string $phone;

    public function __construct(string $phone)
    {
        Assert::notEmpty($phone);
        $this->phone = $phone;
    }

    public function getValue()
    {
        return $this->phone;
    }
}
