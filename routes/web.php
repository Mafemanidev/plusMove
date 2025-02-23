<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DriverDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TrackingController;


// Unauthorised Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/tracking/{tracking_code}', [TrackingController::class, 'show'])->name('tracking.show');

Route::get('/unauthorized', function () {

    return view('errors.unauthorized');

})->name('unauthorized');

Route::get('/dynamic-dashboard', function () {
    $user = Auth::user();

    if ($user->group->name === 'Admin') {
        return redirect()->route('dashboard');
    } elseif ($user->group->name === 'Driver') {
        return redirect()->route('driver.dashboard');
    } else {
        return redirect()->route('unauthorized');
    }
})->name('dynamic.dashboard');

// Logout Route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Redirect Home to Login or Dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->group->name === 'Driver'
            ? redirect()->route('driver.dashboard')
            : redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Separate Dashboards for Different Groups
Route::middleware(['auth', 'group:Admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/orders', OrderController::class);
});

Route::middleware(['auth', 'group:Driver'])->group(function () {

    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard');

    Route::post('/driver/orders/{order}/tracking', [DriverDashboardController::class, 'updateTracking'])->name('driver.tracking.update');
});

// Include Auth Routes
require __DIR__.'/auth.php';
