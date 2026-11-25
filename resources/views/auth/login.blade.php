@extends('layouts.app')
@section('title','Masuk · LaporWud')
@section('content')
<div class="flex min-h-screen items-center justify-center px-5 py-10"><div class="grid w-full max-w-5xl overflow-hidden rounded-[28px] bg-white shadow-xl md:grid-cols-2">
<div class="dark-panel flex min-h-[580px] flex-col justify-between p-9 md:p-12"><a href="/" class="text-2xl font-extrabold">lapor<span class="text-neutral-500">wud.</span></a><div><p class="eyebrow !text-neutral-400">PORTAL {{ strtoupper($portal) }}</p><h1 class="serif mt-5 text-5xl font-bold leading-tight">Fasilitas baik, tanggung jawab bersama.</h1><p class="mt-5 max-w-sm text-sm leading-7 text-neutral-400">Masuk untuk mengelola laporan kerusakan fasilitas sekolah.</p></div><p class="text-xs text-neutral-500">LAPORWUD · SCHOOL FACILITY REPORTING</p></div>
<div class="p-8 md:p-14"><a href="/" class="text-sm text-neutral-500">← Kembali ke beranda</a><p class="eyebrow mt-16">Selamat datang</p><h2 class="serif mt-3 text-4xl font-bold">Masuk akun</h2><p class="mt-2 text-sm text-neutral-500">@if($portal==='admin')Portal administrator @elseif($portal==='teknisi')Portal teknisi @else Portal siswa dan guru @endif</p>
<form method="POST" action="{{ route('login.submit') }}" class="mt-9 space-y-5">@csrf<input type="hidden" name="portal" value="{{ $portal }}">
@if($portal==='pelapor')
<div><label class="mb-2 block text-sm font-semibold" for="role">Masuk sebagai</label><select class="field" id="role" name="role" required><option value="siswa" @selected(old('role', 'siswa')==='siswa')>Siswa</option><option value="guru" @selected(old('role')==='guru')>Guru</option></select></div>
@endif
<div><label class="mb-2 block text-sm font-semibold">Email</label><input class="field" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@sekolah.sch.id"></div><div><label class="mb-2 block text-sm font-semibold">Password</label><input class="field" type="password" name="password" required placeholder="Masukkan password"></div><label class="flex items-center gap-2 text-sm text-neutral-500"><input type="checkbox" name="remember"> Ingat saya</label><button class="btn btn-dark w-full">Masuk ke dashboard ↗</button></form>
@if($portal==='pelapor')<p class="mt-6 text-xs leading-6 text-neutral-500">Akun siswa/guru dibuat oleh administrator sekolah.</p>@endif
@if($portal==='admin')<p class="mt-6 text-center text-sm"><a href="{{ route('technician.login') }}" class="text-neutral-500 underline">Login teknisi</a></p>@endif
</div></div></div>
@endsection
