<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Peminjaman Ruangan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family: 'Poppins',sans-serif;background: url("{{ asset('images/kampus-bg.jpg') }}") center/cover fixed no-repeat; color:#1f2937}
        a{text-decoration:none}
        .top-navbar{padding:0.9rem 0;background:rgba(4,29,57,0.72);backdrop-filter:blur(6px)}
        .top-navbar .nav-link{color:rgba(255,255,255,0.9)}
        .top-navbar .nav-link:hover{color:#ffd600}
        .logo-img-circle{width:56px;height:56px;border-radius:50%;overflow:hidden;background:#fff;border:2px solid rgba(255,255,255,0.4);display:flex;align-items:center;justify-content:center}
        .logo-text{color:#fff;font-weight:700}
        .hero{min-height:28vh;background:linear-gradient(180deg,rgba(16,52,86,0.72),rgba(16,52,86,0.42));position:relative;display:flex;align-items:center}
        .hero::before{content:'';position:absolute;inset:0;background:rgba(5,20,50,0.45)}
        .hero > *{position:relative;z-index:1}
        .hero .container{padding-top:1.25rem;padding-bottom:1.25rem}
        .page-title{color:#fff;font-size:clamp(1.8rem,3.5vw,2.8rem);font-weight:800;margin:0}
        .main-panel{padding:1.5rem;margin-top:1.5rem;background:rgba(255,255,255,0.96);border-radius:18px;box-shadow:0 20px 50px rgba(0,0,0,0.08)}
        @media(max-width:768px){.logo-img-circle{width:44px;height:44px}.page-title{font-size:1.6rem}.top-navbar{padding:0.6rem 0}.main-panel{margin-top:1rem}}
    </style>
</head>
<body>
    <nav class="navbar top-navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="#">
                <div class="logo-img-circle">
                    <img src="{{ asset('images/logo-himatro.png') }}" alt="Logo HIMATRO" style="width:100%;height:100%;object-fit:contain">
                </div>
                <div class="logo-text">
                    <div style="font-size:1.05rem"><span class="si">Si</span>Ruang</div>
                    <div style="font-size:0.9rem;color:#ffd600">Elektro</div>
                </div>
            </a>
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}"><i class="bi bi-house"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('peminjaman.index') }}"><i class="bi bi-calendar-check"></i> Peminjaman</a>
                <a class="nav-link" href="{{ route('notifikasi.index') }}"><i class="bi bi-bell"></i> Notifikasi</a>
                <span class="nav-link"><i class="bi bi-person-circle"></i> {{ Auth::guard('mahasiswa')->user()->nama_lengkap }}</span>
                <form method="POST" action="{{ route('mahasiswa.logout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm ms-2"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <h1 class="page-title">@yield('title', 'Halo, Mahasiswa')</h1>
        </div>
    </section>

    <div class="container main-panel">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>