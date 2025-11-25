@extends('layouts.app')

@section('title', 'AMKT Semayang - Sewa Baju Adat Kaltim Terlengkap')

@section('content')

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-background">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Background Baju Adat Kalimantan Timur">
    </div>
    <div class="container">
        <div class="hero-content">
            <h1>Sewa Baju Adat Kaltim Terlengkap</h1>
            <p class="subtitle">Dikelola oleh AMKT Semayang. Koleksi otentik, terawat, dan harga bersahabat untuk mahasiswa & umum.</p>
            <button class="btn btn-white btn-lg dropdown-toggle" onclick="scrollToKoleksi()">
                Lihat Semua Koleksi
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="arrow-down">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <script>
                function scrollToKoleksi() {
                    document.getElementById('koleksi').scrollIntoView({ behavior: 'smooth' });
                }
            </script>
        </div>
    </div>
</section>

<section class="intro">
    <div class="container text-center">
        <h2>Keanggunan Adat Kalimantan untuk <br> Momen Spesial Anda</h2>
        <p>Kami menyediakan baju adat dari Kalimantan Timur yang cocok digunakan untuk <br> anak-anak hingga dewasa.</p>
    </div>
</section>

<section class="koleksi" id="koleksi">
    <div class="container text-center">
        <h2>Telusuri Koleksi Kami</h2>
    </div>

    <div class="container">
        <div class="koleksi-grid">
            <div class="koleksi-card">
                <div class="card-image">
                    <img src="{{ asset('images/koleksi-pria.jpg') }}" alt="Koleksi Pria">
                </div>
                <div class="card-content">
                    <h3>Koleksi Pria</h3>
                    <p class="price">Harga Sewa: Rp 55.000 / 3 hari</p>
                    <a href="{{ route('katalog.pria') }}" class="btn btn-outline">Lihat Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="arrow-right">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="koleksi-card">
                <div class="card-image">
                    <img src="{{ asset('images/koleksi-wanita.jpg') }}" alt="Koleksi Wanita">
                </div>
                <div class="card-content">
                    <h3>Koleksi Wanita</h3>
                    <p class="price">Harga Sewa: Rp 75.000 / 3 hari</p>
                    <a href="{{ route('katalog.wanita') }}" class="btn btn-outline">Lihat Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="arrow-right">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="koleksi-card">
                <div class="card-image">
                    <img src="{{ asset('images/aksesoris.jpg') }}" alt="Aksesoris & Pelengkap">
                </div>
                <div class="card-content">
                    <h3>Aksesoris & Pelengkap</h3>
                    <p class="price">Harga Sewa: Rp 5.000 - Rp 40.000 / 3 hari</p>
                    <a href="{{ route('katalog.aksesoris') }}" class="btn btn-outline">Lihat Koleksi
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="arrow-right">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cara-sewa-section">
    <div class="image-cara-sewa">
        <div class="image-background">
            <img src="{{ asset('images/hero.jpeg') }}" alt="Background Baju Adat Kalimantan Timur">
        </div>
        <div class="image-overlay"></div>
        <div class="image-content">
            <h2>Cara Menyewa Baju Adat<br>di AMKT Semayang</h2>
        </div>
    </div>

    <div class="steps-container">
        <div class="steps-grid">
            <div class="step">
                <div class="step-image">
                    <img src="{{ asset('images/step-1.jpg') }}" alt="Pilih Baju">
                </div>
                <span class="step-title">1. Pilih Baju</span>
                <p class="step-description">Cari dan pilih baju favoritmu di katalog.</p>
            </div>

            <div class="step">
                <div class="step-image">
                    <img src="{{ asset('images/step-2.jpg') }}" alt="Mengisi Form">
                </div>
                <span class="step-title">2. Mengisi Form</span>
                <p class="step-description">Isi formulir pesanan dan tentukan tanggal sewa.</p>
            </div>

            <div class="step">
                <div class="step-image">
                    <img src="{{ asset('images/step-3.png') }}" alt="Melakukan Pembayaran">
                </div>
                <span class="step-title">3. Melakukan Pembayaran</span>
                <p class="step-description">Lakukan pembayaran sesuai dengan metode yang tersedia</p>
            </div>

            <div class="step">
                <div class="step-image">
                    <img src="{{ asset('images/step-4.jpg') }}" alt="Mengambil Baju">
                </div>
                <span class="step-title">4. Mengambil Baju</span>
                <p class="step-description">Ambil bajumu di tempat kami</p>
            </div>
        </div>

        <a href="{{ route('cara-sewa') }}" class="btn-selengkapnya">Lihat Selengkapnya
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="arrow-right">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </a>
    </div>
