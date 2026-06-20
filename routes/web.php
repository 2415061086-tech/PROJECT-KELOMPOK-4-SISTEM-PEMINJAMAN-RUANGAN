<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Http\Controllers\Auth\MahasiswaAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\NotifikasiController;

// Mahasiswa Auth
Route::get('/login', [MahasiswaAuthController::class, 'showLogin'])->name('mahasiswa.login');
Route::post('/login', [MahasiswaAuthController::class, 'login']);
Route::get('/register', [MahasiswaAuthController::class, 'showRegister'])->name('mahasiswa.register');
Route::post('/register', [MahasiswaAuthController::class, 'register']);
Route::post('/logout', [MahasiswaAuthController::class, 'logout'])->name('mahasiswa.logout');

// Mahasiswa Pages
Route::middleware('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::resource('peminjaman', PeminjamanController::class);
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
});

// Admin Auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Pages
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('ruangan', RuanganController::class)->names([
        'index'   => 'admin.ruangan.index',
        'create'  => 'admin.ruangan.create',
        'store'   => 'admin.ruangan.store',
        'show'    => 'admin.ruangan.show',
        'edit'    => 'admin.ruangan.edit',
        'update'  => 'admin.ruangan.update',
        'destroy' => 'admin.ruangan.destroy',
    ]);
    Route::get('/peminjaman', [PersetujuanController::class, 'index'])->name('admin.peminjaman');
    Route::post('/persetujuan/{id}', [PersetujuanController::class, 'proses'])->name('admin.persetujuan');
});

Route::get('/', function (Request $request) {
    $availableRooms = Ruangan::where('status', 'Tersedia')->count();
    $bookingResult = null;
    $availabilityResults = null;
    $scheduleResults = null;
    $activeTab = 'jadwal';

    $lookup = trim($request->query('lookup', ''));
    $searchDate = trim($request->query('tanggal', ''));
    $roomId = trim($request->query('room_id', ''));
    $panel = trim($request->query('panel', ''));
    $scheduleDate = trim($request->query('schedule_date', ''));

    if ($lookup !== '') {
        $activeTab = 'sudah';

        if (ctype_digit($lookup)) {
            $booking = Peminjaman::with(['ruangan', 'mahasiswa'])
                ->where('id_peminjaman', $lookup)
                ->first();
        } else {
            $booking = Peminjaman::with(['ruangan', 'mahasiswa'])
                ->whereHas('mahasiswa', function ($query) use ($lookup) {
                    $query->where('email', $lookup);
                })
                ->latest()
                ->first();
        }

        if ($booking) {
            $bookingResult = [
                'found' => true,
                'booking_id' => $booking->id_peminjaman,
                'email' => $booking->mahasiswa->email,
                'nama_mahasiswa' => $booking->mahasiswa->nama_lengkap,
                'nama_ruangan' => $booking->ruangan->nama_ruangan,
                'tanggal' => $booking->tanggal,
                'jam_mulai' => $booking->jam_mulai,
                'jam_selesai' => $booking->jam_selesai,
                'status' => $booking->status,
            ];
        } else {
            $bookingResult = ['found' => false];
        }
    }

    // Load schedule by default
    $scheduleQuery = Peminjaman::with(['ruangan', 'mahasiswa'])
        ->whereIn('status', ['Pending', 'Disetujui']);

    if ($scheduleDate !== '') {
        $scheduleQuery->where('tanggal', $scheduleDate);
    }

    if ($roomId !== '') {
        $scheduleQuery->where('id_ruangan', $roomId);
    }

    $scheduleResults = $scheduleQuery->orderBy('tanggal')->orderBy('jam_mulai')->get();

    if ($searchDate !== '' || $roomId !== '') {
        $activeTab = 'cek';

        $query = Ruangan::where('status', 'Tersedia');

        if ($searchDate !== '') {
            $query->whereDoesntHave('peminjaman', function ($q) use ($searchDate) {
                $q->where('tanggal', $searchDate)
                  ->whereIn('status', ['Pending', 'Disetujui']);
            });
        }

        if ($roomId !== '') {
            $query->where('id_ruangan', $roomId);
        }

        $availabilityResults = $query->get();
    }

    $availableRoomList = Ruangan::where('status', 'Tersedia')
        ->orderBy('nama_ruangan')
        ->get(['id_ruangan', 'nama_ruangan']);

    return view('welcome', compact('availableRooms', 'bookingResult', 'availabilityResults', 'scheduleResults', 'activeTab', 'scheduleDate', 'roomId', 'availableRoomList'));
});