@extends('layouts.app')

@section('content')
    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Success Alert for Anggota Actions -->
    @if(session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif

    <!-- Error Alert for Anggota Actions -->
    @if(session('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>
    @endif

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Anggota</h1>
        <a href="{{ route('anggota.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggota
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sekolah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas->pluck('sekolah')->unique()->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Angkatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas->pluck('angkatan_id')->unique()->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggotas->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Pencarian</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="form-group mb-2 mr-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="form-control" placeholder="Cari nama anggota...">
                </div>

                <div class="form-group mb-2 mr-3">
                    <select name="angkatan_id" class="form-control">
                        <option value="">Semua Angkatan</option>
                        @foreach($angkatans ?? [] as $angkatan)
                            <option value="{{ $angkatan->id }}" @selected(request('angkatan_id')==$angkatan->id)>
                                {{ $angkatan->nama_angkatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2 mr-3">
                    <select name="sekolah" class="form-control">
                        <option value="">Semua Sekolah</option>
                        @foreach($anggotas->pluck('sekolah')->unique() as $sekolah)
                            <option value="{{ $sekolah }}" @selected(request('sekolah')==$sekolah)>
                                {{ $sekolah }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mb-2 mr-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary mb-2">
                    <i class="fas fa-undo"></i> Reset
                </a>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama Anggota</th>
                            <th>Sekolah</th>
                            <th>Asal</th>
                            <th>Angkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($anggotas as $anggota)
                        <tr>
                            <td>{{ $loop->iteration + ($anggotas->currentPage() - 1) * $anggotas->perPage() }}</td>
                            <td>
                                @if(!empty($anggota->foto) && file_exists(public_path('storage/' . $anggota->foto)))
                                    <img src="{{ asset('storage/' . $anggota->foto) }}"
                                        alt="Foto {{ $anggota->nama }}"
                                        class="img-thumbnail"
                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $anggota->nama }}</td>
                            <td>{{ $anggota->sekolah }}</td>
                            <td>{{ $anggota->asal }}</td>
                            <td>
                                <span class="badge badge-dark">{{ $anggota->angkatan->nama_angkatan ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <a href="{{ route('anggota.show', $anggota->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $anggotas->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
