<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::query();
        $query->where('status', 'pending');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->sort_by;
            $sortOrder = $request->sort_order ?? 'asc';

            if ($sortBy === 'name') {
                $query->orderBy('nama_lengkap', $sortOrder);
            } elseif ($sortBy === 'date') {
                $query->orderBy('tanggal_ambil', $sortOrder);
            }
        }

        $orders = $query->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    public function confirm($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->update(['status' => 'approved']);

        return redirect()->route('admin.orders')->with('success', 'Order confirmed successfully.');
    }

    public function reject($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->update(['status' => 'rejected']);

        return redirect()->route('admin.orders')->with('success', 'Order rejected successfully.');
    }

    public function transactions(Request $request)
    {
        $query = Rental::query();

        if ($request->has('status') && !empty($request->status) && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_lengkap', 'like', '%' . $searchTerm . '%');

                // Handle order number search (e.g., "ORD-000001", "000001", or "1")
                if (preg_match('/^ORD-(\d+)$/', $searchTerm, $matches)) {
                    $q->orWhere('id', $matches[1]);
                } elseif (is_numeric($searchTerm)) {
                    $q->orWhere('id', $searchTerm);
                }
            });
        }

        $orders = $query->paginate(10);

        return view('admin.transactions', compact('orders'));
    }

    public function complete($id, Request $request)
    {
        $rental = Rental::findOrFail($id);
        $rental->update(['status' => 'completed']);

        return redirect()->route('admin.transactions')->with('success', 'Transaction completed successfully.');
    }

    public function orderDetail($id)
    {
        $order = Rental::findOrFail($id);
        return view('admin.order-detail', compact('order'));
    }
}
