# Aplikasi Manajemen Persetujuan

## Pengguna & Informasi Login

1. **Admin**
   - Username: admin
   - Password: password

2. **Atasan Cabang (Approver) - Level 1**
   - Username: approver1_user
   - Password: password

3. **Atasan Pusat (Approver) - Level 2**
   - Username: approver2_user
   - Password: password

## Informasi Teknis

- **Database Version:** MySQL 8.0.30
- **PHP Version:** PHP 8.3.3 (cli) 
- **Framework:** Laravel Framework 10.48.11

## Panduan Penggunaan Aplikasi

### 1. Instalasi

- Pastikan komputer Anda telah terpasang HP 8.3.3 (cli) 
- Clone repositori aplikasi dari [GitHub](https://github.com/namauser/aplikasi-manajemen-persetujuan).
- Buka terminal dan arahkan ke direktori aplikasi.

### 2. Konfigurasi Environment

- Salin file `.env.example` menjadi `.env`.
- Atur koneksi database Anda di file `.env` dengan mengisi informasi seperti nama database, username, dan password.
- Setel `APP_KEY` dengan menjalankan perintah `php artisan key:generate`.

### 3. Instalasi Dependencies

- Jalankan perintah `composer install` untuk menginstal semua dependencies yang diperlukan.

### 4. Migrasi Database

- Pastikan database yang diatur dalam `.env` telah dibuat.
- Jalankan perintah `php artisan migrate` untuk menjalankan semua migrasi database yang diperlukan.

### 5. Seed Database

- Jika ada data dummy yang perlu ditambahkan, jalankan perintah `php artisan db:seed` untuk mengisi database dengan data awal.

### 6. Menjalankan Aplikasi

- Jalankan perintah `php artisan serve` untuk memulai server lokal.
- Aplikasi sekarang dapat diakses melalui browser pada `http://localhost:8000`.

### 7. Masuk ke Aplikasi

- Gunakan informasi login yang disediakan di atas untuk masuk ke aplikasi sesuai peran pengguna Anda.

