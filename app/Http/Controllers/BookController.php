<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $availability = $request->input('availability');

        $books = Book::with('authors')
        ->when($search, function ($query, $search) {
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(isbn) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereHas('authors', function ($authorQuery) use ($search) {
                      $authorQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                  });
        })->when($availability, function ($query, $availability) {
        if ($availability === 'available') {
            $query->where('is_borrowed', false); // Show only available books
        } elseif ($availability === 'borrowed') {
            $query->where('is_borrowed', true); // Show only borrowed books
        }
    })->paginate(10);//Use pagination

        // Retrive all books
        // $books =Book::all();

        // Pass the books to the index view
    return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $authors = \App\Models\Author::all();
    $publishers = \App\Models\Publisher::all(); // Fetch all publishers
    return view('books.create', compact('authors', 'publishers'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string', // Comma-separated authors
            'isbn' => 'required|string|unique:books,isbn',
            'published_year' => 'required|integer|min:1000|max:9999',
            'description' => 'required|string',
            'publisher_id' => 'required|exists:publishers,id',
        ]);
    
        // Create the book
        $book = Book::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'published_year' => $request->published_year,
            'description' => $request->description,
            'publisher_id' => $request->publisher_id,
        ]);
    
        // Process authors
        $authorNames = explode(',', $request->authors);
        $authorIds = [];
    
        foreach ($authorNames as $name) {
            $name = trim($name);
            if (!empty($name)) {
                $author = Author::firstOrCreate(['name' => $name]);
                $authorIds[] = $author->id;
            }
        }
    
        // Attach authors to the book
        $book->authors()->sync($authorIds);
    
        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }
    
    


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the book with its associated reviews
        $book = Book::with('reviews')->findOrFail($id);
    
        // Pass the book to the view
        return view('books.show', compact('book'));
    }
    

    /**
     * Show the form for editing the specified resource(book's details).
     */
    public function edit(Book $book)
    {
        $authors = \App\Models\Author::all();
        $publishers = \App\Models\Publisher::all(); // Fetch all publishers
        return view('books.edit', compact('book', 'authors', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id,
            'published_year' => 'required|integer|min:1000|max:9999',
            'description' => 'nullable|string',
            'publisher_id' => 'required|exists:publishers,id',
        ]);
    
        $book->update($request->only(['title', 'isbn', 'published_year', 'description', 'publisher_id']));
    
        // Process authors
        $authorNames = explode(',', $request->authors);
        $authorIds = [];
    
        foreach ($authorNames as $name) {
            $name = trim($name);
            $author = Author::firstOrCreate(['name' => $name]);
            $authorIds[] = $author->id;
        }
    
        // Sync authors with the book
        $book->authors()->sync($authorIds);
    
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete(); //Soft Deletes the book from the database
        return redirect()->route('books.index')->with('success','Book deleted successfully.');
    }

    public function trashed()
    {
        $books = Book::onlyTrashed()->get();
    return view('books.trashed', compact('books'));

    }
    

    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id); // Find the soft-deleted book
        $book->restore(); // Restore the book
        return redirect()->route('books.trashed')->with('success', 'Book restored successfully.');
    }
    
    public function borrow(Request $request, Book $book)
    {
        // Ensure the book is not already borrowed
        if ($book->is_borrowed) {
            return redirect()->back()->with('error', 'This book is already borrowed.');
        }
    
        // Create a borrow record
        $book->borrows()->create([
            'user_id' => auth()->id(),
            'borrowed_at' => now(),
        ]);
    
        // Update the is_borrowed status
        $book->update(['is_borrowed' => true]);
        // dd($book); // Debug the book object after the update
        return redirect()->route('user.dashboard')->with('success', 'Book borrowed successfully!');
    }


    public function returnBook(Request $request, Book $book)
{
    // Check if the book is actually borrowed
    if (!$book->is_borrowed) {
        return redirect()->back()->with('error', 'This book is not currently borrowed.');
    }

    // Find the most recent borrow record for this book where returned_at is NULL
    $borrow = $book->borrows()->whereNull('returned_at')->latest('borrowed_at')->first();

    if ($borrow) {
        $borrow->update(['returned_at' => now()]); // Mark as returned
    }

    // Update the book's is_borrowed status
    $book->update(['is_borrowed' => false]);

    return redirect()->route('user.dashboard')->with('success', 'Book returned successfully!');
}

    

    public function userDashboard()
    {
        $borrowedBooks = Auth::user()
            ->borrows()
            ->whereNull('returned_at') // Only get unreturned borrows
            ->with('book') // Eager load the related book
            ->get()
            ->unique('book_id') // Ensure each book is listed only once
            ->map(function ($borrow) {
                $borrow->book->borrowed_at = $borrow->borrowed_at; // Attach borrowed_at to the book
                return $borrow->book;
            });
    
        $availableBooks = Book::where('is_borrowed', false)->get();
    
        return view('user.dashboard', compact('borrowedBooks', 'availableBooks'));
    }
    
    public function addReview(Request $request, $type, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a review.');
        }
    
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        // Dynamically determine the model class based on the type
        $modelClass = match ($type) {
            'book' => \App\Models\Book::class,
            'publisher' => \App\Models\Publisher::class,
            'author' => \App\Models\Author::class,
            default => abort(404, 'Invalid reviewable type.'),
        };
    
        // Find the specific reviewable item
        $reviewable = $modelClass::findOrFail($id);
    
        // Create a review using the polymorphic relationship
        $reviewable->reviews()->create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->back()->with('success', 'Review added successfully!');
    }
    
    public function publicBooks()
    {
    $books = Book::all(); // Fetch all books
    return view('books.public', compact('books')); // Return the new public view
    }

    
    
}