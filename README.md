# Web App Sistem Penjamin Mutu Internal (SPMI) Laravel 7.29 + Docker 🚀

Proyek ini adalah aplikasi Laravel 7.29 yang diatur untuk berjalan di lingkungan Docker. Ini mencakup server web, PHP-FPM, MySQL, dan semua dependensi yang diperlukan agar Anda dapat memulai dengan cepat.

## Prasyarat

Sebelum Anda memulai, pastikan Anda telah menginstal hal-hal berikut pada sistem Anda:

- Docker
- Docker Compose
- Git

## Memulai

Ikuti langkah-langkah berikut untuk menjalankan lingkungan pengembangan Anda:

1. Klon repositori:
   ```
   git clone <url-repositori-anda>
   cd <direktori-proyek-anda>
   ```

2. Salin file environment contoh:
   ```
   cp .env.example .env
   ```

3. Bangun dan mulai kontainer Docker:
   ```
   docker-compose up -d --build
   ```

4. Instal dependensi PHP:
   ```
   docker-compose exec app composer install
   ```

5. Hasilkan kunci aplikasi:
   ```
   docker-compose exec app php artisan key:generate
   ```

6. Jalankan migrasi database:
   ```
   docker-compose exec app php artisan migrate
   ```

7. Instal dependensi Node.js dan kompilasi aset:
   ```
   docker-compose exec app npm install
   docker-compose exec app npm run dev
   ```

Aplikasi Laravel Anda sekarang seharusnya berjalan dan dapat diakses di `http://localhost:8000`.

## Layanan Docker

Proyek ini menggunakan layanan Docker berikut:

- **app**: Kontainer PHP-FPM dengan aplikasi Laravel
- **db**: Database MySQL
- **nginx**: Server web Nginx

## Pengembangan dengan Visual Studio Code

Proyek ini menyertakan file `devcontainer.json` untuk pengembangan dengan ekstensi Remote - Containers Visual Studio Code. Untuk menggunakannya:

1. Instal [ekstensi Remote - Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) di VS Code.
2. Buka folder proyek di VS Code.
3. Saat diminta, klik "Reopen in Container" atau jalankan perintah "Remote-Containers: Reopen in Container" dari command palette.

VS Code akan membangun kontainer Docker dan menyediakan Anda dengan lingkungan pengembangan lengkap, termasuk ekstensi dan pengaturan yang ditentukan dalam `devcontainer.json`.

## Perintah Docker yang Berguna

Berikut beberapa perintah Docker yang berguna untuk mengelola lingkungan Anda:

- Mulai kontainer: `docker-compose up -d`
- Hentikan kontainer: `docker-compose down`
- Lihat log kontainer: `docker-compose logs`
- Mulai ulang layanan tertentu: `docker-compose restart <nama-layanan>`
- Jalankan perintah artisan: `docker-compose exec app php artisan <perintah>`
- Akses CLI MySQL: `docker-compose exec db mysql -u<username> -p<password>`

## Perintah untuk Menjalankan ke Kontainer Docker

1. `docker-compose exec -u www-data app` - Untuk menjalankan perintah/terminal ke kontainer aplikasi
2. `docker-compose exec -u www-data db` - Untuk menjalankan perintah/terminal ke kontainer db (mysql)

## Perintah Inisialisasi:

1. `php artisan migrate` atau `php artisan migrate:fresh` (untuk migrasi awal; membuat struktur database)
2. `php artisan db:seed` (untuk melakukan inisialisasi data; impor database, letakkan file SQL inisialisasi data ke dalam folder seeds)

## Perintah Tambahan untuk Pengembangan (bukan untuk hosting)

> `browser-sync start --config bs-config.js` (untuk menjalankan sinkronisasi ke browser, syarat aplikasi yang dalam docker/php artisan serve harus sudah berjalan terlebih dahulu)

## Cara Penggunaan Factory untuk Data Dummy (Data Testing) (jalankan perintah menggunakan php artisan tinker):

1. Masuk ke terminal dan jalankan `php artisan tinker`, untuk masuk ke console command artisan tinker
2. Urutan generate factory saat ini adalah sebagai berikut:
   i. `factory(App\Element::class,100)->create()`
   ii. `factory(App\Target::class,100)->create()`
   iii. `factory(App\Berkas::class,100)->create()`

## PhpMyAdmin

Jika docker anda sudah berjalan, anda dapat mengakses phpmyadmin pada alamat: localhost:8080

## Langkah Update 18/11/2023

1. Jalankan `php artisan migrate` (sampai muncul error)
2. Akses URL http://127.0.0.1:8000/update-indikator-lam
3. Jalankan `php artisan migrate` lagi

## Menyesuaikan Lingkungan

- Untuk memodifikasi pengaturan PHP, edit file `php/local.ini`.
- Untuk memodifikasi pengaturan Nginx, edit file di direktori `nginx/conf.d/`.
- Untuk memodifikasi pengaturan MySQL, edit file `mysql/my.cnf`.

## Pemecahan Masalah

Jika Anda mengalami masalah, coba langkah-langkah berikut:

1. Pastikan semua kontainer berjalan: `docker-compose ps`
2. Periksa log untuk pesan kesalahan: `docker-compose logs`
3. Bangun ulang kontainer: `docker-compose up -d --build`
4. Jika masalah berlanjut, coba hapus semua kontainer dan volume, lalu bangun ulang:
   ```
   docker-compose down -v
   docker-compose up -d --build
   ```

## Kontributor

Kami ingin berterima kasih kepada kontributor berikut atas usaha mereka dalam proyek ini:

- [Recky-A](https://github.com/recky-a)
- [Ugik-Dev](https://github.com/ugik-dev)
- [Warcat7456](https://github.com/warcat7456)

## Berkontribusi

Kami menyambut kontribusi untuk proyek ini! Jika Anda ingin berkontribusi, silakan ikuti langkah-langkah berikut:

1. Fork repositori
2. Buat branch baru untuk fitur atau perbaikan bug Anda
3. Buat perubahan Anda dan commit dengan pesan commit yang jelas
4. Push perubahan Anda ke fork Anda
5. Buat pull request ke repositori utama

Pastikan kode Anda mengikuti gaya yang ada dan sertakan tes yang sesuai jika memungkinkan.

## Lisensi

Lihat [Lisensi](https://github.com/warcat7456/spmi/LICENSE.md) untuk melihat keterangan lisensi tentang projek ini
