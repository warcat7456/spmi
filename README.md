## Untuk Running Docker
1. docker-compose build
2. docker-compose up

## Command Inisiasi:
1. php artisan migrate atau php artisan migrate:fresh (untuk migrasi awal;buat struktur database)
2. php artisan db:seed (untuk melakukan inisiasi data;import database letakkan file SQL inisiasi data ke dalam folder seeds)

## Command Tambahan untuk development (bukan dihosting)
> browser-sync start --config bs-config.js (untuk running sinkron ke browser syarat aplikasi yang dalam docker/php artisan serve harus sudah running terlebih dahulu)
