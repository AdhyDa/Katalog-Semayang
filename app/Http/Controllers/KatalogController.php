<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter by status
        if ($request->has('status') && $request->status !== 'semua') {
            $this->applyStatusFilter($query, $request->status);
        }

        // Filter by search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(9)->through(function($product) {
            return $this->formatProduct($product);
        });

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

        $query = Product::with('category')->whereHas('category', function($q) use ($kategori) {
            $q->where('slug', $kategori);
        });

        // Filter by status
        if ($request->has('status') && $request->status !== 'semua') {
            $this->applyStatusFilter($query, $request->status);
        }

        // Filter by search
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(9)->through(function($product) {
            return $this->formatProduct($product);
        });

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

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        // Format product for view
        $formattedProduct = $this->formatProduct($product);

        // Add additional details for the product detail view
        $formattedProduct['duration'] = '3 hari';
        $formattedProduct['description'] = $product->description ?: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $formattedProduct['size'] = $product->size_info ?: 'All Size (Uk. S sampai XXL)';
        $formattedProduct['package'] = $product->included_items ?: 'Paket sudah termasuk: Topi bulu, rompi manik, dan rok rumbai.';
        $formattedProduct['images'] = [
            $product->image,
            $product->image, // Placeholder for additional images
            $product->image,
            $product->image,
        ];

        return view('product-detail', ['product' => $formattedProduct]);
    }

    private function applyStatusFilter($query, $status)
    {
        switch ($status) {
            case 'menipis':
                // Stok menipis = stock_available <= 2 dan > 0
                $query->where('stock_available', '>', 0)->where('stock_available', '<=', 2);
                break;
            case 'habis':
                // Habis = stock_available = 0
                $query->where('stock_available', 0);
                break;
        }
    }

    private function formatProduct($product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'kategori' => $product->category->slug ?? 'unknown',
            'harga' => $product->price_per_3days,
            'status' => $product->stock_available > 2 ? 'tersedia' : ($product->stock_available > 0 ? 'terbatas' : 'habis'),
            'stock' => $product->stock_available,
            'sisa' => $product->stock_available,
            'image' => $product->image,
        ];
    }
}
