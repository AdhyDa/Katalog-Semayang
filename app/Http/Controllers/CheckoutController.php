<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Start database transaction
        DB::beginTransaction();

        try {
            // Base validation rules
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
                $rules['nominal_bayar'] = 'required|in:lunas,dp'; // HANYA untuk umum
            } else {
                // Untuk organisasi
                $rules['nama_instansi'] = 'required|string|max:255';
                $rules['surat_peminjaman'] = 'required|image|mimes:jpg,jpeg,png|max:1024';
                // TIDAK ada validasi nominal_bayar untuk organisasi
            }

            $messages = [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi',
                'nomor_telepon.regex' => 'Nomor telepon harus diawali 08 dan memiliki panjang 10-13 digit',
                'tanggal_ambil.after_or_equal' => 'Tanggal ambil minimal hari ini',
                'durasi_custom.required_if' => 'Durasi custom harus diisi jika memilih "Lainnya"',
                'durasi_custom.min' => 'Durasi custom minimal 6 hari',
                'dokumen_jaminan.max' => 'Ukuran file dokumen jaminan maksimal 1MB',
                'dokumen_jaminan.required' => 'Dokumen jaminan (KTP/KTM/SIM) wajib diupload',
                'bukti_transfer.required' => 'Bukti transfer wajib diupload untuk penyewa umum',
                'bukti_transfer.max' => 'Ukuran file bukti transfer maksimal 1MB',
                'surat_peminjaman.required' => 'Surat peminjaman wajib diupload untuk organisasi',
                'surat_peminjaman.max' => 'Ukuran file surat peminjaman maksimal 1MB',
                'syarat_ketentuan.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
                'nama_instansi.required' => 'Nama instansi wajib diisi untuk kategori Organisasi',
                'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih',
                'nominal_bayar.required' => 'Pilih Bayar Lunas atau Bayar DP',
            ];

            $validated = $request->validate($rules, $messages);

            // Get cart data
            $cart = Session::get('cart', []);

            if (empty($cart)) {
                throw new \Exception('Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');
            }

            // Calculate tanggal kembali
            $durasi = $request->durasi_sewa === 'lainnya'
                ? (int)$request->durasi_custom
                : (int)str_replace(' hari', '', $request->durasi_sewa);

            $tanggalAmbil = new \DateTime($request->tanggal_ambil);
            $tanggalKembali = clone $tanggalAmbil;
            $tanggalKembali->modify("+{$durasi} days");

            // Upload files
            $dokumenJaminanPath = $request->file('dokumen_jaminan')->store('dokumen_jaminan', 'public');

            $buktiTransferPath = null;
            $suratPeminjamanPath = null;

            if ($request->user_type === 'umum' && $request->hasFile('bukti_transfer')) {
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            }

            if ($request->user_type === 'organisasi' && $request->hasFile('surat_peminjaman')) {
                $suratPeminjamanPath = $request->file('surat_peminjaman')->store('surat_peminjaman', 'public');
            }

            // Calculate total
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

            $syaratKetentuan = $request->has('syarat_ketentuan') && $request->syarat_ketentuan ? true : false;

            // Save to database
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
                'metode_pembayaran' => $request->metode_pembayaran ?? null, // null untuk organisasi
                'bukti_transfer' => $buktiTransferPath,
                'surat_peminjaman' => $suratPeminjamanPath,
                'catatan' => $request->catatan,
                'syarat_ketentuan' => $syaratKetentuan,
                'cart_items' => $cart,
                'subtotal' => $subtotal,
                'additional_cost' => $additionalCost,
                'total' => $total,
                'nominal_bayar' => $request->user_type === 'umum' ? $request->nominal_bayar : null, // null untuk organisasi
                'status' => 'pending',
            ]);

            // Log the successful rental creation
            Log::info('Rental created successfully', [
                'rental_id' => $rental->id,
                'user_id' => Auth::id(),
                'user_type' => $request->user_type,
                'total' => $total,
            ]);

            // Commit transaction
            DB::commit();

            // Clear cart after successful checkout
            Session::forget('cart');

            // Redirect to success page with rental info
            return redirect()->route('checkout.success')
                ->with('success', 'Pesanan berhasil diajukan!')
                ->with('rental_id', $rental->id)
                ->with('order_number', $rental->order_number);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback transaction
            DB::rollBack();

            // Validation errors are automatically handled by Laravel
            throw $e;

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();

            // Delete uploaded files if they exist
            if (isset($dokumenJaminanPath)) {
                Storage::disk('public')->delete($dokumenJaminanPath);
            }
            if (isset($buktiTransferPath)) {
                Storage::disk('public')->delete($buktiTransferPath);
            }
            if (isset($suratPeminjamanPath)) {
                Storage::disk('public')->delete($suratPeminjamanPath);
            }

            // Log the error
            Log::error('Checkout failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return with error message
            return back()
                ->withErrors(['error' => 'Gagal memproses pesanan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function success()
    {
        // Check if there's a success message
        if (!session('success')) {
            return redirect()->route('home');
        }

        return view('checkout-success');
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
