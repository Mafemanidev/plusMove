<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }

    public function boot(): void {
        // Define Redirection Rules for Home Route
        $this->app->afterResolving(Redirector::class, function (Redirector $redirector) {
            $redirector->macro('home', function () {
                $user = Auth::user();

                if ($user) {
                    return redirect()->route(match ($user->group->name ?? '') {
                        'Driver' => 'driver.dashboard',
                        default => 'dashboard',
                    });
                }
                return redirect()->route('login');
            });
        });
    }
}

