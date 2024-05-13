<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdvertisementController;
use App\Models\Advertisement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Маршруты для авторизации и регистрации
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Маршрут для выхода из системы
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Маршруты для объявлений
Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create')->middleware('check.registered');
Route::post('/advertisements', [AdvertisementController::class, 'store'])->name('advertisements.store');
Route::post('/advertisements/{id}/add-to-cart', [AdvertisementController::class, 'addToCart'])->name('advertisements.add-to-cart')->middleware('check.registered');
Route::get('/cart', [AdvertisementController::class, 'showCart'])->name('cart.index')->middleware('check.registered');
Route::delete('/cart/{cart}/remove', [AdvertisementController::class, 'removeCart'])->name('cart.remove')->middleware('check.registered');

Route::get('/admin', [AdminController::class, 'index'], [UserController::class])->name('admin.index')->middleware('admin');
Route::put('/admin/{advertisement}/approve', [AdminController::class, 'approve'])->name('admin.approve')->middleware('admin');
Route::put('/admin/{advertisement}/reject', [AdminController::class, 'reject'])->name('admin.reject')->middleware('admin');

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit')->middleware('admin');
Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update')->middleware('admin');

Route::get('/admin/advertisements/{id}/edit', [AdminController::class, 'editAdvertisement'])->name('admin.advertisements.edit')->middleware('admin');
Route::put('/admin/advertisements/{id}', [AdminController::class, 'updateAdvertisement'])->name('admin.advertisements.update')->middleware('admin');