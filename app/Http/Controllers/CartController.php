<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        // Add stock to cart items
        foreach ($cart as $id => &$item) {
            $item['stock'] = $this->getProductStock($id);
        }
        $total = $this->calculateTotal($cart);

        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'duration' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Session::get('cart', []);
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $quantity,
                'image' => $request->image,
                'duration' => $request->duration,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false, 'message' => 'Item not found']);
        }

        $stock = $this->getProductStock($id);
        $quantity = min($stock, max(1, (int)$request->quantity));

        $cart[$id]['quantity'] = $quantity;
        Session::put('cart', $cart);

        // selalu return JSON
        return response()->json([
            'success' => true,
            'quantity' => $quantity,
            'total' => $this->calculateTotal($cart)
        ]);
    }


    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    private function getProductStock($id)
    {
        // Get stock from products array
        $products = $this->getAllProducts();
        foreach ($products as $product) {
            if ($product['id'] == $id) {
                return $product['stock'];
            }
        }
        return 0; // Default if not found
    }

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
}
