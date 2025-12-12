@extends('layouts.admin')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-extrabold text-gray-800" style="font-family: 'Inter', sans-serif;">
        Metode Pembayaran
    </h1>
    <a href="{{ route('admin.payment-methods.create') }}" class="px-6 py-2 bg-[#7e9a3e] text-white font-bold rounded-full hover:bg-[#1f2b03] transition shadow-lg">
        + Tambah Metode
    </a>
</div>

<div class="bg-white rounded-[1.5rem] border-2 border-gray-100 p-6 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-500 border-b border-gray-200">
                    <th class="py-4 px-4 font-bold">Logo</th>
                    <th class="py-4 px-4 font-bold">Nama Metode</th>
                    <th class="py-4 px-4 font-bold">Tipe</th>
                    <th class="py-4 px-4 font-bold">Detail Akun</th>
                    <th class="py-4 px-4 font-bold">Status</th>
                    <th class="py-4 px-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($methods as $method)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-4 px-4">
                        @if($method->logo_image)
                            <img src="{{ asset($method->logo_image) }}" alt="Logo" class="h-10 w-auto object-contain">
                        @else
                            <span class="text-gray-400 text-sm">No Logo</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 font-bold">{{ $method->name }} <br> <span class="text-xs text-gray-400 font-normal">Code: {{ $method->code }}</span></td>
                    <td class="py-4 px-4">
                        @if($method->type == 'manual') <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold">Transfer</span>
                        @elseif($method->type == 'qr') <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-lg text-xs font-bold">QRIS/E-Wallet</span>
                        @else <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold">COD/Tunai</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 text-sm">
                        @if($method->type == 'manual')
                            <div>No: {{ $method->account_number }}</div>
                            <div class="text-gray-500">A.n: {{ $method->account_name }}</div>
                        @elseif($method->type == 'qr')
                            <div class="text-blue-600 cursor-pointer hover:underline">Lihat QR Code</div>
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        @if($method->is_active)
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold">Aktif</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="py-4 px-4 flex justify-center gap-2">
                        <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="p-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" onsubmit="return confirm('Hapus metode pembayaran ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">Belum ada metode pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
