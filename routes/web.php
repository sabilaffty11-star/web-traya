<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// ==================== HALAMAN STATIS ====================

// Halaman Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman statis (Cara Kerja, Tentang Kami, Bantuan)
Route::get('/cara-kerja', function () {
    return view('cara-kerja');
})->name('cara-kerja');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/bantuan', function () {
    return view('bantuan');
})->name('bantuan');

// ==================== ROUTE PRODUK (PUBLIC) ====================

// Daftar produk dan detail produk (bisa diakses semua orang)
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');

// Profil penjual (bisa diakses semua orang)
Route::get('/penjual/{id}', [ProductController::class, 'sellerProfile'])->name('seller.show');

// ==================== ROUTE DASHBOARD ====================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==================== ROUTE YANG BUTUH LOGIN (AUTH) ====================

Route::middleware('auth')->group(function () {
    
    // ==================== ROUTE PROFIL ====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ==================== ROUTE CRUD PRODUK ====================
    Route::get('/jual', [ProductController::class, 'create'])->name('products.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // ==================== ROUTE CHAT ====================
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/start/{productId}', [ChatController::class, 'startChat'])->name('chat.start');
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{id}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    
    // ==================== ROUTE ORDER / PEMBELIAN ====================
    
    // Checkout dan proses order
    Route::get('/checkout/{productId}', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/order/{productId}', [OrderController::class, 'store'])->name('order.store');
    
    // Detail dan sukses order
    Route::get('/order/success/{orderId}', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/detail/{orderId}', [OrderController::class, 'detail'])->name('order.detail');
    
    // Upload bukti transfer
    Route::get('/order/upload-proof/{orderId}', [OrderController::class, 'uploadProof'])->name('order.upload-proof');
    Route::post('/order/upload-proof/{orderId}', [OrderController::class, 'storeProof'])->name('order.store-proof');
    
    // Daftar pesanan
    Route::get('/orders/my-orders', [OrderController::class, 'myOrders'])->name('order.my-orders');
    Route::get('/orders/incoming', [OrderController::class, 'incomingOrders'])->name('order.incoming');
    
    // Update status pesanan (untuk penjual)
    Route::put('/order/status/{orderId}', [OrderController::class, 'updateStatus'])->name('order.update-status');
    
    // Konfirmasi pembayaran (untuk penjual)
    Route::post('/order/confirm-payment/{orderId}', [OrderController::class, 'confirmPayment'])->name('order.confirm-payment');
});

// ==================== AUTH ROUTES (DARI LARAVEL BREEZE) ====================

require __DIR__.'/auth.php';