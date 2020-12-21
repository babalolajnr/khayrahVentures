<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HandleInertiaRequests
{
    public function handle(Request $request, $next)
    {
        Inertia::share([
            'user' => function () {
                $user = auth()->user();
                return $user ? [
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'phoneNumber' => $user->phone_number,
                    'email' => $user->email,
                    'userType' => $user->userType->name,
                    'can' => [
                        'createProduct' => $user->can('create', Product::class),
                    ]
                ] : null;
            }
        ]);
        return $next($request);
    }
}
