@extends('layouts.app')

@section('title', 'Cara Sewa - AMKT Semayang')

@section('content')
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-background">
        <img src="{{ asset('images/hero.jpeg') }}" alt="Background Baju Adat Kalimantan Timur">
    </div>
    <div class="container">
        <div class="hero-content-index">
            <h1>Panduan Penyewaan</h1>
            <p class="subtitle">Proses mudah, cepat, dan fleksibel untuk kamu yang ingin tampil membanggakan budaya Indonesia!</p>
</section>

<!-- Steps Section -->
<section class="cara-sewa-steps">
    <div class="container">
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <img src="{{ asset('images/icons/icon-search.svg') }}" alt="Pilih Baju">
                </div>
                <h3>Pilih Baju</h3>
                <p>Cari dan pilih baju favoritmu di katalog.</p>
            </div>

            <div class="step-card">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <img src="{{ asset('images/icons/icon-form.svg') }}" alt="Mengisi Form">
                </div>
                <h3>Mengisi Form</h3>
                <p>Isi formulir pesanan dan tentukan tanggal sewa.</p>
            </div>

            <div class="step-card">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <img src="{{ asset('images/icons/icon-payment.svg') }}" alt="Pembayaran">
                </div>
                <h3>Melakukan Pembayaran</h3>
                <p>Lakukan pembayaran sesuai dengan metode yang tersedia</p>
            </div>

            <div class="step-card">
                <div class="step-number">4</div>
                <div class="step-icon">
                    <img src="{{ asset('images/icons/icon-pickup.svg') }}" alt="Mengambil Baju">
                </div>
                <h3>Mengambil Baju</h3>
                <p>Ambil bajumu di tempat kami</p>
            </div>
        </div>
    </div>
</section>

<!-- Syarat Ketentuan Section -->
<section class="syarat-ketentuan">
    <div class="container">
        <h2>Syarat & Ketentuan</h2>

        <div class="ketentuan-wrapper">
            <!-- Syarat Umum -->
            <div class="ketentuan-box">
                <ol>
                    <li>Penyewa memberikan kartu identitas (KTP/SIM/KTM asli) sebagai jaminan</li>
                    <li>Penyewa wajib membayar DP minimal 50% dari total harga sewa dan mendapat nota penyewaan</li>
                    <li>Batas waktu peminjaman maksimal 3 hari terhitung dari baju adat diambil penyewa. Jika melebihi dari batas waktu yang telah ditentukan, dikenakan denda Rp. 15.000,00/ hari (seluruh item)</li>
                    <li>Jika penyewa ingin memperpanjang masa penyewaan, dapat menghubungi CP maksimal H-1 dan dikenakan biaya tambahan Rp. 5.000,00 / hari (seluruh item)</li>
                    <li>Setiap item yang disewa harus dikembalikan sesuai dengan kondisi awal. Jika terdapat kerusakan/hilang maka penyewa wajib mengganti dengan barang yang serupa</li>
                    <li>Dengan melakukan pembayaran untuk penyewaan baju adat, maka penyewa dianggap telah menyetujui seluruh ketentuan yang telah disebutkan diatas</li>
                </ol>
            </div>

            <!-- Khusus ORDA KALTIM -->
        <h3>Khusus ORDA KALTIM</h3>
            <div class="ketentuan-box special">
                <ol>
                    <li>Tidak dikenakan biaya peminjaman</li>
                    <li>Wajib konfirmasi maksimal H-1 peminjaman serta melampirkan surat peminjaman dari AMKT/Orda Kaltim yang bersangkutan dan ditujukan kepada AMKT Semayang Malang</li>
                    <li>Batas waktu peminjaman maksimal 3 hari terhitung dari barang diambil. Jika melebihi dari batas waktu yang telah ditentukan, dikenakan denda Rp. 15.000,00 / hari (seluruh item)</li>
                    <li>Jika ingin memperpanjang masa penyewaan, dapat menghubungi CP maksimal H-1 dan tidak dikenakan biaya tambahan</li>
                    <li>Setiap item yang dipinjam harus dikembalikan sesuai dengan kondisi awal. Jika terdapat kerusakan/hilang, maka wajib mengganti dengan barang yang serupa</li>
                    <li>Dengan melakukan peminjaman baju adat, maka yang bersangkutan dianggap telah menyetujui seluruh ketentuan yang telah disebutkan di atas</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <h2>Frequently Asked Questions</h2>

        <div class="faq-list">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Q: Apakah baju yang disewa sudah bersih?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>A: Tentu! Semua baju sudah kami laundry dan setrika uap. Baju diterima dalam keadaan wangi dan siap pakai.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Q: Pembayarannya bisa pakai apa saja?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>A: Kami menerima pembayaran melalui transfer bank, e-wallet (OVO, GoPay, Dana), dan tunai.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Q: Bagaimana jika saya terlambat mengembalikan?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>A: Keterlambatan pengembalian akan dikenakan denda Rp. 15.000/hari untuk seluruh item yang disewa.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Q: Apa yang terjadi jika baju rusak atau aksesoris hilang?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>A: Penyewa wajib mengganti dengan barang yang serupa atau membayar biaya penggantian sesuai nilai barang.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Q: Apakah bajunya boleh saya cuci/setrika sendiri?</h3>
                    <span class="faq-toggle">+</span>
                </div>
                <div class="faq-answer">
                    <p>A: Tidak disarankan. Kembalikan baju dalam kondisi seperti saat diterima, dan kami akan membersihkannya dengan cara yang tepat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <p class="cta-text">
            Sudah Paham?
            <a href="{{ route('katalog') }}" class="cta-link">Mulai Pilih Baju Sekarang</a>
        </p>
    </div>
</section>

<script>
    // FAQ Toggle
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const toggle = item.querySelector('.faq-toggle');

        question.addEventListener('click', function() {
            // Close other FAQs
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                    otherItem.querySelector('.faq-toggle').textContent = '+';
                }
            });

            // Toggle current FAQ
            item.classList.toggle('active');

            if (item.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                toggle.textContent = '+';
            } else {
                answer.style.maxHeight = null;
                toggle.textContent = '+';
            }
        });
    });
</script>
@endsection
