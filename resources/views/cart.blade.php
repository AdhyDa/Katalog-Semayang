@extends('layouts.app')

@section('title', 'Keranjang Saya - AMKT Semayang')

@section('content')

<div class="hero-overlay-cart"></div>
<div class="breadcrumb">
    <a href=""{{ route('home') }}"">Beranda</a> &gt; Keranjang
</div>

<section class="cart-section">
    <div class="container">
        <h1 class="cart-title">Keranjang Saya</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cart) || count($cart) == 0)
            <!-- Empty Cart State -->
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#8FA957" stroke-width="1.5">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        <line x1="12" y1="9" x2="12" y2="13" stroke-linecap="round"></line>
                        <line x1="9" y1="11" x2="15" y2="11" stroke-linecap="round"></line>
                    </svg>
                </div>
                <h2>Keranjang sewa Anda masih kosong</h2>
                <p>Yuk, cari baju adat yang pas buat acara kamu!</p>
                <a href="{{ route('katalog') }}" class="btn btn-primary btn-lg">Lihat Katalog Sekarang</a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="cart-content">
                <div class="cart-items">
                    @foreach($cart as $id => $item)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ $item['image'] ?? asset('images/products/placeholder.jpg') }}" alt="{{ $item['name'] }}">
                        </div>
                        <div class="item-details" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                            <h3>{{ $item['name'] }}</h3>
                            <p class="item-price">Rp {{ number_format($item['price'], 0, ',', '.') }} <span class="item-duration">/ {{ $item['duration'] }}</span></p>
                            <p class="item-subtotal">Subtotal: <span class="quantity-text">{{ $item['quantity'] }}</span> Pesanan x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-control">
                                <button class="qty-btn minus" onclick="updateQuantity({{ $id }}, -1)">-</button>
                                <input type="number" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" id="qty-{{ $id }}" readonly>
                                <button class="qty-btn plus" onclick="updateQuantity({{ $id }}, 1)">+</button>
                            </div>
                            <button class="btn-remove" onclick="removeItem({{ $id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Total Harga Dasar</span>
                        <span class="summary-price">Rp <span id="total-price">{{ number_format($total, 0, ',', '.') }}</span></span>
                    </div>
                    <p class="summary-note">* Belum termasuk biaya tambahan durasi bila melebihi batas</p>

                    <div class="summary-actions">
                        <div class="summary-action-back">
                            <a href="{{ route('katalog') }}" class="btn btn-outline btn-block">Kembali Pilih Kostum</a>
                        </div>
                        <div class="summary-action-checkout">
                            @auth
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Lanjut ke Checkout</a>
                            @else
                                <a href="{{ route('login') }}?redirect=checkout" class="btn btn-primary btn-block">Lanjut ke Checkout</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Hidden forms for AJAX-like behavior -->
@foreach($cart as $id => $item)
<form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach

<script>
function updateQuantity(id, change) {
    const qtyInput = document.getElementById('qty-' + id);
    let currentQty = parseInt(qtyInput.value);
    let newQty = currentQty + change;
    const maxStock = parseInt(qtyInput.getAttribute('max'));

    if (newQty < 1) newQty = 1;
    if (newQty > maxStock) newQty = maxStock;

    if (newQty !== currentQty) {
        fetch('/cart/update/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: new URLSearchParams({
                '_method': 'PUT',
                'quantity': newQty
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                qtyInput.value = data.quantity;
                updateSubtotal(id, data.quantity);
                updateTotal();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function updateSubtotal(id, quantity) {
    const itemDetails = document.querySelector(`.item-details[data-id="${id}"]`);
    const price = parseInt(itemDetails.getAttribute('data-price'));
    const subtotalText = itemDetails.querySelector('.quantity-text');
    subtotalText.textContent = quantity;
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.item-details').forEach(item => {
        const price = parseInt(item.getAttribute('data-price'));
        const quantity = parseInt(item.querySelector('.quantity-text').textContent);
        total += price * quantity;
    });
    document.getElementById('total-price').textContent = total.toLocaleString('id-ID');
}

function removeItem(id) {
    if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
        document.getElementById('remove-form-' + id).submit();
    }
}
</script>
@endsection
