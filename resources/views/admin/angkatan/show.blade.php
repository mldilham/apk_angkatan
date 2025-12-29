@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Detail Angkatan</h1>
                    <p class="text-blue-100">Informasi lengkap angkatan {{ $angkatan->nama_angkatan }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('angkatan.edit', $angkatan->id) }}" class="bg-white bg-opacity-20 backdrop-blur hover:bg-opacity-30 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('angkatan.index') }}" class="bg-white bg-opacity-20 backdrop-blur hover:bg-opacity-30 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Logo and Basic Info -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-xl p-6 text-center">
                        @if($angkatan->logo)
                            <img src="{{ asset('storage/' . $angkatan->logo) }}" alt="{{ $angkatan->nama_angkatan }}" class="w-48 h-48 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
                        @else
                            <div class="w-48 h-48 bg-gradient-to-br from-blue-200 to-purple-300 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                                <i class="fas fa-graduation-cap text-blue-600 text-6xl"></i>
                            </div>
                        @endif
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $angkatan->nama_angkatan }}</h2>
                        <p class="text-blue-600 font-semibold">Tahun {{ $angkatan->tahun }}</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 gap-4 mt-6">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                            <div class="flex items-center">
                                <div class="bg-blue-500 rounded-full p-3 mr-4">
                                    <i class="fas fa-users text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-blue-600 text-sm font-medium">Total Anggota</p>
                                    <p class="text-2xl font-bold text-blue-800">{{ $angkatan->anggota->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Dasar
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Angkatan</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $angkatan->nama_angkatan }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Tahun</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $angkatan->tahun }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Motto -->
                    @if($angkatan->motto)
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-quote-left mr-2 text-purple-600"></i>Motto
                        </h3>
                        <blockquote class="text-lg text-gray-700 italic border-l-4 border-purple-500 pl-4">
                            "{{ $angkatan->motto }}"
                        </blockquote>
                    </div>
                    @endif

                    <!-- Filosofi -->
                    @if($angkatan->filosofi)
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-lightbulb mr-2 text-amber-600"></i>Filosofi
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $angkatan->filosofi }}</p>
                    </div>
                    @endif

                    <!-- Anggota List -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-users mr-2 text-green-600"></i>Anggota Angkatan
                        </h3>
                        @if($angkatan->anggotas->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($angkatan->anggotas as $anggota)
                                    <div class="bg-gray-50 rounded-lg p-4 flex items-center space-x-3">
                                        @if($anggota->foto)
                                            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $anggota->nama }}</p>
                                            <p class="text-sm text-gray-600">{{ $anggota->sekolah }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-users text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500">Belum ada anggota yang terdaftar di angkatan ini</p>
                                <a href="{{ route('anggota.create') }}" class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                                    <i class="fas fa-plus mr-2"></i>Tambah Anggota
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4efe9 100%);
        min-height: 100vh;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #3b82f6;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #2563eb;
    }

    /* Animation for content */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Hover effects */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
