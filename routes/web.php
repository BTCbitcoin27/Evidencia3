<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SalesController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('orders', OrderController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('auth');

Route::resource('admin', AdminController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware('auth', 'admin');

Route::resource('sales', SalesController::class)
    ->only(['index', 'create', 'edit', 'store'])
    ->middleware('auth', 'sales');

Route::resource('warehouse', WarehouseController::class)
    ->only(['index', 'updateStatus', 'edit'])
    ->middleware('auth', 'warehouse');

Route::resource('ruta', OrderController::class)
    ->only(['index', 'show', 'updateStatus'])
    ->middleware('auth');

Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.create');
Route::get('/orders/{invoice_number}', [OrderController::class, 'show']);
Route::patch('/orders/{order}', [OrderController::class, 'updateStatus']);
Route::put('/warehouse/{order}', [WarehouseController::class, 'updateStatus'])->name('warehouse.updateStatus');
Route::get('/ruta', [RutaController::class, 'index'])->name('ruta.index');
Route::put('/ruta/{order}', [RutaController::class, 'updateStatus'])->name('ruta.updateStatus');
Route::post('/ruta/{order}/upload1', [RutaController::class, 'uploadImage1'])->name('ruta.uploadImage1');
Route::post('/ruta/{order}/upload2', [RutaController::class, 'uploadImage2'])->name('ruta.uploadImage2');

require __DIR__.'/auth.php';
