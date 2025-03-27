<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('notifications', function () {
    return Inertia::render('Notifications');
})->middleware(['auth', 'verified'])->name('notifications');

Route::get('logs', function () {
    return Inertia::render('Logs');
})->middleware(['auth', 'verified'])->name('logs');

use App\Http\Controllers\BookshelfController;

Route::get('/bookshelves', [BookshelfController::class, 'index']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
