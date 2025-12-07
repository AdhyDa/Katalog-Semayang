<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AMKT Semayang - Sewa Baju Adat Kaltim')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>

    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo AMKT Semayang" class="logo-img">
                    <h2>AMKT Semayang</h2>
                </a>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog*') ? 'active' : '' }}">Katalog</a></li>
                <li><a href="{{ route('cara-sewa') }}" class="{{ Request::is('cara-sewa') ? 'active' : '' }}">Cara Sewa</a></li>
                <li><a href="{{ route('tentang') }}" class="{{ Request::is('tentang') ? 'active' : '' }}">Tentang Kami</a></li>
            </ul>
            <div class="nav-buttons">
                @if(Auth::check() && Auth::user()->role != 'admin')
                    <a href="{{ route('cart') }}" class="btn-cart">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="8" cy="21" r="1"/>
                            <circle cx="19" cy="21" r="1"/>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                        </svg>
                        @php
                            $cart = Session::get('cart', []);
                            $cartCount = count($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                @endif
            </div>
            <div class="nav-buttons-auth">
                @auth
                    <div class="user-dropdown">
                        <button class="user-btn">
                            <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </button>
                        <div class="dropdown-menu">
                            @if(Auth::check() && Auth::user()->role == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Dashboard</a>
                                <a href="{{ route('admin.orders') }}" class="dropdown-item">Kelola Pesanan</a>
                                <a href="{{ route('admin.products.index') }}" class="dropdown-item">Kelola Produk</a>
                                <a href="{{ route('admin.transactions') }}" class="dropdown-item">Transaksi</a>
                            @else
                                <a href="{{ route('customer.profile') }}" class="dropdown-item">Profil Saya</a>
                                <a href="{{ route('customer.orders') }}" class="dropdown-item">Pesanan Saya</a>
                            @endif
                            <hr class="dropdown-divider">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-nav">Login</a>
                    <a href="{{ route('daftar') }}" class="btn btn-primary-nav">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-top-edge"></div>
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-logo-section">
                        <div class="footer-logo">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo AMKT Semayang">
                        </div>
                        <div class="footer-description">
                            <p>Platform penyewaan baju adat Kalimantan Timur yang dikelola oleh Asrama Mahasiswa AMKT Semayang. Melestarikan budaya dengan harga terjangkau.</p>
                        </div>
                    </div>

                    <div class="jam-operasional">
                        <h4>Jam Operasional</h4>
                        <p>Setiap Hari: 08.00 – 20.30 WIB</p>
                    </div>
                </div>

                <div class="footer-col-menu">
                    <h4>Menu Cepat:</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('katalog') }}">Katalog</a></li>
                        <li><a href="{{ route('cara-sewa') }}">Cara Sewa</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Temukan Kami di:</h4>
                    <ul class="contact-info">
                        <li><strong>WhatsApp:</strong> 0822-5442-9990</li>
                        <li><strong>Instagram:</strong> @amktsemayang</li>
                        <li><strong>Facebook:</strong> @amktsemayang</li>
                        <li style="margin-top: 15px;"><strong>Alamat:</strong><br>Jl. Bondowoso no.27, GadingKasri, Klojen</li>
                    </ul>

                    <div class="social-icons">
                        <a href="https://wa.me/6282254429990" class="social-icon" target="_blank" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://instagram.com/amktsemayang" class="social-icon" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://facebook.com/amktsemayang" class="social-icon" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-edge"></div>
        <div class="footer-bottom">
            <p>© 2025 Katalog Semayang. All Rights Reserved.</p>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
