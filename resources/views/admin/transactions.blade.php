@extends('layouts.admin')

@section('title', 'Riwayat & Manajemen Transaksi - Admin Katalog Semayang')

@section('content')
<div class="mb-8">
    <h1 class="text-4xl font-extrabold text-black tracking-tight" style="font-family: 'Inter', sans-serif;">
        <span style="font-family: serif; font-weight: 800;">Riwayat & Manajemen Transaksi</span>
    </h1>
</div>

<div class="flex flex-col space-y-4 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.transactions') }}"
                class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ !request('status') || request('status') == 'All' ? 'bg-[#718355] text-white' : 'bg-white text-gray-600 border-2 border-[#718355] hover:bg-gray-50' }}">
                All
            </a>
            <a href="{{ route('admin.transactions', ['status' => 'active']) }}"
                class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ request('status') == 'active' ? 'bg-[#718355] text-white' : 'bg-white text-gray-600 border-2 border-[#718355] hover:bg-gray-50' }}">
                Sedang Disewa
            </a>
            <a href="{{ route('admin.transactions', ['status' => 'completed']) }}"
                class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ request('status') == 'completed' ? 'bg-[#718355] text-white' : 'bg-white text-gray-600 border-2 border-[#718355] hover:bg-gray-50' }}">
                Selesai
            </a>
            <a href="{{ route('admin.transactions', ['status' => 'cancelled']) }}"
                class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ request('status') == 'cancelled' ? 'bg-[#718355] text-white' : 'bg-white text-gray-600 border-2 border-[#718355] hover:bg-gray-50' }}">
                Batal
            </a>
        </div>

        <form action="{{ route('admin.transactions') }}" method="GET" class="w-full md:w-auto">
            @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama baju adat"
                        class="w-full md:w-80 pl-4 pr-10 py-2 rounded-full border-2 border-[#718355] focus:outline-none focus:ring-2 focus:ring-[#718355] text-gray-600">
                <button type="submit" class="absolute right-3 top-2.5 text-[#718355]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>
        </form>
    </div>

    <div class="flex justify-start">
        <button class="flex items-center space-x-2 px-6 py-2 bg-white border-2 border-[#718355] rounded-full text-gray-700 font-bold text-sm shadow-sm">
            <span>22 Nov 2025 - 24 Nov 2025</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
    </div>
</div>

