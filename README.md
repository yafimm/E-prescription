<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Spesifikasi E-Prescription

- Laravel 8.82.0
- PHP >= 7.3
- Mysql mysqlnd 5.0.12

## Instalasi

Langkah langkah:
- Clone Project dari github ini https://github.com/yafimm/E-prescription/ berikut langkahnya.
    -   buka Terminal/CMD, lalu pindahkan direktori untuk penyimpanan projek
    -   ketika sudah dipindahkan, jalankan perintah "git clone https://github.com/yafimm/E-prescription/" dan tunggu beberapa detik
    -   setelah selesai clone projek, masuk ke direktori tersebut dan jalankan perintah "composer install" untuk mengunduh beberapa library yang dibutuhkan projek ini
    -   setelah selesai clone dan install library yang dibutuhkan, selanjutnya copy file ".env.example" lalu rename dengan nama file ".env" atau dengan perintah "cp .env.example .env"
- Setelah clone project dan install package depedency, tahap selanjutnya membuat database berikut langkahnya.
    -   Buat database dengan nama bebas
    -   Buka file ".env" lalu isi nama database sesuai dengan database yang sudah dibuat, dan password default "root"
    -   setelah itu jalankan database migrate dan seeder dengan cmd (tetap dilokasi project) dengan cmd "php artisan migrate" lalu "php artisan db:seed" atau bisa juga dengan cara singkat yaitu "php artisan migrate:refresh --seed" (Pembuatan table dan seeder data termasuk data obatalkes_m dan signa_m)
    -   database berhasil dibuat 
- Setelah database berhasil dibuat, pastikan .env sesuai
- jalankan "php artisan serve" untuk menjalankan websitenya, dan buka lewat browser dengan ip "localhost:8000" (defaultnya) atau sesuai dengan settingan serve nya

## Dummy User Account
- email / password = admin@prescription.com / admin
- email / password = admintest@prescription.com / admin
- email / password = dadang@prescription.com / admin

