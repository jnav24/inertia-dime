<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetTemplateController;
use App\Http\Controllers\CommonExpenseController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserMfaController;
use App\Http\Controllers\UserVehicleController;
use App\Http\Controllers\VehicleController;
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
})->middleware(['auth', 'mfa', 'verified'])->name('dashboard');

Route::middleware(['auth', 'mfa', 'verified'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/budgets/template', [BudgetTemplateController::class, 'index'])
            ->name('budget.template.index');
        Route::patch('/budgets/template/{uuid}', [BudgetTemplateController::class, 'update'])
            ->name('budget.template.update');

        Route::get('/budgets', [BudgetController::class, 'index'])
            ->name('budget.index');
        Route::get('/budgets/{uuid}', [BudgetController::class, 'show'])
            ->name('budget.show');
        Route::post('/budgets', [BudgetController::class, 'store'])
            ->name('budget.store');
        Route::delete('/budgets', [BudgetController::class, 'destroy'])
            ->name('budget.destroy');
        Route::patch('/budgets/{uuid}', [BudgetController::class, 'update'])
            ->name('budget.update');

        Route::post('/user-vehicle', [UserVehicleController::class, 'store'])->name('user-vehicle.store');
        Route::patch('/user-vehicle/{uuid}', [UserVehicleController::class, 'update'])->name('user-vehicle.update');
        Route::delete('/user-vehicle', [UserVehicleController::class, 'destroy'])->name('user-vehicle.destroy');

        // save expenses
        Route::middleware('aggregate')->group(function () {
            Route::post('/expense/banks', [BankController::class, 'store'])->name('expense.bank.store');
            Route::patch('/expense/banks/{uuid}', [BankController::class, 'update'])->name('expense.bank.update');
            Route::delete('/expense/banks', [BankController::class, 'destroy'])->name('expense.bank.destroy');

            Route::post('/expense/income', [IncomeController::class, 'store'])->name('expense.income.store');
            Route::patch('/expense/income/{uuid}', [IncomeController::class, 'update'])->name('expense.income.update');
            Route::delete('/expense/income', [IncomeController::class, 'destroy'])->name('expense.income.destroy');

            Route::post('/expense/investments', [InvestmentController::class, 'store'])->name('expense.investment.store');
            Route::patch('/expense/investments/{uuid}', [InvestmentController::class, 'update'])->name('expense.investment.update');
            Route::delete('/expense/investments', [InvestmentController::class, 'destroy'])->name('expense.investment.destroy');

            Route::post('/expense/creditCards', [CreditCardController::class, 'store'])->name('expense.credit_cards.store');
            Route::patch('/expense/creditCards/{uuid}', [CreditCardController::class, 'update'])->name('expense.credit_cards.update');
            Route::delete('/expense/creditCards', [CreditCardController::class, 'destroy'])->name('expense.credit_cards.destroy');

            Route::post('/expense/childcare', [CommonExpenseController::class, 'store'])->name('expense.childcare.store');
            Route::patch('/expense/childcare/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.childcare.update');
            Route::delete('/expense/childcare', [CommonExpenseController::class, 'destroy'])->name('expense.childcare.destroy');

            Route::post('/expense/education', [CommonExpenseController::class, 'store'])->name('expense.education.store');
            Route::patch('/expense/education/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.education.update');
            Route::delete('/expense/education', [CommonExpenseController::class, 'destroy'])->name('expense.education.destroy');

            Route::post('/expense/entertainment', [CommonExpenseController::class, 'store'])->name('expense.entertainment.store');
            Route::patch('/expense/entertainment/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.entertainment.update');
            Route::delete('/expense/entertainment', [CommonExpenseController::class, 'destroy'])->name('expense.entertainment.destroy');

            Route::post('/expense/food', [CommonExpenseController::class, 'store'])->name('expense.food.store');
            Route::patch('/expense/food/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.food.update');
            Route::delete('/expense/food', [CommonExpenseController::class, 'destroy'])->name('expense.food.destroy');

            Route::post('/expense/gift', [CommonExpenseController::class, 'store'])->name('expense.gift.store');
            Route::patch('/expense/gift/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.gift.update');
            Route::delete('/expense/gift', [CommonExpenseController::class, 'destroy'])->name('expense.gift.destroy');

            Route::post('/expense/housing', [CommonExpenseController::class, 'store'])->name('expense.housing.store');
            Route::patch('/expense/housing/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.housing.update');
            Route::delete('/expense/housing', [CommonExpenseController::class, 'destroy'])->name('expense.housing.destroy');

            Route::post('/expense/loan', [CommonExpenseController::class, 'store'])->name('expense.loan.store');
            Route::patch('/expense/loan/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.loan.update');
            Route::delete('/expense/loan', [CommonExpenseController::class, 'destroy'])->name('expense.loan.destroy');

            Route::post('/expense/medical', [CommonExpenseController::class, 'store'])->name('expense.medical.store');
            Route::patch('/expense/medical/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.medical.update');
            Route::delete('/expense/medical', [CommonExpenseController::class, 'destroy'])->name('expense.medical.destroy');

            Route::post('/expense/miscellaneous', [CommonExpenseController::class, 'store'])->name('expense.miscellaneous.store');
            Route::patch('/expense/miscellaneous/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.miscellaneous.update');
            Route::delete('/expense/miscellaneous', [CommonExpenseController::class, 'destroy'])->name('expense.miscellaneous.destroy');

            Route::post('/expense/personal', [CommonExpenseController::class, 'store'])->name('expense.personal.store');
            Route::patch('/expense/personal/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.personal.update');
            Route::delete('/expense/personal', [CommonExpenseController::class, 'destroy'])->name('expense.personal.destroy');

            Route::post('/expense/shopping', [CommonExpenseController::class, 'store'])->name('expense.shopping.store');
            Route::patch('/expense/shopping/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.shopping.update');
            Route::delete('/expense/shopping', [CommonExpenseController::class, 'destroy'])->name('expense.shopping.destroy');

            Route::post('/expense/subscription', [CommonExpenseController::class, 'store'])->name('expense.subscription.store');
            Route::patch('/expense/subscription/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.subscription.update');
            Route::delete('/expense/subscription', [CommonExpenseController::class, 'destroy'])->name('expense.subscription.destroy');

            Route::post('/expense/tax', [CommonExpenseController::class, 'store'])->name('expense.tax.store');
            Route::patch('/expense/tax/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.tax.update');
            Route::delete('/expense/tax', [CommonExpenseController::class, 'destroy'])->name('expense.tax.destroy');

            Route::post('/expense/travel', [CommonExpenseController::class, 'store'])->name('expense.travel.store');
            Route::patch('/expense/travel/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.travel.update');
            Route::delete('/expense/travel', [CommonExpenseController::class, 'destroy'])->name('expense.travel.destroy');

            Route::post('/expense/utility', [CommonExpenseController::class, 'store'])->name('expense.utility.store');
            Route::patch('/expense/utility/{uuid}', [CommonExpenseController::class, 'update'])->name('expense.utility.update');
            Route::delete('/expense/utility', [CommonExpenseController::class, 'destroy'])->name('expense.utility.destroy');

            Route::post('/expense/vehicle', [VehicleController::class, 'store'])->name('expense.vehicle.store');
            Route::patch('/expense/vehicle/{uuid}', [VehicleController::class, 'update'])->name('expense.vehicle.update');
            Route::delete('/expense/vehicle', [VehicleController::class, 'destroy'])->name('expense.vehicle.destroy');
        });

        Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
        Route::post('/reports', [ReportController::class, 'index'])->name('report.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/mfa', [UserMfaController::class, 'store'])->name('profile.mfa.store');
    Route::delete('/profile/mfa', [UserMfaController::class, 'destroy'])->name('profile.mfa.destroy');
    Route::delete('/profile/mfa-api', [UserMfaController::class, 'destroyAPI'])->name('profile.mfa.destroy-api');
});

Route::post('/verify', [UserMfaController::class, 'verify'])->name('verify');

require __DIR__.'/auth.php';
