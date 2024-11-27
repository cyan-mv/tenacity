<?php

use App\Http\Controllers\UserTeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
//    Route::get('/dashboard', function () {
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
    Route::get('/dashboard', [UserTeamController::class, 'index'])->name('dashboard');
//    Route::get('/dashboard', function () {
//        $teams = auth()->user()->teams ?? []; // Adjust based on your data model
//        return Inertia::render('Dashboard', [
//            'teams' => $teams,
//        ]);
//    })->name('dashboard');
//    Route::get('/dashboard', function () {
//        $teams = auth()->user()->teams ?? []; // Adjust based on your data model
//        return Inertia::render('Dashboard', [
//            'teams' => $teams, // Pass the teams to the Dashboard component
//        ]);
//    })->name('dashboard');
    Route::get('/user-teams', [UserTeamController::class, 'index'])->name('user.teams');

    // Join Group route
    Route::post('/user/join-group', [UserTeamController::class, 'joinGroup'])->name('user.join-group');
});
