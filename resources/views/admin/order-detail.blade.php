@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin Katalog Semayang')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <a href="{{ route('admin.orders') }}" class="text-red-600 hover:text-red-700 text-sm mb-2 inline-block">
            ← Kembali ke Daftar Pesanan
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan {{ $order->order_number }}</h1>
    </div>

    <div>
        @if($order->status == 'pending')
            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Menunggu Konfirmasi</span>
        @elseif($order->status == 'confirmed')
            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">Dikonfirmasi</span>
        @elseif($order->status == 'active')
            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Sedang Disewa</span>
        @elseif($order->status == 'completed')
            <span class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-semibold">Selesai</span>
        @else
            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Dibatalkan</span>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Customer Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Informasi Penyewa</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600">Nama Lengkap</label>
                    <p class="font-semibold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Nomor Handphone</label>
                    <p class="font-semibold">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Nama Instansi</label>
                    <p class="font-semibold">{{ $order->customer_institution ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm text-gray-600">Email</label>
                    <p class="font-semibold">{{ $order->user->email }}</p>
                </div>
            </div>

            @if($order->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <label class="text-sm text-gray-600">Catatan</label>
                    <p class="text-gray-900">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Barang yang Disewa</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                        @if($item->product->image)
                            <img src="{{ Storage::url($item->product->image) }}"
                                 alt="{{ $item->product->name }}"
                                 class="w-20 h-20 object-cover rounded">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded"></div>
                        @endif

                        <div class="flex-1">
                            <h3 class="font-semibold">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600">Durasi Sewa: {{ $order->duration_days }} Hari</p>
                            <p class="text-sm text-gray-600">Tanggal Sewa: {{ $order->pickup_date->format('d M Y') }} - {{ $order->return_date->format('d M Y') }}</p>
                            <p class="text-sm mt-1">
                                @if($item->product->stock_available >= $item->quantity)
                                    <span class="text-green-600 font-semibold">✓ Stok Aman</span>
                                @else
                                    <span class="text-red-600 font-semibold">⚠ Stok Tidak Cukup (Tersedia: {{ $item->product->stock_available }})</span>
                                @endif
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="font-bold text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Documents -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Dokumen</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600 mb-2 block">Jaminan (KTP/KTM/SIM)</label>
                    <a href="{{ Storage::url($order->id_card_photo) }}" target="_blank" class="block">
                        <img src="{{ Storage::url($order->id_card_photo) }}" alt="ID Card" class="w-full rounded-lg border border-gray-200 hover:border-red-500 transition">
                    </a>
                </div>
                <div>
                    <label class="text-sm text-gray-600 mb-2 block">Bukti Pembayaran</label>
                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="block">
                        <img src="{{ Storage::url($order->payment_proof) }}" alt="Payment Proof" class="w-full rounded-lg border border-gray-200 hover:border-red-500 transition">
                    </a>
                </div>
            </div>
        </div>

        <!-- Actions -->
        @if($order->status == 'pending')
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Tindakan</h2>
                <div class="flex space-x-4">
                    <form action="{{ route('admin.order.confirm', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-md font-semibold hover:bg-green-700 transition">
                            ✓ KONFIRMASI
                        </button>
                    </form>
                    <form action="{{ route('admin.order.reject', $order->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menolak pesanan ini?')">
                        @csrf
                        <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-md font-semibold hover:bg-red-700 transition">
                            ✕ TOLAK
                        </button>
                    </form>
                </div>
            </div>
        @elseif($order->status == 'confirmed')
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Tindakan</h2>
                <form action="{{ route('admin.order.activate', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 transition">
                        🚀 AKTIFKAN PESANAN (Customer Mengambil)
                    </button>
                </form>
            </div>
        @elseif($order->status == 'active')
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Selesaikan Transaksi</h2>
                <form action="{{ route('admin.order.complete', $order->id) }}" method="POST">
                    @csrf

                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengembalian Aktual</label>
                            <input type="date" name="actual_return_date" value="{{ date('Y-m-d') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                        </div>

                        <div>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="has_damage" value="1" onchange="toggleDamageNotes(this)"
                                    class="w-4 h-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <span class="text-sm font-medium text-gray-700">Ada kerusakan/kehilangan</span>
                            </label>
                        </div>

                        <div id="damage_notes_field" class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Kerusakan</label>
                            <textarea name="damage_notes" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-md font-semibold hover:bg-green-700 transition">
                        ✓ SELESAIKAN TRANSAKSI
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Payment Summary -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Ringkasan Pembayaran</h2>

            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>

                @if($order->additional_duration_fee > 0)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Biaya Tambahan Durasi</span>
                    <span class="font-semibold">Rp {{ number_format($order->additional_duration_fee, 0, ',', '.') }}</span>
                </div>
                @endif

                <div class="flex justify-between text-sm pt-3 border-t border-gray-200">
                    <span class="text-gray-600">Total</span>
                    <span class="font-bold text-lg text-red-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>

                <div class="pt-3 border-t border-gray-200">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600">Dibayar ({{ $order->payment_type == 'dp' ? 'DP' : 'Lunas' }})</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($order->payment_amount, 0, ',', '.') }}</span>
                    </div>

                    @if($order->remaining_amount > 0)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Sisa Bayar</span>
                        <span class="font-semibold text-orange-600">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif

                    @if($order->late_fee > 0)
                    <div class="flex justify-between text-sm mt-2">
                        <span class="text-gray-600">Denda Keterlambatan</span>
                        <span class="font-semibold text-red-600">Rp {{ number_format($order->late_fee, 0, ',', '.') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold mb-4">Timeline</h2>

            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-600">Tanggal Pemesanan</p>
                    <p class="font-semibold">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Jadwal Pengambilan</p>
                    <p class="font-semibold">{{ $order->pickup_date->format('d M Y') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Jadwal Pengembalian</p>
                    <p class="font-semibold">{{ $order->return_date->format('d M Y') }}</p>
                </div>

                @if($order->actual_return_date)
                <div>
                    <p class="text-sm text-gray-600">Tanggal Pengembalian Aktual</p>
                    <p class="font-semibold">{{ $order->actual_return_date->format('d M Y') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleDamageNotes(checkbox) {
        const field = document.getElementById('damage_notes_field');
        if (checkbox.checked) {
            field.classList.remove('hidden');
        } else {
            field.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
