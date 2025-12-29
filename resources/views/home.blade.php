<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $angkatan ? $angkatan->nama_angkatan : 'APK Angkatan' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .section-padding {
            padding: 80px 0;
        }
        .card-member {
            transition: transform 0.3s;
        }
        .card-member:hover {
            transform: translateY(-5px);
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
        }
        .gallery-item img {
            transition: transform 0.3s;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if($angkatan && $angkatan->logo)
                    <img src="{{ asset('storage/' . $angkatan->logo) }}" alt="Logo">
                @else
                    <i class="fas fa-graduation-cap"></i>
                @endif
                {{ $angkatan ? $angkatan->nama_angkatan : 'APK Angkatan' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#anggota">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Selamat Datang di {{ $angkatan ? $angkatan->nama_angkatan : 'APK Angkatan' }}</h1>
            <p class="lead mb-4">{{ $angkatan ? $angkatan->tahun : 'Tahun ' . date('Y') }}</p>
            @if($angkatan && $angkatan->motto)
                <p class="h5 mb-4">"{{ $angkatan->motto }}"</p>
            @endif
            <a href="#tentang" class="btn btn-light btn-lg me-3">Pelajari Lebih Lanjut</a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">Masuk Admin</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-4">Tentang Kami</h2>
                    @if($angkatan && $angkatan->filosofi)
                        <p class="lead">{{ $angkatan->filosofi }}</p>
                    @else
                        <p class="lead">Kami adalah angkatan yang solid dan penuh semangat untuk terus berkembang dan berkontribusi bagi almamater tercinta.</p>
                    @endif
                    <p>Angkatan kami terdiri dari individu-individu yang berbakat dan memiliki komitmen tinggi terhadap kemajuan bersama.</p>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Anggota Aktif</h5>
                            <p class="card-text">{{ $anggotas->count() }} orang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Members Section -->
    <section id="anggota" class="section-padding">
        <div class="container">
            <h2 class="text-center mb-5">Anggota Kami</h2>
            <div class="row">
                @forelse($anggotas as $anggota)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card card-member h-100 shadow-sm">
                        @if($anggota->foto)
                            <img src="{{ asset('storage/' . $anggota->foto) }}" class="card-img-top" alt="{{ $anggota->nama }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-user fa-3x text-white"></i>
                            </div>
                        @endif
                        <div class="card-body text-center">
                            <h6 class="card-title">{{ $anggota->nama }}</h6>
                            <p class="card-text small text-muted">{{ $anggota->sekolah }}</p>
                            <p class="card-text small">{{ $anggota->asal }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada data anggota.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="section-padding bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Galeri Kegiatan</h2>
            <div class="row">
                @forelse($galeris as $galeri)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="gallery-item shadow">
                        @if($galeri->foto)
                            <img src="{{ asset('storage/' . $galeri->foto) }}" alt="{{ $galeri->judul }}">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-image fa-3x text-white"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <h6>{{ $galeri->judul }}</h6>
                            <p class="small text-muted">{{ Str::limit($galeri->deskripsi, 100) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada galeri kegiatan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ $angkatan ? $angkatan->nama_angkatan : 'APK Angkatan' }}. All rights reserved.</p>
            <p>Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk angkatan tercinta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
