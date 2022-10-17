<?php

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\AuthersController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('add', function () {
    return view('add_books');
});

Route::get('test', function () {
    return "gg";
});
Route::get('update/{id}', [BooksController::class, 'update'])->name('up');


Route::get('/index', [BooksController::class, 'index']);

Route::post('/req', [BooksController::class, 'store'])->name('req');
Route::delete('/delete/{id}', [BooksController::class, 'destroy'])->name('delete');
Route::put('/put/{id}', [BooksController::class, 'updateBook'])->name('put');
Route::post('/findBook', [BooksController::class, 'findBook'])->name('Find');


Route::get('/trash', [BooksController::class, 'Trash'])->name('Trash');
Route::get('/restore/{id}', [BooksController::class, 'restore'])->name('restore');

Route::get('sortUp', [BooksController::class, 'sortUp']);
Route::get('sortDown', [BooksController::class, 'sortDown']);

///relsations 

Route::get('/viewBooks', [AuthersController::class, 'show']);
Route::get('/viewByAuther/{id}', [AuthersController::class, 'index']);