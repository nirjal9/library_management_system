<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-semibold mb-4">Update Your Profile</h2>

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="text-red-500">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <!-- Email (readonly) -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                   value="{{ Auth::user()->email }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm bg-gray-100" readonly>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="address" class="block text-gray-700">Address</label>
                            <input type="text" name="address" id="address"
                                   value="{{ old('address', $profile->address ?? 'N/A') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-4">
                            <label for="contact_number" class="block text-gray-700">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number"
                                   value="{{ old('contact_number', $profile->contact_number ?? 'N/A') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <button type="submit"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Save Changes
                        </button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('profile.show') }}" class="text-blue-500">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
