<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Video Baru</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('videos.store') }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Link YouTube</label>
                    <input type="url" name="link" value="{{ old('link') }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                    @error('link') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Kategori</label>
                    <select name="category_id" class="w-full mt-1 border-gray-300 rounded shadow-sm" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category_id }}" {{ old('category_id') == $cat->category_id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Simpan
                </button>
                <a href="{{ route('videos.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>
