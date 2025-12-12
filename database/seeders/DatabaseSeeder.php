<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Semayang',
            'email' => 'adhyaksa209@gmail.com',
            'username' => 'admin',
            'phone' => '082254429990',
            'password' => Hash::make('akuAdmin'),
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

        $products = [
            [
                'category_id' => 2,
                'name' => 'Set Baju Adat Perempuan Merah',
                'price_per_3days' => 75000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Tampil memukau dengan set lengkap baju adat Dayak berwarna merah cerah, yang melambangkan keberanian dan semangat. Paket ini sudah termasuk atasan, bawahan, serta aksesoris pelengkap untuk penampilan yang otentik.',
                'stock_total' => 3,
                'image' => 'baju-wanita-merah.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Set Baju Adat Perempuan Hijau',
                'price_per_3days' => 75000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Rasakan keanggunan alami dengan baju adat Dayak bernuansa hijau segar yang menenangkan. Set ini hadir lengkap dengan aksesoris tradisional untuk menyempurnakan gaya etnik Anda.',
                'stock_total' => 1,
                'image' => 'baju-wanita-hijau.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Set Baju Adat Perempuan Biru',
                'price_per_3days' => 75000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Baju adat Dayak berwarna biru ini menawarkan pesona yang tenang dan elegan, cocok untuk berbagai acara budaya. Paket lengkap ini memastikan Anda tampil percaya diri dengan atasan, bawahan, dan aksesoris yang serasi.',
                'stock_total' => 2,
                'image' => 'baju-wanita-biru.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Set Baju Adat Perempuan Hitam',
                'price_per_3days' => 75000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Pancarkan aura misterius dan berwibawa dengan set baju adat Dayak berwarna hitam yang klasik dan timeless. Dilengkapi dengan aksesoris tradisional, busana ini sangat pas untuk upacara adat atau acara formal.',
                'stock_total' => 8,
                'image' => 'baju-wanita-hitam.png',
            ],
            [
                'category_id' => 2,
                'name' => 'Baju Adat Perempuan Biru',
                'price_per_3days' => 75000,
                'size_info' => 'All Size',
                'included_items' => '-',
                'description' => 'Pilihan tepat bagi Anda yang mencari atasan atau busana satuan bernuansa biru khas Dayak yang menawan. Busana ini menonjolkan detail motif tradisional yang indah tanpa aksesoris tambahan.',
                'stock_total' => 5,
                'image' => 'baju-wanita-biru.png',
            ],

            [
                'category_id' => 1,
                'name' => ' Set Baju Adat Laki-Laki Hitam',
                'price_per_3days' => 55000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Tunjukkan gagahnya budaya Kalimantan dengan set baju adat pria berwarna hitam yang melambangkan kekuatan. Paket lengkap ini sudah termasuk atasan, bawahan, dan aksesoris untuk tampilan prajurit Dayak yang sejati.',
                'stock_total' => 6,
                'image' => 'baju-laki-hitam.png',
            ],
            [
                'category_id' => 1,
                'name' => ' Set Baju Adat Laki-Laki Biru',
                'price_per_3days' => 55000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Tampil beda dengan baju adat pria bernuansa biru yang merepresentasikan ketenangan dan kedalaman makna budaya. Set ini menyediakan busana lengkap dari kepala hingga kaki untuk acara spesial Anda.',
                'stock_total' => 2,
                'image' => 'baju-laki-biru.png',
            ],
            [
                'category_id' => 1,
                'name' => ' Set Baju Adat Laki-Laki Kuning',
                'price_per_3days' => 55000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Warna kuning yang cerah pada set baju adat ini melambangkan kejayaan dan kemakmuran, cocok untuk acara perayaan. Dapatkan tampilan lengkap yang memikat perhatian dengan atasan, bawahan, dan aksesorisnya.',
                'stock_total' => 1,
                'image' => 'baju-laki-kuning.png',
            ],
            [
                'category_id' => 1,
                'name' => ' Set Baju Adat Laki-Laki Merah',
                'price_per_3days' => 55000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Kobarkan semangat dengan baju adat pria berwarna merah menyala yang penuh energi dan keberanian. Set lengkap ini dirancang untuk membuat Anda tampil menonjol dalam setiap kesempatan budaya.',
                'stock_total' => 1,
                'image' => 'baju-laki-merah.png',
            ],
            [
                'category_id' => 1,
                'name' => ' Set Baju Adat Laki-Laki Kayu',
                'price_per_3days' => 55000,
                'size_info' => 'All Size',
                'included_items' => 'Atasan, Bawahan, Aksesoris Pelengkap',
                'description' => 'Kembali ke alam dengan baju adat unik yang terbuat dari kulit kayu atau bernuansa alami, menampilkan sisi eksotis budaya Dayak. Set ini memberikan pengalaman mengenakan busana tradisional yang sangat otentik dan bersejarah.',
                'stock_total' => 5,
                'image' => 'baju-laki-kayu.png',
            ],

            [
                'category_id' => 3,
                'name' => 'Mahkota Perempuan Biasa',
                'price_per_3days' => 5000,
                'size_info' => 'Kecil',
                'included_items' => '-',
                'description' => 'Hiasan kepala sederhana namun cantik untuk melengkapi busana adat wanita Anda sehari-hari atau acara santai. Menambah sentuhan etnik yang manis tanpa terlihat berlebihan.',
                'stock_total' => 15,
                'image' => 'mahkota-biasa-wanita.jpeg',
            ],
            [
                'category_id' => 3,
                'name' => 'Mahkota Perempuan Besar',
                'price_per_3days' => 25000,
                'size_info' => 'Besar',
                'included_items' => '-',
                'description' => '',
                'stock_total' => 2,
                'image' => 'mahkota-besar-wanita.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Mahkota Laki-Laki Biasa',
                'price_per_3days' => 5000,
                'size_info' => 'Kecil',
                'included_items' => '-',
                'description' => 'Tampil bak ratu dengan mahkota kebesaran yang penuh detail manik-manik rumit dan bulu enggang. Aksesoris pernyataan ini wajib untuk pengantin atau penari utama yang ingin menjadi pusat perhatian.',
                'stock_total' => 14,
                'image' => 'mahkota-biasa-laki.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Mahkota Laki-Laki Besar',
                'price_per_3days' => 25000,
                'size_info' => 'Besar',
                'included_items' => '-',
                'description' => 'Simbol status dan kehormatan, mahkota besar ini dihiasi dengan detail yang lebih megah untuk penampilan yang lebih istimewa. Cocok digunakan oleh tokoh adat atau dalam upacara penting.',
                'stock_total' => 2,
                'image' => 'mahkota-besar-laki.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Kalung Biasa',
                'price_per_3days' => 10000,
                'size_info' => 'Kecil',
                'included_items' => '-',
                'description' => 'Untaian manik-manik khas Kalimantan dengan motif sederhana yang bisa dipakai untuk mempermanis penampilan kasual maupun formal. Aksesoris wajib untuk menambah nuansa etnik pada busana apa pun.',
                'stock_total' => 22,
                'image' => 'kalung-kecil.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Kalung Besar',
                'price_per_3days' => 15000,
                'size_info' => 'Besar',
                'included_items' => '-',
                'description' => 'Kalung pernyataan (statement necklace) dengan susunan manik-manik yang rumit dan lebar, menutupi dada dengan keindahan motif Dayak. Aksesoris ini menjadi fokus utama yang menyempurnakan kemewahan baju adat Anda.',
                'stock_total' => 4,
                'image' => 'kalung-besar.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Anting',
                'price_per_3days' => 5000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Sepasang anting etnik dengan desain tradisional yang menjuntai, memberikan sentuhan feminin dan budaya yang kental. Pelengkap sempurna untuk membingkai wajah saat mengenakan busana adat.',
                'stock_total' => 13,
                'image' => 'anting.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Gelang Putih',
                'price_per_3days' => 5000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Gelang tangan berwarna putih yang terbuat dari bahan alami atau manik-manik, sering dipakai dalam jumlah banyak untuk efek visual yang menarik. Simbol kesucian dan pelengkap gerak tari yang dinamis.',
                'stock_total' => 20,
                'image' => 'gelang.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Mandau',
                'price_per_3days' => 25000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Senjata tradisional khas Dayak yang legendaris, digunakan sebagai pelengkap kostum pria untuk menambah kesan gagah dan berwibawa. Bilah parang ini merupakan simbol keberanian dan kehormatan.',
                'stock_total' => 1,
                'image' => 'mandau.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Tameng Kecil',
                'price_per_3days' => 20000,
                'size_info' => 'Kecil',
                'included_items' => '-',
                'description' => 'Perisai pelindung berukuran ringkas dengan ukiran motif khas yang artistik, cocok untuk properti tari atau pelengkap kostum anak-anak. Menambah detail otentik pada penampilan prajurit kecil.',
                'stock_total' => 1,
                'image' => 'tameng-kecil.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Tameng Besar',
                'price_per_3days' => 25000,
                'size_info' => 'Besar',
                'included_items' => '-',
                'description' => 'Perisai perang berukuran penuh dengan ukiran detail yang rumit, melambangkan pertahanan yang kuat. Properti wajib untuk tarian perang atau kostum prajurit dewasa yang mengesankan.',
                'stock_total' => 2,
                'image' => 'tameng-besar.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Gong',
                'price_per_3days' => 40000,
                'size_info' => 'All Size',
                'included_items' => '-',
                'description' => 'Alat musik tradisional yang juga berfungsi sebagai properti upacara atau dekorasi yang megah. Kehadirannya menambah nuansa sakral dan kemeriahan dalam setiap acara adat.',
                'stock_total' => 3,
                'image' => 'gong.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Cincin Enggang Asli',
                'price_per_3days' => 30000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Cincin eksklusif yang dibuat dari material asli menyerupai paruh burung enggang, hewan yang disakralkan di Kalimantan. Aksesoris langka ini adalah simbol prestise dan kedekatan dengan alam.',
                'stock_total' => 1,
                'image' => 'cincin-bulu-asli.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Cincin Enggang Sintetis',
                'price_per_3days' => 15000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Replika cincin paruh enggang yang dibuat dengan detail menyerupai aslinya, menawarkan keindahan etnik dengan harga yang lebih terjangkau. Pilihan tepat untuk melengkapi gaya tanpa menggunakan bahan hewan asli.',
                'stock_total' => 1,
                'image' => 'cincin-bulu-sintetis.png',
            ],
            [
                'category_id' => 3,
                'name' => 'Tongkat Gantar',
                'price_per_3days' => 5000,
                'size_info' => '-',
                'included_items' => '-',
                'description' => 'Tongkat panjang yang digunakan dalam tarian Gantar, melambangkan alat penumbuk padi saat menanam. Properti penting yang tidak boleh ketinggalan saat membawakan tarian tradisional ini.',
                'stock_total' => 16,
                'image' => 'tongkat-gantar.png',
            ],
        ];

        foreach ($products as $item) {
            $stockAvailable = $item['stock_total'];
            $status = $stockAvailable > 2 ? 'tersedia' : ($stockAvailable > 0 ? 'sisa' : 'habis');

            Product::create([
                'category_id'     => $item['category_id'],
                'name'            => $item['name'],
                'slug'            => Str::slug($item['name']),
                'description'     => $item['description'],
                'price_per_3days' => $item['price_per_3days'],
                'stock_total'     => $item['stock_total'],
                'stock_available' => $item['stock_total'],
                'status'          => $status,
                'size_info'       => $item['size_info'],
                'included_items'  => $item['included_items'],
                'image'           => $item['image'],
            ]);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin credentials:');
        $this->command->info('Email: adhyaksa209@gmail.com');
        $this->command->info('Password: akuAdmin');

            PaymentMethod::create([
                'code' => 'bri',
                'name' => 'Bank BRI',
                'type' => 'manual',
                'account_number' => '1234-5678-9012-3456',
                'account_name' => 'AMKT SEMAYANG',
                'logo_image' => 'images/payment/bri.png',
                'is_active' => true,
            ]);

            PaymentMethod::create([
                'code' => 'bca',
                'name' => 'Bank BCA',
                'type' => 'qr',
                'qr_image' => 'images/payment/qr-bca.png',
                'logo_image' => 'images/payment/bca.png',
                'is_active' => true,
            ]);

            PaymentMethod::create([
                'code' => 'cod',
                'name' => 'Bayar di Tempat (COD)',
                'type' => 'cash',
                'logo_image' => 'images/payment/cod.png',
                'is_active' => true,
            ]);
    }
}
