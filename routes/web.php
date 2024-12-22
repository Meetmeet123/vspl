<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComboPlanController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EligibilityCriteriaController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users Only)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Auth::check() 
        ? redirect()->route('dashboard') 
        : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', function () {
        return Auth::check() 
            ? redirect()->route('profile.edit') 
            : redirect()->route('login');
    })->name('profile');
    
    // Profile management routes
    Route::middleware(['auth'])->prefix('profile')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Show profile edit form
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update'); // Handle profile update
        Route::delete('/delete', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Handle account deletion
    });

    // Dashboard Route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Plan Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('plans')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('plans.index');
        Route::get('/data', [PlanController::class, 'getData'])->name('plans.data');
        Route::get('/list', [PlanController::class, 'getPlans'])->name('plans.list');
        Route::get('/create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('/', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/{plan}', [PlanController::class, 'update'])->name('plans.update');
        Route::delete('/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy'); // Added destroy route
    });

    /*
    |--------------------------------------------------------------------------
    | Combo Plan Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('combo-plans')->group(function () {
        Route::get('/', [ComboPlanController::class, 'index'])->name('combo-plans.index');
        Route::get('/data', [ComboPlanController::class, 'getData'])->name('combo-plans.data');
        Route::get('/create', [ComboPlanController::class, 'create'])->name('combo-plans.create');
        Route::post('/', [ComboPlanController::class, 'store'])->name('combo-plans.store');
        Route::get('/{comboPlan}/edit', [ComboPlanController::class, 'edit'])->name('combo-plans.edit');
        Route::put('/{comboPlan}', [ComboPlanController::class, 'update'])->name('combo-plans.update');
        Route::delete('/{comboPlan}', [ComboPlanController::class, 'destroy'])->name('combo-plans.destroy'); // Added destroy route
    });

    /*
    |--------------------------------------------------------------------------
    | Eligibility Criteria Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('eligibility-criteria')->group(function () {
        Route::get('/', [EligibilityCriteriaController::class, 'index'])->name('eligibility-criteria.index');
        Route::get('/eligibility-criteria/data', [EligibilityCriteriaController::class, 'getData'])->name('eligibility-criteria.data');
        Route::get('/create', [EligibilityCriteriaController::class, 'create'])->name('eligibility-criteria.create');
        Route::post('/', [EligibilityCriteriaController::class, 'store'])->name('eligibility-criteria.store');
        Route::get('/{eligibilityCriteria}/edit', [EligibilityCriteriaController::class, 'edit'])->name('eligibility-criteria.edit');
        Route::put('/{eligibilityCriteria}', [EligibilityCriteriaController::class, 'update'])->name('eligibility-criteria.update');
        Route::delete('/{eligibilityCriteria}', [EligibilityCriteriaController::class, 'destroy'])->name('eligibility-criteria.destroy');
    });
    
});
