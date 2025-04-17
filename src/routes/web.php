<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products/register', [ProductController::class, 'create']);
Route::get('/products/{productId}', [ProductController::class, 'show']);
Route::get('/products/{productId}/update', [ProductController::class, 'edit']);

Route::post('/products/{productId}/update', [ProductController::class, 'update']);

Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);
Route::post('/products/store', [ProductController::class, 'store'])->name('store');

Route::get('/products', [ProductController::class, 'index'])->name('index');
