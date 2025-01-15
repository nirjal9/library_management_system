<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Logged In Message -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as ") }} <strong>{{ Auth::user()->role }}</strong>!
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Your Profile</h3>
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                <!-- Admin Panel Links -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">Admin Panel</h3>
                        <ul class="list-disc list-inside">
                            <li><a href="{{ route('books.index') }}" class="text-blue-500 hover:underline">Manage Books</a></li>
                            <li><a href="{{ route('books.trashed') }}" class="text-blue-500 hover:underline">View Trashed Books</a></li>
                            <li><a href="{{ url('/admin') }}" class="text-blue-500 hover:underline">Admin-Only Section</a></li>
                        </ul>
                    </div>
                </div>

            @endif

            
        </div>

    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Existing sections here -->
    
            <!-- Go to Book List Button -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ url('/books') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block text-center">
                        Go to Book List
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    
    
</x-app-layout>
