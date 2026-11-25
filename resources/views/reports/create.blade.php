@extends('layouts.app')
@section('title','Buat Laporan')
@section('content')
<div class="mx-auto max-w-3xl px-5 py-10"><a href="{{ route('dashboard') }}" class="text-sm text-neutral-500">← Dashboard</a><div class="mt-8"><p class="eyebrow">Form pelaporan</p><h1 class="serif mt-2 text-5xl font-bold">Buat laporan.</h1><p class="mt-3 text-sm text-neutral-500">Isi informasi kerusakan dengan jelas dan sertakan foto pendukung.</p></div>
<form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data" class="card mt-8 space-y-5 p-6 md:p-8">@csrf
<div><label class="mb-2 block text-sm font-semibold">Judul laporan</label><input name="title" class="field" required maxlength="150" placeholder="Contoh: Lampu ruang kelas mati"></div>
<div class="grid gap-5 md:grid-cols-2"><div><label class="mb-2 block text-sm font-semibold">Kategori kerusakan</label><select name="category" class="field" required><option value="">Pilih kategori</option>@foreach(['Elektronik','Bangunan','Fasilitas kelas','Sanitasi','Lainnya'] as $v)<option>{{ $v }}</option>@endforeach</select></div><div><label class="mb-2 block text-sm font-semibold">Lokasi</label><select name="location" class="field" required><option value="">Pilih lokasi</option>@foreach(['Ruang TU','WC/Toilet','LAB RPL','LAB TKJ','LAB TAV','LAB TEI','Bengkel TSM','Ruang Guru','Ruang BK','Kantin','Ruang kelas 1-42','Lainnya'] as $v)<option>{{ $v }}</option>@endforeach</select></div></div>
<div><label class="mb-2 block text-sm font-semibold">Deskripsi kerusakan</label><textarea name="description" rows="5" class="field" required placeholder="Jelaskan kondisi kerusakan dan informasi yang membantu pemeriksaan..."></textarea></div>
<div><label class="mb-2 block text-sm font-semibold">Foto kerusakan</label><input type="file" name="photo" accept="image/jpeg,image/png,image/webp" class="field" required><p class="mt-2 text-xs text-neutral-500">JPG, PNG, atau WEBP. Maksimal 2 MB.</p></div>
<div class="rounded-xl bg-neutral-100 p-4 text-xs leading-6 text-neutral-600">Pelapor: <b>{{ auth()->user()->name }}</b> · Kelas: <b>{{ auth()->user()->class_name ?? '-' }}</b><br>Tanggal laporan diisi otomatis oleh sistem.</div>
<button class="btn btn-dark w-full">Kirim laporan ↗</button></form></div>
@endsection
