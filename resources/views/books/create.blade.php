<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="authors" class="block text-gray-700">Authors</label>
                            <input type="text" name="authors" id="authors" placeholder="Enter authors separated by commas" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        
                        

                        <div class="mb-4">
                            <label for="isbn" class="block text-gray-700">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="published_year" class="block text-gray-700">Published Year</label>
                            <input type="number" name="published_year" id="published_year" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label for="publisher">Publisher</label>
                            <select name="publisher_id" id="publisher">
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Save Book
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
