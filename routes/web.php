<?php

use App\Http\Controllers\AddBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfirmOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// authentication
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store');

Route::get('/logout', [LogoutController::class, 'destroy'])->name('logout');

Route::get('/login', [LoginController::class, 'login']) -> name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/loginCart', [LoginController::class, 'loginCart']);
Route::post('/loginCart', [LoginController::class, 'storeCart']);

// Admin
Route::get('/addbook', [AddBookController::class, 'index'])->name('addbook');
Route::post('/addbook', [AddBookController::class, 'store']);


// cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/addtocart/{id}', [CartController::class, 'addtocart']);
Route::get('/removeFromCart/{id}', [CartController::class, 'removeFromCart']);
Route::post('/updateCart', [CartController::class, 'updateCart']) -> name('updateCart');

// confirm order
Route::get('/confirm-order' , [ConfirmOrderController::class, 'index'])->name('confirm-order');
Route::post('/confirm-order' , [ConfirmOrderController::class, 'saveAddress'])->name('confirm-address');
Route::post('/confirm-done' , [ConfirmOrderController::class, 'confirmOrder'])->name('confirm-done');

// order
Route::get('/myorder' , [MyOrderController::class, 'index'])->name('myorder');
Route::get('/cancelOrders' , [MyOrderController::class, 'deleteOrder'])->name('cancelOrder');


// books
Route::get('/books' , [BookController::class, 'index'])->name('books');