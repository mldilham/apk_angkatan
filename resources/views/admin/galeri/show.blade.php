@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-800">Detail Galeri</h1>
            <a href="{{ route('galeri.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                @if($galeri->foto)
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-64 object-cover rounded-lg shadow-md">
                @else
                    <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-image text-gray-600 text-4xl"></i>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $galeri->judul }}</h2>
                    <p class="text-gray-600">{{ $galeri->deskripsi }}</p>
                </div>

                <div class="border-t pt-4">
                    <p class="text-sm text-gray-500">
                        <strong>Dibuat:</strong> {{ $galeri->created_at->format('d M Y H:i') }}
                    </p>
                    <p class="text-sm text-gray-500">
                        <strong>Diupdate:</strong> {{ $galeri->updated_at->format('d M Y H:i') }}
                    </p>
                </div>

                <div class="flex space-x-2 pt-4">
                    <a href="{{ route('galeri.edit', $galeri->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
    .rounded-lg {
        border-radius: 12px;
    }
    .shadow-lg {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
