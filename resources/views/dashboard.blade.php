<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as ") }} <strong>{{ Auth::user()->role }}</strong>!
                </div>
            </div>

            @if (Auth::user()->role === 'admin')
                <div class="mt-4">
                    <h3 class="text-lg font-bold">Admin Panel</h3>
                    <ul>
                        <li><a href="{{ route('books.index') }}" class="text-blue-500">Manage Books</a></li>
                        <li><a href="{{ route('books.trashed') }}" class="text-blue-500">View Trashed Books</a></li>
                        <li><a href="{{ url('/admin') }}" class="text-blue-500">Admin-Only Section</a></li>
                    </ul>
                </div>
            @else
                <div class="mt-4">
                    <h3 class="text-lg font-bold">User Panel</h3>
                    <ul>
                        <li><a href="{{ route('books.index') }}" class="text-green-500">View Books</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
