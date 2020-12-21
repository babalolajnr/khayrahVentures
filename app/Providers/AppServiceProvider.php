<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerInertia();
    }

    //create shared data to be viewed from any page in the app
    public function registerInertia()
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
                        'create_product' => $user->can('create', Product::class),
                    ]
                ] : null;
            }
        ]);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
