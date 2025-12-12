@extends('layouts.admin')

@section('title', 'Laporan Keuangan & Performa')

@section('content')
    <h2 class="text-3xl font-extrabold mb-8 text-black" style="font-family: 'Merriweather', serif;">
        Laporan Keuangan & Performa
    </h2>

    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
        <form action="" method="GET" class="w-full md:w-auto">
            <label class="block text-gray-600 font-semibold mb-2">Rentang Tanggal</label>
            <div class="flex flex-wrap items-center gap-3">
                <div class="relative">
                    <input type="date" name="start_date" class="pl-4 pr-10 py-2 border-2 border-[#7e9a3e] rounded-lg outline-none focus:ring-2 focus:ring-[#7e9a3e]/50 text-gray-700 font-medium">
                </div>

                <span class="text-gray-400 font-bold">-</span>

                <div class="relative">
                    <input type="date" name="end_date" class="pl-4 pr-10 py-2 border-2 border-[#7e9a3e] rounded-lg outline-none focus:ring-2 focus:ring-[#7e9a3e]/50 text-gray-700 font-medium">
                </div>

                <a href="{{ route('admin.reports') }}" class="p-2 border-2 border-black rounded-lg hover:bg-gray-100 transition flex items-center justify-center">
                    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            </div>

            <button type="submit" class="mt-4 bg-[#7e9a3e] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#5a6b42] transition shadow-md">
                Tampilkan Data
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

        <div class="bg-white border-2 border-black rounded-2xl p-6 flex items-center gap-5 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-[#7e9a3e] flex items-center justify-center flex-shrink-0 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 font-bold text-sm">Total Pemasukan (Omzet)</p>
                <h3 class="text-2xl font-extrabold text-black">Rp 5.250.000</h3>
            </div>
        </div>

        <div class="bg-white border-2 border-black rounded-2xl p-6 flex items-center gap-5 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-blue-600 flex items-center justify-center flex-shrink-0 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 font-bold text-sm">Total Transaksi Sukses</p>
                <h3 class="text-2xl font-extrabold text-black">50 Transaksi</h3>
            </div>
        </div>

        <div class="bg-white border-2 border-black rounded-2xl p-6 flex items-center gap-5 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-red-500 flex items-center justify-center flex-shrink-0 text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-gray-600 font-bold text-sm">Pendapatan Denda</p>
                <h3 class="text-2xl font-extrabold text-black">Rp 150.000</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

        <div>
            <h3 class="text-lg font-bold mb-4 text-black">Kostum Terlaris</h3>
            <div class="overflow-hidden border border-gray-300 rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-300">
                        <tr>
                            <th class="py-3 px-4 font-bold text-gray-700">Nama Baju</th>
                            <th class="py-3 px-4 font-bold text-gray-700 text-center">Jumlah Disewa</th>
                            <th class="py-3 px-4 font-bold text-gray-700 text-right">Total Penghasilan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4 font-medium">Baju Adat Pria (Hitam)</td>
                            <td class="py-3 px-4 text-center">10 kali</td>
                            <td class="py-3 px-4 text-right font-bold">Rp 550.000</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-medium">Baju Adat Wanita (Merah)</td>
                            <td class="py-3 px-4 text-center">7 kali</td>
                            <td class="py-3 px-4 text-right font-bold">Rp 385.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-bold mb-4 text-black">Kostum Jarang Disewa</h3>
            <div class="overflow-hidden border border-gray-300 rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-300">
                        <tr>
                            <th class="py-3 px-4 font-bold text-gray-700">Nama Baju</th>
                            <th class="py-3 px-4 font-bold text-gray-700 text-center">Jumlah Disewa</th>
                            <th class="py-3 px-4 font-bold text-gray-700 text-right">Total Penghasilan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="py-3 px-4 font-medium">Cincin Enggang Asli</td>
                            <td class="py-3 px-4 text-center">1 kali</td>
                            <td class="py-3 px-4 text-right font-bold">Rp 55.000</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 font-medium">Mahkota Besar Wanita</td>
                            <td class="py-3 px-4 text-center">1 kali</td>
                            <td class="py-3 px-4 text-right font-bold">Rp 55.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <h3 class="text-xl font-bold mb-4 text-black">Detail Pemasukan</h3>
        <div class="overflow-x-auto border border-gray-300 rounded-lg">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center w-12">No</th>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center">Tanggal & ID</th>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center">Pemesan</th>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center">Keterangan</th>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center">Metode Bayar</th>
                        <th class="py-3 px-4 border border-gray-300 font-bold text-center">Jumlah Masuk</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td class="py-3 px-4 border border-gray-300 text-center font-bold">1</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            <div class="font-bold">22 Nov - 24 Nov 2025</div>
                            <div class="text-xs text-gray-500 font-mono mt-1">#APH-2025001</div>
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center font-medium">Budi Santoso</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            Sewa Baju Adat Pria (Hitam)<br>
                            <span class="text-xs text-gray-500">+ 2 lainnya</span>
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            <div class="flex justify-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/QRIS_logo.svg/1200px-QRIS_logo.svg.png"
                                    alt="QRIS" class="h-6 object-contain">
                            </div>
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center font-bold">Rp 165.000</td>
                    </tr>

                    <tr>
                        <td class="py-3 px-4 border border-gray-300 text-center font-bold">2</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            <div class="font-bold">22 Nov - 24 Nov 2025</div>
                            <div class="text-xs text-gray-500 font-mono mt-1">#AWM-2025001</div>
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center font-medium">Sri Sulistiyo</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            Sewa Baju Adat Wanita (Merah)
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            <div class="flex justify-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/QRIS_logo.svg/1200px-QRIS_logo.svg.png"
                                    alt="QRIS" class="h-6 object-contain">
                            </div>
                        </td>
                        <td class="py-3 px-4 border border-gray-300 text-center font-bold">Rp 55.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
