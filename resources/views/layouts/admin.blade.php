<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Katalog Semayang')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Merriweather:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>
<body x-data="{ showLogoutModal: false }">
    <div class="admin-container">
        <aside class="sidebar">
            <div style="height: 100%; display: flex; flex-direction: column;">

                <div class="mb-8 pl-2">
                    <div class="flex items-center gap-3 mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 rounded-full object-cover">
                        </a>
                        <div>
                            <p class="text-sm font-light text-white opacity-80">Admin</p>
                            <h1 class="text-xl font-extrabold text-white leading-none">Semayang</h1>
                        </div>
                    </div>
                    <div class="h-px w-full bg-white/30"></div>
                </div>

                <nav class="flex-grow overflow-y-auto space-y-2" style="width: 400px;">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.orders') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('admin.orders*') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span>Pesanan Masuk</span>
                    </a>

                    <a href="{{ route('admin.transactions') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('admin.transactions') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Riwayat Transaksi</span>
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('admin.products*') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Manajemen Katalog</span>
                    </a>

                    <a href="{{ route('admin.customers') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('admin.customers') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <span>Data Pelanggan</span>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 text-white hover:bg-[rgba(31,43,3,0.4)]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        <span>Laporan</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 text-white hover:bg-[rgba(31,43,3,0.4)]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        <span>Ganti Password</span>
                    </a>
                </nav>

                <div class="mt-auto pt-4">
                    <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                    <button type="button" @click="showLogoutModal = true" class="w-full flex items-center gap-3 px-4 py-3 rounded-full text-white hover:bg-[rgba(31,43,3,0.4)] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </aside>

        <div class="main-content-wrapper">
            <main class="main-content no-scrollbar">
                @if(session('success'))
                    <div class="alert alert-success mb-4 p-4 rounded-lg bg-green-100 text-green-700 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error mb-4 p-4 rounded-lg bg-red-100 text-red-700 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div x-show="showLogoutModal"
        style="display: none;"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <div class="bg-white p-8 rounded shadow-xl w-[90%] max-w-md transform transition-all"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.outside="showLogoutModal = false">

            <h3 class="text-2xl font-bold mb-4 text-black" style="font-family: 'Merriweather', serif;">
                Konfirmasi
            </h3>
            <p class="text-gray-800 text-lg mb-10 font-sans">
                Apakah anda yakin akan keluar?
            </p>

            <div class="flex justify-end items-center gap-8">
                <button @click="showLogoutModal = false" class="px-4 py-3 rounded-xl text-gray-500 font-bold hover:text-gray-800 hover:bg-gray-500 transition tracking-wide text-lg">
                    TIDAK
                </button>

                <button onclick="document.getElementById('logout-form-admin').submit();" class="px-4 py-3 rounded-xl text-[rgba(126,154,62,1)] font-bold hover:text-[rgba(31,43,3,1)] hover:bg-[rgba(126,154,62,1)] transition tracking-wide text-lg">
                    YA
                </button>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
