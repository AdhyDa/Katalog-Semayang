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
        $product = \App\Models\Product::find($id);
        return $product ? $product->stock_available : 0;
    }
}