</section>

<section class="keunggulan">
    <div class="container">
        <h2 class="text-center">Mengapa Harus Sewa di Katalog Semayang</h2>
        <div class="keunggulan-grid">
            <div class="keunggulan-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-img">
                        <path d="M17 14h.01"/><path d="M7 7h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14"/>
                    </svg>
                </div>
                <h3>Harga Mahasiswa</h3>
                <p>Tarif sewa sangat bersahabat, dirancang khusus agar terjangkau bagi pelajar, mahasiswa, dan umum.</p>
            </div>
            <div class="keunggulan-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-img">
                        <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                    </svg>
                </div>
                <h3>Koleksi Otentik</h3>
                <p>Dikelola langsung oleh putra-putri Kaltim, menjamin keaslian detail motif dan aksesoris setiap baju.</p>
            </div>
            <div class="keunggulan-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon-img">
                        <path fill-rule="evenodd" d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3>Bersih & Wangi</h3>
                <p>Kebersihan adalah prioritas. Setiap kostum di-laundry dan disetrika uap sebelum diserahkan.</p>
            </div>
            <div class="keunggulan-card">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-img">
                        <path d="M18 8c0 3.613-3.869 7.429-5.393 8.795a1 1 0 0 1-1.214 0C9.87 15.429 6 11.613 6 8a6 6 0 0 1 12 0"/><circle cx="12" cy="8" r="2"/><path d="M8.714 14h-3.71a1 1 0 0 0-.948.683l-2.004 6A1 1 0 0 0 3 22h18a1 1 0 0 0 .948-1.316l-2-6a1 1 0 0 0-.949-.684h-3.712"/>
                    </svg>
                </div>
                <h3>Lokasi Strategis</h3>
                <p>Pengambilan dan pengembalian mudah di Lobi Asrama AMKT Semayang.</p>
            </div>
        </div>
    </div>
</section>

<section class="dokumentasi">
    <h2 class="text-center">Dokumentasi</h2>
    <div class="marquee-container">
        <div class="marquee-content">
            <div class="dok-item">
                <img src="{{ asset('images/doku-1.jpg') }}" alt="Dokumentasi 1">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-2.jpg') }}" alt="Dokumentasi 2">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-3.jpg') }}" alt="Dokumentasi 3">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-4.jpg') }}" alt="Dokumentasi 4">
            </div>
            <div class="dok-item-land">
                <img src="{{ asset('images/doku-5.jpeg') }}" alt="Dokumentasi 5">
            </div>
            <div class="dok-item-land">
                <img src="{{ asset('images/doku-6.jpeg') }}" alt="Dokumentasi 6">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-7.jpg') }}" alt="Dokumentasi 7">
            </div>

            <div class="dok-item">
                <img src="{{ asset('images/doku-1.jpg') }}" alt="Dokumentasi 1">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-2.jpg') }}" alt="Dokumentasi 2">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-3.jpg') }}" alt="Dokumentasi 3">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-4.jpg') }}" alt="Dokumentasi 4">
            </div>
            <div class="dok-item-land">
                <img src="{{ asset('images/doku-5.jpeg') }}" alt="Dokumentasi 5">
            </div>
            <div class="dok-item-land">
                <img src="{{ asset('images/doku-6.jpeg') }}" alt="Dokumentasi 6">
            </div>
            <div class="dok-item">
                <img src="{{ asset('images/doku-7.jpg') }}" alt="Dokumentasi 7">
            </div>
        </div>
    </div>
</section>

<section class="testimoni">
    <div class="container">
        <h2 class="text-center">Apa Kata Mereka?</h2>
        <div class="testimoni-grid">
            <div class="testimoni-card">
                <p>"Bajunya bersih dan bagus banget! Pelayanannya ramah. Puas banget sewa di sini."</p>
                <strong>- Andini, Samarinda.</strong>
            </div>
            <div class="testimoni-card">
                <p>"Bajunya bersih dan bagus banget! Pelayanannya ramah. Puas banget sewa di sini."</p>
                <strong>- Andini, Samarinda.</strong>
            </div>
            <div class="testimoni-card">
                <p>"Bajunya bersih dan bagus banget! Pelayanannya ramah. Puas banget sewa di sini."</p>
                <strong>- Andini, Samarinda.</strong>
            </div>
        </div>
    </div>
</section>

@endsection