<div class="bg-white rounded-lg overflow-hidden shadow-sm pb-20">
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">ID Pesanan</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Pemesan</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Tanggal Sewa</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600 w-1/4">Barang</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Status</th>
                <th class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @forelse($orders as $order)
                <tr x-data="{ showReturnModal: false }">
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-600">#{{ $order->order_number }}</td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">{{ $order->customer_name }}</td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">
                        {{ $order->pickup_date->format('d M') }} - {{ $order->return_date->format('d M Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-800">
                        @if($order->orderItems->count() > 0)
                            <div class="leading-tight">{{ $order->orderItems->first()->product->name }}</div>
                            @if($order->orderItems->count() > 1)
                                <div class="text-xs text-gray-500 mt-1 font-normal">+ {{ $order->orderItems->count() - 1 }} lainnya</div>
                            @endif
                        @else - @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-4 text-center text-sm font-bold">
                        @if($order->status == 'active') <span class="text-[#718355]">Sedang Disewa</span>
                        @elseif($order->status == 'completed') <span class="text-blue-500">Selesai</span>
                        @elseif($order->status == 'cancelled') <span class="text-red-500">Batal</span>
                        @else <span class="text-yellow-600">{{ ucfirst($order->status) }}</span> @endif
                    </td>

                    <td class="border border-gray-300 px-4 py-4 text-center">
                        @if($order->status == 'active')
                            <button @click="showReturnModal = true" class="bg-[#718355] hover:bg-[#5a6944] text-white px-4 py-2 rounded-md text-xs font-bold transition">
                                Terima Pengembalian
                            </button>

                            <div x-show="showReturnModal" style="display: none;">
                                <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm p-4">

                                    <div @click.away="showReturnModal = false" class="relative w-full max-w-4xl bg-white rounded-[2rem] shadow-2xl p-8">

                                        <form action="{{ route('admin.order.complete', $order->id) }}" method="POST">
                                            @csrf

                                            <h2 class="text-2xl font-extrabold font-serif mb-6 text-left">Cek Keterlambatan</h2>

                                            <div class="flex flex-col md:flex-row gap-6 mb-8">
                                                <div class="w-full md:w-1/4">
                                                    <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden border-2 border-gray-300 relative">
                                                        <svg class="absolute inset-0 w-full h-full text-gray-400 p-8" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <div class="space-y-4">
                                                        <div>
                                                            <label class="block text-gray-700 font-medium mb-1 ml-1 text-sm">Nama Lengkap</label>
                                                            <div class="bg-[#B6C99B] text-gray-800 px-4 py-3 rounded-xl font-bold border border-[#718355]/30">
                                                                {{ $order->customer_name }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-gray-700 font-medium mb-1 ml-1 text-sm">ID Pesanan</label>
                                                            <div class="bg-[#B6C99B] text-gray-800 px-4 py-3 rounded-xl font-bold border border-[#718355]/30">
                                                                #{{ $order->order_number }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <div>
                                                            <label class="block text-gray-700 font-medium mb-1 ml-1 text-sm">Jadwal Kembali</label>
                                                            <div class="bg-[#B6C99B] text-gray-800 px-4 py-3 rounded-xl font-bold border border-[#718355]/30">
                                                                {{ $order->return_date->format('d F Y') }}
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-gray-700 font-medium mb-1 ml-1 text-sm">Dikembalikan pada</label>
                                                            <input type="date" name="actual_return_date" value="{{ date('Y-m-d') }}"
                                                                    class="w-full bg-white border-2 border-black text-gray-900 px-4 py-3 rounded-xl font-bold focus:ring-[#718355] focus:border-[#718355]">
                                                            <div class="text-right text-[#718355] text-sm font-bold mt-1">Status: Tepat Waktu</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h2 class="text-2xl font-extrabold font-serif mb-4 text-left">Cek Fisik & Denda</h2>

                                            <div class="space-y-4 mb-6">
                                                <div>
                                                    <label class="block text-gray-800 font-medium mb-2 text-sm">Apakah ada kerusakan/kehilangan?</label>
                                                    <select name="has_damage" class="w-full md:w-2/3 border-2 border-black rounded-xl px-4 py-3 font-medium bg-white focus:outline-none">
                                                        <option value="0">Tidak Ada</option>
                                                        <option value="1">Ada</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="block text-gray-800 font-medium mb-2 text-sm">Keterangan (jika ada)</label>
                                                    <input type="text" name="damage_note" class="w-full md:w-2/3 border-2 border-black rounded-xl px-4 py-3 font-medium bg-white focus:outline-none">
                                                </div>
                                            </div>

                                            <div class="border-t-2 border-gray-100 pt-4 mb-6">
                                                <h3 class="font-bold text-gray-700 mb-2">Rincian Denda</h3>
                                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                                    <span>Sisa Biaya Sewa</span>
                                                    <span class="font-bold">Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                                    <span>Denda Keterlambatan</span>
                                                    <span class="font-bold">Rp 0</span> </div>
                                                <div class="flex justify-between text-lg font-extrabold text-black border-t border-gray-200 pt-2">
                                                    <span>Total yang Harus Dibayar</span>
                                                    <span>Rp {{ number_format($order->remaining_amount, 0, ',', '.') }}</span>
                                                </div>
                                            </div>

                                            <div class="mb-8">
                                                <label class="flex items-center space-x-3 cursor-pointer">
                                                    <input type="checkbox" required class="w-6 h-6 rounded border-gray-300 text-[#718355] focus:ring-[#718355]">
                                                    <span class="text-sm font-bold text-gray-800">Saya sudah menerima uang & mengembalikan KTP Penyewa.</span>
                                                </label>
                                            </div>

                                            <div class="flex gap-4">
                                                <button type="button" @click="showReturnModal = false" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-4 rounded-xl font-bold text-lg transition">
                                                    Batal
                                                </button>
                                                <button type="submit" class="flex-1 bg-[#718355] hover:bg-[#5a6944] text-white py-4 rounded-xl font-bold text-lg transition">
                                                    Selesaikan Transaksi
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            @else
                            <a href="{{ route('admin.orders', ['search' => $order->order_number]) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md text-xs font-bold transition inline-block">
                                Lihat Detail
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 px-6 py-12 text-center text-gray-500">
                        <p class="text-lg font-semibold">Tidak ada transaksi ditemukan</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->appends(request()->query())->links() }}
</div>
@endsection
