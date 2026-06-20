<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.mahasiswa.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function showRegister()
    {
        return view('auth.mahasiswa.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nim'           => 'required|unique:mahasiswa,nim',
            'nama_lengkap'  => 'required',
            'email'         => 'required|email|unique:mahasiswa,email',
            'no_telepon'    => 'nullable',
            'program_studi' => 'nullable',
            'fakultas'      => 'nullable',
            'angkatan'      => 'nullable|digits:4',
            'password'      => 'required|min:6|confirmed',
        ]);

        Mahasiswa::create([
            'nim'           => $request->nim,
            'nama_lengkap'  => $request->nama_lengkap,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'program_studi' => $request->program_studi,
            'fakultas'      => $request->fakultas,
            'angkatan'      => $request->angkatan,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('mahasiswa.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        Auth::guard('mahasiswa')->logout();
        return redirect()->route('mahasiswa.login');
    }
}