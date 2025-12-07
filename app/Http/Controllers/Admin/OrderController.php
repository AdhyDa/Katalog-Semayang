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

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
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
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
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
}
