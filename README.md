
## 🚀 Panduan Instalasi SIM IKU dari GitHub (Clone + Docker)

Ikuti langkah-langkah di bawah ini secara berurutan.

### 1. Clone Repository

Buka terminal (CMD/PowerShell/Git Bash) di folder tempat Anda ingin menyimpan proyek.

```bash
git clone https://github.com/Unsri-Presensi-App/SIM-IKU---UNIVERSITAS-SRIWIJAYA.git sim-iku
cd sim-iku
```

> ⚠️ **Catatan:** Repository ini sudah berisi semua file Laravel, Dockerfile, docker-compose.yml, migration, seeder, model, controller, route, dan view. Anda **tidak perlu** membuat proyek dari awal lagi.

### 2. Copy File Environment

Buat file `.env` dari contoh yang sudah disediakan:

```bash
cp .env.example .env
```

### 3. Sesuaikan Konfigurasi Database di `.env`

Buka file `.env` (bisa dengan `nano .env` atau notepad), lalu **pastikan** bagian database seperti ini:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sim_iku
DB_USERNAME=sim_user
DB_PASSWORD=secret123
```

> ✅ Username sudah benar `sim_user` (satu huruf `i`). Jangan diubah.

### 4. Build & Jalankan Container Docker

```bash
docker-compose up -d --build
```

Tunggu proses build selesai (pertama kali akan lama karena mendownload image).  
Cek status container:

```bash
docker-compose ps
```

Pastikan ketiga service (`app`, `nginx`, `db`) berstatus **Up**.

### 5. Generate Key Laravel & Jalankan Migrasi + Seeder

Masuk ke dalam container `app`:

```bash
docker-compose exec app bash
```

Di dalam container, jalankan perintah berikut:

```bash
php artisan key:generate
php artisan migrate --seed
```

Jika ada error `Access denied`, cek ulang `.env` lalu jalankan `docker-compose down -v` dan ulangi dari langkah 4.

### 6. Akses Aplikasi

Buka browser dan kunjungi:

```
http://localhost:8080/iku/1
```

Anda akan melihat halaman **IKU 1 – Angka Efisiensi Edukasi** dengan data dummy yang sudah disediakan.

---

## 📋 Perintah Cepat (Copy-paste semua sekaligus)

Jika Anda ingin menjalankan semua langkah di atas sekaligus (setelah clone), Anda bisa copy blok perintah berikut:

```bash
cd sim-iku
cp .env.example .env
# (Optional: edit .env jika perlu, tapi default sudah benar)
docker-compose up -d --build
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```

Lalu buka `http://localhost:8080/iku/1` di browser.

---

## 🛠️ Perintah Berguna Lainnya

| Tujuan | Perintah |
|--------|----------|
| Hentikan semua container | `docker-compose down` |
| Hentikan + hapus volume database (reset data) | `docker-compose down -v` |
| Lihat log container | `docker-compose logs -f` |
| Masuk ke terminal database MySQL | `docker-compose exec db mysql -u root -psecret123` |
| Perbarui dependency composer | `docker-compose exec app composer update` |

---

## ✅ Troubleshooting Ringkas

| Masalah | Solusi |
|---------|--------|
| `Access denied for user 'siim_user'` | Cek `.env` → `DB_USERNAME=sim_user` (bukan `siim_user`). Lalu `docker-compose down -v` dan ulangi build. |
| Port 8080 sudah dipakai | Ubah `"8080:80"` menjadi `"8081:80"` di `docker-compose.yml`, lalu akses `localhost:8081`. |
| Tabel tidak muncul | Jalankan ulang `docker-compose exec app php artisan migrate:fresh --seed` |

---

## 📁 Catatan Penting

- Repository ini sudah berisi **semua file** yang diperlukan: migration, seeder, model, controller, route, dan view (termasuk UI dengan sidebar + topbar sesuai mockup).
- Anda **tidak perlu** membuat file apapun lagi.
- Aplikasi berjalan di **Docker**, jadi tidak perlu install PHP atau MySQL di komputer Anda.

---

Selamat mencoba! Jika ada kendala, silakan tanyakan. 🚀
