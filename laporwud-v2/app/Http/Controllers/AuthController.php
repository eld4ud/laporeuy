<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $portal = $request->input('portal', 'pelapor');
        $role = $request->input('role');
        if ($portal === 'pelapor') {
            $request->validate([
                'role' => ['required', Rule::in(['siswa', 'guru'])],
                'password' => ['required', 'string'],
                'identifier' => ['required', 'string'],
            ]);
            $field = $role === 'siswa' ? 'nis' : 'email';
            $credentials = [$field => $request->input('identifier'), 'password' => $request->input('password'), 'role' => $role];
            $errorField = 'identifier';
            $errorMessage = $role === 'siswa' ? 'NIS atau password tidak sesuai.' : 'Email atau password tidak sesuai.';
        } else {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ]);
            $expectedRole = $portal === 'admin' ? 'admin' : 'teknisi';
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password'), 'role' => $expectedRole];
            $errorField = 'email';
            $errorMessage = 'Email atau password tidak sesuai.';
        }
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([$errorField => $errorMessage]);
        }
        $request->session()->regenerate();
        $user = $request->user();
        return redirect()->intended(match ($user->role) {
            'admin' => route('admin.dashboard'),
            'teknisi' => route('technician.dashboard'),
            default => route('dashboard'),
        });
    }

    public function register(Request $request)
    {
        $role = $request->input('role');
        $rules = [
            'role' => ['required', Rule::in(['siswa', 'guru'])],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        if ($role === 'siswa') {
            $rules['nis'] = ['required', 'string', 'max:30', 'unique:users,nis'];
            $rules['class_name'] = ['required', 'string', 'max:50'];
        } elseif ($role === 'guru') {
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email'];
            $rules['nip'] = ['nullable', 'string', 'max:30', 'unique:users,nip'];
        }
        $validated = $request->validate($rules);
        $user = User::create([
            'name' => $validated['name'],
            'nis' => $validated['nis'] ?? null,
            'nip' => $validated['nip'] ?? null,
            'email' => $validated['email'] ?? null,
            'class_name' => $validated['class_name'] ?? null,
            'password' => $validated['password'],
            'role' => $validated['role'],
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
