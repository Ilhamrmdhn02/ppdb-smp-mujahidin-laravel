# PPDB SMP Mujahidin Surabaya — Laravel

Aplikasi ini adalah rekonstruksi Laravel dari backup situs PPDB SMP Mujahidin Surabaya. Tampilan beranda mempertahankan identitas visual, aset logo, kartu informasi, alur pendaftaran, serta navigasi utama dari situs sumber. Logika aplikasi dipindahkan ke route, controller, model Eloquent, migrasi SQLite, dan Blade views.

## Fitur

- Beranda PPDB dengan informasi, alur, dan ekstrakurikuler.
- Formulir pendaftaran calon peserta didik.
- Pembuatan nomor pendaftaran otomatis.
- Cek status berdasarkan nomor pendaftaran.
- Login admin demo dan dashboard data pendaftar.
- Konfirmasi pendaftar dan ekspor CSV.

## Instalasi

Kebutuhan: PHP 8.2+, Composer, SQLite, dan ekstensi `mbstring`, `openssl`, `pdo_sqlite`, serta `xml`.

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## Login Admin Demo

- Email: `admin@mujahidin.sch.id`
- Password: `admin123`

Kredensial ini hanya untuk demo/tugas lokal. Ganti mekanisme autentikasi sebelum dipakai di server produksi.

## Catatan

Backup asli memuat file sertifikat/private key dan data contoh sensitif. File tersebut tidak disertakan dalam proyek ini. Asset visual publik sekolah yang diperlukan untuk tampilan telah disalin ke `public/assets`.
