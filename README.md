# Tutorial mulai

## Yang harus udah diinstall


- PHP 
- Composer
- MySQL 
- Laravel 

## Memulai

### 1. Clone Repositori

Pertama, clone repositori proyek ke folder kosong


### 2. Buat .env baru

copy .env.example yang udh gw buat ke .env (.env gabisa diupload ke github):
```
cp .env.example .env
```

### 3. Buat Database

- Nyalain xampp / laragon
- Buka **phpMyAdmin**.
- Buat database baru dengan nama `freshleaf`.

### 4. Instal Dependencies

tulis ini di terminal buat install dependencies:
```
composer install
```

### 5. Generate key

habistu tulis ini di terminal:
```
php artisan key:generate
```

### 6. Jalankan Migrasi

kalau database udah ada, jalanin migration biar ada tabelnya:
```
php artisan migrate
```

### 7. Jalankan Aplikasi

start development server biar keliatan websitenya kek apa:
```
php artisan serve
```

### 