<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','LaporWud') · Sistem Pelaporan</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
<style>
body{font-family:'DM Sans',sans-serif;background:#f4f4f1;color:#171717}.serif{font-family:'Playfair Display',serif}
.glass{background:rgba(255,255,255,.82);backdrop-filter:blur(18px)}.dark-panel{background:#111;color:#f7f7f4}
.btn{display:inline-flex;align-items:center;justify-content:center;border-radius:999px;padding:.75rem 1.2rem;font-weight:700;font-size:.88rem;transition:.2s}
.btn-dark{background:#111;color:white}.btn-dark:hover{background:#333;transform:translateY(-1px)}
.btn-light{background:white;color:#111;border:1px solid #ddd}.field{width:100%;border:1px solid #deded9;background:white;border-radius:12px;padding:12px 14px;outline:none}.field:focus{border-color:#111;box-shadow:0 0 0 3px #11111112}
.card{background:white;border:1px solid #e8e8e3;border-radius:20px;box-shadow:0 8px 30px #00000006}
.muted{color:#777}.eyebrow{font-size:11px;letter-spacing:.18em;text-transform:uppercase;font-weight:800;color:#777}
</style>
</head>
<body>
@if(session('success'))<div class="fixed top-4 right-4 z-50 rounded-xl bg-black px-5 py-3 text-sm text-white shadow-xl">{{ session('success') }}</div>@endif
@if($errors->any())<div class="mx-auto mt-4 max-w-5xl rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-sm text-red-700">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
@yield('content')
</body></html>
