<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    $books = Book::when($search, function ($query, $search) { //when(): Dynamically applies the search filter only if $search is provided.
        $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%']) //whereRaw(): Allows raw SQL to apply the LOWER() function for case-insensitive search.
              ->orWhereRaw('LOWER(author) LIKE ?', ['%' . strtolower($search) . '%']) //orWhereRaw(): Extends the search to additional fields like description.
              ->orWhereRaw('LOWER(isbn) LIKE ?', ['%' . strtolower($search) . '%'])
              ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%']);
            })->get();

        //Retrive all books
        // $books =Book::all();

        // Pass the books to the index view
    return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource(book's details).
     */
    public function edit(Book $book)
    {
       
        //load the edit.blade.php view and pass the specific book to it
        return view('books.edit',compact('book')); //compact creates an associative array where the key is 'book' and the value is the $book object
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book) //update the book record in the database
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'published_year' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        $book->update($request->all()); 

        //After updating, the user is redirected back to the book listing page (books.index route)
    return redirect()->route('books.index')->with('success', 'Book updated successfully.'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete(); //Soft Deletes the book from the database
        return redirect()->route('books.index')->with('success','Book deleted successfully.');
    }
}
