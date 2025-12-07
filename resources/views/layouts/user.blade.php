<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard User')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Merriweather:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body x-data="{ showLogoutModal: false }">
    <div class="admin-container">
        <aside class="sidebar">
            <div style="height: 100%; display: flex; flex-direction: column; ">
                <div class="mb-8 pl-2">
                    <div class="flex items-center gap-3 mb-4">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 rounded-full object-cover">
                        </a>
                        <div>
                            <p class="text-sm font-light text-white opacity-80">Katalog</p>
                            <h1 class="text-xl font-extrabold text-white leading-none">Semayang</h1>
                        </div>
                    </div>
                    <div class="h-px w-full bg-white/30"></div>
                </div>

                <nav class="flex-grow overflow-y-auto space-y-2" style="width: 400px;">
                    <a href="{{ route('customer.profile') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('customer.profile') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Profil Saya</span>
                    </a>

                    <a href="{{ route('customer.orders') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 {{ request()->routeIs('customer.orders*') ? 'bg-white text-[#718355] font-bold shadow-lg' : 'text-white hover:bg-[rgba(31,43,3,0.4)]' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span>Pesanan Saya</span>
                    </a>

                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 rounded-full transition-all duration-300 text-white hover:bg-[rgba(31,43,3,0.4)]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        <span>Ganti Password</span>
                    </a>
                </nav>

                <div class="mt-auto pt-4">
                    <form id="logout-form-user" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                    <button type="button" @click="showLogoutModal = true" class="w-full flex items-center gap-3 px-4 py-3 rounded-full text-white hover:bg-[rgba(31,43,3,0.4)] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar</span>
                    </button>
                </div>
            </div>
        </aside>

        <div class="main-content-wrapper">
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <div class="main-content-wrapper">
            <main class="main-content">
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

                <button onclick="document.getElementById('logout-form-user').submit();" class="px-4 py-3 rounded-xl text-[rgba(126,154,62,1)] font-bold hover:text-[rgba(31,43,3,1)] hover:bg-[rgba(126,154,62,1)] transition tracking-wide text-lg">
                    YA
                </button>
            </div>
        </div>
    </div>
</body>
</html>
