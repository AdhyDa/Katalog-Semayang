@extends('layouts.app')

@section('title', 'Pesanan Berhasil - AMKT Semayang')

@section('content')
<section class="success-section">
    <div class="container">
        <div class="success-card">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>

            <h1>Pesanan Berhasil Diajukan!</h1>
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
                <a href="{{ route('home') }}" class="btn btn-outline">Kembali ke Beranda</a>
                <a href="{{ route('katalog') }}" class="btn btn-primary">Lihat Katalog Lagi</a>
            </div>
        </div>
    </div>
</section>

<style>
.success-section {
    padding: 100px 0;
    background: linear-gradient(135deg, rgba(126, 154, 62, 0.05) 0%, rgba(184, 212, 111, 0.05) 100%);
    min-height: calc(100vh - 70px);
    display: flex;
    align-items: center;
}

.success-card {
    max-width: 700px;
    margin: 0 auto;
    background-color: white;
    padding: 60px 40px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 30px;
    background: linear-gradient(135deg, rgba(126, 154, 62, 0.1) 0%, rgba(184, 212, 111, 0.1) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-icon svg {
    stroke: rgba(126, 154, 62, 1);
}

.success-card h1 {
    font-family: 'Bebas Neue';
    font-size: 36px;
    color: rgba(126, 154, 62, 1);
    margin-bottom: 15px;
}

.success-message {
    font-family: 'Georgia';
    font-size: 16px;
    color: var(--text-gray);
    margin-bottom: 40px;
    line-height: 1.6;
}

.success-info {
    display: grid;
    gap: 25px;
    margin-bottom: 40px;
    text-align: left;
}

.info-item {
    display: flex;
    gap: 20px;
    padding: 20px;
    background-color: #F9F9F9;
    border-radius: 10px;
    border-left: 4px solid rgba(126, 154, 62, 1);
}

.info-item svg {
    flex-shrink: 0;
    stroke: rgba(126, 154, 62, 1);
}

.info-item h3 {
    font-family: 'Montserrat';
    font-size: 16px;
    color: var(--text-dark);
    margin-bottom: 8px;
    font-weight: 600;
}

.info-item p {
    font-family: 'Georgia';
    font-size: 14px;
    color: var(--text-gray);
    margin: 0;
    line-height: 1.6;
}

.success-note {
    background-color: #FFF3E0;
    padding: 25px;
    border-radius: 10px;
    border-left: 4px solid #FF9800;
    margin-bottom: 40px;
    text-align: left;
}

.success-note h4 {
    font-family: 'Montserrat';
    font-size: 16px;
    color: var(--text-dark);
    margin-bottom: 15px;
    font-weight: 600;
}

.success-note ol {
    margin-left: 20px;
    font-family: 'Georgia';
    font-size: 14px;
    color: var(--text-dark);
    line-height: 1.8;
}

.success-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.success-actions .btn {
    padding: 12px 30px;
    font-family: 'Mulish';
    font-weight: 600;
}

@media (max-width: 768px) {
    .success-card {
        padding: 40px 25px;
    }

    .success-card h1 {
        font-size: 28px;
    }

    .success-actions {
        flex-direction: column;
    }

    .success-actions .btn {
        width: 100%;
    }
}
</style>
@endsection
