<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required|email','password'=>'required|string']);
        $requestedRole = $request->input('role');
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages(['email' => 'Email atau password tidak sesuai.']);
        }
        $request->session()->regenerate();
        $user = $request->user();
        $portal = $request->input('portal', 'pelapor');
        $allowed = match ($portal) {
            'admin' => $user->role === 'admin',
            'teknisi' => $user->role === 'teknisi',
            default => in_array($user->role, ['siswa','guru'], true) && $user->role === $requestedRole,
        };
        if (!$allowed) {
            Auth::logout();
            return back()->withErrors(['email' => 'Akun ini tidak memiliki akses ke pilihan portal tersebut. Periksa pilihan Siswa/Guru atau gunakan halaman login yang sesuai.'])->withInput();
        }
        return redirect()->intended(match ($user->role) {
            'admin' => route('admin.dashboard'),
            'teknisi' => route('technician.dashboard'),
            default => route('dashboard'),
        });
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
