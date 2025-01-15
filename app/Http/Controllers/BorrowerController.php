<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowers = Borrower::all(); // Fetch all borrowers
        return view('borrowers.index', compact('borrowers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('borrowers.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:borrowers,email',
            'phone' => 'nullable|string|max:15',
        ]);
    
        Borrower::create($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrower $borrower)
    {
        return view('borrowers.edit', compact('borrower'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrower $borrower)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:borrowers,email,' . $borrower->id,
            'phone' => 'nullable|string|max:15',
        ]);
    
        $borrower->update($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrower $borrower)
    {
        $borrower->delete();
        return redirect()->route('borrowers.index')->with('success', 'Borrower deleted successfully!');
    }
    

    public function history()
{
    $borrows = \App\Models\Borrow::with(['book', 'user'])->paginate(10); // Show 10 records per page
    return view('borrows.history', compact('borrows'));
}


}
