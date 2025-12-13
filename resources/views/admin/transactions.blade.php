@extends('layouts.admin')

@section('title', 'Riwayat & Manajemen Transaksi - Admin Katalog Semayang')

@section('content')
<div x-data="{ showModal: false, selectedOrder: null }">

    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-black tracking-tight" style="font-family: 'Inter', sans-serif;">
            <span style="font-family: serif; font-weight: 800;">Riwayat & Manajemen Transaksi</span>
        </h1>
    </div>

    <div class="flex flex-col space-y-4 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.transactions') }}"
                    class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ !request('status') || request('status') == 'All' ? 'bg-[#7e9a3e] text-white' : 'bg-white text-gray-600 border-2 border-[#7e9a3e] hover:bg-[#1f2b03] hover:border-[#1f2b03] hover:text-white ' }}">
                    All
                </a>
                <a href="{{ route('admin.transactions', ['status' => 'active']) }}"
                    class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ request('status') == 'active' ? 'bg-[#7e9a3e] text-white' : 'bg-white text-gray-600 border-2 border-[#7e9a3e] hover:bg-[#1f2b03] hover:border-[#1f2b03] hover:text-white ' }}">
                    Sedang Disewa
                </a>
                <a href="{{ route('admin.transactions', ['status' => 'completed']) }}"
                    class="px-6 py-2 rounded-full font-bold text-sm transition shadow-sm {{ request('status') == 'completed' ? 'bg-[#7e9a3e] text-white' : 'bg-white text-gray-600 border-2 border-[#7e9a3e] hover:bg-[#1f2b03] hover:border-[#1f2b03] hover:text-white ' }}">
                    Selesai
                </a>
            </div>

            <form method="GET" action="{{ route('admin.transactions') }}" class="w-full md:w-auto">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari ID Pesanan / Nama..."
                        class="w-full md:w-64 pl-10 pr-4 py-2 rounded-full border-2 border-gray-300 focus:border-[#7e9a3e] focus:outline-none">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border-2 border-gray-200 overflow-hidden shadow-sm mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-900">
                    <tr>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider">ID Pesanan</th>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider">Penyewa</th>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider">Tgl Sewa</th>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 font-extrabold text-sm uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-[#7e9a3e]">#{{ $order->order_number }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $order->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500">{{ $order->nomor_telepon }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div><span class="font-bold">Ambil:</span> {{ \Carbon\Carbon::parse($order->tanggal_ambil)->format('d M Y') }}</div>
                                <div><span class="font-bold">Kembali:</span> {{ \Carbon\Carbon::parse($order->tanggal_kembali)->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($order->status == 'active')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-bold">Sedang Disewa</span>
                                @elseif($order->status == 'completed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Selesai</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">
                                        @if($order->status == 'pending')
                                            <span class="text-yellow-600">Tertunda</span>
                                        @elseif($order->status == 'approved')
                                            <span class="text-green-600">Disetujui</span>
                                        @elseif($order->status == 'rejected')
                                            <span class="text-red-500">Ditolak</span>
                                        @else <span class="text-yellow-600">Tertunda
                                            </span>
                                        @endif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col gap-2">
                                    <button @click="selectedOrder = {{ $order }}; showModal = true"
                                        class="bg-[#7e9a3e] text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-[#1f2b03] transition shadow-md">
                                        LIHAT DETAIL
                                    </button>

                                    @if($order->status == 'active')
                                        <form action="{{ route('admin.transaction.complete', $order->id) }}" method="POST" onsubmit="return confirm('Selesaikan pesanan ini? Pastikan barang sudah dikembalikan.')">
                                            @csrf
                                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-blue-800 transition shadow-md">
                                                SELESAIKAN
                                            </button>
                                        </form>
                                    @endif
                                </div>
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
    </div>

    <div class="mt-6">
        {{ $orders->appends(request()->query())->links() }}
    </div>

    <div x-show="showModal" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-md p-4 overflow-y-auto">

        <div @click.away="showModal = false" class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-5xl overflow-hidden animate-fade-in my-8 border border-white/20">
            <div class="bg-[#7e9a3e] p-8 flex justify-between items-center shadow-md">
                <h2 class="text-3xl font-extrabold text-white font-serif tracking-wide">Detail Transaksi</h2>
                <button @click="showModal = false" class="text-white hover:bg-[#1f2b03] hover:rotate-90 rounded-full p-3 transition duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <template x-if="selectedOrder">
                <div class="p-10 max-h-[80vh] overflow-y-auto bg-gray-50/30">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                        <div class="space-y-10">

                            <div>
                                <h3 class="text-sm font-bold text-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-[#7e9a3e]"></span> Informasi Penyewa
                                </h3>
                                <div class="bg-white p-6 rounded-2xl border border-gray-400 shadow-md hover:shadow-xl transition">
                                    <p class="text-2xl font-extrabold text-gray-900 mb-3" x-text="selectedOrder.nama_lengkap"></p>

                                    <div class="space-y-3">
                                        <p class="text-gray-600 flex items-center gap-3 text-base">
                                            <span class="p-2 bg-gray-100 rounded-lg text-gray-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                </svg>
                                            </span>
                                            <span x-text="selectedOrder.nomor_telepon"></span>
                                        </p>
                                        <p class="text-gray-600 flex items-center gap-3 text-base" x-show="selectedOrder.nama_instansi">
                                            <span class="p-2 bg-gray-100 rounded-lg text-gray-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </span>
                                            <span x-text="selectedOrder.nama_instansi"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span> Detail Pembayaran
                                </h3>
                                <div class="bg-white p-6 rounded-2xl border border-gray-400 shadow-md hover:shadow-xl transition space-y-4">
                                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                                        <span class="text-gray-500 font-medium">Total Harga</span>
                                        <span class="font-extrabold text-xl text-gray-900" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedOrder.total)"></span>
                                    </div>
                                    <div class="flex justify-between items-center px-2">
                                        <span class="text-gray-600">Metode Bayar</span>
                                        <span class="font-bold uppercase tracking-wide text-[#7e9a3e] bg-[#7e9a3e]/10 px-3 py-1 rounded-lg" x-text="selectedOrder.metode_pembayaran || 'Transfer'"></span>
                                    </div>
                                    <div class="flex justify-between items-center px-2">
                                        <span class="text-gray-600">Opsi Bayar</span>
                                        <span class="font-bold uppercase tracking-wide text-blue-600 bg-blue-50 px-3 py-1 rounded-lg" x-text="selectedOrder.nominal_bayar"></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-sm font-bold text-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Catatan
                                </h3>
                                <div class="w-full border-2 border-dashed border-gray-400 rounded-2xl px-6 py-5 font-medium text-gray-600 italic bg-white leading-relaxed">
                                    <span x-text="selectedOrder.catatan || 'Tidak ada catatan tambahan dari penyewa.'"></span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-10">

                            <div x-show="selectedOrder.dokumen_jaminan">
                                <h3 class="text-sm font-bold text-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-purple-500"></span> Dokumen Jaminan
                                </h3>
                                <div class="rounded-2xl overflow-hidden border border-gray-400 shadow-md group relative bg-white p-2">
                                    <a :href="'{{ asset('storage') }}/' + selectedOrder.dokumen_jaminan" target="_blank" class="block overflow-hidden rounded-xl">
                                        <img :src="'{{ asset('storage') }}/' + selectedOrder.dokumen_jaminan" class="w-full h-56 object-cover transform group-hover:scale-105 transition duration-500 ease-in-out">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 backdrop-blur-sm rounded-xl">
                                            <span class="text-white font-bold text-sm bg-white/20 border border-white/50 px-6 py-2 rounded-full backdrop-blur-md shadow-xl flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Jaminan
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div x-show="selectedOrder.bukti_transfer">
                                <h3 class="text-sm font-bold text-black uppercase tracking-widest mb-4 flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-green-500"></span> Bukti Transfer
                                </h3>
                                <div class="rounded-2xl overflow-hidden border border-gray-400 shadow-md group relative bg-white p-2">
                                    <a :href="'{{ asset('storage') }}/' + selectedOrder.bukti_transfer" target="_blank" class="block overflow-hidden rounded-xl">
                                        <img :src="'{{ asset('storage') }}/' + selectedOrder.bukti_transfer" class="w-full h-56 object-cover transform group-hover:scale-105 transition duration-500 ease-in-out">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 backdrop-blur-sm rounded-xl">
                                            <span class="text-white font-bold text-sm bg-white/20 border border-white/50 px-6 py-2 rounded-full backdrop-blur-md shadow-xl flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Bukti
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div x-show="!selectedOrder.bukti_transfer" class="bg-yellow-50 p-6 rounded-2xl border border-yellow-200 text-yellow-800 text-base flex items-start gap-3 shadow-sm">
                                <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p class="font-bold mb-1">Tidak Ada Bukti Transfer</p>
                                    <p class="opacity-90">Pesanan ini mungkin menggunakan metode <strong>COD (Bayar di Tempat)</strong> atau <strong>Organisasi</strong> yang tidak memerlukan bukti transfer.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <button @click="showModal = false" class="w-full bg-white border-2 border-red-500 hover:bg-red-200 text-red-500 py-4 rounded-xl font-bold text-lg transition shadow-lg">
                            Tutup
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection
