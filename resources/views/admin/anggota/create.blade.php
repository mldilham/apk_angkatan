@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Anggota</h1>
        <a href="{{ route('anggota.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Anggota</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                           class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sekolah">Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="sekolah" id="sekolah" value="{{ old('sekolah') }}"
                           class="form-control @error('sekolah') is-invalid @enderror" required>
                    @error('sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="asal">Asal <span class="text-danger">*</span></label>
                    <input type="text" name="asal" id="asal" value="{{ old('asal') }}"
                           class="form-control @error('asal') is-invalid @enderror" required>
                    @error('asal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="angkatan_id">Angkatan <span class="text-danger">*</span></label>
                    <select name="angkatan_id" id="angkatan_id"
                            class="form-control @error('angkatan_id') is-invalid @enderror" required>
                        <option value="">Pilih Angkatan</option>
                        @foreach($angkatans as $angkatan)
                            <option value="{{ $angkatan->id }}" {{ old('angkatan_id') == $angkatan->id ? 'selected' : '' }}>
                                {{ $angkatan->nama_angkatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('angkatan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kesan">Kesan <span class="text-danger">*</span></label>
                    <textarea name="kesan" id="kesan" rows="3"
                              class="form-control @error('kesan') is-invalid @enderror" required>{{ old('kesan') }}</textarea>
                    @error('kesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan <span class="text-danger">*</span></label>
                    <textarea name="pesan" id="pesan" rows="3"
                              class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                           class="form-control-file @error('foto') is-invalid @enderror">
                    <small class="form-text text-muted">Upload foto anggota (opsional)</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
