@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-800">Daftar Galeri</h1>
            <a href="{{ route('galeri.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Galeri
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-green-50">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-green-800 font-semibold">Foto</th>
                        <th class="py-3 px-4 border-b text-left text-green-800 font-semibold">Judul</th>
                        <th class="py-3 px-4 border-b text-left text-green-800 font-semibold">Deskripsi</th>
                        <th class="py-3 px-4 border-b text-center text-green-800 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galeris as $galeri)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">
                                @if($galeri->foto)
                                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gray-300 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-600"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b font-medium">{{ $galeri->judul }}</td>
                            <td class="py-3 px-4 border-b">{{ Str::limit($galeri->deskripsi, 50) }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('galeri.show', $galeri->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition duration-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('galeri.edit', $galeri->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-images text-4xl mb-4"></i>
                                <p>Belum ada galeri yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($galeris->hasPages())
            <div class="mt-6">
                {{ $galeris->links() }}
            </div>
        @endif
    </div>
</div>
@endsection



@push('scripts')
<script>
    // Optional: Add any JavaScript for interactivity
</script>
@endpush
