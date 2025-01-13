<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Auth; // This ensures Auth is recognized
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
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/dashboard');
        } else {
            return redirect('/user-dashboard');
        }
    } 
     
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth', 'role:admin');

Route::get('/user-dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard')->middleware('auth', 'role:user');






// Route::get('/redirect-dashboard', function () {
//     if (Auth::user()->role === 'admin') {
//         return redirect('/dashboard');
//     } else {
//         return redirect('/user-dashboard');
//     }
// })->middleware('auth');



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
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');


Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/trashed', [BookController::class, 'trashed'])->name('books.trashed');

Route::patch('/books/{book}/restore', [BookController::class, 'restore'])->name('books.restore');

Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Author routes
Route::resource('authors', AuthorController::class);

// Publisher routes
Route::resource('publishers', PublisherController::class);

// Borrower routes
Route::resource('borrowers', BorrowerController::class);
Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');

//Borrow history routes
Route::get('/borrows/history', [App\Http\Controllers\BorrowerController::class, 'history'])->name('borrows.history');



