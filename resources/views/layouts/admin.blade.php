<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiRuang-Elektro Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Poppins", sans-serif; background: url("{{ asset('images/kampus-bg.jpg') }}") center/cover fixed no-repeat; color: #1f2937; }
        a { text-decoration: none; }

        .hero {
            min-height: 28vh;
            background: linear-gradient(180deg, rgba(16,52,86,0.72), rgba(16,52,86,0.42));
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 1rem 0 1.5rem;
            color: #ffffff;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(5, 20, 50, 0.45);
            pointer-events: none;
        }
        .hero > * { position: relative; z-index: 1; }

        .top-navbar {
            padding: 1rem 0;
        }
        .top-navbar .navbar-brand {
            color: #ffffff;
            font-size: 1.1rem;
            letter-spacing: 0.03em;
        }
        .top-navbar .nav-link {
            color: rgba(255,255,255,0.82);
            margin-left: 1rem;
        }
        .top-navbar .nav-link:hover,
        .top-navbar .nav-link.active {
            color: #ffd600;
        }
        .top-navbar .btn-outline-light {
            border-color: rgba(255,255,255,0.65);
            color: #fff;
        }
        .top-navbar .btn-outline-light:hover {
            background: rgba(255,214,0,0.12);
            border-color: #ffd600;
            color: #ffd600;
        }

        .hero-content {
            padding: 2rem 0 0;
        }
        .hero-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .siruang-logo { display: flex; align-items: center; gap: 12px; }
        .logo-img-circle {
            width: 52px; height: 52px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.45);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-img-circle img { width: 100%; height: 100%; object-fit: contain; }
        .logo-text {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.2rem;
            line-height: 1;
        }
        .logo-text .si { color: #ffd600; }
        .logo-text .elektro { color: #ffd600; font-size: 0.82rem; font-weight: 600; display: block; letter-spacing: 0.08em; }
        .lead-innovate {
            color: rgba(255,255,255,0.68);
            font-size: 0.95rem;
            font-weight: 500;
            text-align: right;
        }

        .hero-title {
            font-size: clamp(2rem, 4vw, 3.8rem);
            font-weight: 800;
            color: #ffffff;
            line-height: 1.05;
            margin-bottom: 0.4rem;
        }
        .hero-title .hl { color: #ffd600; }

        .admin-main {
            margin-top: 0;
            padding-top: 3rem;
            padding-bottom: 3rem;
            background: transparent;
        }
        .admin-panel {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(0,0,0,0.12);
            padding: 1.75rem;
            color: #212529;
        }
        .admin-panel .card {
            border: none;
            border-radius: 16px;
        }
        .admin-panel .card-header {
            background: #f8fafc;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .hero { min-height: auto; padding-top: 1rem; padding-bottom: 1.5rem; }
            .top-navbar { padding: 0.75rem 0; }
            .hero-head { flex-direction: column; align-items: flex-start; }
            .lead-innovate { text-align: left; }
            .admin-main { margin-top: 0; }
        }
    </style>
</head>
<body>
<section class="hero">
    <nav class="navbar top-navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="#">
                <div class="logo-img-circle" style="width:64px; height:64px; border-width:2px;">
                    <img src="{{ asset('images/logo-himatro.png') }}" alt="Logo HIMATRO">
                </div>
                <div class="logo-text" style="font-size:1.25rem; color:#ffffff;">
                    <span><span class="si">Si</span>Ruang</span>
                    <span class="elektro" style="font-size:0.95rem; display:block;">Elektro</span>
                </div>
            </a>
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.ruangan.index') }}">
                    <i class="bi bi-building"></i> Ruangan
                </a>
                <a class="nav-link" href="{{ route('admin.peminjaman') }}">
                    <i class="bi bi-clipboard-check"></i> Persetujuan
                </a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline ms-2">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="hero-content container">
        <h1 class="hero-title">@yield('title', 'SiRuang-Elektro Admin')</h1>
    </div>
</section>

<div class="container admin-main">
    <div class="admin-panel">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>