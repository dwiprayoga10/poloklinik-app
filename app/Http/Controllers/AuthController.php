<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // dd($user->role);
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'dokter') {
                return redirect()->route('dokter.dashboard');
            } else {
                return redirect()->route('pasien.dashboard');
            }
            // dd($user);
        }

        // dd($user->role);
        return back()->withErrors(['email' => 'Email atau Password Salah !']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'alamat' => ['required', 'string', 'max:255'],
        'no_ktp' => ['required', 'string', 'max:30'],
        'no_hp' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
    ]);

    // 🔍 Cek apakah nomor KTP sudah terdaftar
    if (User::where('no_ktp', $request->no_ktp)->exists()) {
        return back()->withErrors(['no_ktp' => 'Nomor KTP sudah terdaftar.']);
    }

    // 🧩 Generate Nomor Rekam Medis (format: YYYYMM-XXX)
    $prefix = date('Ym'); // contoh: 202510
    $lastUser = User::where('no_rm', 'like', "$prefix-%")
        ->orderBy('id', 'desc')
        ->first();

    if ($lastUser) {
        $lastNumber = (int) substr($lastUser->no_rm, -3); // ambil 3 digit terakhir
        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $nextNumber = '001';
    }

    $no_rm = $prefix . '-' . $nextNumber; // hasil akhir: 202510-001

    // 🧾 Simpan data user baru
    User::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_ktp' => $request->no_ktp,
        'no_hp' => $request->no_hp,
        'no_rm' => $no_rm,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'pasien',
    ]);

    return redirect()->route('login')->with('message', 'Registrasi berhasil! Silakan login.');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dokter()
    {
        $data = Poli::with('dokters')->get();
        return $data;
    }
}