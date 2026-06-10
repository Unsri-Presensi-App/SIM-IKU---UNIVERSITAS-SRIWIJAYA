# 🎓 SIM IKU - Universitas Sriwijaya

> **Sistem Informasi Manajemen Indikator Kinerja Utama**  
> Berdasarkan Kepmendiktisaintek No. 358/M/KEP/2026

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?logo=laravel)
![Docker](https://img.shields.io/badge/Docker-28.0+-blue?logo=docker)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)

---

## 📌 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
- [Prasyarat](#-prasyarat)
- [Instalasi & Setup](#-instalasi--setup)
  - [1. Buat Proyek Laravel Baru](#1-buat-proyek-laravel-baru)
  - [2. Siapkan File Docker](#2-siapkan-file-docker)
  - [3. Konfigurasi Environment (.env)](#3-konfigurasi-environment-env)
  - [4. Build & Jalankan Container](#4-build--jalankan-container)
  - [5. Migrasi & Seeder Database](#5-migrasi--seeder-database)
  - [6. Buat Model, Controller, Route, dan View](#6-buat-model-controller-route-dan-view)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Troubleshooting Umum](#-troubleshooting-umum)
- [Struktur Folder Penting](#-struktur-folder-penting)
- [Lisensi](#-lisensi)

---

## 🧭 Tentang Proyek

**SIM IKU** adalah aplikasi berbasis web untuk mengelola dan memvisualisasikan Indikator Kinerja Utama (IKU) di lingkungan Universitas Sriwijaya. Proyek ini menggunakan **Laravel** sebagai backend dan **Docker** untuk menyatukan lingkungan pengembangan (PHP, Nginx, MySQL). Fitur pertama yang diimplementasikan adalah **IKU 1 – Angka Efisiensi Edukasi (AEE)**.

![Arsitektur Sederhana](https://via.placeholder.com/800x200?text=Browser+→+Nginx+→+Laravel+→+MySQL)

---

## ⚙️ Teknologi yang Digunakan

- **Laravel 11** – Framework PHP
- **Docker & Docker Compose** – Kontainerisasi
- **Nginx (Alpine)** – Web server
- **PHP 8.3-FPM** – Runtime PHP
- **MySQL 8.0** – Database
- **Composer** – Manajer dependensi PHP
- **Blade** – Template engine Laravel

---

## 📋 Prasyarat

Pastikan perangkat Anda sudah terinstall:

- [Git](https://git-scm.com/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (versi 28+)
- [Composer](https://getcomposer.org/) (opsional, karena akan berjalan di dalam container)
- [PHP 8.3](https://www.php.net/) (jika ingin menjalankan artisan tanpa Docker, tapi disarankan via Docker)

---

## 🚀 Instalasi & Setup

Ikuti langkah-langkah berikut secara berurutan.

### 1. Buat Proyek Laravel Baru

Buka terminal (CMD/PowerShell/Git Bash) dan jalankan:

```bash
composer create-project laravel/laravel sim-iku
cd sim-iku
```

> Jika tidak ingin menginstall Composer global, Anda bisa menggunakan `docker run --rm -v $(pwd):/app composer create-project laravel/laravel sim-iku`.

### 2. Siapkan File Docker

Di dalam folder `sim-iku`, buat tiga file berikut.

#### a. `docker-compose.yml`

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: sim_iku_app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - .:/var/www
    networks:
      - sim_iku_network

  nginx:
    image: nginx:alpine
    container_name: sim_iku_nginx
    restart: unless-stopped
    ports:
      - "8080:80"
    volumes:
      - .:/var/www
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - sim_iku_network

  db:
    image: mysql:8.0
    container_name: sim_iku_db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: sim_iku
      MYSQL_ROOT_PASSWORD: secret123
      MYSQL_PASSWORD: secret123
      MYSQL_USER: sim_user
    ports:
      - "3307:3306"
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - sim_iku_network

networks:
  sim_iku_network:
    driver: bridge

volumes:
  db_data:
```

#### b. `Dockerfile`

```dockerfile
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
```

#### c. Konfigurasi Nginx

Buat folder dan file:

```bash
mkdir -p docker/nginx
```

Buat file `docker/nginx/default.conf`:

```nginx
server {
    listen 80;
    index index.php index.html;
    root /var/www/public;

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### 3. Konfigurasi Environment (.env)

Buka file `.env` dan sesuaikan bagian database:

```env
APP_NAME="SIM IKU UNSRI"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sim_iku
DB_USERNAME=sim_user
DB_PASSWORD=secret123
```

> ⚠️ **Penting:** Username harus `sim_user` (satu huruf `i`). Jangan sampai typo menjadi `siim_user` karena akan menyebabkan error koneksi.

### 4. Build & Jalankan Container

```bash
docker-compose up -d --build
```

Tunggu hingga semua image terdownload (hanya pertama kali). Cek status:

```bash
docker-compose ps
```

Semua service (`app`, `nginx`, `db`) harus berstatus **Up**.

### 5. Migrasi & Seeder Database

Masuk ke dalam container `app`:

```bash
docker-compose exec app bash
```

Jalankan migration dan seeder:

```bash
php artisan migrate
php artisan db:seed
```

> Jika muncul error `Access denied for user`, pastikan `.env` sudah benar, lalu jalankan `docker-compose down -v` dan ulangi langkah 4–5.

### 6. Buat Model, Controller, Route, dan View

Semua perintah berikut dijalankan **di dalam container** (`docker-compose exec app bash`).

#### a. Model `IkuSatu`

```bash
php artisan make:model IkuSatu
```

Edit `app/Models/IkuSatu.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkuSatu extends Model
{
    protected $table = 'iku_satu';
    protected $fillable = [
        'nama_program', 'jenjang', 'total_mahasiswa', 
        'lulus_tepat_waktu', 'aee_realisasi', 'aee_ideal', 
        'tingkat_pencapaian', 'tahun_akademik'
    ];
}
```

#### b. Migration & Seeder

Buat migration:

```bash
php artisan make:migration create_iku_satu_table
```

Edit file migration (di `database/migrations/..._create_iku_satu_table.php`):

```php
public function up()
{
    Schema::create('iku_satu', function (Blueprint $table) {
        $table->id();
        $table->string('nama_program');
        $table->string('jenjang');
        $table->integer('total_mahasiswa');
        $table->integer('lulus_tepat_waktu');
        $table->decimal('aee_realisasi', 5, 2);
        $table->decimal('aee_ideal', 5, 2);
        $table->decimal('tingkat_pencapaian', 5, 2);
        $table->integer('tahun_akademik');
        $table->timestamps();
    });
}
```

Buat seeder:

```bash
php artisan make:seeder IkuSatuSeeder
```

Isi `database/seeders/IkuSatuSeeder.php` dengan data contoh (lihat [kode lengkap](https://github.com/Unsri-Presensi-App/SIM-IKU---UNIVERSITAS-SRIWIJAYA/blob/main/database/seeders/IkuSatuSeeder.php)).

Daftarkan di `DatabaseSeeder.php`:

```php
$this->call(IkuSatuSeeder::class);
```

#### c. Controller `IkuController`

```bash
php artisan make:controller IkuController
```

Edit `app/Http/Controllers/IkuController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\IkuSatu;

class IkuController extends Controller
{
    public function ikuSatu()
    {
        $data = IkuSatu::all();
        $aee_pt = $data->avg('tingkat_pencapaian');
        return view('iku.iku-satu', compact('data', 'aee_pt'));
    }
}
```

#### d. Route

Edit `routes/web.php`:

```php
use App\Http\Controllers\IkuController;

Route::get('/iku/1', [IkuController::class, 'ikuSatu'])->name('iku.satu');
```

#### e. View (UI dengan Mockup)

Buat folder `resources/views/iku/` dan file `iku-satu.blade.php`. Gunakan layout utama `layouts/app.blade.php` yang mengadopsi mockup desain (sidebar + topbar). Kode lengkapnya dapat dilihat di [repository](https://github.com/Unsri-Presensi-App/SIM-IKU---UNIVERSITAS-SRIWIJAYA).

> ✨ **Tips:** Template sudah mendukung **tab Ringkasan, Rincian, Perhitungan, Riwayat**, **grafik bar**, **card target**, dan **responsive sidebar**.

---

## ▶️ Menjalankan Aplikasi

1. Pastikan container berjalan:

   ```bash
   docker-compose up -d
   ```

2. Buka browser dan akses:

   ```
   http://localhost:8080/iku/1
   ```

3. Untuk menghentikan container:

   ```bash
   docker-compose down
   ```

4. Menghapus semua data (termasuk database):

   ```bash
   docker-compose down -v
   ```

---

## 🛠️ Troubleshooting Umum

| Masalah | Solusi |
|---------|--------|
| `Access denied for user` | Cek `.env` → `DB_USERNAME=sim_user` (bukan `siim_user`). Lalu jalankan `docker-compose down -v` dan `docker-compose up -d` |
| `src refspec main does not match any` | Branch lokal Anda mungkin `master`. Gunakan `git push -u origin master` atau rename branch: `git branch -m master main` |
| Port 8080 sudah digunakan | Ubah port di `docker-compose.yml` menjadi `"8081:80"` |
| `composer install` gagal di dalam container | Pastikan koneksi internet stabil, lalu jalankan ulang `docker-compose build --no-cache` |
| Tabel tidak muncul | Jalankan `php artisan migrate:fresh --seed` di dalam container |

---

## 📁 Struktur Folder Penting

```
sim-iku/
├── docker/
│   └── nginx/
│       └── default.conf
├── app/
│   ├── Http/Controllers/IkuController.php
│   └── Models/IkuSatu.php
├── database/
│   ├── migrations/ ..._create_iku_satu_table.php
│   └── seeders/IkuSatuSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          # Sidebar + topbar (mockup)
│       └── iku/
│           └── iku-satu.blade.php     # Konten IKU 1
├── routes/web.php
├── .env
├── Dockerfile
└── docker-compose.yml
```

---

## 📄 Lisensi

Proyek ini bersifat internal untuk keperluan akademik Universitas Sriwijaya.  
Dibangun dengan ❤️ oleh tim PKL Magang Web.

---

<div align="center">
  <sub>SIM IKU - UNSRI | Berdasarkan Kepmendiktisaintek No. 358/M/KEP/2026</sub>
</div>
```
