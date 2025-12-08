@extends('layouts.admin')

@section('title', (isset($product) ? 'Edit' : 'Tambah') . ' Produk - Admin Katalog Semayang')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="text-red-600 hover:text-red-700 text-sm mb-2 inline-block">
        ← Kembali ke Daftar Produk
    </a>
    <h1 class="text-3xl font-bold text-gray-900">{{ isset($product) ? 'Edit Produk' : 'Tambah Baju Baru' }}</h1>
</div>

<form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
        method="POST" enctype="multipart/form-data" class="max-w-4xl">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-6">Data Produk</h2>

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                    placeholder="Contoh: Baju Adat Pria (Hitam)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                <select name="category_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Sewa (per 3 Hari) *</label>
                <div class="relative">
                    <span class="absolute left-4 top-2 text-gray-600">Rp</span>
                    <input type="number" name="price_per_3days" value="{{ old('price_per_3days', $product->price_per_3days ?? '') }}" required min="0"
                        placeholder="55000"
                        class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('price_per_3days') border-red-500 @enderror">
                </div>
                @error('price_per_3days')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Stok Total *</label>
                    <input type="number" name="stock_total" value="{{ old('stock_total', $product->stock_total ?? '') }}" required min="0"
                        placeholder="Contoh: 5"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('stock_total') border-red-500 @enderror">
                    @error('stock_total')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if(isset($product))
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok Tersedia</label>
                    <input type="text" value="{{ $product->stock_available }}" readonly
                        class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-600">
                    <p class="text-xs text-gray-500 mt-1">Otomatis diupdate berdasarkan penyewaan</p>
                </div>
                @endif
            </div>

            <!-- Size Info -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Informasi Ukuran</label>
                <input type="text" name="size_info" value="{{ old('size_info', $product->size_info ?? '') }}"
                    placeholder="Contoh: All Size (Uk. S sampai XXL)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
            </div>

            <!-- Included Items -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kelengkapan Paket</label>
                <input type="text" name="included_items" value="{{ old('included_items', isset($product) && $product->included_items ? implode(', ', $product->included_items) : '') }}"
                    placeholder="Contoh: Topi bulu, Rompi manik, Rok rumbai (pisahkan dengan koma)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                <p class="text-xs text-gray-500 mt-1">Pisahkan setiap item dengan koma (,)</p>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi & Detail Produk *</label>
                <textarea name="description" rows="6" required
                    placeholder="Tuliskan deskripsi baju, perkiraan ukuran (S/M/L), dan daftar aksesoris yang termasuk dalam paket."
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>

                @if(isset($product) && $product->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 mt-2">Foto saat ini (upload baru untuk mengubah)</p>
                    </div>
                @endif

                <input type="file" name="image" accept="image/*" {{ isset($product) ? '' : 'required' }}
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 @error('image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Upload an Image (jpg, png, jpeg) - Max 2MB</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="flex space-x-4">
        <a href="{{ route('admin.products.index') }}" class="flex-1 bg-gray-300 text-gray-700 text-center py-3 rounded-md hover:bg-gray-400 transition font-semibold">
            Batal
        </a>
        <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-md hover:bg-red-700 transition font-semibold">
            {{ isset($product) ? 'Update Produk' : 'Simpan Produk' }}
        </button>
    </div>
</form>
@endsection
