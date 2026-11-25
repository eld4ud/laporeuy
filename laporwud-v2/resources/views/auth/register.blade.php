@extends('layouts.app')
@section('title','Daftar Akun · LaporWud')
@section('content')
<div class="flex min-h-screen items-center justify-center px-5 py-10">
    <div class="grid w-full max-w-5xl overflow-hidden rounded-[28px] bg-white shadow-xl md:grid-cols-2">
        <div class="dark-panel flex min-h-[620px] flex-col justify-between p-9 md:p-12">
            <a href="/" class="text-2xl font-extrabold">lapor<span class="text-neutral-500">wud.</span></a>
            <div>
                <p class="eyebrow !text-neutral-400">REGISTRASI PELAPOR</p>
                <h1 class="serif mt-5 text-5xl font-bold leading-tight">Mulai peduli dari satu laporan.</h1>
                <p class="mt-5 max-w-sm text-sm leading-7 text-neutral-400">Buat akun untuk melaporkan kerusakan dan memantau perbaikannya.</p>
            </div>
            <p class="text-xs text-neutral-500">LAPORWUD · SMK MA'ARIF NU 1 AJIBARANG</p>
        </div>
        <div class="p-8 md:p-12">
            <a href="{{ route('login') }}" class="text-sm text-neutral-500">← Kembali ke login</a>
            <p class="eyebrow mt-10">Buat akun baru</p>
            <h2 class="serif mt-3 text-4xl font-bold">Daftar akun</h2>
            <form method="POST" action="{{ route('register.submit') }}" class="mt-7 space-y-4">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold" for="role">Daftar sebagai</label>
                    <select class="field" id="role" name="role" onchange="toggleRegisterFields()" required>
                        <option value="siswa" @selected(old('role','siswa')==='siswa')>Siswa</option>
                        <option value="guru" @selected(old('role')==='guru')>Guru</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold" for="name">Nama lengkap</label>
                    <input class="field" id="name" name="name" value="{{ old('name') }}" required maxlength="255" placeholder="Nama lengkap">
                </div>
                <div id="student-fields" class="space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-semibold" for="nis">NIS</label>
                        <input class="field" id="nis" name="nis" value="{{ old('nis') }}" maxlength="30" placeholder="Nomor Induk Siswa">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold" for="class_name">Kelas</label>
                        <input class="field" id="class_name" name="class_name" value="{{ old('class_name') }}" maxlength="50" placeholder="Contoh: XI RPL">
                    </div>
                </div>
                <div id="teacher-fields" class="hidden space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-semibold" for="email">Email</label>
                        <input class="field" id="email" type="email" name="email" value="{{ old('email') }}" maxlength="255" placeholder="nama@sekolah.sch.id">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold" for="nip">NIP <span class="font-normal text-neutral-400">(opsional)</span></label>
                        <input class="field" id="nip" name="nip" value="{{ old('nip') }}" maxlength="30" placeholder="Nomor Induk Pegawai">
                    </div>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold" for="password">Password</label>
                    <input class="field" id="password" type="password" name="password" required minlength="8" placeholder="Minimal 8 karakter">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold" for="password_confirmation">Konfirmasi password</label>
                    <input class="field" id="password_confirmation" type="password" name="password_confirmation" required minlength="8" placeholder="Ulangi password">
                </div>
                <button class="btn btn-dark w-full">Buat akun ↗</button>
            </form>
            <p class="mt-5 text-xs leading-6 text-neutral-500">Akun admin dan teknisi dibuat oleh administrator sekolah.</p>
        </div>
    </div>
</div>
<script>
function toggleRegisterFields(){
    const isStudent=document.getElementById('role').value==='siswa';
    document.getElementById('student-fields').classList.toggle('hidden',!isStudent);
    document.getElementById('teacher-fields').classList.toggle('hidden',isStudent);
    document.getElementById('nis').required=isStudent;
    document.getElementById('class_name').required=isStudent;
    document.getElementById('email').required=!isStudent;
}
toggleRegisterFields();
</script>
@endsection
