# BACKEND API EMPLOYEE DATA LARAVEL - LUMEN 8


### Instalasi

Sebelum melakukan instalasi pastikan sudah terpasang `composer` dan `php`.
Versi PHP 7.3 - 8.0
Database Mysql
Laragon

```php
// Setup library yang dibutuhkan
$ composer install

// Cek .env apakah ter create atau tidak, jika tidak jalankan langkah berikut 
$ cmd : copy .env.example .env

// Generate Key
$ php artisan key:generate

//Create database di env
setting database file -> .env 

// Setup Database
$ php artisan migrate --seed

// Jika Manual Setup Database
$ php artisan migrate
$ Data Bank Account: php artisan make:seeder BankAccountTableSeeder
$ Data Provinsi: php artisan make:seeder ProvincesTableSeeder
$ Data Kota: php artisan make:seeder CitiesTableSeeder
$ Data Posisi: php artisan make:seeder PositionsTableSeeder

// Menjalankan Aplikasi
$ php -S localhost:8000 -t public
```
