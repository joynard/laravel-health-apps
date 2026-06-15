<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarePortal - Aplikasi Portal Kesehatan Terintegrasi</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #0F52BA;
            --primary-light: #EBF2FA;
            --secondary: #00A896;
            --accent: #FF6F59;
            --dark: #1E293B;
            --light: #F8FAFC;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 0% 0%, rgba(15, 82, 186, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(0, 168, 150, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(255, 111, 89, 0.03) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .navbar {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
        }

        .hero-section {
            padding: 120px 0 80px 0;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1.5px;
            color: var(--dark);
        }

        .hero-title span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: #64748B;
            line-height: 1.7;
        }

        .btn-custom-primary {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            border-radius: 50px;
            padding: 14px 30px;
            box-shadow: 0 4px 14px rgba(15, 82, 186, 0.3);
            transition: all 0.3s ease;
            border: 2px solid var(--primary);
        }

        .btn-custom-primary:hover {
            background-color: #0b4194;
            border-color: #0b4194;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 82, 186, 0.4);
            color: white;
        }

        .btn-custom-secondary {
            background-color: transparent;
            color: var(--dark);
            font-weight: 600;
            border-radius: 50px;
            padding: 14px 30px;
            border: 2px solid #CBD5E1;
            transition: all 0.3s ease;
        }

        .btn-custom-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        .btn-nav-login {
            font-weight: 600;
            color: var(--dark);
            border-radius: 50px;
            padding: 8px 20px;
            transition: all 0.2s;
        }

        .btn-nav-login:hover {
            color: var(--primary);
        }

        .btn-nav-register {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 24px;
            transition: all 0.2s;
        }

        .btn-nav-register:hover {
            background-color: var(--primary);
            color: white;
        }

        .image-container {
            position: relative;
        }

        .hero-img {
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(15, 82, 186, 0.08);
            border: 8px solid white;
            transition: transform 0.5s ease;
        }

        .hero-img:hover {
            transform: scale(1.02);
        }



        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .features-section {
            padding: 80px 0;
            background-color: white;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .feature-card {
            border: 1px solid #F1F5F9;
            background-color: var(--light);
            border-radius: 24px;
            padding: 30px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.04);
            border-color: rgba(15, 82, 186, 0.1);
            background-color: white;
        }

        .footer {
            background-color: var(--dark);
            color: #94A3B8;
            padding: 40px 0;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <i class="bi bi-heart-pulse-fill fs-3 text-primary"></i>
                <span>CarePortal</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2 mt-3 mt-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn-nav-login me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-nav-register px-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link btn-nav-register px-4 dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2 rounded-3">
                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('categories.index') }}">
                                        <i class="bi bi-layout-text-window-reverse me-2"></i> Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="badge bg-primary-light text-primary rounded-pill px-3 py-2 fw-semibold mb-3">
                        <i class="bi bi-shield-check me-1"></i> Layanan Kesehatan Digital Tepercaya
                    </div>
                    <h1 class="hero-title mb-4">
                        Solusi Kesehatan <span>Modern & Terintegrasi</span>
                    </h1>
                    <p class="hero-desc mb-5">
                        Dapatkan akses mudah untuk mengelola kategori medis, berkonsultasi dengan dokter spesialis, serta memantau seluruh transaksi kesehatan Anda secara real-time dan terpercaya.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('menu') }}" class="btn btn-custom-primary btn-lg d-inline-flex align-items-center gap-2">
                            <i class="bi bi-chat-heart-fill"></i> Start Konsultasi
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-custom-secondary btn-lg d-inline-flex align-items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Dashboard
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container px-lg-5">
                        <img src="https://media.istockphoto.com/id/1208604845/id/vektor/gaya-hidup-sehat-dan-konsep-perawatan-diri.jpg?s=1024x1024&w=is&k=20&c=uqgM69lCrX5BEWSEDGN7zHEaoJPBOQVZ6NjHhHUKyoM="
                            class="img-fluid hero-img" alt="Health Illustration">
                        

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Fitur Unggulan CarePortal</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Kami menghadirkan ekosistem digital terbaik untuk mengelola dan memantau pelayanan medis Anda secara praktis.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box bg-primary text-white mb-4">
                            <i class="bi bi-menu-button-wide-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Kategori Medis</h5>
                        <p class="text-muted mb-0">Pilihan kategori pelayanan kesehatan yang sangat terstruktur untuk mempermudah navigasi pengobatan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box bg-success text-white mb-4">
                            <i class="bi bi-calendar2-heart-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Pemesanan Mudah</h5>
                        <p class="text-muted mb-0">Daftarkan konsultasi atau atur jadwal temu dokter hanya dalam hitungan detik tanpa antrean panjang.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-box bg-info text-white mb-4">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Keamanan Data</h5>
                        <p class="text-muted mb-0">Perlindungan privasi data medis dan otorisasi ketat guna menjaga kerahasiaan riwayat kesehatan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0 text-white">
                Developed by <a href="https://github.com/joynard" target="_blank" class="text-white text-decoration-underline fw-bold">@joynard</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>