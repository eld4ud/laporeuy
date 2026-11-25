@extends('layouts.app')
@section('title','LaporWud | Pelaporan Fasilitas Sekolah')
@section('content')
<div class="min-h-screen bg-[#10110f] text-white">
<nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-7">
<a href="/" class="text-2xl font-extrabold tracking-tight">lapor<span class="text-neutral-400">wud.</span></a>
<div class="hidden items-center gap-8 text-sm text-neutral-300 md:flex"><a href="#layanan" class="hover:text-white">Layanan</a><a href="#alur" class="hover:text-white">Alur Pelaporan</a><a href="#statistik" class="hover:text-white">Statistik</a></div>
<div class="flex gap-2"><a href="{{ route('login') }}" class="btn btn-light">Masuk</a><a href="{{ route('login') }}" class="btn border border-white/20 text-white">Login Siswa</a></div>
</nav>
<section class="relative mx-auto max-w-7xl overflow-hidden px-6 pb-16 pt-16 md:pt-24">
<div class="absolute inset-0 opacity-30" style="background:radial-gradient(ellipse at 70% 20%,#8b8b7d 0%,transparent 42%),radial-gradient(ellipse at 10% 80%,#3e493f 0%,transparent 38%)"></div>
<div class="relative grid items-center gap-12 lg:grid-cols-[1.05fr_.95fr]">
<div><p class="eyebrow !text-neutral-400">Sistem pelaporan kerusakan sekolah</p><h1 class="serif mt-6 max-w-3xl text-6xl font-bold leading-[.98] tracking-tight md:text-8xl">Sekolah baik, dimulai dari <span class="text-neutral-400">laporanmu.</span></h1>
<p class="mt-7 max-w-xl text-base leading-8 text-neutral-300">Laporkan fasilitas sekolah yang rusak dengan mudah. Pantau proses penanganan, dari laporan masuk hingga perbaikan selesai.</p>
<div class="mt-9 flex flex-wrap gap-3"><a class="btn btn-light" href="{{ route('login') }}">Buat Laporan <span class="ml-2">↗</span></a><a class="btn border border-white/25 text-white" href="#alur">Pelajari alurnya</a></div>
<div class="mt-12 flex gap-8 text-sm"><div><b class="text-2xl">{{ $stats['total'] }}</b><p class="mt-1 text-neutral-400">Laporan masuk</p></div><div><b class="text-2xl">{{ $stats['proses'] }}</b><p class="mt-1 text-neutral-400">Dalam proses</p></div><div><b class="text-2xl">{{ $stats['selesai'] }}</b><p class="mt-1 text-neutral-400">Terselesaikan</p></div></div></div>
<div class="relative"><div class="absolute -inset-4 rounded-[2rem] bg-white/5 blur-2xl"></div><div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-[#22241f] p-3 shadow-2xl">
<div class="rounded-[1.5rem] bg-gradient-to-br from-[#77796c] via-[#363a32] to-[#151713] p-7 md:p-10">
<div class="flex items-center justify-between text-xs text-white/60"><span>LINGKUNGAN SEKOLAH</span><span>01 / 03</span></div>
<div class="mt-24 rounded-2xl border border-white/15 bg-black/25 p-5 backdrop-blur"><p class="eyebrow !text-white/50">Laporan fasilitas</p><h2 class="serif mt-3 text-4xl">Perhatikan. Laporkan. Perbaiki.</h2><p class="mt-3 text-sm leading-6 text-white/70">Satu laporan kecil bisa membantu menjaga fasilitas bersama.</p></div>
<div class="mt-10 flex justify-between text-xs text-white/60"><span>SMK · FASILITAS · KEPEDULIAN</span><span> LAPORWUD®</span></div></div></div></div>
</div></section>
<section id="layanan" class="bg-[#f4f4f1] px-6 py-20 text-black"><div class="mx-auto max-w-7xl"><p class="eyebrow">Apa yang bisa dilakukan</p><div class="mt-4 flex flex-col justify-between gap-5 md:flex-row md:items-end"><h2 class="serif max-w-2xl text-5xl font-bold">Satu tempat untuk menjaga fasilitas sekolah.</h2><p class="max-w-sm text-sm leading-7 text-neutral-500">Tidak perlu mencari siapa yang harus dihubungi. Kirim laporan, sertakan foto, lalu pantau perkembangannya.</p></div>
<div class="mt-12 grid gap-4 md:grid-cols-3"><div class="card p-7"><span class="eyebrow">01 / LAPORKAN</span><h3 class="serif mt-12 text-3xl">Kirim laporan</h3><p class="mt-3 text-sm leading-7 text-neutral-500">Jelaskan kerusakan dan sertakan foto agar mudah diperiksa.</p></div><div class="card p-7"><span class="eyebrow">02 / PANTAU</span><h3 class="serif mt-12 text-3xl">Pantau progres</h3><p class="mt-3 text-sm leading-7 text-neutral-500">Lihat status laporan dan catatan penanganan secara berkala.</p></div><div class="card p-7"><span class="eyebrow">03 / SELESAI</span><h3 class="serif mt-12 text-3xl">Periksa hasil</h3><p class="mt-3 text-sm leading-7 text-neutral-500">Admin memverifikasi bukti perbaikan sebelum laporan ditutup.</p></div></div></div></section>
<section id="alur" class="px-6 py-20"><div class="mx-auto max-w-7xl"><p class="eyebrow">Alur sederhana</p><h2 class="serif mt-4 text-5xl font-bold">Dari laporan ke tindakan.</h2><div class="mt-10 grid gap-3 md:grid-cols-4">@foreach([['01','Kirim laporan','Siswa atau guru mengirim detail kerusakan.'],['02','Verifikasi admin','Admin memeriksa dan menetapkan teknisi.'],['03','Perbaikan','Teknisi mengerjakan dan mengunggah bukti.'],['04','Selesai','Admin memeriksa hasil dan menutup laporan.']] as $step)<div class="rounded-2xl border border-neutral-200 bg-white p-6"><p class="text-sm font-bold text-neutral-400">{{ $step[0] }}</p><h3 class="mt-8 text-xl font-bold">{{ $step[1] }}</h3><p class="mt-2 text-sm leading-6 text-neutral-500">{{ $step[2] }}</p></div>@endforeach</div></div></section>
<footer class="bg-black px-6 py-10 text-white"><div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 md:flex-row"><div><b class="text-xl">laporwud.</b><p class="mt-2 text-sm text-neutral-500">Sistem pelaporan kerusakan fasilitas sekolah.</p></div><p class="text-xs text-neutral-500">© {{ date('Y') }} LaporWud. Dibuat untuk lingkungan sekolah yang lebih baik.</p></div></footer>
</div>
@endsection
