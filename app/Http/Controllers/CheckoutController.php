<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong!');
        }

        $total = $this->calculateTotal($cart);

        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'user_type' => 'required|in:umum,organisasi',
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'regex:/^08[0-9]{8,11}$/'],
            'tanggal_ambil' => 'required|date|after_or_equal:today',
            'durasi_sewa' => 'required',
            'durasi_custom' => 'required_if:durasi_sewa,lainnya|nullable|integer|min:6|max:30',
            'dokumen_jaminan' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'catatan' => 'nullable|string|max:500',
            'syarat_ketentuan' => 'required|accepted',
        ];

        // Conditional validation based on user type
        if ($request->user_type === 'umum') {
            $rules['nama_instansi'] = 'nullable|string|max:255';
            $rules['metode_pembayaran'] = 'required|in:bri,bca,dana';
            $rules['bukti_transfer'] = 'required|image|mimes:jpg,jpeg,png|max:1024';
            $rules['nominal_bayar'] = 'required|in:lunas,dp';
        } else {
            $rules['nama_instansi'] = 'required|string|max:255';
            $rules['surat_peminjaman'] = 'required|image|mimes:jpg,jpeg,png|max:1024';
        }

        $messages = [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'nomor_telepon.regex' => 'Nomor telepon harus diawali 08 dan memiliki panjang 10-13 digit',
            'tanggal_ambil.after_or_equal' => 'Tanggal ambil minimal hari ini',
            'durasi_custom.required_if' => 'Durasi custom harus diisi jika memilih "Lainnya"',
            'durasi_custom.min' => 'Durasi custom minimal 6 hari',
            'dokumen_jaminan.max' => 'Ukuran file maksimal 1MB',
            'bukti_transfer.required' => 'Bukti transfer wajib diupload untuk penyewa umum',
            'surat_peminjaman.required' => 'Surat peminjaman wajib diupload untuk organisasi',
            'syarat_ketentuan.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
            'nama_instansi.required' => 'Nama instansi wajib diisi untuk kategori Organisasi',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih',
            'nominal_bayar.required' => 'Nominal bayar wajib dipilih',
        ];

        $validated = $request->validate($rules, $messages);

        // Calculate tanggal kembali
        $durasi = $request->durasi_sewa === 'lainnya'
            ? (int)$request->durasi_custom
            : (int)str_replace(' hari', '', $request->durasi_sewa);

        $tanggalAmbil = new \DateTime($request->tanggal_ambil);
        $tanggalKembali = clone $tanggalAmbil;
        $tanggalKembali->modify("+{$durasi} days");

        // Upload files
        try {
            $dokumenJaminanPath = $request->file('dokumen_jaminan')->store('dokumen_jaminan', 'public');

            $buktiTransferPath = null;
            $suratPeminjamanPath = null;

            if ($request->user_type === 'umum' && $request->hasFile('bukti_transfer')) {
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            }

            if ($request->user_type === 'organisasi' && $request->hasFile('surat_peminjaman')) {
                $suratPeminjamanPath = $request->file('surat_peminjaman')->store('surat_peminjaman', 'public');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['upload' => 'Gagal mengupload file. Silakan coba lagi.'])->withInput();
        }

        // Calculate total
        $cart = Session::get('cart', []);
        $subtotal = $this->calculateTotal($cart);
        $itemCount = array_sum(array_column($cart, 'quantity'));

        // Calculate additional cost for extra days
        $additionalCost = 0;
        if ($request->user_type === 'umum') {
            if ($durasi === 4) {
                $additionalCost = 5000 * $itemCount;
            } elseif ($durasi === 5) {
                $additionalCost = 10000 * $itemCount;
            } elseif ($durasi > 5) {
                $additionalCost = (10000 + ($durasi - 5) * 5000) * $itemCount;
            }
        }

        $total = $request->user_type === 'organisasi' ? 0 : ($subtotal + $additionalCost);

        // Save to database
        try {
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'user_type' => $request->user_type,
                'nama_lengkap' => $request->nama_lengkap,
                'nomor_telepon' => $request->nomor_telepon,
                'nama_instansi' => $request->nama_instansi,
                'tanggal_ambil' => $request->tanggal_ambil,
                'durasi_sewa' => $request->durasi_sewa,
                'durasi_custom' => $request->durasi_custom,
                'tanggal_kembali' => $tanggalKembali->format('Y-m-d'),
                'dokumen_jaminan' => $dokumenJaminanPath,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_transfer' => $buktiTransferPath,
                'surat_peminjaman' => $suratPeminjamanPath,
                'catatan' => $request->catatan,
                'syarat_ketentuan' => $request->syarat_ketentuan,
                'cart_items' => $cart,
                'subtotal' => $subtotal,
                'additional_cost' => $additionalCost,
                'total' => $total,
                'nominal_bayar' => $request->nominal_bayar ?? null,
                'status' => 'pending',
            ]);

            // Clear cart
            Session::forget('cart');

            return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil diajukan! Nomor pesanan: #' . str_pad($rental->id, 6, '0', STR_PAD_LEFT));
        } catch (\Exception $e) {
            // If database save fails, delete uploaded files
            if (isset($dokumenJaminanPath)) Storage::disk('public')->delete($dokumenJaminanPath);
            if (isset($buktiTransferPath)) Storage::disk('public')->delete($buktiTransferPath);
            if (isset($suratPeminjamanPath)) Storage::disk('public')->delete($suratPeminjamanPath);

            return back()->withErrors(['error' => 'Gagal menyimpan pesanan. Silakan coba lagi.'])->withInput();
        }
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
