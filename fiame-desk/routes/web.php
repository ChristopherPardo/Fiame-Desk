<?php

use App\Http\Controllers\GatheringController;
use App\Http\Controllers\UserController;
use App\Models\Gathering;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('admin')->group(function () {
    Route::get('/members', function () {
        $users = User::orderBy('firstname')->get();
        return view('members')->with(compact('users'));
    })->name('members');

    Route::post('/members/{user}', [UserController::class, 'update'])->name('members.update');
    Route::post('/members', [UserController::class, 'store'])->name('users.store');

    Route::post('/events/{gathering}', [GatheringController::class, 'Delete'])->name('events.delete');
    Route::post('/events', [GatheringController::class, 'store'])->name('events.store');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/events', function () {
        $gatherings = Gathering::orderBy('date')->get();
        return view('events')->with(compact('gatherings'));
    })->name('events');
});
