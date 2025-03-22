<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Channel</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('channels.update', $channel->channel_id) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700">Nama Channel</label>
                    <input type="text" name="channel_name" value="{{ old('channel_name', $channel->channel_name) }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                    @error('channel_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">URL Channel</label>
                    <input type="text" name="channel_url" value="{{ old('channel_url', $channel->channel_url) }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                    @error('channel_url') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Update
                </button>
                <a href="{{ route('channels.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>
