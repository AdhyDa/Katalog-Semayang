<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Statistik produk
        $totalProducts = Product::count();
        $availableProducts = Product::where('stock_available', '>', 0)->count();
        $outOfStockProducts = Product::where('stock_available', 0)->count();

        // Statistik rental
        $totalRentals = Rental::count();
        $pendingRentals = Rental::where('status', 'pending')->count();
        $approvedRentals = Rental::where('status', 'approved')->count();
        $completedRentals = Rental::where('status', 'completed')->count();

        // Statistik pengguna
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $customerUsers = User::where('role', 'customer')->count();

        // Produk terlaris (berdasarkan rental)
        $popularProducts = Product::withCount('rentals')
            ->orderBy('rentals_count', 'desc')
            ->take(5)
            ->get();

        // Kategori dengan produk terbanyak
        $categoriesWithProducts = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->get();

        return view('admin.report', compact(
            'totalProducts',
            'availableProducts',
            'outOfStockProducts',
            'totalRentals',
            'pendingRentals',
            'approvedRentals',
            'completedRentals',
            'totalUsers',
            'adminUsers',
            'customerUsers',
            'popularProducts',
            'categoriesWithProducts'
        ));
    }
}
