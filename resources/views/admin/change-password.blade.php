@extends('layouts.admin')

@section('title', 'Ganti Password Admin')

@section('content')
    <h2 class="text-3xl font-bold mb-10 text-black" style="font-family: 'Merriweather', serif;">
        Ganti Password
    </h2>

    @if(session('status'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-800 border border-green-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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
            @method('PUT')
            <div x-data="{ show: false }">
                <label class="block text-sm font-bold text-gray-800 mb-2">Password Lama</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'"
                            name="current_password"
                            required
                            placeholder="Masukkan Password Lama Anda"
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400 bg-white">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg x-show="show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="!show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.42m5.06-2.106c.703-.173 1.45-.259 2.193-.259 4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.992 4.606L4.015 4.015zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400 bg-white">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg x-show="show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="!show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.42m5.06-2.106c.703-.173 1.45-.259 2.193-.259 4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.992 4.606L4.015 4.015zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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
                            class="w-full px-5 py-3 border-2 border-[#7e9a3e] rounded-xl outline-none focus:ring-4 focus:ring-[#7e9a3e]/20 transition text-gray-700 placeholder-gray-400 bg-white">

                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#7e9a3e] focus:outline-none">
                        <svg x-show="show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="!show" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.42m5.06-2.106c.703-.173 1.45-.259 2.193-.259 4.478 0 8.268 2.943 9.542 7a10.059 10.059 0 01-2.992 4.606L4.015 4.015zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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
