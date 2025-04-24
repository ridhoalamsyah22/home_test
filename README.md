# E-Catalog Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

Proyek e-catalog sederhana dengan fitur:
- Manajemen produk admin
- Pencarian produk pengunjung
- Sistem checkout dasar

## Instalasi
1. Install dependencies:
```bash
composer install
npm install
```

2. Setup environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Jalankan migrasi:
```bash
php artisan migrate
```

## Penggunaan

- Admin:
  - Email: admin@example.com
  - Password: password123

- Pengunjung:
  - Buka `/products` untuk melihat katalog

## Struktur Proyek

```
├── app/
├── config/
├── database/
├── resources/
│   └── views/
│       ├── admin/
│       └── products/
└── routes/
```
