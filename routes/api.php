<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VazifaController;
use App\Http\Controllers\Api\AuthController;

// 1. Ochiq yo'l (Hamma kirishi mumkin)
Route::post('/login', [AuthController::class, 'login']);

// 2. Himoyalangan yo'llar (Faqat Tokeni borlar uchun)
Route::middleware('auth:sanctum')->group(function () {
    
    // Foydalanuvchi ma'lumotlarini olish
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Vazifalar CRUD yo'llari
    Route::get('/vazifalar', [VazifaController::class, 'index']);      // Ko'rish
    Route::post('/vazifalar', [VazifaController::class, 'store']);    // Qo'shish
    Route::patch('/vazifalar/{id}', [VazifaController::class, 'update']); // Tahrirlash
    Route::delete('/vazifalar/{id}', [VazifaController::class, 'destroy']); // O'chirish

}); // MANA SHU YERDA QAVS YOPILISHI KERAK EDI!