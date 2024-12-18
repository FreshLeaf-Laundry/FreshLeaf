# Panduan Pengaturan Proyek Freshleaf

Selamat datang di proyek Freshleaf! Ikuti langkah-langkah di bawah ini untuk mengatur lingkungan pengembangan lokal Anda.

## Prasyarat

Sebelum Anda mulai, pastikan Anda telah menginstal perangkat lunak berikut:

- PHP (versi 7.3 atau lebih tinggi)
- Composer
- MySQL (atau MariaDB)
- Laravel (opsional, untuk instalasi global)

## Memulai

### 1. Clone Repositori

Pertama, clone repositori proyek ke folder kosong:


### 2. Buat .env baru

copy .env.example yang udh gw buat ke .env (.env gabisa diupload ke github):

bash cp .env.example .env

### 3. Buat Database

- Nyalain xampp / laragon
- Buka **phpMyAdmin**.
- Buat database baru dengan nama `freshleaf`.

### 4. Instal Dependencies

tulis ini di terminal buat install dependencies:

bash composer install

### 5. Generate key

habistu tulis ini di terminal:

bash php artisan key:generate

### 6. Jalankan Migrasi

kalau database udah ada, jalanin migration biar ada tabelnya:

bash php artisan migrate

### 7. Jalankan Aplikasi

start development server biar keliatan websitenya kek apa:

bash php artisan serve