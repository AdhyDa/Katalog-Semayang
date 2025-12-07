<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Semayang',
            'email' => 'admin@semayang.com',
            'username' => 'admin',
            'phone' => '082254429990',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Customer
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'username' => 'budi01',
            'phone' => '081234567890',
            'institution' => 'Universitas Negeri Malang',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Pria', 'slug' => 'pria'],
            ['name' => 'Wanita', 'slug' => 'wanita'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Products
        $products = [
            [
                'category_id' => 2, // Wanita
                'name' => 'Set Baju Adat Wanita (Merah)',
                'slug' => 'set-baju-adat-wanita-merah',
                'description' => 'Paket lengkap baju adat wanita Dayak warna merah. Termasuk aksesoris kepala dan kalung manik tradisional.',
                'price_per_3days' => 55000,
                'stock_total' => 5,
                'stock_available' => 5,
                'size_info' => 'All Size (Uk. S sampai XXL)',
                'included_items' => json_encode(['Mahkota', 'Kalung manik', 'Gelang', 'Rok']),
                'status' => 'tersedia',
                'image' => 'baju-wanita-merah.jpg',
            ],
            [
                'category_id' => 1, // Pria
                'name' => 'Baju Adat Pria (Hitam)',
                'slug' => 'baju-adat-pria-hitam',
                'description' => 'Baju adat Dayak untuk pria warna hitam dengan ornamen tradisional khas Kalimantan Timur. Cocok untuk acara formal dan upacara adat.',
                'price_per_3days' => 55000,
                'stock_total' => 1,
                'stock_available' => 1,
                'size_info' => 'All Size (Uk. S sampai XXL)',
                'included_items' => json_encode(['Topi bulu', 'Rompi manik', 'Rok rumbai']),
                'status' => 'tersedia',
                'image' => 'baju-pria-hitam.jpg',
            ],
            [
                'category_id' => 3, // Aksesoris
                'name' => 'Cincin Enggang Asli',
                'slug' => 'cincin-enggang-asli',
                'description' => 'Cincin dengan motif burung enggang, simbol khas Kalimantan. Terbuat dari material berkualitas.',
                'price_per_3days' => 55000,
                'stock_total' => 0,
                'stock_available' => 0,
                'size_info' => 'Size L',
                'included_items' => json_encode([]),
                'status' => 'habis',
                'image' => 'cincin-enggang.jpg',
            ],
            [
                'category_id' => 2, // Wanita
                'name' => 'Set Baju Adat Wanita (Kuning)',
                'slug' => 'set-baju-adat-wanita-kuning',
                'description' => 'Paket lengkap baju adat wanita Dayak warna kuning dengan detail manik-manik cantik.',
                'price_per_3days' => 60000,
                'stock_total' => 3,
                'stock_available' => 3,
                'size_info' => 'All Size (Uk. S sampai XXL)',
                'included_items' => json_encode(['Mahkota', 'Kalung manik', 'Gelang', 'Rok']),
                'status' => 'tersedia',
                'image' => 'baju-wanita-kuning.jpg',
            ],
            [
                'category_id' => 1, // Pria
                'name' => 'Baju Adat Pria (Merah)',
                'slug' => 'baju-adat-pria-merah',
                'description' => 'Baju adat Dayak untuk pria warna merah dengan ornamen tradisional khas Kalimantan Timur. Cocok untuk acara formal dan upacara adat.',
                'price_per_3days' => 55000,
                'stock_total' => 2,
                'stock_available' => 2,
                'size_info' => 'All Size (Uk. S sampai XXL)',
                'included_items' => json_encode(['Topi bulu', 'Rompi manik', 'Rok rumbai']),
                'status' => 'tersedia',
                'image' => 'baju-pria-merah.jpg',
            ],
            [
                'category_id' => 3, // Aksesoris
                'name' => 'Mandau (Pedang Tradisional)',
                'slug' => 'mandau-pedang-tradisional',
                'description' => 'Mandau pedang tradisional Kalimantan sebagai pelengkap kostum pria. Aman digunakan.',
                'price_per_3days' => 75000,
                'stock_total' => 4,
                'stock_available' => 4,
                'size_info' => 'Panjang 30cm',
                'included_items' => json_encode([]),
                'status' => 'tersedia',
                'image' => 'mandau.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials:');
        $this->command->info('Email: admin@semayang.com');
        $this->command->info('Password: password');
    }
}
