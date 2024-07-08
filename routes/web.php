<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/switch-branch', [ProfileController::class, 'switchBranch'])->name('profile.switch-branch');
});

// Branches routes
Route::resource('branches', BranchController::class)->middleware('auth');

// Test routes
Route::post('/test-toast', function () {
    return redirect()->back()->with('toast', [
        'message' => 'This is a toast message',
        'type' => 'error',
    ]);
})->name('test.toast');

require __DIR__.'/auth.php';
