<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::middleware(['auth', 'verified'])->get('/dashboard', [UserController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->get('/user/{id}', [UserController::class, 'show'])->name('user.show');

Route::middleware('auth')->post('/user/heartbeat', [UserController::class, 'heartbeat']);


Route::middleware('auth')->get('/chat', [ChatController::class, 'index'])->name('chat.index');

Route::middleware('auth')->post('/chat/start', [ChatController::class, 'startChat'])->name('chat.start');

Route::middleware('auth')->get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');

Route::middleware('auth')->post('/chat/{id}', [ChatController::class, 'update'])->name('chat.update');

Route::middleware('auth')->post('/chat/{id}/read', [ChatController::class, 'markAsRead'])->name('chat.markAsRead');
