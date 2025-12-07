@extends('layouts.admin')

@section('title', 'Manajemen Katalog - Admin Katalog Semayang')

@section('content')
<div x-data="productManager()" class="relative">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-extrabold text-black tracking-tight" style="font-family: 'Inter', sans-serif;">
                <span style="font-family: serif; font-weight: 800;">Manajemen Katalog & Stok</span>
            </h1>
        </div>
        <div>
            <button @click="openModal('create')" class="inline-flex items-center px-6 py-3 bg-[#718355] hover:bg-[#5a6944] text-white font-bold rounded-full transition shadow-sm">
                <span class="mr-2 text-xl">+</span> Tambah Baju Baru
            </button>
        </div>
    </div>

    <div class="mb-8">
        <form method="GET" action="{{ route('admin.products.index') }}">
            <div class="flex flex-col space-y-2">
                <label class="font-bold text-gray-800 ml-1">Cari Nama Baju</label>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Ketik nama baju..."
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] text-gray-700">
                    </div>
                    <div class="w-full md:w-1/4 relative">
                        <select name="category" onchange="this.form.submit()" class="w-full appearance-none px-4 py-2 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] text-gray-500 bg-white cursor-pointer">
                            <option value="">Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 relative">
                        <select name="status" onchange="this.form.submit()" class="w-full appearance-none px-4 py-2 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] text-gray-500 bg-white cursor-pointer">
                            <option value="">Status Stok</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="sisa" {{ request('status') == 'sisa' ? 'selected' : '' }}>Sisa Stok</option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="space-y-6">
        @forelse($products as $product)
            <div class="bg-white border-2 border-black rounded-[1.5rem] p-4 flex flex-col md:flex-row gap-6 relative group hover:shadow-lg transition-all duration-300">
                <div class="w-full md:w-48 h-48 flex-shrink-0">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl border border-gray-200">
                    @else
                        <div class="w-full h-full bg-blue-50 rounded-xl border border-gray-200 flex items-center justify-center relative overflow-hidden">
                            <svg class="absolute bottom-0 w-full text-[#718355]" viewBox="0 0 1440 320" preserveAspectRatio="none">
                                <path fill="currentColor" fill-opacity="1" d="M0,224L60,213.3C120,203,240,181,360,181.3C480,181,600,203,720,224C840,245,960,267,1080,261.3C1200,256,1320,224,1380,208L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex-1 flex flex-col justify-between py-1">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="text-2xl font-bold font-serif text-black leading-tight">{{ $product->name }}</h3>
                            <div class="flex items-center space-x-2 text-sm font-bold">
                                @if($product->stock_total > 2)
                                    <span class="w-3 h-3 rounded-full bg-[#718355]"></span><span class="text-[#718355]">Tersedia {{ $product->stock_total }}</span>
                                @elseif($product->stock_total > 0 && $product->stock_total <= 2)
                                    <span class="w-3 h-3 rounded-full bg-red-500"></span><span class="text-red-500">Sisa {{ $product->stock_total }}</span>
                                @else
                                    <span class="w-3 h-3 rounded-full bg-gray-400"></span><span class="text-gray-400">Habis</span>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm mb-2">{{ $product->category->name }}</p>
                        <div class="mb-4">
                            <span class="text-xl font-extrabold text-black">Rp {{ number_format($product->price_per_3days, 0, ',', '.') }}</span>
                            <span class="text-black font-medium text-sm"> / 3 hari</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-auto">
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-white border border-gray-400 text-gray-500 hover:text-red-500 hover:border-red-500 font-medium py-2.5 rounded-full transition text-sm">Hapus</button>
                        </form>

                        <button @click="openModal('edit', {{ $product }})" class="w-full bg-[#718355] hover:bg-[#5a6944] text-white font-medium py-2.5 rounded-full transition text-sm">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-gray-300">
                <p class="text-xl font-bold text-gray-500">Belum ada baju di katalog</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->appends(request()->query())->links() }}
    </div>

    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 backdrop-blur-sm p-4">

        <div @click.away="closeModal()" class="relative w-full max-w-5xl bg-white rounded-[2rem] shadow-2xl p-8 transition-all">

            <h2 class="text-3xl font-extrabold font-serif mb-6 text-black" x-text="mode === 'create' ? 'Tambah Baju Baru' : 'Edit Data Produk'"></h2>

            <form :action="formAction" method="POST" enctype="multipart/form-data">
                @csrf
                <template x-if="mode === 'edit'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-1">
                        <div class="relative w-full aspect-square bg-gray-50 rounded-2xl border-2 border-dashed border-gray-400 flex flex-col items-center justify-center text-gray-500 hover:bg-gray-100 transition cursor-pointer overflow-hidden group">

                            <input type="file" name="image" accept="image/*" @change="previewImage" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                            <img x-show="imagePreview" :src="imagePreview" class="absolute inset-0 w-full h-full object-cover">

                            <div x-show="!imagePreview" class="text-center p-4">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-400 group-hover:text-[#718355]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span class="text-sm font-bold">Upload an Image</span>
                                <span class="block text-xs">(jpg, png, jpeg)</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-gray-800 font-bold mb-2 ml-1">Nama Produk</label>
                                <input type="text" name="name" x-model="formData.name" required placeholder="Contoh: Baju Adat Pria (Hitam)"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] focus:ring-1 focus:ring-[#718355]">
                            </div>

                            <div>
                                <label class="block text-gray-800 font-bold mb-2 ml-1">Harga Sewa (per 3 Hari)</label>
                                <input type="number" name="price_per_3days" x-model="formData.price_per_3days" required placeholder="Contoh: 55000"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] focus:ring-1 focus:ring-[#718355]">
                            </div>

                            <div>
                                <label class="block text-gray-800 font-bold mb-2 ml-1">Kategori</label>
                                <div class="relative">
                                    <select name="category_id" x-model="formData.category_id" required class="w-full appearance-none px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] bg-white">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-800 font-bold mb-2 ml-1">Jumlah Stok</label>
                                <input type="number" name="stock_total" x-model="formData.stock_total" required placeholder="Contoh: 5"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] focus:ring-1 focus:ring-[#718355]">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <h3 class="text-xl font-bold mb-4">Deskripsi & Detail Produk</h3>
                            <div>
                                <label class="block text-gray-800 font-bold mb-2 ml-1">Deskripsi, Ukuran & Kelengkapan</label>
                                <textarea name="description" x-model="formData.description" rows="4" required placeholder="Tuliskan deskripsi baju, perkiraan ukuran (S/M/L), dan daftar aksesoris yang termasuk dalam paket."
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:border-[#718355] focus:ring-1 focus:ring-[#718355]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <button type="button" @click="closeModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-4 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-[#718355] hover:bg-[#5a6944] text-white font-bold py-4 rounded-xl transition shadow-lg">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function productManager() {
        return {
            showModal: false,
            mode: 'create', // 'create' or 'edit'
            formAction: '',
            imagePreview: null,
            formData: {
                id: null,
                name: '',
                price_per_3days: '',
                category_id: '',
                stock_total: '',
                description: ''
            },

            openModal(mode, product = null) {
                this.mode = mode;
                this.showModal = true;

                if (mode === 'create') {
                    // Reset Form untuk Create
                    this.formAction = "{{ route('admin.products.store') }}";
                    this.imagePreview = null;
                    this.formData = {
                        id: null, name: '', price_per_3days: '', category_id: '', stock_total: '', description: ''
                    };
                } else {
                    // Isi Form untuk Edit
                    this.formAction = "{{ url('admin/products') }}/" + product.id;
                    this.formData = {
                        id: product.id,
                        name: product.name,
                        price_per_3days: product.price_per_3days,
                        category_id: product.category_id,
                        stock_total: product.stock_total,
                        description: product.description
                    };
                    // Set image preview dari storage jika ada
                    this.imagePreview = product.image ? "{{ Storage::url('') }}" + product.image : null;
                }
            },

            closeModal() {
                this.showModal = false;
            },

            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imagePreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>
@endsection
