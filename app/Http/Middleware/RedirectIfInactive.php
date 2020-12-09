<?php

namespace App\Http\Middleware;

use App\Models\User\Entity\User;
use Closure;
use Illuminate\Http\Request;
use Auth;

class RedirectIfInactive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::guard()->user();

        if ($user->isExpired()) {
            return redirect('inactive');
        }

        return $next($request);

    }
}
