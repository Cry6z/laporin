# Laporin

![Laravel 12](https://img.shields.io/badge/Laravel-12.x-ff2d20?logo=laravel&logoColor=white)
![PHP 8.3](https://img.shields.io/badge/PHP-8.3-777bb4?logo=php&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-Volt%20%2B%20Flux-9333ea?logo=livewire&logoColor=white)

> Sistem pelaporan pengaduan publik berbasis Laravel yang menggabungkan formulir daring untuk warga, tracking progres, serta dashboard admin modern untuk verifikasi dan tindak lanjut laporan.

---

## Daftar Isi

1. [Ringkasan Cepat](#ringkasan-cepat)
2. [Arsitektur Tingkat Tinggi](#arsitektur-tingkat-tinggi)
3. [Modul & Fitur Utama](#modul--fitur-utama)
4. [Alur Pengguna](#alur-pengguna)
5. [Teknologi Inti](#teknologi-inti)
6. [Persyaratan Sistem](#persyaratan-sistem)
7. [Instalasi](#instalasi)
8. [Konfigurasi Lingkungan](#konfigurasi-lingkungan)
9. [Akun Awal & Peran](#akun-awal--peran)
10. [Menjalankan Aplikasi](#menjalankan-aplikasi)
11. [Pengujian](#pengujian)
12. [Struktur Direktori](#struktur-direktori)
13. [Routing & Endpoint Penting](#routing--endpoint-penting)
14. [Keamanan & Kepatuhan](#keamanan--kepatuhan)
15. [Alur Kerja Pengembangan](#alur-kerja-pengembangan)
16. [Troubleshooting](#troubleshooting)
17. [Kontribusi](#kontribusi)
18. [Lisensi](#lisensi)

---

## Ringkasan Cepat

| Topik | Detail |
| --- | --- |
| Jenis Aplikasi | Pelaporan pengaduan publik (Laravel Monolith) |
| Target Pengguna | Warga (pelapor) & Admin OPD |
| Mekanisme Registrasi | OTP email menggunakan `RegistrationOtp` |
| Manajemen Laporan | CRUD laporan + lampiran, status lifecycle, ekspor PDF |
| Autentikasi | Laravel Fortify + middleware role (`admin` / `user`) |
| UI/UX | Landing page Blade + Tailwind 4, dashboard admin Livewire Volt & Flux |

---

## Arsitektur Tingkat Tinggi

- **Frontend publik**: Blade + Tailwind untuk landing dan formulir pelaporan.
- **Frontend admin**: Livewire Volt + Flux menyediakan komponen reaktif (dashboard, tabel laporan, detail laporan, progress tracking).
- **Backend**: Laravel 12 API/controller + Livewire actions, menyimpan laporan, OTP, lampiran, dan progres.
- **Storage**: File laporan tersimpan di `storage/app/public/reports` dan disajikan melalui symlink `public/storage`.
- **Queue**: Pengiriman email OTP dan pekerjaan berat siap dialihkan ke `database` queue (default).
- **Ekspor PDF**: `barryvdh/laravel-dompdf` menghasilkan dokumen laporan resmi.

---

## Modul & Fitur Utama

### 1. Pelaporan Publik
- Form pelaporan (`LandingPage`, `CreateReportWizard`, `ReportForm`) menerima judul, kategori, lokasi, prioritas, deskripsi, serta hingga 5 lampiran (maks 5 MB per file).
- Validasi ketat terhadap format file (`jpg`, `jpeg`, `png`) dan throttling submit `throttle:report-submit` untuk mencegah spam.

### 2. OTP Registration
- `RegistrationOtpController` menampung data sementara dan mengirim OTP 6 digit via email (berlaku 10 menit, maksimal 5 percobaan).
- Setelah OTP valid, akun `user` dibuat, diverifikasi, dan otomatis login.

### 3. Dashboard Admin
- Komponen Livewire `AdminDashboard`, `AdminReports`, `AdminReportView` menyediakan:
  - Filter laporan berdasarkan status, kategori, rentang tanggal, dan pencarian bebas.
  - Update status dan progres (dengan catatan + foto pendukung).
  - Ekspor PDF tiap laporan melalui `ReportExportController`.

### 4. Tracking dan Notifikasi
- Halaman `MyReports` menampilkan daftar laporan milik pengguna beserta progres terbaru (`ReportProgress`).
- Pengguna dapat membuka detail publik `/reports/{report}` untuk melihat status terkini.

---

## Alur Pengguna

1. **Registrasi** – Pengguna mengisi form, menerima OTP via email, dan memverifikasi.
2. **Login & Buat Laporan** – Autentikasi Fortify, lalu mengisi formulir pelaporan publik.
3. **Proses Internal** – Admin memvalidasi, mengubah status (`pending`, `in_progress`, `resolved`, dll.), dan menambahkan progres.
4. **Pelacakan** – Pengguna memantau `My Reports` atau membuka tautan publik laporan.
5. **Output** – Admin dapat mengekspor PDF laporan lengkap sebagai dokumentasi formal.

---

## Teknologi Inti

| Layer | Teknologi |
| --- | --- |
| Backend | Laravel 12, PHP 8.3, Fortify |
| Frontend | Blade + Tailwind 4, Alpine.js, Livewire Volt & Flux |
| Database | MySQL / MariaDB (default), mendukung SQLite untuk dev |
| Queue & Session | Database driver |
| Build tool | Vite 7, npm |
| Utilitas | Dompdf (PDF), Axios (HTTP), Composer scripts |

---

## Persyaratan Sistem

- PHP **8.3+** dengan ekstensi standar Laravel (OpenSSL, PDO, Mbstring, dll.)
- Composer **2+**
- Node.js **20+** dan npm **10+**
- Database MySQL/MariaDB atau SQLite (dev)
- Server lokal (XAMPP/LAMP/WAMP) atau Sail/Docker sesuai kebutuhan

---

## Instalasi

1. **Clone repositori**
   ```bash
   git clone https://github.com/your-org/laporin.git
   cd laporin
   ```

2. **Pasang dependensi PHP & JavaScript**
   ```bash
   composer install
   npm install
   ```

3. **Salin dan konfigurasi environment**
   ```bash
   cp .env.example .env
   ```
   Set variabel minimum:
   ```env
   APP_NAME="Laporin"
   APP_URL=http://127.0.0.1:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laporin
   DB_USERNAME=root
   DB_PASSWORD=

   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.test
   MAIL_PORT=587
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=admin@laporin.test
   MAIL_FROM_NAME="${APP_NAME}"
   ```

4. **Generate key, migrasi, seeding, dan storage link**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   ```

5. **Build aset (opsional untuk development, wajib untuk production)**
   ```bash
   npm run build
   ```

---

## Konfigurasi Lingkungan

- **Database**: gunakan MySQL untuk production; SQLite cocok untuk uji cepat.
- **Queue**: default `database`. Jalankan `php artisan queue:work` atau `queue:listen` untuk OTP/email.
- **Session & Cache**: sudah diarahkan ke driver `database`. Jalankan `php artisan session:table` bila ingin memisahkan storage.
- **Mail**: gunakan Mailpit/Mailtrap untuk dev, atau SMTP resmi untuk produksi.
- **Storage**: semua lampiran tersimpan di `storage/app/public/reports`. Pastikan izin tulis server web.
- **Rate limiting**: middleware `throttle:report-submit` dapat disetel pada `app/Providers/RouteServiceProvider.php` bila ingin mengubah kuota.

---

## Akun Awal & Peran

Seeder menyiapkan kredensial berikut:

| Peran | Email | Password |
| --- | --- | --- |
| Admin | `adminlaporin@gmail.com` | `password` |
| User Dummy | `user@example.com` | `password` |

> Peran ditentukan oleh kolom `users.role` (`admin` atau `user`). Tambahkan akun tambahan melalui seeder atau `php artisan tinker`.

---

## Menjalankan Aplikasi

### Mode Development

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

Terminal 3 (jika menggunakan queue):
```bash
php artisan queue:listen --tries=1
```

Alternatif sekali jalan dengan Composer script:
```bash
composer dev
```
(Menjalankan `php artisan serve`, `queue:listen`, dan `npm run dev` via `concurrently`).

### Mode Production / Preview

```bash
php artisan config:cache
php artisan route:cache
npm run build
php artisan serve --env=production
```

Sesuaikan dengan web server (Nginx/Apache) dan supervisor untuk queue worker.

---

## Pengujian

Gunakan Pest/Laravel test suite:

```bash
php artisan test
# atau
composer test
```

Cakupan utama:
- Akses dashboard berdasarkan role & verifikasi email.
- Alur pelaporan (form, upload lampiran, throttling).
- Ekspor PDF dan pembaruan status oleh admin.

Tambahkan test baru di `tests/Feature` atau `tests/Unit` sesuai modul.

---

## Struktur Direktori

```
app/
  Http/Controllers/        # Auth OTP, Report CRUD
  Livewire/                # Komponen landing, wizard, admin dashboard
  Models/                  # Report, ReportAttachment, ReportProgress, User, OTP
bootstrap/
config/
database/
  migrations/              # Skema report & OTP
  seeders/                 # AdminSeeder, DatabaseSeeder
public/
  storage/ -> ../storage/app/public
resources/
  views/                   # Blade + Volt
  css/, js/                # Aset Tailwind/Vite
routes/
  web.php                  # Rute publik & admin
storage/
tests/
vite.config.js
```

Gunakan struktur ini sebagai referensi saat menambah modul baru.

---

## Routing & Endpoint Penting

| HTTP | Path | Deskripsi |
| --- | --- | --- |
| GET | `/` | Landing page + formulir laporan (Livewire) |
| POST | `/report` | Simpan laporan (auth + throttled) |
| GET | `/reports/{report}` | Detail publik laporan |
| GET | `/my-reports` | Daftar laporan milik user (auth) |
| GET | `/reports/create` | Wizard pembuatan laporan |
| POST | `/register/request-otp` | Kirim OTP registrasi |
| POST | `/register/otp` | Verifikasi OTP |
| GET | `/admin` | Dashboard ringkas admin |
| GET | `/admin/reports` | Tabel kelola laporan |
| GET | `/admin/reports/{report}` | Detail laporan untuk update |
| POST | `/admin/reports/{report}/export` | Ekspor PDF per laporan |
| Volt routes | `/settings/*` | Manajemen profil, password, tampilan, 2FA (admin) |

---

## Keamanan & Kepatuhan

1. **Autentikasi & Otorisasi** – Laravel Fortify + middleware `auth`, `verified`, dan `role:admin`.
2. **OTP & Rate Limit** – OTP berlaku 10 menit, percobaan maksimal 5X; submit laporan dibatasi 3/menit.
3. **Validasi Input** – Semua form memiliki validasi server-side termasuk ukuran dan format berkas.
4. **Penyimpanan Password** – `bcrypt` (Hash::make) bawaan Laravel.
5. **File Upload** – Disimpan di storage publik dengan path terisolasi. Pertimbangkan virus scan untuk produksi.
6. **Audit Trail** – Progress laporan tersimpan di `report_progresses` dengan timestamp.

---

## Alur Kerja Pengembangan

| Script | Fungsi |
| --- | --- |
| `composer setup` | Menjalankan install + generate env, migrate, npm build (untuk provisioning cepat) |
| `composer dev` | Menjalankan server PHP, queue listener, dan Vite dev secara paralel |
| `composer test` | Membersihkan konfigurasi dan menjalankan test suite |
| `npm run dev` | Vite dev server + HMR |
| `npm run build` | Build aset produksi |

---

## Troubleshooting

1. **OTP tidak terkirim** – Pastikan variabel SMTP benar dan queue worker berjalan (atau set `MAIL_MAILER=log` untuk debug).
2. **Lampiran tidak muncul** – Cek `php artisan storage:link` dan perizinan folder `storage/app/public`.
3. **Asset 404 saat production** – Jalankan `npm run build` dan pastikan `APP_URL` benar.
4. **Queue macet** – Cek tabel `jobs` dan `failed_jobs`. Jalankan `php artisan queue:retry all`.
5. **Error migrasi** – Hapus tabel lama atau jalankan `php artisan migrate:fresh --seed` saat development.

---

## Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE). Silakan gunakan, modifikasi, dan distribusikan sesuai ketentuan lisensi.
