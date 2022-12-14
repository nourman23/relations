<?php

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AutherController;
use App\Http\Controllers\AuthersController;
use PharIo\Manifest\AuthorCollection;

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

// Route::get('add', function () {
//     return view('add_books');
// });

Route::get('add', [AuthersController::class, 'create']);


// Route::get('test', function () {
//     return "gg";
// });
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

// auther/{{$book['book_auther']}}

Route::get('/auther/{book_auther}', [BooksController::class, 'showAuther']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('signout', [BooksController::class, 'signOut'])->name('signout');

// //authetication
// Route::get('dashboard', [BooksController::class, 'dashboard'])->middleware('can:admin');
// Route::get('login', [BooksController::class, 'login'])->name('login');
Route::post('custom-login', [BooksController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [BooksController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [BooksController::class, 'customRegistration'])->name('register.custom');
// Route::get('signout', [BooksController::class, 'signOut'])->name('signout');