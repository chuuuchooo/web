<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FamilyPlanningController;
use App\Http\Controllers\ChildProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\ImmunizationController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('family-planning', FamilyPlanningController::class);
    Route::resource('immunization', ImmunizationController::class);
    Route::get('/immunization-dashboard', [ImmunizationController::class, 'dashboard'])->name('immunization.dashboard');
    
    // Vaccination routes
    Route::get('/vaccination/{id}/edit', [VaccinationController::class, 'edit'])->name('vaccination.edit');
    Route::put('/vaccination/{id}', [VaccinationController::class, 'update'])->name('vaccination.update');
    Route::post('/vaccination/{id}/complete', [VaccinationController::class, 'markCompleted'])->name('vaccination.complete');
    
    // Change profile routes to account routes for regular users
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');

    Route::get('/bmi-calculator', [HomeController::class, 'bmiCalculator'])->name('bmi.calculator');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/user-activity', [AdminController::class, 'userActivity'])->name('user-activity');
    Route::get('/family-planning-records', [AdminController::class, 'familyPlanningRecords'])->name('family-planning-records');
    Route::get('/family-planning/{id}/edit-history', [AdminController::class, 'familyPlanningEditHistory'])->name('family-planning.edit-history');
    
    // Admin still has access to manage user profiles
    Route::resource('profile', ProfileController::class);
});
