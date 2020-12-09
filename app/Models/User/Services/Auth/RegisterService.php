<?php

declare(strict_types=1);

namespace App\Models\User\Services\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User\Entity\Email;
use App\Models\User\Entity\Name;
use App\Models\User\Entity\Role;
use App\Models\User\Entity\User;
use Illuminate\Support\Facades\Auth;

final class RegisterService
{
    public function register(RegisterRequest $request): void
    {
        $user = User::register(
            new Name($request['name']),
            new Email($request['email']),
            $request['password'],
            new Role($request['role'])
        );

        Auth::guard()->login($user);
    }
}
