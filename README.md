# LabTrack

LabTrack adalah aplikasi inventaris perangkat laboratorium berbasis Laravel yang dibuat untuk tugas mata kuliah Administrasi Sistem. Aplikasi ini digunakan untuk mencatat dan mengelola data perangkat laboratorium, kemudian dijalankan menggunakan Docker dengan database MySQL pada container terpisah.

## Fitur

- Menampilkan daftar perangkat laboratorium
- Menambah data perangkat
- Mengubah data perangkat
- Menghapus data perangkat
- Menyimpan informasi nama perangkat, kategori, lokasi, IP address, status, dan keterangan
- Seeder data awal untuk pengujian
- Database persisten menggunakan Docker volume

## Teknologi

- Laravel 13
- PHP 8.3
- MySQL 8.4
- Composer
- Docker

## Arsitektur Docker

```text
Browser
  |
  | http://127.0.0.1:8082
  v
labtrack-app
Laravel / PHP
  |
  | labtrack-net
  v
labtrack-db
MySQL 8.4
  |
  v
labtrack-db-data
Docker Volume
```

## Menjalankan Project dengan Docker

### 1. Clone repository

```bash
git clone https://github.com/DiegoPrac/LabTrack.git
cd LabTrack
```

### 2. Buat Docker network

```bash
docker network create labtrack-net
```

### 3. Buat persistent volume

```bash
docker volume create labtrack-db-data
```

### 4. Jalankan MySQL container

```bash
docker run -d \
  --name labtrack-db \
  --network labtrack-net \
  -v labtrack-db-data:/var/lib/mysql \
  -e MYSQL_ROOT_PASSWORD=GANTI_PASSWORD_ROOT \
  -e MYSQL_DATABASE=labtrack \
  -e MYSQL_USER=labtrack \
  -e MYSQL_PASSWORD=GANTI_PASSWORD_DB \
  mysql:8.4
```

> Ganti kedua nilai contoh dengan kata sandi lokal pilihan Anda sebelum menjalankan MySQL. Gunakan kata sandi pengguna MySQL yang sama pada `DB_PASSWORD`.

### 5. Siapkan file environment Docker

Salin file contoh:

```powershell
Copy-Item .env.docker.example .env.docker
```

Di Bash, gunakan `cp .env.docker.example .env.docker`. Contoh `docker run` di bawah menggunakan sintaks Bash. Di PowerShell, gabungkan argumen `docker run` dalam satu baris.

Kemudian sesuaikan konfigurasi database pada `.env.docker`:

```env
DB_CONNECTION=mysql
DB_HOST=labtrack-db
DB_PORT=3306
DB_DATABASE=labtrack
DB_USERNAME=labtrack
DB_PASSWORD=GANTI_PASSWORD_DB
```

### 6. Build image aplikasi

```bash
docker build -t labtrack-app:1.0 .
```

### Alternatif: Pull image dari Docker Hub

Image LabTrack juga dipublikasikan pada Docker Hub:

```bash
docker pull diegoprac/labtrack-app:1.0
```

Docker Hub: https://hub.docker.com/r/diegoprac/labtrack-app

Jika menggunakan image dari Docker Hub, gunakan `diegoprac/labtrack-app:1.0` pada perintah `docker run` menggantikan `labtrack-app:1.0`.

### 7. Buat kunci aplikasi dan jalankan container Laravel

Gunakan nama image yang dipilih pada langkah 6. Contoh berikut menggunakan image lokal.

```bash
docker run --rm labtrack-app:1.0 php artisan key:generate --show
```

Salin hasilnya ke `APP_KEY` pada `.env.docker` sebelum menjalankan container. Tunggu hingga MySQL siap menerima koneksi sebelum menjalankan migrasi.

```bash
docker run -d \
  --name labtrack-app \
  --network labtrack-net \
  --env-file .env.docker \
  -p 127.0.0.1:8082:8000 \
  labtrack-app:1.0
```

### 8. Jalankan migration dan seeder

```bash
docker exec labtrack-app php artisan migrate
docker exec labtrack-app php artisan db:seed --class=DeviceSeeder
```

Jalankan seeder satu kali pada database baru untuk mengisi data demonstrasi. Lewati seeding jika data awal sudah tersedia. Gunakan `migrate` untuk menerapkan perubahan skema tanpa menghapus tabel.

### 9. Buka aplikasi

Akses melalui browser:

```text
http://127.0.0.1:8082/devices
```

## Verifikasi

Melihat container yang berjalan:

```bash
docker ps
```

Memeriksa network:

```bash
docker network inspect labtrack-net
```

Memeriksa volume:

```bash
docker volume inspect labtrack-db-data
```

Memeriksa tabel database:

```bash
docker exec -it labtrack-db mysql -u labtrack -p labtrack
```

Kemudian pada MySQL:

```sql
SHOW TABLES;
SELECT id, nama_perangkat, kategori, lokasi, status FROM devices;
```

## Catatan Keamanan

File `.env` dan `.env.docker` tidak disimpan di repository. Repository hanya menyediakan `.env.example` dan `.env.docker.example` sebagai contoh konfigurasi.

## Status Project

Aplikasi LabTrack telah berhasil:
- dibangun sebagai Docker image,
- dijalankan pada container Laravel,
- terhubung dengan container MySQL,
- menggunakan Docker network khusus,
- menggunakan persistent volume,
- dipublikasikan pada Docker Hub sebagai `diegoprac/labtrack-app:1.0`,
- dan diuji setelah restart container tanpa kehilangan data.
