<?php

use App\Http\Controllers\MemoryListController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::get('/', fn () => Inertia::render('Welcome'))->name('home');

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('memory-lists', MemoryListController::class);
    Route::get('memory-lists/{id}/test', [MemoryListController::class, 'startTest'])->name('memory-lists.test');
    Route::post('memory-lists/{id}/check-test', [MemoryListController::class, 'checkTest'])->name('memory-lists.check-test');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
