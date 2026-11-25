@extends('layouts.app')
@section('title','Buat Akun Teknisi')
@section('content')
<div class="mx-auto max-w-xl px-5 py-12"><a href="{{ route('admin.dashboard') }}" class="text-sm text-neutral-500">← Dashboard admin</a><p class="eyebrow mt-10">Manajemen akun</p><h1 class="serif mt-2 text-5xl font-bold">Tambah teknisi.</h1><form method="POST" action="{{ route('admin.technicians.store') }}" class="card mt-8 space-y-5 p-7">@csrf<div><label class="mb-2 block text-sm font-semibold">Nama lengkap</label><input name="name" class="field" required></div><div><label class="mb-2 block text-sm font-semibold">Email</label><input type="email" name="email" class="field" required></div><div><label class="mb-2 block text-sm font-semibold">Password awal</label><input type="password" name="password" class="field" minlength="8" required></div><button class="btn btn-dark w-full">Buat akun teknisi</button></form></div>
@endsection
