<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/ban/{user}', [\App\Http\Controllers\DashboardController::class, 'ban'])->middleware(['auth'])->name('ban');

Route::post('/newColoc' , [ColocationController::class , 'store'])->name('newColoc');
Route::get('/colocation' ,[ColocationController::class , 'show'])->name('colocation');

Route::post('/expense' , [ExpenseController::class , 'store'])->name('expense.store');
Route::post('/category' , [CategoryController::class , 'store'])->name('category.store');
Route::post('/calculate' , [\App\Http\Controllers\SettlementController::class , 'calculate'])->name('settlement.calculate');
Route::patch('/settlement/{settlement}/paid' , [\App\Http\Controllers\SettlementController::class , 'markAsPaid'])->name('settlement.paid');

Route::get('/colocation/invite/{token}' , [ColocationController::class , 'showInvite'])->name('invite');
Route::post('/colocation/invite/{token}/accept' , [ColocationController::class , 'accept'])->name('invite.accept');
Route::post('/colocation/decline' , [ColocationController::class , 'decline'])->name('colocation.decline');
Route::post('/colocation/leave' , [ColocationController::class , 'leave'])->name('colocation.leave');
Route::post('/colocation/kick/{member}' , [ColocationController::class , 'kick'])->name('colocation.kick');
Route::post('/colocation/cancel' , [ColocationController::class , 'cancel'])->name('colocation.cancel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
