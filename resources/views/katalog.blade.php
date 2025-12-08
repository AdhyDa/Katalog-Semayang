@extends('layouts.app')

@section('title', 'Katalog - AMKT Semayang')

@section('content')
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-background">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Background Baju Adat Kalimantan Timur">
    </div>
    <div class="container">
        <div class="hero-content-index">
            <h1>Katalog Kami</h1>
</section>

<!-- Katalog Header -->
<section class="katalog-header">
    <div class="container">
        <p>Kami menghadirkan beragam pilihan baju adat dari Kalimantan Timur di Indonesia yang siap digunakan untuk acara upacara adat dan lainnya </p>

        <div class="filter-search-wrapper">
            <!-- Filter Icon & Tabs -->
            <div class="filter-section">
                <button class="filter-icon-btn" id="filterToggleBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-funnel-icon lucide-funnel">
                        <path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"/>
                    </svg>
                </button>

                <!-- Dropdown Filter Panel -->
                <div class="filter-dropdown" id="filterDropdown">
                    <div class="filter-dropdown-content">
                        <h4>Filter Produk</h4>

                        <!-- Status Stok Filter -->
                        <div class="filter-group">
                            <label>Status Stok:</label>
                            <select class="filter-select" id="statusFilter">
                                <option value="semua" {{ request('status') == 'semua' || !request('status') ? 'selected' : '' }}>Semua</option>
                                <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Stok Menipis</option>
                                <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="filter-actions">
                            <button type="button" class="btn-reset" onclick="resetFilters()">Reset</button>
                            <button type="button" class="btn-apply" onclick="applyFilters()">Terapkan</button>
                        </div>
                    </div>
                </div>

                <div class="filter-tabs">
                    <a href="{{ route('katalog') }}{{ request('status') ? '?status=' . request('status') : '' }}"
                        class="tab-btn {{ $kategori == 'all' ? 'active' : '' }}">
                        All
                    </a>
                    <a href="{{ route('katalog.kategori', ['kategori' => 'pria']) }}{{ request('status') ? '?status=' . request('status') : '' }}"
                        class="tab-btn {{ $kategori == 'pria' ? 'active' : '' }}">
                        Pria
                    </a>
                    <a href="{{ route('katalog.kategori', ['kategori' => 'wanita']) }}{{ request('status') ? '?status=' . request('status') : '' }}"
                        class="tab-btn {{ $kategori == 'wanita' ? 'active' : '' }}">
                        Wanita
                    </a>
                    <a href="{{ route('katalog.kategori', ['kategori' => 'aksesoris']) }}{{ request('status') ? '?status=' . request('status') : '' }}"
                        class="tab-btn {{ $kategori == 'aksesoris' ? 'active' : '' }}">
                        Aksesoris
                    </a>
                </div>
            </div>

            <!-- Search Box -->
            <div class="search-box">
                <form action="{{ $kategori == 'all' ? route('katalog') : route('katalog.kategori', ['kategori' => $kategori]) }}" method="GET" id="searchForm">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <input type="text" name="search" placeholder="Cari nama baju adat" value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Katalog Products -->
<section class="katalog-products">
    <div class="container">
        <div class="products-grid">
            @forelse($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>{{ $product['name'] }}</h3>
                            @if($product['status'] == 'tersedia')
                                <span class="status-badge status-available">
                                    <span class="status-dot"></span> Tersedia
                                </span>
                            @elseif($product['status'] == 'terbatas')
                                <span class="status-badge status-limited">
                                    <span class="status-dot"></span> Sisa {{ $product['sisa'] ?? $product['stock'] }}
                                </span>
                            @else
                                <span class="status-badge status-unavailable">
                                    <span class="status-dot"></span> Habis
                                </span>
                            @endif
                        </div>
                        <p class="product-price">Harga Sewa: Rp {{ number_format($product['harga'], 0, ',', '.') }} / 3 hari</p>
                        <a href="{{ route('katalog.show', ['id' => $product['id']]) }}" class="btn btn-detail {{ $product['status'] == 'habis' ? 'btn-disabled' : '' }}">
                            Lihat Detail ›
                        </a>
                    </div>
                </div>
            @empty
                <div class="no-products">
                    <p>Tidak ada produk yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn page-next">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
</section>

<script>
// Toggle Filter Dropdown
const filterToggleBtn = document.getElementById('filterToggleBtn');
const filterDropdown = document.getElementById('filterDropdown');

filterToggleBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    filterDropdown.classList.toggle('active');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!filterDropdown.contains(e.target) && !filterToggleBtn.contains(e.target)) {
        filterDropdown.classList.remove('active');
    }
});

// Apply Filters
function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const currentUrl = new URL(window.location.href);

    if (status && status !== 'semua') {
        currentUrl.searchParams.set('status', status);
    } else {
        currentUrl.searchParams.delete('status');
    }

    window.location.href = currentUrl.toString();
}

// Reset Filters
function resetFilters() {
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.delete('status');
    window.location.href = currentUrl.toString();
}

// Add active indicator to filter button when filter is applied
document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.getElementById('filterToggleBtn');
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('status') && urlParams.get('status') !== 'semua') {
        filterBtn.classList.add('has-filter');
    }
});
</script>
@endsection
