LAPORWUD V2 - LOGIN NIS SISWA DAN EMAIL GURU

ISI PEMBARUAN
- Login siswa menggunakan NIS dan password.
- Login guru menggunakan email dan password.
- Registrasi siswa: nama, NIS, kelas, password.
- Registrasi guru: nama, email, NIP opsional, password.
- Login admin tetap di /admin/login.
- Login teknisi tetap di /teknisi/login.
- Tombol admin tidak ditampilkan di landing page.
- Database tetap menggunakan database laporwud.

CARA EKSTRAK
1. Download laporwud-v2.zip ke folder Downloads.
2. Buka terminal PowerShell VS Code.
3. Jalankan:
   cd C:\laragon\www\lapor-rusak
4. Ekstrak overlay:
   Expand-Archive -LiteralPath "$env:USERPROFILE\Downloads\laporwud-v2.zip" -DestinationPath . -Force
5. Jalankan migrasi menggunakan PHP Laragon 8.3:
   & "C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe" artisan migrate
6. Bersihkan cache:
   & "C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe" artisan optimize:clear
7. Jalankan server:
   & "C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe" artisan serve

CATATAN
- ZIP ini adalah overlay pembaruan, bukan project Laravel lengkap.
- Jangan jalankan migrate:fresh.
- Jangan jalankan composer update.
- File .env dan database tidak disertakan atau ditimpa.
- Registrasi umum hanya menerima role siswa dan guru.
- Pastikan migration role/class_name dari ZIP sebelumnya sudah dijalankan.

AKUN DEMO (jika sudah pernah menjalankan db:seed)
Siswa: NIS 1234567890 / password123
Admin: admin@laporwud.test / password123
Teknisi: teknisi@laporwud.test / password123
