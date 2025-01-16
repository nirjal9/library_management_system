<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserProfileController;
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

Route::get('/user-dashboard', [BookController::class, 'userDashboard'])->name('user.dashboard')->middleware('auth', 'role:user');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Protect routes for admin role
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
    Route::get('/books/trashed', [BookController::class, 'trashed'])->name('books.trashed');
    Route::patch('/books/{book}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');
});

// Public routes for viewing books (accessible to both admin and user)
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Author routes (admin only)
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('authors', AuthorController::class);
//     Route::resource('publishers', PublisherController::class)->except(['show']);;
//     Route::resource('borrowers', BorrowerController::class);
// });

// Author Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('authors', AuthorController::class)->except(['index', 'show']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
});

// Publisher Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('publishers', PublisherController::class)->except(['index', 'show']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('publishers', [PublisherController::class, 'index'])->name('publishers.index');
    Route::get('publishers/{publisher}', [PublisherController::class, 'show'])->name('publishers.show');
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->name('books.return');
});


// Borrow history route for users
Route::get('/borrows/history', [App\Http\Controllers\BorrowerController::class, 'history'])->name('borrows.history')->middleware('auth', 'role:user');

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});

Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
Route::get('/publishers/{id}', [PublisherController::class, 'show'])->name('publishers.show')->middleware('auth');


Route::post('/reviews/{type}/{id}', [ReviewController::class, 'addReview'])->name('addReview');

Route::resource('borrowers', BorrowerController::class);


Auth::routes(['register' => true]);



Route::get('/public-books', [BookController::class, 'publicBooks'])->name('books.public');








