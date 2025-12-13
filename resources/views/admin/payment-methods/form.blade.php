@extends('layouts.admin')

@section('title', isset($method) ? 'Edit Metode Pembayaran' : 'Tambah Metode Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.payment-methods.index') }}" class="p-2 rounded-full bg-white shadow hover:bg-gray-50">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="text-3xl font-extrabold text-gray-800">
            {{ isset($method) ? 'Edit Metode' : 'Tambah Metode Baru' }}
        </h1>
    </div>

    <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100">
        <form action="{{ isset($method) ? route('admin.payment-methods.update', $method->id) : route('admin.payment-methods.store') }}"
                method="POST"
                enctype="multipart/form-data">
            @csrf
            @if(isset($method)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block font-bold text-gray-700 mb-2">Nama Bank / Metode</label>
                    <input type="text" name="name" value="{{ old('name', $method->name ?? '') }}" placeholder="Contoh: Bank BCA"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#7e9a3e] focus:outline-none transition" required>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-2">Kode Unik (Huruf Kecil)</label>
                    <input type="text" name="code" value="{{ old('code', $method->code ?? '') }}" placeholder="Contoh: bca"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#7e9a3e] focus:outline-none transition" required>
                    <small class="text-gray-500">Digunakan untuk logika sistem (bri, bca, dana, cod).</small>
                </div>

                <div class="md:col-span-2">
                    <label class="block font-bold text-gray-700 mb-2">Tipe Pembayaran</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#7e9a3e] focus:outline-none bg-white">
                        <option value="manual" {{ (old('type', $method->type ?? '') == 'manual') ? 'selected' : '' }}>Transfer (Rekening)</option>
                        <option value="qr" {{ (old('type', $method->type ?? '') == 'qr') ? 'selected' : '' }}>QR Code / E-Wallet</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-2">Nomor Rekening / HP</label>
                    <input type="text" name="account_number" value="{{ old('account_number', $method->account_number ?? '') }}" placeholder="Contoh: 1234-5678-90"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#7e9a3e] focus:outline-none transition">
                </div>
                <div>
                    <label class="block font-bold text-gray-700 mb-2">Atas Nama</label>
                    <input type="text" name="account_name" value="{{ old('account_name', $method->account_name ?? '') }}" placeholder="Contoh: AMKT Semayang"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#7e9a3e] focus:outline-none transition">
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-2">Logo Bank (Icon)</label>
                    @if(isset($method) && $method->logo_image)
                        <img src="{{ asset($method->logo_image) }}" class="h-10 mb-2 object-contain border p-1 rounded">
                    @endif
                    <input type="file" name="logo_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#7e9a3e] file:text-white hover:file:bg-[#1f2b03]">
                    <small class="text-gray-500">Format: png/jpg, max 2MB.</small>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 mb-2">Gambar QR Code (Jika ada)</label>
                    @if(isset($method) && $method->qr_image)
                        <img src="{{ asset($method->qr_image) }}" class="h-20 mb-2 object-contain border p-1 rounded">
                    @endif
                    <input type="file" name="qr_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#7e9a3e] file:text-white hover:file:bg-[#1f2b03]">
                </div>

                <div class="md:col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                            class="w-5 h-5 text-[#7e9a3e] rounded focus:ring-[#7e9a3e]"
                            {{ old('is_active', $method->is_active ?? true) ? 'checked' : '' }}>
                    <label for="is_active" class="font-bold text-gray-700">Aktifkan Metode Ini</label>
                </div>
            </div>

            <div class="border-t pt-6 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-[#7e9a3e] hover:bg-[#1f2b03] text-white font-bold rounded-xl transition shadow-lg transform hover:scale-105">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
