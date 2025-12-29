@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Angkatan</h1>
        <a href="{{ route('angkatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Angkatan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('angkatan.update', $angkatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Logo Upload Section -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <div id="logo-preview" class="mb-3">
                                    @if($angkatan->logo)
                                        <img src="{{ asset('storage/' . $angkatan->logo) }}" alt="{{ $angkatan->nama_angkatan }}"
                                             class="rounded-circle img-thumbnail mx-auto d-block" style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 120px; height: 120px;">
                                            <i class="fas fa-graduation-cap text-white fa-3x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label for="logo" class="form-label font-weight-bold">Logo Angkatan</label>
                                    <input type="file" name="logo" id="logo" accept="image/*" class="form-control-file">
                                    <small class="form-text text-muted">Upload logo baru jika ingin mengubah. Biarkan kosong jika tidak ingin mengubah logo.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Basic Fields -->
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama_angkatan">Nama Angkatan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_angkatan" id="nama_angkatan" value="{{ old('nama_angkatan', $angkatan->nama_angkatan) }}"
                                   class="form-control @error('nama_angkatan') is-invalid @enderror" placeholder="Masukkan nama angkatan" required>
                            @error('nama_angkatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', $angkatan->tahun) }}" min="1900" max="{{ date('Y') + 10 }}"
                                   class="form-control @error('tahun') is-invalid @enderror" placeholder="Masukkan tahun angkatan" required>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="motto">Motto <span class="text-danger">*</span></label>
                            <input type="text" name="motto" id="motto" value="{{ old('motto', $angkatan->motto) }}"
                                   class="form-control @error('motto') is-invalid @enderror" placeholder="Masukkan motto angkatan" required>
                            @error('motto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Filosofi Field -->
                <div class="form-group">
                    <label for="filosofi">Filosofi <span class="text-danger">*</span></label>
                    <textarea name="filosofi" id="filosofi" rows="6"
                              class="form-control @error('filosofi') is-invalid @enderror" placeholder="Jelaskan filosofi angkatan..." required>{{ old('filosofi', $angkatan->filosofi) }}</textarea>
                    <small class="form-text text-muted text-right">Maksimal 1000 karakter</small>
                    @error('filosofi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="form-group text-right">
                    <a href="{{ route('angkatan.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Angkatan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Logo preview functionality
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('logo-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Logo Preview" class="rounded-circle img-thumbnail mx-auto d-block" style="width: 120px; height: 120px; object-fit: cover;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            @if($angkatan->logo)
                preview.innerHTML = `
                    <img src="{{ asset('storage/' . $angkatan->logo) }}" alt="{{ $angkatan->nama_angkatan }}"
                         class="rounded-circle img-thumbnail mx-auto d-block" style="width: 120px; height: 120px; object-fit: cover;">
                `;
            @else
                preview.innerHTML = `
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                        <i class="fas fa-graduation-cap text-white fa-3x"></i>
                    </div>
                `;
            @endif
        }
    });

    // Character counter for filosofi
    document.getElementById('filosofi').addEventListener('input', function() {
        const maxLength = 1000;
        const currentLength = this.value.length;
        const counter = this.parentNode.querySelector('.text-right');

        if (currentLength > maxLength) {
            this.value = this.value.substring(0, maxLength);
        }

        counter.textContent = `Maksimal ${maxLength} karakter (tersisa ${maxLength - this.value.length})`;
    });
</script>
@endpush
