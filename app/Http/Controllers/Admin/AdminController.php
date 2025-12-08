<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Rental;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get dashboard statistics
        $pendingOrders = Rental::where('status', 'pending')->count();
        $activeOrders = Rental::where('status', 'active')->count();
        $overdueOrders = Rental::where('status', 'overdue')->count();

        // For today returns, we need to check rentals where return_date is today
        $today = now()->toDateString();
        $todayReturns = Rental::where('return_date', $today)->where('status', 'active')->count();

        return view('admin.dashboard', compact('pendingOrders', 'activeOrders', 'overdueOrders', 'todayReturns'));
    }

    public function showChangePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah!']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function customers()
    {
        $pelanggan = User::where('role', '!=', 'admin')
            ->withCount(['rentals as orders_count'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.customers', compact('pelanggan'));
    }
}
