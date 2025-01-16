<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                    

                    <!-- User Profile Section -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold">Your Profile</h4>
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>

                    <!-- Go to Book List Button -->
<div class="mb-6">
    <a href="{{ url('/books') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Go to Book List
    </a>

</div>

                    <!-- Borrowed Books Section -->
                    <div class="mb-6">
                        <h4 class="text-md font-semibold">Borrowed Books</h4>
                        <table class="table-auto w-full border">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Title</th>
                                    <th class="border px-4 py-2">Authors</th>
                                    <th class="border px-4 py-2">Borrowed At</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($borrowedBooks as $book)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $book->id }}</td>
                                        <td class="border px-4 py-2">{{ $book->title }}</td>
                                        <td class="border px-4 py-2">@foreach($book->authors as $author)
                                            {{ $author->name }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach</td>
                                        <td class="border px-4 py-2">{{ $book->borrowed_at }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('books.return', $book->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded">
                                                    Return
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="border px-4 py-2 text-center">No borrowed books</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-6">
                        <a href="{{ url('/borrows/history') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                           View Borrow History
                        </a>
                    
                    </div>
                    <!-- Available Books Section -->
                    <div>
                        <h4 class="text-md font-semibold">Available Books</h4>
                        <table class="table-auto w-full border">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Title</th>
                                    <th class="border px-4 py-2">Authors</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @forelse($availableBooks as $book)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $book->id }}</td>
                                        <td class="border px-4 py-2">{{ $book->title }}</td>
                                        <td class="border px-4 py-2">@foreach($book->authors as $author)
                                            {{ $author->name }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                        </td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded">
                                                    Borrow
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="border px-4 py-2 text-center">No available books</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>
</x-app-layout>
