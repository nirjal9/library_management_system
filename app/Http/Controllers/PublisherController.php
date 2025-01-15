<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all(); // Fetch all publishers
        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
    
        Publisher::create($request->all());
        return redirect()->route('publishers.index')->with('success', 'Publisher added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $publisher = Publisher::with('reviews')->findOrFail($id);
        return view('publishers.show', ['publisher' => $publisher, 'type' => 'publisher']);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', compact('publisher'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);
    
        $publisher->update($request->all());
        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully!');
    }
    
}
