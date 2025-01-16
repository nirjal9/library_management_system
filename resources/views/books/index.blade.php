<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('books.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                            Add Book
                        </a>
                        <a href="{{ route('books.trashed') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                            View Trashed Books
                        </a>
                    @endif

                    <!-- Back to Dashboard -->
                    <div class="mb-4">
                        <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    <!-- Search Functionality -->
                    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
                        <div class="flex items-center space-x-4">
                            <input type="text" name="search" placeholder="Search by Title, Author, or ISBN" 
                                   value="{{ request('search') }}" class="border-gray-300 rounded-md shadow-sm w-full">

                            <select name="availability" class="border-gray-300 rounded-md shadow-sm">
                                <option value="">All</option>
                                <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="borrowed" {{ request('availability') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            </select>

                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Books Table -->
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Title</th>
                                <th class="border border-gray-300 px-4 py-2">Authors</th>
                                <th class="border border-gray-300 px-4 py-2">ISBN</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $book->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $book->title }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $book->authors->pluck('name')->join(', ') }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $book->isbn }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500 hover:underline">View</a>
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('books.edit', $book->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif

                                        <!-- Borrow/Return Actions -->
                                        @if ($book->is_borrowed)
                                            <form action="{{ route('books.return', $book->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-green-500 hover:underline">Return</button>
                                            </form>
                                        @else
                                            <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-purple-500 hover:underline">Borrow</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $books->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
