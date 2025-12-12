<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('admin.payment-methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment-methods.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:payment_methods,code',
            'name' => 'required|string',
            'type' => 'required|in:manual,qr,cash',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        // Default is_active true jika tidak ada input (atau handle checkbox)
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Upload Logo
        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $filename = 'logo_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/payment'), $filename);
            $data['logo_image'] = 'images/payment/' . $filename;
        }

        // Upload QR
        if ($request->hasFile('qr_image')) {
            $file = $request->file('qr_image');
            $filename = 'qr_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/payment'), $filename);
            $data['qr_image'] = 'images/payment/' . $filename;
        }

        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $method = PaymentMethod::findOrFail($id);
        return view('admin.payment-methods.form', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = PaymentMethod::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:payment_methods,code,' . $id,
            'name' => 'required|string',
            'type' => 'required|in:manual,qr,cash',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Update Logo
        if ($request->hasFile('logo_image')) {
            // Hapus file lama
            if ($method->logo_image && File::exists(public_path($method->logo_image))) {
                File::delete(public_path($method->logo_image));
            }
            $file = $request->file('logo_image');
            $filename = 'logo_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/payment'), $filename);
            $data['logo_image'] = 'images/payment/' . $filename;
        }

        // Update QR
        if ($request->hasFile('qr_image')) {
            // Hapus file lama
            if ($method->qr_image && File::exists(public_path($method->qr_image))) {
                File::delete(public_path($method->qr_image));
            }
            $file = $request->file('qr_image');
            $filename = 'qr_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/payment'), $filename);
            $data['qr_image'] = 'images/payment/' . $filename;
        }

        $method->update($data);

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $method = PaymentMethod::findOrFail($id);

        // Hapus gambar jika ada
        if ($method->logo_image && File::exists(public_path($method->logo_image))) {
            File::delete(public_path($method->logo_image));
        }
        if ($method->qr_image && File::exists(public_path($method->qr_image))) {
            File::delete(public_path($method->qr_image));
        }

        $method->delete();

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}
