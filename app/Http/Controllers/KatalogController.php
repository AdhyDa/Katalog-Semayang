<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        // Get all products
        $products = $this->getAllProducts();

        // Filter by status
        if ($request->has('status') && $request->status !== 'semua') {
            $products = $this->filterByStatus($products, $request->status);
        }

        // Filter by search
        if ($request->has('search') && !empty($request->search)) {
            $products = $this->searchProducts($products, $request->search);
        }

        return view('katalog', [
            'products' => $products,
            'kategori' => 'all'
        ]);
    }

    public function kategori($kategori, Request $request)
    {
        // Validasi kategori
        $validKategori = ['pria', 'wanita', 'aksesoris'];

        if (!in_array($kategori, $validKategori)) {
            abort(404);
        }

        // Filter produk berdasarkan kategori
        $products = $this->getProductsByKategori($kategori);

        // Filter by status
        if ($request->has('status') && $request->status !== 'semua') {
            $products = $this->filterByStatus($products, $request->status);
        }

        // Filter by search
        if ($request->has('search') && !empty($request->search)) {
            $products = $this->searchProducts($products, $request->search);
        }

        return view('katalog', [
            'products' => $products,
            'kategori' => $kategori
        ]);
    }

    // Method untuk backward compatibility
    public function pria(Request $request)
    {
        return $this->kategori('pria', $request);
    }

    public function wanita(Request $request)
    {
        return $this->kategori('wanita', $request);
    }

    public function aksesoris(Request $request)
    {
        return $this->kategori('aksesoris', $request);
    }

    // Private helper methods
    private function getAllProducts()
    {
        // Sample data - in real app, fetch from database
        return [
            [
                'id' => 1,
                'name' => 'Set Baju Adat Wanita (Merah)',
                'kategori' => 'wanita',
                'harga' => 55000,
                'status' => 'tersedia',
                'stock' => 5,
                'image' => 'baju-wanita-merah.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Baju Adat Pria (Hitam)',
                'kategori' => 'pria',
                'harga' => 55000,
                'status' => 'terbatas',
                'sisa' => 1,
                'stock' => 1,
                'image' => 'baju-pria-hitam.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Cincin Enggang Asli',
                'kategori' => 'aksesoris',
                'harga' => 55000,
                'status' => 'habis',
                'stock' => 0,
                'image' => 'cincin-enggang.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Set Baju Adat Wanita (Kuning)',
                'kategori' => 'wanita',
                'harga' => 60000,
                'status' => 'tersedia',
                'stock' => 3,
                'image' => 'baju-wanita-kuning.jpg'
            ],
            [
                'id' => 5,
                'name' => 'Baju Adat Pria (Merah)',
                'kategori' => 'pria',
                'harga' => 55000,
                'status' => 'terbatas',
                'sisa' => 2,
                'stock' => 2,
                'image' => 'baju-pria-merah.jpg'
            ],
            [
                'id' => 6,
                'name' => 'Mandau (Pedang Tradisional)',
                'kategori' => 'aksesoris',
                'harga' => 75000,
                'status' => 'tersedia',
                'stock' => 4,
                'image' => 'mandau.jpg'
            ],
        ];
    }

    public function show($id)
    {
        // Find product by id from the products array
        $allProducts = $this->getAllProducts();
        $product = null;

        foreach ($allProducts as $p) {
            if ($p['id'] == $id) {
                $product = $p;
                break;
            }
        }

        if (!$product) {
            abort(404);
        }

        // Add additional details for the product detail view
        $product['duration'] = '3 hari';
        $product['description'] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $product['size'] = 'All Size (Uk. S sampai XXL)';
        $product['package'] = 'Paket sudah termasuk: Topi bulu, rompi manik, dan rok rumbai.';
        $product['images'] = [
            $product['image'],
            $product['image'], // Placeholder for additional images
            $product['image'],
            $product['image'],
        ];

        return view('product-detail', compact('product'));
    }

    private function getProductsByKategori($kategori)
    {
        $allProducts = $this->getAllProducts();

        return array_filter($allProducts, function($product) use ($kategori) {
            return $product['kategori'] === $kategori;
        });
    }

    private function filterByStatus($products, $status)
    {
        return array_filter($products, function($product) use ($status) {
            if ($status === 'menipis') {
                // Stok menipis = status terbatas atau stock <= 2
                return $product['status'] === 'terbatas' || ($product['stock'] > 0 && $product['stock'] <= 2);
            } elseif ($status === 'habis') {
                // Habis = status habis atau stock = 0
                return $product['status'] === 'habis' || $product['stock'] === 0;
            }
            return true;
        });
    }

    private function searchProducts($products, $search)
    {
        $search = strtolower(trim($search));

        return array_filter($products, function($product) use ($search) {
            $name = strtolower($product['name']);
            return strpos($name, $search) !== false;
        });
    }
}
