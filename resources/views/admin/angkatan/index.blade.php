@extends('layouts.app')

@section('content')
    <!-- SweetAlert2 Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Success Alert for Angkatan Actions -->
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

    <!-- Error Alert for Angkatan Actions -->
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
        <h1 class="h3 mb-0 text-gray-800">Manajemen Angkatan</h1>
        <a href="{{ route('angkatan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Angkatan
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
                                Total Angkatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $angkatans->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
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
                                Total Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $angkatans->sum('anggotas_count') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Tahun Terbaru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $angkatans->max('tahun') ?? 'N/A' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Angkatan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Nama Angkatan</th>
                            <th>Tahun</th>
                            <th>Motto</th>
                            <th>Anggota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($angkatans as $angkatan)
                            <tr>
                                <td>{{ $loop->iteration + ($angkatans->currentPage() - 1) * $angkatans->perPage() }}</td>
                                <td class="text-center">
                                    @if($angkatan->logo)
                                        <img src="{{ asset('storage/' . $angkatan->logo) }}" alt="{{ $angkatan->nama_angkatan }}"
                                             class="img-thumbnail rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-graduation-cap text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $angkatan->nama_angkatan }}</td>
                                <td>{{ $angkatan->tahun }}</td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;" title="{{ $angkatan->motto }}">
                                        {{ $angkatan->motto }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $angkatan->anggotas_count ?? 0 }} Anggota</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('angkatan.show', $angkatan->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('angkatan.edit', $angkatan->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('angkatan.destroy', $angkatan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus angkatan ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada angkatan yang terdaftar</h5>
                                        <p class="text-muted mb-3">Mulai dengan menambahkan angkatan pertama Anda</p>
                                        <a href="{{ route('angkatan.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Tambah Angkatan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $angkatans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
