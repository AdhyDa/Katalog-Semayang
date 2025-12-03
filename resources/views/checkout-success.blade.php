@extends('layouts.app')

@section('title', 'Pesanan Berhasil - AMKT Semayang')

@section('content')
<div class="hero-overlay-cart"></div>
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

            </div>

            <h1>Pesanan Berhasil Diajukan!</h1>

            @if(session('order_number'))
                <div class="order-number-box">
                    <p>Nomor Pesanan Anda:</p>
                    <h2 class="order-number">{{ session('order_number') }}</h2>
                </div>
            @endif

            <p class="success-message">
                Terima kasih telah menyewa di AMKT Semayang. Pesanan Anda sedang kami proses.
            </p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="success-info">
                <div class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <div>
                        <h3>Pengambilan</h3>
                        <p>Lobi Asrama AMKT Semayang<br>Jl. Bondowoso no.27, GadingKasri, Klojen</p>
                    </div>
                </div>

                <div class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <div>
                        <h3>Jam Operasional</h3>
                        <p>Setiap Hari: 08.00 - 20.30 WIB</p>
                    </div>
                </div>

                <div class="info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <div>
                        <h3>Kontak Kami</h3>
                        <p>WhatsApp: 0822-5442-9990</p>
                    </div>
                </div>
            </div>

            <div class="success-note">
                <h4>Langkah Selanjutnya:</h4>
                <ol>
                    <li>Tim kami akan menghubungi Anda untuk konfirmasi pesanan</li>
                    <li>Siapkan dokumen jaminan (KTP/KTM/SIM asli) saat pengambilan</li>
                    <li>Datang ke lokasi sesuai jadwal yang telah ditentukan</li>
                </ol>
            </div>

            <div class="success-actions">
                <div class="success-actions-back">
                    <a href="{{ route('home') }}" class="btn btn-outline btn-block">Kembali ke Beranda</a>
                </div>
                <div class="success-actions-catalog">
                    <a href="{{ route('katalog') }}" class="btn btn-primary btn-block">Lihat Katalog Lagi</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
