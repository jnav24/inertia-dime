<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetTemplateController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/budgets', [BudgetController::class, 'index'])
            ->name('budget.index');
        Route::post('/budgets', [BudgetController::class, 'store'])
            ->name('budget.store');
        Route::patch('/budgets/{uuid}', [BudgetController::class, 'update'])
            ->name('budget.update');

        Route::get('/budgets/template', [BudgetTemplateController::class, 'index'])
            ->name('budget.template.index');
        Route::patch('/budgets/template/{uuid}', [BudgetTemplateController::class, 'update'])
            ->name('budget.template.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
