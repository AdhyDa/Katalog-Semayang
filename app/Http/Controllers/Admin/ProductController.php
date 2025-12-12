<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search by name
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            switch ($request->status) {
                case 'tersedia':
                    $query->where('stock_available', '>', 2);
                    break;
                case 'sisa':
                    $query->where('stock_available', '>', 0)->where('stock_available', '<=', 2);
                    break;
                case 'habis':
                    $query->where('stock_available', 0);
                    break;
            }
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('admin.products', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product-form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_3days' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock_total' => 'required|integer|min:0',
            'description' => 'required|string',
            'size_info' => 'nullable|string|max:255',
            'included_items' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Ensure size_info is always included
        $data['size_info'] = $request->input('size_info', '');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $data['stock_available'] = $request->stock_total;

        // Generate slug from name
        $data['slug'] = Str::slug($request->name);

        // Process included_items as array
        if ($request->included_items) {
            $data['included_items'] = array_map('trim', explode(',', $request->included_items));
        } else {
            $data['included_items'] = [];
        }

        // Set status based on stock_available
        if ($data['stock_available'] > 2) {
            $data['status'] = 'tersedia';
        } elseif ($data['stock_available'] > 0) {
            $data['status'] = 'sisa';
        } else {
            $data['status'] = 'habis';
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('admin.product-detail', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product-form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_3days' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'stock_total' => 'required|integer|min:0',
            'description' => 'required|string',
            'size_info' => 'nullable|string|max:255',
            'included_items' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Ensure size_info is always included
        $data['size_info'] = $request->input('size_info', '');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        $data['stock_available'] = $request->stock_total;

        // Process included_items as array
        if ($request->included_items) {
            $data['included_items'] = array_map('trim', explode(',', $request->included_items));
        } else {
            $data['included_items'] = [];
        }

        // Set status based on stock_available
        if ($data['stock_available'] > 2) {
            $data['status'] = 'tersedia';
        } elseif ($data['stock_available'] > 0) {
            $data['status'] = 'sisa';
        } else {
            $data['status'] = 'habis';
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
