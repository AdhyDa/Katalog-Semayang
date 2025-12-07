@extends('layouts.user')

@section('title', 'Pesanan Saya')

@section('content')
    {{-- Judul Halaman --}}
    <h2 class="text-4xl font-black mb-8 text-black" style="font-family: 'Merriweather', serif;">
        Pesanan Saya
    </h2>

    @if($orders->count() > 0)
        <div class="flex flex-col gap-8">
            @foreach($orders as $order)
                {{-- CARD ITEM --}}
                <div class="bg-white border-[3px] border-black rounded-[2rem] p-6 relative flex flex-col md:flex-row gap-6">

                    {{-- 1. Gambar Produk --}}
                    <div class="flex-shrink-0">
                        @php
                            $firstItem = $order->orderItems->first();
                            $productImage = $firstItem && $firstItem->product->image ? Storage::url($firstItem->product->image) : null;
                        @endphp

                        @if($productImage)
                            <img src="{{ $productImage }}" alt="Produk"
                                class="w-full md:w-40 h-40 object-cover rounded-2xl border border-gray-200">
                        @else
                            {{-- Placeholder jika tidak ada gambar --}}
                            <div class="w-full md:w-40 h-40 bg-blue-50 rounded-2xl border border-gray-200 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute bottom-0 w-full h-12 bg-[#8da560]"></div>
                                <div class="w-10 h-10 bg-white/50 rounded-full absolute top-4 left-4"></div>
                            </div>
                        @endif
                    </div>

                    {{-- 2. Detail Info --}}
                    <div class="flex-grow flex flex-col justify-between py-1">
                        <div>
                            {{-- Baris Atas: ID & Status --}}
                            <div class="flex flex-wrap items-start justify-between mb-2">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    ID: #{{ $order->order_number }} | {{ $order->pickup_date->format('d M Y') }}
                                </p>

                                {{-- Status Label with Dot --}}
                                @php
                                    $statusData = match($order->status) {
                                        'pending' => ['color' => 'bg-yellow-400', 'text' => 'text-yellow-600', 'label' => 'Menunggu Konfirmasi'],
                                        'active' => ['color' => 'bg-green-500', 'text' => 'text-green-600', 'label' => 'Sedang Disewa'],
                                        'completed' => ['color' => 'bg-blue-500', 'text' => 'text-blue-600', 'label' => 'Selesai'],
                                        'cancelled' => ['color' => 'bg-red-500', 'text' => 'text-red-600', 'label' => 'Dibatalkan'],
                                        default => ['color' => 'bg-gray-400', 'text' => 'text-gray-600', 'label' => 'Diproses'],
                                    };
                                @endphp
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full {{ $statusData['color'] }}"></span>
                                    <span class="text-sm font-bold {{ $statusData['text'] }}">{{ $statusData['label'] }}</span>
                                </div>
                            </div>

                            {{-- Nama Produk --}}
                            <h3 class="text-2xl font-bold text-black font-serif leading-tight mb-1">
                                {{ $firstItem->product->name ?? 'Produk Tidak Dikenal' }}
                            </h3>
                            @if($order->orderItems->count() > 1)
                                <p class="text-sm text-gray-500 font-medium">+ {{ $order->orderItems->count() - 1 }} item lainnya</p>
                            @endif

                            {{-- Durasi --}}
                            <p class="text-sm text-gray-500 mt-2">
                                Durasi: <span class="text-black font-semibold">{{ $order->duration_days }} Hari</span>
                                ({{ $order->pickup_date->format('d M') }} - {{ $order->return_date->format('d M') }})
                            </p>
                        </div>

                        {{-- Harga Total --}}
                        <div class="flex justify-between items-end mt-4 md:mt-0 border-t md:border-t-0 border-dashed pt-3 md:pt-0">
                            <span class="text-xs font-bold text-gray-600">Total Harga</span>
                            <span class="text-lg font-extrabold text-black">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                </div>

                {{-- TOMBOL ACTION DI LUAR CARD (Biar lebar penuh seperti desain) --}}
                <a href="{{ route('customer.order.detail', $order->id) }}"
                    class="block w-full py-3 -mt-6 rounded-full border-2 border-[#718355] text-[#718355] text-center font-bold hover:bg-[#718355] hover:text-white transition-colors duration-200">
                    Lihat Detail
                </a>

            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $orders->links() }}
        </div>

    @else
        {{-- Tampilan Kosong --}}
        <div class="flex flex-col items-center justify-center h-[50vh] text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-black mb-2">Belum ada pesanan</h3>
            <p class="text-gray-500 mb-6">Anda belum pernah menyewa baju adat.</p>
            <a href="{{ route('katalog') }}" class="px-8 py-3 bg-[#718355] text-white rounded-xl font-bold hover:bg-[#5a6b42] transition shadow-lg" style="margin: unset;">
                Lihat Katalog
            </a>
        </div>
    @endif
@endsection
