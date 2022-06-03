<?php

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

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group(['prefix' => '/produtos', 'as' => 'product.'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/criar', [ProductController::class, 'create'])->name('create');
    Route::get('/atualizar/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::get('/excluir/{id}', [ProductController::class, 'remove'])->name('remove');

    Route::post('/insert', [ProductController::class, 'store'])->name('store');
    Route::post('/update', [ProductController::class, 'update'])->name('update');
    Route::post('/delete', [ProductController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => '/categorias', 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/criar', [CategoryController::class, 'create'])->name('create');
    Route::get('/atualizar/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::get('/excluir/{id}', [CategoryController::class, 'remove'])->name('remove');

    Route::post('/insert', [CategoryController::class, 'store'])->name('store');
    Route::post('/update', [CategoryController::class, 'update'])->name('update');
    Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');
});
