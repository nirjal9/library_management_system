<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->profile;
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $user = Auth::user();
    
        // Check if user profile exists; if not, create it
        if (!$user->profile) {
            $user->profile()->create([
                'address' => 'N/A', // Default value
                'contact_number' => 'N/A', // Default value
            ]);
        }
    
        return view('profile.edit', ['profile' => $user->profile]);
    }
    

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);
    
        // Update the user's name and email in the users table
        $user = Auth::user();
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        // Update the user profile details in the user_profiles table
        $user->profile()->update([
            'address' => $request->input('address'),
            'contact_number' => $request->input('contact_number'),
        ]);
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
    
}

