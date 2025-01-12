<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Protect routes for admin role
Route::middleware(['role:admin'])->group(function () {
    Route::get('/books/trashed', [BookController::class, 'trashed'])->name('books.trashed');
    Route::patch('/books/{book}/restore', [BookController::class, 'restore'])->name('books.restore');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Welcome Admin!';
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', function () {
        return 'Welcome User!';
    });
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');




//set up all the routes required for CRUD operations:
Route::resource('books',BookController::class);

// Route::get('/books/trashed', [BookController::class, 'trashed'])->name('books.trashed');

// Route::patch('/books/{book}/restore', [BookController::class, 'restore'])->name('books.restore');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
