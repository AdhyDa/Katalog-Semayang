@extends('layouts.app')

@section('title', 'Formulir Penyewaan - AMKT Semayang')

@section('content')
<div class="hero-overlay-cart"></div>
<div class="breadcrumb">
    <a href="{{ route('home') }}">Beranda</a> &gt;
    <a href="{{ route('cart') }}">Keranjang</a> &gt; Checkout
</div>

<section class="checkout-section">
    <div class="container">
        <div class="checkout-grid">
            <!-- Left: Form -->
            <div class="checkout-form-wrapper">
                <div class="checkout-header">
                    <h1>Formulir Penyewaan</h1>
                    <p>Silakan isi data Anda dengan benar</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" id="checkoutForm">
                    @csrf

                    <!-- User Type Selection -->
                    <div class="form-section">
                        <div class="user-type-selection">
                            <label class="user-type-card">
                                <input type="radio" name="user_type" value="umum" checked onchange="handleUserTypeChange()">
                                <div class="card-content">
                                    <h3>Penyewa Umum</h3>
                                </div>
                            </label>
                            <label class="user-type-card">
                                <input type="radio" name="user_type" value="organisasi" onchange="handleUserTypeChange()">
                                <div class="card-content">
                                    <h3>AMKT / Orda Kaltim</h3>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Data Penyewa -->
                    <div class="form-section">
                        <h2>Data Penyewa</h2>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                class="form-control"
                                placeholder="Contoh: Budi Santoso"
                                value="{{ old('nama_lengkap') }}"
                                oninput="this.value = this.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase())"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Handphone <span class="required">*</span></label>
                            <input
                                type="tel"
                                id="nomor_telepon"
                                name="nomor_telepon"
                                class="form-control"
                                placeholder="08123456789"
                                value="{{ old('nomor_telepon') }}"
                                pattern="08[0-9]{6,11}"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="nama_instansi">Nama Instansi</label>
                            <input
                                type="text"
                                id="nama_instansi"
                                name="nama_instansi"
                                class="form-control"
                                placeholder="Contoh: AMKT Semayang"
                                value="{{ old('nama_instansi') }}">
                        </div>
                    </div>

                    <!-- Rencana Peminjaman -->
                    <div class="form-section">
                        <h2>Rencana Peminjaman</h2>

                        <div class="form-group">
                            <label for="tanggal_ambil">Tanggal Ambil <span class="required">*</span></label>
                            <input
                                type="date"
                                id="tanggal_ambil"
                                name="tanggal_ambil"
                                class="form-control"
                                min="{{ date('Y-m-d') }}"
                                value="{{ old('tanggal_ambil') }}"
                                onchange="calculateTanggalKembali()"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="durasi_sewa">Durasi Sewa</label>
                            <select id="durasi_sewa" name="durasi_sewa" class="form-control" onchange="handleDurasiChange()" required>
                                <option value="3 hari">3 Hari - Harga Normal</option>
                                <option value="4 hari">4 Hari (+Rp 5.000/item)</option>
                                <option value="5 hari">5 Hari (+Rp 10.000/item)</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group" id="durasi_custom_group" style="display: none;">
                            <label for="durasi_custom">Durasi Custom (Hari) <span class="required">*</span></label>
                            <input
                                type="number"
                                id="durasi_custom"
                                name="durasi_custom"
                                class="form-control"
                                min="6"
                                max="30"
                                placeholder="Minimal 6 hari"
                                onchange="calculateTanggalKembali(); calculateTotal();">
                            <small>Minimal 6 hari, maksimal 30 hari</small>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kembali">Tanggal Kembali</label>
                            <input
                                type="date"
                                id="tanggal_kembali"
                                class="form-control"
                                readonly>
                        </div>
                    </div>

                    <!-- Dokumen Jaminan -->
                    <div class="form-section">
                        <h2>Dokumen Jaminan</h2>

                        <div class="form-group">
                            <label for="dokumen_jaminan">Upload Foto Scan (KTP/KTM/SIM) <span class="required">*</span></label>
                            <div class="file-upload-wrapper">
                                <input
                                    type="file"
                                    id="dokumen_jaminan"
                                    name="dokumen_jaminan"
                                    accept="image/jpeg,image/jpg,image/png"
                                    onchange="previewFile(this, 'preview_jaminan')"
                                    required>
                                <label for="dokumen_jaminan" class="file-upload-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Upload gambar (Drag atau klik)</span>
                                </label>
                                <div id="preview_jaminan" class="file-preview"></div>
                            </div>
                            <small>Format: JPG, PNG, JPEG. Maksimal 1MB</small>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="form-section" id="payment_section">
                        <h2>Pembayaran</h2>
                        <p>Silakan pilih metode pembayaran Anda</p>

                        <div class="payment-methods">
                            <label class="payment-method">
                                <input type="radio" name="metode_pembayaran" value="bri" onchange="showPaymentInfo('bri')" required>
                                <img src="{{ asset('images/payment/bri.png') }}" alt="BRI">
                            </label>
                            <label class="payment-method">
                                <input type="radio" name="metode_pembayaran" value="bca" onchange="showPaymentInfo('bca')">
                                <img src="{{ asset('images/payment/bca.png') }}" alt="BCA">
                            </label>
                            <label class="payment-method">
                                <input type="radio" name="metode_pembayaran" value="dana" onchange="showPaymentInfo('dana')">
                                <img src="{{ asset('images/payment/dana.png') }}" alt="DANA">
                            </label>
                        </div>

                        <div id="payment_info" class="payment-info" style="display: none;">
                            <!-- Will be populated by JavaScript -->
                        </div>

                        <!-- Upload Bukti Transfer (Umum) / Surat Peminjaman (Organisasi) -->
                        <div class="form-group" id="bukti_transfer_group">
                            <label for="bukti_transfer">Upload Bukti Transfer (DP/Lunas) <span class="required">*</span></label>
                            <div class="file-upload-wrapper">
                                <input
                                    type="file"
                                    id="bukti_transfer"
                                    name="bukti_transfer"
                                    accept="image/jpeg,image/jpg,image/png"
                                    onchange="previewFile(this, 'preview_transfer')">
                                <label for="bukti_transfer" class="file-upload-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Upload gambar (Drag atau klik)</span>
                                </label>
                                <div id="preview_transfer" class="file-preview"></div>
                            </div>
                            <small class="help-text-transfer">Foto/gambar bukti pembayaran dengan keterangan lengkap (Nama lengkap). Ukuran maks: 1 MB</small>
                        </div>

                        <div class="form-group" id="surat_peminjaman_group" style="display: none;">
                            <label for="surat_peminjaman">Upload Surat Peminjaman Resmi <span class="required">*</span></label>
                            <div class="file-upload-wrapper">
                                <input
                                    type="file"
                                    id="surat_peminjaman"
                                    name="surat_peminjaman"
                                    accept="image/jpeg,image/jpg,image/png"
                                    onchange="previewFile(this, 'preview_surat')">
                                <label for="surat_peminjaman" class="file-upload-label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    <span>Upload gambar (Drag atau klik)</span>
                                </label>
                                <div id="preview_surat" class="file-preview"></div>
                            </div>
                            <small class="help-text-surat" style="color: #DC3545;">Wajib melampirkan surat peminjaman resmi dari AMKT atau Pengurus ORDA yang bertanda tangan basah/stempel.</small>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="form-section">
                        <h2>Catatan</h2>
                        <div class="form-group">
                            <textarea
                                id="catatan"
                                name="catatan"
                                class="form-control"
                                rows="4"
                                placeholder="Contoh: Biaya titip ambil jam 4 sore atau Tolong sediakan ukuran M jika ada"
                                maxlength="500">{{ old('catatan') }}</textarea>
                            <small>Opsional. Maksimal 500 karakter</small>
                        </div>
                    </div>

                    <!-- Syarat & Ketentuan -->
                    <div class="form-section">
                        <label class="checkbox-label">
                            <input type="checkbox" name="syarat_ketentuan" required>
                            <span>Saya telah membaca dan menyetujui <a href="{{ route('cara-sewa') }}" target="_blank">Syarat & Ketentuan</a> sewa di Katalog Semayang.</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-checkout">AJUKAN SEWA SEKARANG</button>
                </form>
            </div>

            <!-- Right: Ringkasan -->
            <div class="checkout-summary">
                <h2>Ringkasan</h2>

                <div class="summary-items">
                    @foreach($cart as $item)
                    <div class="summary-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <div class="item-info">
                            <h4>{{ $item['name'] }}</h4>
                            <p>{{ $item['quantity'] }} Pasang</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="summary-divider"></div>

                <div class="summary-details">
                    <h3 class="summary-section-title">Jumlah Pesanan</h3>

                    <div class="summary-row">
                        <p id="subtotal_qty">{{ array_sum(array_column($cart, 'quantity')) }} Pasang x Rp {{ number_format($total / array_sum(array_column($cart, 'quantity')), 0, ',', '.') }}</p>
                        <span id="subtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row">
                        <span>Durasi Sewa</span>
                        <span id="durasi_text">3 Hari</span>
                    </div>

                    <div class="summary-row" id="biaya_tambahan_row" style="display: none;">
                        <p>Tambahan Biaya</p>
                        <span id="biaya_tambahan">Rp 0</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span id="total_full_amount" class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-divider"></div>

                    <div id="organisasi_section" style="display: none;">
                        <p class="free-charge-note">Fasilitas AMKT/ORDA (Free Charge)</p>
                    </div>

                    <!-- Pilih Nominal Bayar (Hanya untuk Umum) -->
                    <div id="nominal_bayar_section">
                        <h3 class="summary-section-title">Pilih Nominal Bayar</h3>

                        <div class="payment-option-wrapper">
                            <label class="payment-option-radio">
                                <input type="radio" name="nominal_bayar" value="lunas" checked onchange="updateTotalBayar()">
                                <div class="radio-content">
                                    <span class="radio-label">Bayar Lunas</span>
                                    <span class="radio-price" id="lunas_price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label class="payment-option-radio">
                                <input type="radio" name="nominal_bayar" value="dp" onchange="updateTotalBayar()">
                                <div class="radio-content">
                                    <span class="radio-label">Bayar DP</span>
                                    <span class="radio-price" id="dp_price">Rp {{ number_format($total * 0.5, 0, ',', '.') }}</span>
                                </div>
                            </label>
                        </div>

                        <p class="dp-note" id="dp_note" style="display: none;">
                            <small style="color: #DC3545;">Wajib transfer minimal 50% untuk booking</small>
                        </p>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-transfer-row">
                        <span>Total Yang Harus Ditransfer</span>
                        <span id="total_transfer_amount" class="total-transfer-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <p class="summary-note-lunas" id="pelunasan_note">Pembayaran Lunas</p>
                    <p class="summary-note-dp" id="pelunasan_dp_note" style="display: none;">Sisa bayar di tempat (Pelunasan) <span id="sisa_pelunasan">{{ number_format($total * 0.5, 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function get(id) {
    return document.getElementById(id);
    }

    function safe(el) {
        return el !== null && el !== undefined;
    }
    const cart = @json($cart);
    const baseTotal = {{ $total }};
    const itemCount = {{ array_sum(array_column($cart, 'quantity')) }};

    // Helper function to parse currency string to number
    function parseCurrency(string) {
        if (!string) return 0;
        return parseInt(string.replace(/[^0-9]/g, ''));
    }

    function handleUserTypeChange() {
        const userType = document.querySelector('input[name="user_type"]:checked').value;
        const paymentSection = document.getElementById('payment_section');
        const buktiTransferGroup = document.getElementById('bukti_transfer_group');
        const suratPeminjamanGroup = document.getElementById('surat_peminjaman_group');
        const organisasiSection = document.getElementById('organisasi_section');
        const nominalBayarSection = document.getElementById('nominal_bayar_section');
        const totalFullAmount = document.getElementById('total_full_amount');
        const subtotalElement = document.getElementById('subtotal');
        const biayaTambahanRow = document.getElementById('biaya_tambahan_row');
        const pelunasanNote = document.getElementById('pelunasan_note');
        const pelunasanDpNote = document.getElementById('pelunasan_dp_note');

        if (userType === 'organisasi') {
            paymentSection.style.display = 'none';
            buktiTransferGroup.style.display = 'none';
            document.getElementById('bukti_transfer').required = false;

            suratPeminjamanGroup.style.display = 'block';
            document.getElementById('surat_peminjaman').required = true;

            organisasiSection.style.display = 'block';
            nominalBayarSection.style.display = 'none';
            biayaTambahanRow.style.display = 'none';
            pelunasanNote.style.display = 'none';
            pelunasanDpNote.style.display = 'none';

            subtotalElement.innerHTML = '<s>Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal) + '</s>';
            totalFullAmount.textContent = 'Rp 0';
            document.getElementById('total_transfer_amount').textContent = 'Rp 0';

        } else { // User type is 'umum'
            paymentSection.style.display = 'block';
            buktiTransferGroup.style.display = 'block';
            document.getElementById('bukti_transfer').required = true;

            suratPeminjamanGroup.style.display = 'none';
            document.getElementById('surat_peminjaman').required = false;

            organisasiSection.style.display = 'none';
            if (safe(nominalBayarSection)) nominalBayarSection.style.display = 'block';

            // Ensure 'lunas' is the default selected for nominal_bayar
            document.querySelector('input[name="nominal_bayar"][value="lunas"]').checked = true;

            subtotalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal);
            calculateTotal();
            updateTotalBayar();
        }
    }

    function handleDurasiChange() {
        const durasiSewa = document.getElementById('durasi_sewa').value;
        const durasiCustomGroup = document.getElementById('durasi_custom_group');
        const durasiCustomInput = document.getElementById('durasi_custom');

        if (durasiSewa === 'lainnya') {
            durasiCustomGroup.style.display = 'block';
            durasiCustomInput.required = true;
        } else {
            durasiCustomGroup.style.display = 'none';
            durasiCustomInput.required = false;
            durasiCustomInput.value = '';
        }

        calculateTanggalKembali();
        calculateTotal();
    }

    function calculateTanggalKembali() {
        const tanggalAmbilInput = document.getElementById('tanggal_ambil');
        if (!tanggalAmbilInput.value) return;

        const tanggalAmbil = new Date(tanggalAmbilInput.value);
        const durasiSewa = document.getElementById('durasi_sewa').value;
        const durasiCustom = document.getElementById('durasi_custom').value;

        let durasi = 3;
        if (durasiSewa === 'lainnya' && durasiCustom && parseInt(durasiCustom) >= 6) {
            durasi = parseInt(durasiCustom);
        } else if (durasiSewa !== 'lainnya') {
            durasi = parseInt(durasiSewa.split(' ')[0]);
        }

        const tanggalKembali = new Date(tanggalAmbil);
        tanggalKembali.setDate(tanggalKembali.getDate() + durasi - 1);

        document.getElementById('tanggal_kembali').value = tanggalKembali.toISOString().split('T')[0];
        document.getElementById('durasi_text').textContent = durasi + ' Hari';
    }

    function calculateTotal() {
        const userType = document.querySelector('input[name="user_type"]:checked').value;
        if (userType === 'organisasi') {
            updateTotalBayar();
            return;
        }

        const durasiSewa = document.getElementById('durasi_sewa').value;
        const durasiCustom = document.getElementById('durasi_custom').value;

        let durasi = 3;
        if (durasiSewa === 'lainnya' && durasiCustom && parseInt(durasiCustom) >= 6) {
            durasi = parseInt(durasiCustom);
        } else if (durasiSewa !== 'lainnya') {
            durasi = parseInt(durasiSewa.split(' ')[0]);
        }

        let additionalCost = 0;
        if (durasi === 4) {
            additionalCost = 5000 * itemCount;
        } else if (durasi === 5) {
            additionalCost = 10000 * itemCount;
        } else if (durasi > 5) {
            additionalCost = (10000 + (durasi - 5) * 5000) * itemCount;
        }

        const total = baseTotal + additionalCost;

        const biayaTambahanRow = document.getElementById('biaya_tambahan_row');
        if (additionalCost > 0) {
            biayaTambahanRow.style.display = 'flex';
            document.getElementById('biaya_tambahan').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(additionalCost);
        } else {
            biayaTambahanRow.style.display = 'none';
        }

        document.getElementById('total_full_amount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        document.getElementById('lunas_price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        document.getElementById('dp_price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total * 0.5);

        updateTotalBayar();
    }

    function updateTotalBayar() {
        const userType = document.querySelector('input[name="user_type"]:checked').value;
        if (userType === 'organisasi') return;

        const nominalBayar = document.querySelector('input[name="nominal_bayar"]:checked').value;
        const totalText = document.getElementById('total_full_amount').textContent;
        const total = parseCurrency(totalText);

        const dpNote = document.getElementById('dp_note');
        const pelunasanNote = document.getElementById('pelunasan_note');
        const pelunasanDpNote = document.getElementById('pelunasan_dp_note');
        const totalTransferAmount = document.getElementById('total_transfer_amount');
        const sisaPelunasan = document.getElementById('sisa_pelunasan');

        if (nominalBayar === 'dp') {
            const dpAmount = total * 0.5;
            totalTransferAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(dpAmount);
            sisaPelunasan.textContent = new Intl.NumberFormat('id-ID').format(total - dpAmount);
            if (safe(dpNote)) dpNote.style.display = 'block';
            if (safe(pelunasanNote)) pelunasanNote.style.display = 'none';
            pelunasanDpNote.style.display = 'block';
        } else { // Lunas
            totalTransferAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            dpNote.style.display = 'none';
            pelunasanNote.style.display = 'block';
            pelunasanDpNote.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        handleUserTypeChange();
        calculateTanggalKembali();
        calculateTotal();
    });

    function previewFile(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            // Check file size (1MB = 1048576 bytes)
            if (file.size > 1048576) {
                alert('Ukuran file maksimal 1MB!');
                input.value = '';
                preview.innerHTML = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="preview-image">
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" onclick="removeFile('${input.id}', '${previewId}')" class="remove-preview">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <p>${file.name} (${(file.size / 1024).toFixed(2)} KB)</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    }

    function removeFile(inputId, previewId) {
        document.getElementById(inputId).value = '';
        document.getElementById(previewId).innerHTML = '';
    }

    function showPaymentInfo(method) {
        const paymentInfo = document.getElementById('payment_info');
        paymentInfo.style.display = 'block';

        const paymentData = {
            bri: {
                type: 'rekening',
                content: `
                    <div class="payment-details">
                        <h4>Transfer ke Rekening BRI:</h4>
                        <p class="account-number">1234-5678-9012-3456</p>
                        <p class="account-name">a.n. AMKT SEMAYANG</p>
                    </div>
                `
            },
            bca: {
                type: 'qr',
                content: `
                    <div class="payment-details">
                        <h4>Scan QR Code BCA:</h4>
                        <img src="${'{{ asset("images/payment/qr-bca.png") }}'}" alt="QR BCA" class="qr-code">
                    </div>
                `
            },
            dana: {
                type: 'qr',
                content: `
                    <div class="payment-details">
                        <h4>Scan QR Code DANA:</h4>
                        <img src="${'{{ asset("images/payment/qr-dana.png") }}'}" alt="QR DANA" class="qr-code">
                        <p class="account-number">0822-5442-9990</p>
                        <p class="account-name">a.n. AMKT SEMAYANG</p>
                    </div>
                `
            }
        };
        paymentInfo.innerHTML = paymentData[method].content;
    }
</script>
@endsection
