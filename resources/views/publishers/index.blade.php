<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publishers List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('publishers.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                            Add Publisher
                        </a>
                    @endif
                    <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user-dashboard') }}" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                         Back to Dashboard
                     </a>

                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Address</th>
                                <th class="border border-gray-300 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($publishers as $publisher)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $publisher->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $publisher->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $publisher->address ?? 'N/A' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a href="{{ route('publishers.show', $publisher->id) }}" class="text-blue-500 hover:underline">View</a>
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('publishers.edit', $publisher->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                            <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
