<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Entity\User;
use Auth;

class UserController extends Controller
{
    public function inactive()
    {
        /** @var User $user */
        $user = Auth::guard()->user();

        if ($user->getStatus()->isActive()) {
            $user->inactive();
        }
        return view('user.inactive');
    }
}
