<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/newColoc' , [ColocationController::class , 'store'])->name('newColoc');
Route::get('/colocation' ,[ColocationController::class , 'show'])->name('colocation');

Route::post('/expense' , [ExpenseController::class , 'store'])->name('expense.store');
Route::post('/category' , [CategoryController::class , 'store'])->name('category.store');

Route::get('/colocation/invite/{token}' , [ColocationController::class , 'accept'])->name('invite');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
