<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DarsController;
use Illuminate\Support\Facades\Route;

// 1. Bosh sahifa
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard (Breeze o'zi yaratgan asosiy ichki sahifa)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Profilni tahrirlash (Breeze uchun shart)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. BIZNING VAZIFALAR (Faqat login qilganlar kiradi)
Route::middleware(['auth'])->group(function () {
    Route::get('/dars', [DarsController::class, 'index'])->name('dars.index');
    Route::post('/vazifa-saqlash', [DarsController::class, 'store'])->name('vazifa.store');
    Route::patch('/vazifa-ozgartirish/{id}', [DarsController::class, 'update'])->name('vazifa.update');
    Route::delete('/vazifa-ochirish/{id}', [DarsController::class, 'destroy'])->name('vazifa.destroy');
});
// Yangi Frontend sahifamiz uchun yo'l
Route::get('/front', function () {
    return view('front');
});

require __DIR__.'/auth.php';