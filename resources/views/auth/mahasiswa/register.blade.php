<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa | SiRuang-Elektro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-blue: #1e4ed8;
            --brand-blue-dark: #0f2c66;
            --brand-yellow: #ffc233;
        }

        * { font-family: 'Poppins', sans-serif; }

        body { min-height: 100vh; overflow-x: hidden; }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
        }

        /* ===== LEFT HERO PANEL ===== */
        .hero-panel {
            position: relative;
            flex: 1 1 45%;
            min-height: 100vh;
            background-image: url('{{ asset('images/kampus-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
            color: #fff;
        }

        .hero-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(15,44,102,.92) 10%, rgba(30,78,216,.55) 55%, rgba(0,0,0,.55) 100%);
        }

        .hero-content { position: relative; z-index: 2; }

        .brand {
            display: flex;
            align-items: center;
            gap: .6rem;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: .5px;
        }

        .brand .brand-badge {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #000;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand .brand-badge img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-title {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            font-weight: 800;
            line-height: 1.15;
            margin-top: 3rem;
            position: relative;
            z-index: 2;
        }

        .hero-title .accent-blue { color: #93c5fd; }
        .hero-title .accent-yellow { color: var(--brand-yellow); }

        .hero-sub {
            position: relative;
            z-index: 2;
            margin-top: 1rem;
            font-size: 1.05rem;
            color: rgba(255,255,255,.85);
            max-width: 420px;
        }

        .hero-stats {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 2.5rem;
        }

        .stat-pill {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.25);
            backdrop-filter: blur(6px);
            border-radius: 14px;
            padding: .9rem 1.2rem;
            min-width: 150px;
        }

        .stat-pill .num {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--brand-yellow);
        }

        .stat-pill .label {
            font-size: .8rem;
            color: rgba(255,255,255,.85);
        }

        /* ===== RIGHT FORM PANEL ===== */
        .form-panel {
            flex: 1 1 55%;
            background: #f4f6fb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
        }

        .register-card {
            width: 100%;
            max-width: 640px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 25px 60px -15px rgba(15,44,102,.25);
            padding: 2.75rem;
        }

        .register-card .icon-circle {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--brand-blue), var(--brand-blue-dark));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin: 0 auto 1rem;
        }

        .register-card h4 {
            font-weight: 800;
            color: var(--brand-blue-dark);
        }

        .register-card .form-label {
            font-weight: 600;
            font-size: .88rem;
            color: #334155;
        }

        .register-card .form-control {
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            padding: .65rem .9rem;
            font-size: .92rem;
        }

        .register-card .form-control:focus {
            border-color: var(--brand-blue);
            box-shadow: 0 0 0 .2rem rgba(30,78,216,.15);
            background: #fff;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--brand-blue), var(--brand-blue-dark));
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 12px;
            padding: .75rem 1rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(30,78,216,.5);
            color: #fff;
        }

        .badge-yellow {
            background: var(--brand-yellow);
            color: var(--brand-blue-dark);
            font-weight: 700;
            border-radius: 999px;
            padding: .35rem .9rem;
            font-size: .78rem;
            position: relative;
            z-index: 2;
        }

        @media (max-width: 991.98px) {
            .auth-wrapper { flex-direction: column; }
            .hero-panel { min-height: 320px; padding: 1.75rem; }
            .hero-title { margin-top: 1.5rem; font-size: 1.9rem; }
            .hero-stats { display: none; }
            .form-panel { padding: 2rem 1rem; }
            .register-card { padding: 1.75rem; }
        }
    </style>
</head>
<body>

<div class="auth-wrapper">

    {{-- ================= LEFT HERO PANEL ================= --}}
    <div class="hero-panel">
        <div class="hero-content">
            <div class="brand">
                <span class="brand-badge">
                    <img src="{{ asset('images/logo-himatro.png') }}" alt="Logo HIMATRO Unila">
                </span>
                SiRuang-Elektro
            </div>

            <div class="hero-title">
                The <span class="accent-blue">Smart Way</span><br>
                to <span class="accent-yellow">Book a Space</span>
            </div>

            <p class="hero-sub">
                Ajukan peminjaman ruang kelas, ruang rapat, dan fasilitas kampus lainnya
                secara online, cepat, dan transparan.
            </p>

            <span class="badge-yellow d-inline-block mt-3">
                <i class="bi bi-patch-check-fill me-1"></i> Bergabung Sekarang
            </span>
        </div>

        <div class="hero-stats">
            <div class="stat-pill">
                <div class="num">24/7</div>
                <div class="label">Pengajuan Online</div>
            </div>
            <div class="stat-pill">
                <div class="num">100%</div>
                <div class="label">Proses Transparan</div>
            </div>
        </div>
    </div>

    {{-- ================= RIGHT FORM PANEL ================= --}}
    <div class="form-panel">
        <div class="register-card">
            <div class="text-center mb-4">
                <div class="icon-circle">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h4 class="mb-1">Daftar Akun Mahasiswa</h4>
                <p class="text-muted mb-0">Silakan lengkapi data diri Anda</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('mahasiswa.register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" placeholder="Nomor Induk Mahasiswa" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" placeholder="Nama lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email aktif" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" value="{{ old('program_studi') }}" placeholder="Teknik Informatika">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fakultas</label>
                        <input type="text" name="fakultas" class="form-control" value="{{ old('fakultas') }}" placeholder="Fakultas Teknik">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="number" name="angkatan" class="form-control" value="{{ old('angkatan') }}" placeholder="2023">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-register w-100">
                    <i class="bi bi-person-check"></i> Daftar Sekarang
                </button>
            </form>

            <hr class="my-4">
            <div class="text-center">
                <small class="text-muted">Sudah punya akun?
                    <a href="{{ route('mahasiswa.login') }}" class="fw-bold text-decoration-none" style="color: var(--brand-blue);">Login di sini</a>
                </small>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>