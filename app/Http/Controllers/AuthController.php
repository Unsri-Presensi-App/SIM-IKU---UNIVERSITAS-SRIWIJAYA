<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AuthController
 * ------------------------------------------------------------------
 * Menangani autentikasi sederhana berbasis Laravel (session guard).
 * Catatan: registrasi publik SENGAJA tidak disediakan — akun admin
 * ditambahkan secara manual melalui seeder (UserSeeder) atau tinker.
 * ------------------------------------------------------------------
 */
class AuthController extends Controller
{
    /**
     * Tampilkan halaman form login.
     * Jika user sudah login, langsung arahkan ke dashboard.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses percobaan login.
     * Memvalidasi kredensial lalu mengautentikasi via session guard.
     */
    public function login(Request $request)
    {
        // Validasi input dasar (pesan dalam Bahasa Indonesia).
        $kredensial = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $ingatSaya = $request->boolean('remember');

        // Coba autentikasi; bila cocok, regenerasi session (cegah session fixation).
        if (Auth::attempt($kredensial, $ingatSaya)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // Kredensial salah: kembalikan dengan pesan error pada field email.
        return back()
            ->withErrors(['email' => 'Email atau kata sandi salah.'])
            ->onlyInput('email');
    }

    /**
     * Logout: hapus session & token, lalu kembali ke halaman login.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}