# Katalog Semayang - Platform Persewaan Baju AMKT Semayang

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![Status](https://img.shields.io/badge/Status-Development-yellow?style=for-the-badge)](https://github.com/AdhyDa/Katalog-Semayang)

**Katalog Semayang** adalah platform katalog digital yang dirancang khusus untuk mengelola usaha penyewaan baju di **Asrama Mahasiswa Kalimantan Timur (AMKT) Semayang**. Proyek ini bertujuan untuk mendigitalisasi inventaris dan mengoptimalkan proses pemesanan (booking) agar lebih efisien dan terorganisir.

## 🚀 Fitur Utama

- **Katalog Digital:** Menampilkan berbagai koleksi baju tradisional dan atribut lainnya dengan tampilan yang responsif.
- **Manajemen Inventaris:** Memudahkan pengelola untuk melacak ketersediaan stok baju secara real-time.
- **Sistem Booking:** Memungkinkan pengguna untuk melakukan pemesanan jadwal sewa secara langsung melalui platform.
- **Dashboard Admin:** Panel kontrol untuk mengelola produk, kategori, serta memantau status penyewaan.
- **Optimalisasi Proses:** Meminimalkan kesalahan manual dalam pencatatan transaksi dan jadwal sewa.

## 🛠️ Tech Stack

- **Framework:** [Laravel 12](https://laravel.com)
- **Frontend:** [Blade Templating](https://laravel.com/docs/12.x/blade) & [Tailwind CSS](https://tailwindcss.com)
- **Database:** MySQL
- **Build Tool:** [Vite](https://vitejs.dev/)
- **Version Control:** Git & GitHub

## 📋 Prasyarat

Sebelum menjalankan proyek ini di lokal, pastikan Anda telah menginstal:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

## 💻 Instalasi

1. **Clone repositori:**
   ```bash
   git clone [https://github.com/AdhyDa/Katalog-Semayang.git](https://github.com/AdhyDa/Katalog-Semayang.git)
   cd Katalog-Semayang
   
2. **Instal dependensi PHP:**
   ```bash
   composer install

3. Instal dependensi Frontend:
    ```bash
    npm install && npm run dev
    
4. Konfigurasi Environment:
   ```bash
    cp .env.example .env
    php artisan key:generate
   
5. Migrasi Database:
   ```bash
    php artisan migrate --seed

6. Jalankan Server:
    ```bash
    php artisan serve

📂 Struktur Folder
- app/Models - Definisi struktur data (Baju, Kategori, Transaksi).
- app/Http/Controllers - Logika bisnis aplikasi.
- resources/views - Antarmuka pengguna (Layout admin & katalog).
- database/migrations - Struktur tabel database.

🤝 Kontribusi
Jika Anda ingin berkontribusi pada pengembangan platform ini, silakan lakukan fork pada repositori ini dan kirimkan pull request. Kami sangat menghargai setiap saran dan perbaikan.

📄 Lisensi
Proyek ini merupakan perangkat lunak sumber terbuka yang dilisensikan di bawah MIT license.
Dibuat dengan ❤️ oleh Adhyaksa Daudi
