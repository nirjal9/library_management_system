<x-app-layout>
    <x-slot name="header">
        <!-- Flex container for alignment -->
        <div class="flex justify-between items-center">
            <!-- Header Title -->
            <h2 class="font-semibold text-3xl text-gray-100 leading-tight">
                {{ __('User Dashboard') }}
            </h2>
            <!-- Go to Home Page Button -->
            <a href="{{ url('/home') }}" 
               class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white text-lg font-bold py-2 px-6 rounded-lg shadow-lg transition">
                Go to Home Page
            </a>
        </div>
    </x-slot>
    

    <div class="py-12 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Message -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p class="text-lg"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p class="text-lg"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>

            </div>

            <!-- Borrowed Books Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-xl font-bold text-gray-800 mb-4">Borrowed Books</h4>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-800">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Authors</th>
                            <th class="py-3 px-4">Borrowed At</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowedBooks as $book)
                            <tr class="border-t border-gray-200">
                                <td class="py-3 px-4">{{ $book->id }}</td>
                                <td class="py-3 px-4">{{ $book->title }}</td>
                                <td class="py-3 px-4">
                                    @foreach($book->authors as $author)
                                        {{ $author->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
                                <td class="py-3 px-4">{{ $book->borrowed_at }}</td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('books.return', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg shadow-lg transition">
                                            Return
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-4 text-center text-gray-500">No borrowed books</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ url('/borrows/history') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
                        View Borrow History
                    </a>
                </div>
            </div>

            <!-- Available Books Section -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h4 class="text-xl font-bold text-gray-800 mb-4">Available Books</h4>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-800">
                            <th class="py-3 px-4">ID</th>
                            <th class="py-3 px-4">Title</th>
                            <th class="py-3 px-4">Authors</th>
                            <th class="py-3 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($availableBooks as $book)
                            <tr class="border-t border-gray-200">
                                <td class="py-3 px-4">{{ $book->id }}</td>
                                <td class="py-3 px-4">{{ $book->title }}</td>
                                <td class="py-3 px-4">
                                    @foreach($book->authors as $author)
                                        {{ $author->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-lg shadow-lg transition">
                                            Borrow
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-center text-gray-500">No available books</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ url('/books') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition">
                        Go to Book List
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
