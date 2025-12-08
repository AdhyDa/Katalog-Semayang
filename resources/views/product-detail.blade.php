@extends('layouts.app')

@section('title', $product['name'] . ' - AMKT Semayang')

@section('content')

<div class="hero-overlay-cart"></div>

<div class="breadcrumb">
    <a href="{{ route('home') }}">Beranda</a> >
    <a href="{{ route('katalog') }}">Katalog</a> >
    <a href="{{ route('katalog.kategori', ($product['kategori'])) }}">{{ ucfirst($product['kategori']) }}</a> >
    {{ $product['name'] }}
</div>

<section class="product-detail-section">
    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <div class="product-detail-grid">
            <!-- Left: Product Images -->
            <div class="product-images">
                <div class="main-image-detail">
                    @if($product['image'])
                        <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" id="mainImageDetail">
                    @else
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="{{ $product['name'] }}" id="mainImageDetail">
                    @endif
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="product-info-detail">
                <h1 class="product-title-detail">{{ $product['name'] }}</h1>

                <div class="product-price-wrapper-detail">
                    <span class="product-price-detail">Rp {{ number_format($product['harga'], 0, ',', '.') }}</span>
                    <span class="product-duration-detail">/ {{ $product['duration'] }}</span>
                </div>

                <div class="product-stock-detail">
                    @if($product['status'] === 'tersedia')
                        <span class="stock-badge-detail available">● Tersedia {{ $product['stock'] }}</span>
                    @elseif($product['status'] === 'terbatas')
                        <span class="stock-badge-detail limited">● Tersisa {{ $product['stock'] }}</span>
                    @else
                        <span class="stock-badge-detail unavailable">● Habis</span>
                    @endif
                </div>

                <hr class="divider-detail">

                <!-- Deskripsi Produk -->
                <div class="product-description-detail">
                    <h3>Deskripsi Produk</h3>
                    <p>{{ $product['description'] }}</p>

                    <div class="product-details-list-detail">
                        <p><strong>Ukuran:</strong> {{ $product['size'] }}</p>
                        <p><strong>Paket:</strong> {{ $product['package'] }}</p>
                    </div>
                </div>

                <hr class="divider-detail">

                <!-- Quantity & Actions -->
                <div class="product-actions-detail">
                    <div class="quantity-selector-detail">
                        <button type="button" class="qty-btn-detail" onclick="decreaseQtyDetail()">-</button>
                        <input type="number" id="quantityDetail" value="1" min="1" max="{{ $product['stock'] }}" readonly>
                        <button type="button" class="qty-btn-detail" onclick="increaseQtyDetail({{ $product['stock'] }})">+</button>
                    </div>

                    <div class="action-buttons-detail">
                        <a href="https://wa.me/6282254429990?text=Halo,%20saya%20ingin%20bertanya%20tentang%20{{ urlencode($product['name']) }}"
                            target="_blank"
                            class="btn-whatsapp-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            Butuh Bantuan?
                        </a>

                        @if($product['status'] !== 'habis')
                        <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <input type="hidden" name="price" value="{{ $product['harga'] }}">
                            <input type="hidden" name="image" value="{{ $product['image'] }}">
                            <input type="hidden" name="duration" value="{{ $product['duration'] }}">
                            <input type="hidden" name="quantity" id="quantity-input-detail" value="1">
                            <button type="submit" class="btn-cart-add-detail" onclick="updateQuantityInputDetail()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                Masukkan Keranjang
                            </button>
                        </form>
                        @else
                        <button class="btn-disabled-detail" disabled>
                            Stok Habis
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function changeImageDetail(src, thumbnail) {
    document.getElementById('mainImageDetail').src = src;

    // Remove active class from all thumbnails
    document.querySelectorAll('.thumbnail-detail').forEach(t => t.classList.remove('active'));

    // Add active class to clicked thumbnail
    thumbnail.classList.add('active');
}

function increaseQtyDetail(max) {
    const qtyInput = document.getElementById('quantityDetail');
    let currentQty = parseInt(qtyInput.value);
    if (currentQty < max) {
        qtyInput.value = currentQty + 1;
    }
}

function decreaseQtyDetail() {
    const qtyInput = document.getElementById('quantityDetail');
    let currentQty = parseInt(qtyInput.value);
    if (currentQty > 1) {
        qtyInput.value = currentQty - 1;
    }
}

function updateQuantityInputDetail() {
    const qty = document.getElementById('quantityDetail').value;
    document.getElementById('quantity-input-detail').value = qty;
}
</script>
@endsection
