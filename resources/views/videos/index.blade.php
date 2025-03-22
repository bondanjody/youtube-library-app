<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Video Favorit</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('videos.create') }}"
               class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
               + Tambah Video
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
                            <th class="px-4 py-2 text-left">Judul</th>
                            <th class="px-4 py-2 text-left">Link</th>
                            <th class="px-4 py-2 text-left">Kategori</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($videos as $video)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $video->title }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ $video->link }}" class="text-blue-500 hover:underline" target="_blank">
                                        Tonton
                                    </a>
                                </td>
                                <td class="px-4 py-2">{{ $video->category->category_name }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <a href="{{ route('videos.edit', $video->id) }}"
                                       class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                    <form x-data method="POST"
                                          action="{{ route('videos.destroy', $video->id) }}"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin hapus video ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($videos->isEmpty())
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    Belum ada video favorit.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
