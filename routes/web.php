<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Halaman Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route untuk produk (bisa diakses semua orang)
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');

// Route untuk profil penjual
Route::get('/penjual/{id}', [ProductController::class, 'sellerProfile'])->name('seller.show');

// Route dashboard (butuh login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route yang butuh login (auth) untuk CRUD produk
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // CRUD produk (butuh login)
    Route::get('/jual', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Route chat (butuh login)
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/start/{productId}', [ChatController::class, 'startChat'])->name('chat.start');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{id}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
});

// Auth routes (dari Laravel Breeze)
require __DIR__.'/auth.php';