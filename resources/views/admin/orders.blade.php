@extends('layouts.admin')

@section('title', 'Pesanan Masuk - Admin Katalog Semayang')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-extrabold text-black tracking-tight" style="font-family: 'Inter', sans-serif;">
        <span style="font-family: serif; font-weight: 800;">Pesanan Masuk</span>
    </h1>
</div>

<div class="flex flex-wrap items-center gap-4 mb-8">
    <a href="{{ route('admin.orders') }}" class="px-8 py-2 bg-[#718355] text-white rounded-full font-bold shadow-sm hover:bg-[#5a6944] transition flex items-center justify-center min-w-[100px]">
        All
    </a>

    <div class="relative group">
        <button class="px-6 py-2 bg-white border-2 border-[#718355] text-gray-700 rounded-full font-bold shadow-sm hover:bg-gray-50 transition flex items-center space-x-2 min-w-[140px] justify-between">
            <span>Nama</span>
            <svg class="w-4 h-4 text-[#718355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 p-3 hidden group-hover:block z-10">
            <form action="{{ route('admin.orders') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pemesan..." class="w-full border-gray-300 rounded-lg text-sm focus:border-[#718355] focus:ring-[#718355]">
            </form>
        </div>
    </div>

    <div class="relative group">
        <button class="px-6 py-2 bg-white border-2 border-[#718355] text-gray-700 rounded-full font-bold shadow-sm hover:bg-gray-50 transition flex items-center space-x-2 min-w-[180px] justify-between">
            <span>Tanggal Sewa</span>
            <svg class="w-4 h-4 text-[#718355]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>
</div>

<div class="bg-white rounded-lg overflow-hidden pb-20"> <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">ID Pesanan</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Pemesan</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Tanggal Sewa</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Total Barang</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Status</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @forelse($orders as $order)
                <tr x-data="{ showModal: false }">
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">#{{ $order->order_number }}</td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">{{ $order->customer_name }}</td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">
                        {{ $order->pickup_date->format('d M') }} - {{ $order->return_date->format('d M Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">{{ $order->orderItems->sum('quantity') }} Paket</td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">
                        Rp {{ number_format($order->payment_amount, 0, ',', '.') }} - {{ strtoupper($order->payment_type ?? 'DP') }}
                    </td>
                    
                    <td class="border border-gray-300 px-4 py-4 text-center">
                        <button @click="showModal = true" class="inline-block bg-[#718355] text-white px-8 py-2 rounded-full text-xs font-bold hover:bg-[#5a6944] transition uppercase tracking-wide cursor-pointer">
                            TINJAU
                        </button>

                        <div x-show="showModal" style="display: none;">
                            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm p-4 md:p-0">
                                
                                <div @click.away="showModal = false" class="relative w-full max-w-5xl bg-white rounded-3xl shadow-2xl p-8 transform transition-all">
                                    
                                    <div class="text-center mb-8 relative">
                                        <h2 class="text-3xl font-extrabold text-black" style="font-family: serif;">Tinjau & Validasi</h2>
                                        <button @click="showModal = false" class="absolute right-0 top-0 text-gray-400 hover:text-gray-600">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                        
                                        <div class="space-y-6 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                                            @foreach($order->orderItems as $item)
                                            <div class="border-b border-gray-200 pb-4 last:border-0">
                                                <h3 class="text-xl font-bold font-serif text-black mb-1">
                                                    {{ $item->product->name }}
                                                    @if($item->quantity > 1) <span class="text-gray-500 text-sm font-sans">(x{{ $item->quantity }})</span> @endif
                                                </h3>
                                                
                                                <div class="mb-2">
                                                    @if($item->product->stock_available >= $item->quantity)
                                                        <span class="text-[#718355] font-bold text-sm">Stok Aman</span>
                                                    @else
                                                        <span class="text-red-500 font-bold text-sm">⚠ Stok Kurang (Sisa {{ $item->product->stock_available }})</span>
                                                    @endif
                                                </div>

                                                <div class="text-gray-600 text-sm font-medium space-y-1">
                                                    <p>Tanggal Sewa: {{ $order->pickup_date->format('d M') }} - {{ $order->return_date->format('d M Y') }}</p>
                                                    <p>Durasi Sewa: {{ $order->duration_days }} Hari</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-gray-700 font-bold mb-1 ml-1">Nama Lengkap</label>
                                                <div class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium text-gray-900">
                                                    {{ $order->customer_name }}
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-700 font-bold mb-1 ml-1">Nomor Handphone</label>
                                                <div class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium text-gray-900">
                                                    {{ $order->customer_phone }}
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-700 font-bold mb-1 ml-1">Nama Instansi</label>
                                                <div class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium text-gray-900">
                                                    {{ $order->customer_institution ?? '-' }}
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4 mt-2">
                                                <div>
                                                    <label class="block text-gray-700 font-bold mb-1 ml-1">Jaminan</label>
                                                    @if($order->id_card_photo)
                                                    <a href="{{ Storage::url($order->id_card_photo) }}" target="_blank" class="block overflow-hidden rounded-xl border-2 border-gray-300 hover:border-black transition">
                                                        <img src="{{ Storage::url($order->id_card_photo) }}" class="w-full h-24 object-cover">
                                                    </a>
                                                    @else
                                                    <div class="h-24 bg-gray-100 rounded-xl border-2 border-gray-300 flex items-center justify-center text-gray-400 text-xs text-center">Tidak ada</div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <label class="block text-gray-700 font-bold mb-1 ml-1">Bukti Pembayaran</label>
                                                    @if($order->payment_proof)
                                                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="block overflow-hidden rounded-xl border-2 border-gray-300 hover:border-black transition">
                                                        <img src="{{ Storage::url($order->payment_proof) }}" class="w-full h-24 object-cover">
                                                    </a>
                                                    @else
                                                    <div class="h-24 bg-gray-100 rounded-xl border-2 border-gray-300 flex items-center justify-center text-gray-400 text-xs text-center">Tidak ada</div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-gray-700 font-bold mb-1 ml-1">Catatan</label>
                                                <div class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium text-gray-900 min-h-[80px]">
                                                    {{ $order->notes ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-8 flex gap-4">
                                        <form action="{{ route('admin.order.reject', $order->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Yakin tolak pesanan ini?')" class="w-full bg-[#FF0000] text-white font-extrabold text-lg py-4 rounded-xl hover:bg-red-700 transition shadow-lg">
                                                TOLAK
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.order.confirm', $order->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-[#0066FF] text-white font-extrabold text-lg py-4 rounded-xl hover:bg-blue-700 transition shadow-lg">
                                                KONFIRMASI
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 px-6 py-12 text-center text-gray-500">
                        <p class="text-lg font-semibold">Tidak ada pesanan</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection