<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Logged In Message -->
            <div class="bg-white border border-gray-300 text-gray-800 rounded-lg shadow-md p-6">
                <p class="text-xl font-semibold">
                    {{ __("You're logged in as ") }} 
                    <span class="text-indigo-600 uppercase">{{ Auth::user()->role }}</span>!
                </p>
            </div>

            <!-- Profile Information -->
            <div class="bg-white border border-gray-300 text-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold mb-4 text-indigo-700">Your Profile</h3>
                <div class="grid grid-cols-2 gap-4">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                <!-- Admin Panel Links -->
                <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold mb-6 text-center text-indigo-700">Admin Panel</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="{{ route('books.index') }}" 
                           class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg text-center transform transition hover:scale-105">
                            Manage Books
                        </a>
                        <a href="{{ route('books.trashed') }}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg text-center transform transition hover:scale-105">
                            View Trashed Books
                        </a>
                        <a href="{{ url('/borrowers') }}" 
                           class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg text-center transform transition hover:scale-105">
                            Manage Borrowers
                        </a>
                        <a href="{{ url('/publishers') }}" 
                           class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg text-center transform transition hover:scale-105">
                            Manage Publishers
                        </a>
                        <a href="{{ url('/authors') }}" 
                           class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg text-center transform transition hover:scale-105">
                            Manage Authors
                        </a>
                    </div>
                </div>
            @endif

            <!-- Go to Home Page Button -->
            <div class="bg-white border border-gray-300 text-gray-800 rounded-lg shadow-md p-6 text-center">
                <a href="{{ url('/home') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white text-lg font-bold py-3 px-6 rounded-lg shadow-lg transform transition hover:scale-105">
                    Go to Home Page
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
