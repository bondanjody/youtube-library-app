<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Kategori</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('categories.create') }}"
               class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
               + Tambah Kategori
            </a>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left">Nama Kategori</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($categories as $category)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $category->category_name }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('categories.edit', $category->category_id) }}"
                                       class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                    <form x-data method="POST"
                                          action="{{ route('categories.destroy', $category->category_id) }}"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($categories->isEmpty())
                            <tr>
                                <td colspan="2" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
