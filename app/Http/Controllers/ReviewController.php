<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request, $type, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a review.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Determine the model type
        switch ($type) {
            case 'book':
                $reviewable = Book::findOrFail($id);
                break;
            case 'publisher':
                $reviewable = Publisher::findOrFail($id);
                break;
            case 'author':
                $reviewable = Author::findOrFail($id);
                break;
            default:
                abort(404, 'Invalid reviewable type');
        }

        // Create the review
        $reviewable->reviews()->create([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', ucfirst($type) . ' reviewed successfully!');
    }
}
          