@extends('layouts.app')

@section('title', 'Tentang Kami - AMKT Semayang')

@section('content')
<!-- Hero Tentang -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-background">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Background Baju Adat Kalimantan Timur">
    </div>
    <div class="container">
        <div class="hero-content-index">
            <h1>Mengenal Katalog Semayang</h1>
            <p class="subtitle">Inisiatif mahasiswa perantauan dalam melestarikan budaya Kalimantan Timur di tanah rantau.</p>
        </div>
</section>

<!-- Siapa Kami Section -->
<section class="siapa-kami">
    <div class="container">
        <div class="siapa-grid">
            <div class="siapa-image">
                <img src="{{ asset('images/dokumentasi/doku-1.jpg') }}" alt="AMKT Semayang">
            </div>
            <div class="siapa-content">
                <h2>Siapa Kami?</h2>
                <p>Katalog Semayang adalah unit usaha kreatif yang dikelola langsung oleh keluarga besar <b>Asrama Mahasiswa Kalimantan Timur (AMKT) Semayang</b>.</p>
                <p>Berawal dari koleksi inventaris seni tari asrama, kami berinisiatif membuka penyewaan publik. Tujuannya sederhana: memudahkan masyarakat mengakses baju adat Kaltim yang otentik dengan harga yang sangat terjangkau, sekaligus mendukung kegiatan kemahasiswaan kami.</p>
            </div>
        </div>
    </div>
</section>

<!-- Nilai Kami Section -->
<section class="nilai-kami">
    <div class="container">
        <h2 class="text-center">Nilai Kami</h2>
        <div class="nilai-grid">
            <div class="nilai-card">
                <div class="nilai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-green-700 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S13.622 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S10.378 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                    </svg>
                </div>
                <h3>Pelestarian</h3>
                <p>Memperkenalkan kekayaan motif dan busana adat Dayak, Kutai, dan pesisir kepada khalayak luas.</p>
            </div>

            <div class="nilai-card">
                <div class="nilai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5ZM16.5 15a.75.75 0 0 1 .712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 0 1 0 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 0 1-1.422 0l-.395-1.183a1.5 1.5 0 0 0-.948-.948l-1.183-.395a.75.75 0 0 1 0-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0 1 16.5 15Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3>Terawat</h3>
                <p>Menjamin setiap helai kain dan aksesoris dalam kondisi prima, bersih, dan layak pakai untuk momen spesial Anda.</p>
            </div>

            <div class="nilai-card">
                <div class="nilai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>

                </div>
                <h3>Kekeluargaan</h3>
                <p>Dikelola dengan asas kekeluargaan khas asrama, memberikan pelayanan yang ramah dan fleksibel.</p>
            </div>
        </div>
    </div>
</section>

<!-- Lokasi & Kontak Section -->
<section class="lokasi-kontak">
    <div class="container">
        <h2 class="text-center">Kunjungi & Hubungi Kami</h2>
        <div class="lokasi-grid">
            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-box">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Lokasi Kami</h3>
                        <p>Jl. Bondowoso No.27, RT.11/RW.2, Gading Kasri, Kec. Klojen, Kota Malang, Jawa Timur 65115</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Jam Operasional</h3>
                        <p>Setiap Hari: 08.00 - 20.30 WIB</p>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h3>Hubungi Kami</h3>
                        <p>WhatsApp: 0822-5442-9990</p>
                        <p>Instagram: @amktsemayang</p>
                        <p>Facebook: @amktsemayang</p>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.302089547262!2d112.61295701019792!3d-7.967699692024056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788283dfaa776f%3A0x2057747e05c610f8!2sAMKT%20Semayang%20(%20Aspuri%20)!5e0!3m2!1sid!2sid!4v1763959199366!5m2!1sid!2sid"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="our-team">
    <div class="container">
        <h2 class="text-center">Our Team</h2>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-photo">
                    <img src="{{ asset('images/team/aluna.jpeg') }}" alt="Aluna">
                </div>
                <h3>Aluna</h3>
                <p>Mahasiswa</p>
            </div>

            <div class="team-card">
                <div class="team-photo">
                    <img src="{{ asset('images/team/adhyaksa.jpg') }}" alt="Adhyaksa">
                </div>
                <h3>Adhyaksa</h3>
                <p>Mahasiswa</p>
            </div>

            <div class="team-card">
                <div class="team-photo">
                    <img src="{{ asset('images/team/jenny.jpg') }}" alt="Jenny">
                </div>
                <h3>Jenny</h3>
                <p>Mahasiswa</p>
            </div>
        </div>
    </div>
</section>
@endsection
