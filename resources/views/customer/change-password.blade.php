@extends('layouts.user')

@section('title', 'Ganti Password')

@section('content')
    <h2 class="text-3xl font-bold mb-10 text-black" style="font-family: 'Merriweather', serif;">
        Ganti Password
    </h2>

    @if(session('status'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 border border-green-200">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-800 border border-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-full max-w-2xl">
        <form action="{{ route('password.update') }}" method="POST" class="space-y-8">
            @csrf

            <div x-data="{ show: false }">
                <label class="block text-sm font-bold text-gray-800 mb-2">Password Lama</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'"
                            name="current_password"
                            required
                            placeholder="Masukkan Password Lama Anda"
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400">

                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-bold text-gray-800 mb-2">Password Baru</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'"
                            name="password"
                            required
                            placeholder="Masukkan Password Baru Anda"
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400">

                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                    </button>
                </div>
            </div>

            <div x-data="{ show: false }">
                <label class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'"
                            name="password_confirmation"
                            required
                            placeholder="Konfirmasi Password Baru Anda"
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400">

                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" x-show="!show" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/></svg>
                    </button>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-[#7e9a3e] hover:bg-[#5a6b42] text-white font-bold text-lg py-3 rounded-lg shadow-lg transition duration-200 uppercase tracking-wide">
                    SIMPAN
                </button>
            </div>
        </form>
    </div>
@endsection
