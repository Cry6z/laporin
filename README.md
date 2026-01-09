# Laporin

Sistem pelaporan pengaduan publik berbasis Laravel. Masyarakat dapat mengirim laporan secara daring lengkap dengan bukti foto, sementara admin memantau, memvalidasi, dan menindaklanjuti laporan melalui dashboard yang modern.

![Landing Page](public/landing.png)
![Dashboard](public/screenshots/dashboard.png)

## Daftar Isi
1. [Fitur Utama](#fitur-utama)
2. [Arsitektur & Teknologi](#arsitektur--teknologi)
3. [Persyaratan Sistem](#persyaratan-sistem)
4. [Instalasi & Konfigurasi](#instalasi--konfigurasi)
5. [Menjalankan Aplikasi](#menjalankan-aplikasi)
6. [Akun Awal & Peran](#akun-awal--peran)
7. [Struktur Halaman](#struktur-halaman)
8. [Pengujian](#pengujian)
9. [Kontribusi](#kontribusi)

---

## Fitur Utama

- **Pelaporan publik**: warga mengirim judul, kategori, lokasi, prioritas, dan bukti foto (maks. 5 file @ 5 MB) melalui landing page.
- **OTP Registration**: pendaftaran pengguna baru wajib verifikasi email melalui kode OTP sebelum akun aktif.
- **Dashboard Admin**: UI berbasis Flux untuk melihat daftar laporan, filter per status/kategori, hingga ekspor PDF.
- **Status Tracking**: pengguna memantau progres di halaman **Laporan Saya** dan menerima pembaruan status.
- **Peran**: `admin` dan `user` tersimpan pada kolom `users.role`.
- **Keamanan**: autentikasi Fortify, rate limiting (`throttle:report-submit`, limit 3/menit), serta validasi unggahan file.

## Arsitektur & Teknologi

| Layer        | Teknologi Utama |
|--------------|-----------------|
| Backend      | Laravel 12, PHP 8.3 |
| Frontend     | Blade + Tailwind (public), Livewire Volt + Flux (admin) |
| Database     | MySQL / MariaDB |
| Build Tools  | Vite, npm |
| Lainnya      | Dompdf (export PDF), Alpine.js (interaktivitas ringan) |

## Persyaratan Sistem

- PHP 8.3+
- Composer 2+
- Node 20+ dan npm 10+
- MySQL/MariaDB
- XAMPP atau stack LAMP/WAMP sejenis

## Instalasi & Konfigurasi

1. **Clone repo & masuk folder**
   ```bash
   git clone https://github.com/your-org/laporin.git
   cd laporin
   ```

2. **Pasang dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Salin environment & konfigurasi database**
   ```bash
   cp .env.example .env
   ```
   Sesuaikan variabel berikut:
   ```env
   APP_NAME="Laporin"
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laporin
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate key, migrasi, seed**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Buat symlink storage**
   ```bash
   php artisan storage:link
   ```

6. **Build aset Frontend**
   ```bash
   npm run build   
   ```

## Menjalankan Aplikasi

```bash
php artisan serve
```
Buka `http://127.0.0.1:8000` untuk landing page publik. Dashboard admin tersedia di `/admin` setelah login.

## Akun Awal & Peran

Seeder menyiapkan akun berikut:

| Peran  | Email                 | Password      |
|--------|-----------------------|---------------|
| Admin  | `admin@laporin.test`  | `Password123!`|

Peran pengguna dapat diubah melalui kolom `users.role` (`admin` atau `user`).

## Struktur Halaman

- `GET /` – Landing page + form laporan Livewire.
- `GET /my-reports` – Daftar laporan milik user (auth).
- `POST /report` – Endpoint fallback HTTP untuk submit laporan (auth + throttled).
- `GET /admin` – Dashboard admin (Flux layout).
- `GET /admin/reports` – Daftar laporan dengan filter.
- `GET /admin/reports/{report}` – Detail, update status.
- `POST /admin/reports/{report}/export` – Ekspor PDF laporan.

Catatan tambahan:
- Public layout: `resources/views/components/layouts/public.blade.php`
- Admin layout: `resources/views/components/layouts/app.blade.php`
- Aset publik: `resources/css/public.css`, admin: `resources/css/app.css`
- File upload tersimpan di `storage/app/public/reports`

## Pengujian

```bash
php artisan test
```

Cakupan test meliputi:
- Akses dashboard berdasarkan role.
- Pengiriman laporan + lampiran.
- Ekspor PDF oleh admin.
