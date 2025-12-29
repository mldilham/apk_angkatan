@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Anggota</h1>
        <a href="{{ route('anggota.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Anggota</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Current Photo Display -->
                <div class="form-group text-center mb-4">
                    <label class="form-label">Foto Profil Saat Ini</label>
                    <div class="d-flex justify-content-center">
                        @if($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama }}"
                                 class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-user text-muted" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $anggota->nama) }}"
                           class="form-control @error('nama') is-invalid @enderror" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sekolah">Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="sekolah" id="sekolah" value="{{ old('sekolah', $anggota->sekolah) }}"
                           class="form-control @error('sekolah') is-invalid @enderror" required>
                    @error('sekolah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="asal">Asal <span class="text-danger">*</span></label>
                    <input type="text" name="asal" id="asal" value="{{ old('asal', $anggota->asal) }}"
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
                            <option value="{{ $angkatan->id }}" {{ old('angkatan_id', $anggota->angkatan_id) == $angkatan->id ? 'selected' : '' }}>
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
                              class="form-control @error('kesan') is-invalid @enderror" required>{{ old('kesan', $anggota->kesan) }}</textarea>
                    @error('kesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan <span class="text-danger">*</span></label>
                    <textarea name="pesan" id="pesan" rows="3"
                              class="form-control @error('pesan') is-invalid @enderror" required>{{ old('pesan', $anggota->pesan) }}</textarea>
                    @error('pesan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Foto Baru</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                           class="form-control-file @error('foto') is-invalid @enderror">
                    <small class="form-text text-muted">Upload foto baru jika ingin mengubah. Biarkan kosong jika tidak ingin mengubah foto.</small>
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('anggota.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
