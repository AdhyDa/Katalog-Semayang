@extends('layouts.admin')

@section('content')

    {{-- Header Section: Judul & Search --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        {{-- Judul Halaman --}}
        <h2 class="text-3xl font-extrabold text-black self-start md:self-center" style="font-family: 'Merriweather', serif;">
            Data Pelanggan Terdaftar
        </h2>

        {{-- Search Box (Pill Shape dengan Border Hijau) --}}
        <div class="relative w-full md:w-96">
            <input type="text"
                    placeholder="Cari Nama, Email, atau No Telp"
                    class="w-full pl-5 pr-12 py-2 border-2 border-[#718355] rounded-full outline-none focus:ring-2 focus:ring-[#718355]/50 text-gray-700 placeholder-gray-400 font-medium transition-all">

            {{-- Icon Search (Posisi Absolute di Kanan) --}}
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-[#718355]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="M21 21l-4.35-4.35"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Tabel Data Pelanggan --}}
    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
        <table class="w-full text-sm border-collapse">
            {{-- Table Head --}}
            <thead class="bg-white text-gray-800">
                <tr>
                    <th class="py-4 px-4 border border-gray-300 font-bold text-center w-1/4">Nama & Email</th>
                    <th class="py-4 px-4 border border-gray-300 font-bold text-center">Kontak</th>
                    <th class="py-4 px-4 border border-gray-300 font-bold text-center">Asal Instansi/Kampus</th>
                    <th class="py-4 px-4 border border-gray-300 font-bold text-center">Statistik Sewa</th>
                    <th class="py-4 px-4 border border-gray-300 font-bold text-center">Bergabung Sejak</th>
                </tr>
            </thead>

            {{-- Table Body --}}
            <tbody class="bg-white text-gray-700">
                @forelse ($pelanggan as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- Nama & Email (Stacked) --}}
                    <td class="py-3 px-4 border border-gray-300 text-center align-middle">
                        <div class="font-bold text-black">{{ $p->name }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ $p->email }}</div>
                    </td>

                    {{-- Kontak --}}
                    <td class="py-3 px-4 border border-gray-300 text-center align-middle font-medium">
                        {{ $p->phone }}
                    </td>

                    {{-- Instansi --}}
                    <td class="py-3 px-4 border border-gray-300 text-center align-middle">
                        {{ $p->institution ?? '-' }}
                    </td>

                    {{-- Statistik Sewa --}}
                    <td class="py-3 px-4 border border-gray-300 text-center align-middle font-semibold">
                        {{-- Contoh logic statistik, sesuaikan dengan data riil --}}
                        {{ $p->orders_count ?? '0' }}x Sewa
                    </td>

                    {{-- Bergabung Sejak --}}
                    <td class="py-3 px-4 border border-gray-300 text-center align-middle">
                        {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500 border border-gray-300">
                        Belum ada data pelanggan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (Opsional, jika ada) --}}
    <div class="mt-6">
        {{ $pelanggan->links() }}
    </div>

@endsection
