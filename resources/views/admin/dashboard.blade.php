@extends('layouts.admin')

@section('title', 'Dashboard Admin - Katalog Semayang')

@section('content')
<div class="mb-12 flex flex-col md:flex-row items-start md:items-center justify-between">
    <div>
        <p class="text-[#7e9a3e] text-lg font-medium mb-2">Wellcome back, Admin!</p>
        <h1 class="text-5xl font-extrabold text-black tracking-tight" style="font-family: 'Inter', sans-serif;">Dashboard</h1>
    </div>

    <div class="flex items-center space-x-6 mt-6 md:mt-0">

        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-gray-200 border-2 border-[#7e9a3e] flex items-center justify-center overflow-hidden">
                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
            </div>
            <span class="font-bold text-black text-lg">Admin</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
    <div class="bg-white rounded-[2rem] border-[3px] border-black p-8 flex flex-col justify-between h-full">
        <div class="flex items-start space-x-6">
            <div class="bg-[#E9C46A] rounded-full p-5 flex-shrink-0 flex items-center justify-center w-20 h-20">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                    </path>
                </svg>
            </div>

            <div>
                <div class="flex items-baseline space-x-2 font-extrabold text-black">
                    <h2 class="text-7xl leading-none">{{ $pendingOrders ?? 3 }}</h2>
                    <span class="text-xl font-bold">Pesanan</span>
                </div>
                <p class="text-black font-bold text-2xl mt-1">Perlu Dikonfirmasi</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <span class="bg-[#C5E1A5] text-[#558B2F] px-4 py-2 rounded-xl text-lg font-extrabold flex items-center">
                ↑ +60
            </span>
            <button class="bg-white border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-gray-50 transition text-lg">
                Bulan ini
            </button>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border-[3px] border-black p-8 flex flex-col justify-between h-full">
        <div class="flex items-start space-x-6">
            <div class="bg-[#264653] rounded-full p-5 flex-shrink-0 flex items-center justify-center w-20 h-20">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                    </path>
                </svg>
            </div>

            <div>
                <div class="flex items-baseline space-x-2 font-extrabold text-black">
                    <h2 class="text-7xl leading-none">{{ $todayReturns ?? 2 }}</h2>
                    <span class="text-xl font-bold">Pesanan</span>
                </div>
                <p class="text-black font-bold text-2xl mt-1">Akan Kembali Hari Ini</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <span class="bg-[#C5E1A5] text-[#558B2F] px-4 py-2 rounded-xl text-lg font-extrabold flex items-center">
                ↑ +40
            </span>
            <button class="bg-white border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-gray-50 transition text-lg">
                Bulan ini
            </button>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border-[3px] border-black p-8 flex flex-col justify-between h-full">
        <div class="flex items-start space-x-6">
            <div class="bg-[#B8D46F] rounded-full p-5 flex-shrink-0 flex items-center justify-center w-20 h-20">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>

            <div>
                <div class="flex items-baseline space-x-2 font-extrabold text-black">
                    <h2 class="text-7xl leading-none">{{ $activeOrders ?? 1 }}</h2>
                    <span class="text-xl font-bold">Pesanan</span>
                </div>
                <p class="text-black font-bold text-2xl mt-1">Sedang Disewa</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <span class="bg-[#C5E1A5] text-[#558B2F] px-4 py-2 rounded-xl text-lg font-extrabold flex items-center">
                ↑ +10
            </span>
            <button class="bg-white border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-gray-50 transition text-lg">
                Bulan ini
            </button>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border-[3px] border-black p-8 flex flex-col justify-between h-full">
        <div class="flex items-start space-x-6">
            <div class="bg-[#E76F51] rounded-full p-5 flex-shrink-0 flex items-center justify-center w-20 h-20">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                    </path>
                </svg>
            </div>

            <div>
                <div class="flex items-baseline space-x-2 font-extrabold text-black">
                    <h2 class="text-7xl leading-none">{{ $overdueOrders ?? 0 }}</h2>
                    <span class="text-xl font-bold">Pesanan</span>
                </div>
                <p class="text-black font-bold text-2xl mt-1">Terlambat</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <span class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-lg font-extrabold flex items-center">
                ↑ +0
            </span>
            <button class="bg-white border-2 border-black text-black px-6 py-2 rounded-xl font-bold hover:bg-gray-50 transition text-lg">
                Bulan ini
            </button>
        </div>
    </div>
</div>
@endsection
