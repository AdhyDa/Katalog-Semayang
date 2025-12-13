<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\CustomerController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show')->where('id', '[0-9]+');
Route::get('/katalog/{kategori}', [KatalogController::class, 'kategori'])->name('katalog.kategori')->where('kategori', '[a-zA-Z]+');
Route::get('/katalog/pria', [KatalogController::class, 'pria'])->name('katalog.pria');
Route::get('/katalog/wanita', [KatalogController::class, 'wanita'])->name('katalog.wanita');
Route::get('/katalog/aksesoris', [KatalogController::class, 'aksesoris'])->name('katalog.aksesoris');
Route::get('/cara-sewa', [HomeController::class, 'caraSewa'])->name('cara-sewa');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/daftar', [AuthController::class, 'showRegister'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'register'])->name('daftar.post');
});

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::post('/order/confirm/{id}', [OrderController::class, 'confirm'])->name('admin.order.confirm');
    Route::post('/order/reject/{id}', [OrderController::class, 'reject'])->name('admin.order.reject');

    Route::get('/order-detail/{id}', function ($id) {
        // Note: This view requires $order data, may need a controller
        return view('admin.order-detail');
    })->name('admin.order-detail');

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]);

    Route::resource('payment-methods', App\Http\Controllers\Admin\PaymentMethodController::class)
    ->names([
        'index' => 'admin.payment-methods.index',
        'create' => 'admin.payment-methods.create',
        'store' => 'admin.payment-methods.store',
        'edit' => 'admin.payment-methods.edit',
        'update' => 'admin.payment-methods.update',
        'destroy' => 'admin.payment-methods.destroy'
    ]);

    Route::get('/transactions', [OrderController::class, 'transactions'])->name('admin.transactions');
    Route::post('/order/complete/{id}', [OrderController::class, 'complete'])->name('admin.order.complete');

    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.reports');

    Route::get('/ganti-password', [AdminController::class, 'showChangePassword'])->name('password.form');
    Route::post('/ganti-password', [AdminController::class, 'updatePassword'])->name('password.update');
});

// Customer Routes
Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('/orders', function () {
        $orders = auth()->user()->rentals()->orderBy('created_at', 'desc')->paginate(10);
        return view('customer.orders', compact('orders'));
    })->name('customer.orders');

    Route::get('/order/{id}', function ($id) {
        $order = auth()->user()->rentals()->findOrFail($id);
        return view('customer.order-detail', compact('order'));
    })->name('customer.order.detail');

    Route::get('/profile', function () {
        return view('customer.profile', ['user' => auth()->user()]);
    })->name('customer.profile');

    Route::put('/profile', [CustomerController::class, 'update'])->name('customer.profile.update');
    Route::post('/password/change', [CustomerController::class, 'changePassword'])->name('customer.password.change');
    Route::get('/ganti-password', [CustomerController::class, 'showChangePassword'])->name('customer.password.form');
    Route::post('/ganti-password', [CustomerController::class, 'updatePassword'])->name('customer.password.update');
});
