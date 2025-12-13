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

                    <input type="hidden" name="metode_pembayaran" id="input_cod_method" value="cod" disabled>

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

                    <div class="form-section" id="payment_section">
                        <h2>Pembayaran</h2>
                        <p>Silakan pilih metode pembayaran Anda</p>

                        <div class="payment-methods">
                            @foreach(array_chunk($paymentMethods->toArray(), 3) as $row)
                                <div class="payment-row">
                                    @foreach($row as $method)
                                        <label class="payment-method">
                                            <input type="radio"
                                                name="metode_pembayaran"
                                                value="{{ $method['code'] }}"
                                                onchange="showPaymentInfo('{{ $method['code'] }}')"
                                                required>
                                            <img src="{{ asset($method['logo_image']) }}" alt="{{ $method['name'] }}">
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div id="payment_info" class="payment-info" style="display: none;">
                            </div>

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
                    </div>

                    <div class="form-section" id="section_surat_organisasi" style="display: none;">
                        <h2>Dokumen Organisasi</h2>
                        <div class="form-group"> <label for="surat_peminjaman">Upload Surat Peminjaman Resmi <span class="required">*</span></label>
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

                    <div class="form-section">
                        <label class="checkbox-label">
                            <input type="checkbox" name="syarat_ketentuan" value="1" required>
                            <span>Saya telah membaca dan menyetujui <a href="{{ route('cara-sewa') }}" target="_blank">Syarat & Ketentuan</a> sewa di Katalog Semayang.</span>
                        </label>
                    </div>

                    <input type="hidden" name="nominal_bayar" id="nominal_bayar_hidden" value="lunas">

                    <button type="submit" class="btn-submit-checkout" id="submitButton">
                        <span id="submitText">AJUKAN SEWA SEKARANG</span>
                        <span id="submitLoading" style="display: none;">
                            <svg class="spinner" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <circle class="spinner-circle" cx="12" cy="12" r="10" stroke="white" stroke-width="3" fill="none" />
                            </svg>
                            MEMPROSES...
                        </span>
                    </button>
                </form>
            </div>

            <div class="checkout-summary">
                <h2>Ringkasan</h2>

                <div class="summary-items">
                    @foreach($cart as $item)
                    <div class="summary-item">
                        <img src="{{ $item['image'] ? asset('images/' . $item['image']) : asset('images/placeholder.jpg') }}" alt="{{ $item['name'] }}">
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

                    <div id="nominal_bayar_section">
                        <h3 class="summary-section-title">Pilih Nominal Bayar</h3>

                        <div class="payment-option-wrapper">
                            <label class="payment-option-radio">
                                <input type="radio" name="nominal_bayar" value="lunas" checked onchange="document.getElementById('nominal_bayar_hidden').value = this.value; updateTotalBayar();">
                                <div class="radio-content">
                                    <span class="radio-label">Bayar Lunas</span>
                                    <span class="radio-price" id="lunas_price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label class="payment-option-radio">
                                <input type="radio" name="nominal_bayar" value="dp" onchange="document.getElementById('nominal_bayar_hidden').value = this.value; updateTotalBayar();">
                                <div class="radio-content">
                                    <span class="radio-label">Bayar DP</span>
                                    <span class="radio-price" id="dp_price">Rp {{ number_format($total * 0.5, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <label class="payment-option-radio">
                                <input type="radio" name="nominal_bayar" value="cod" onchange="document.getElementById('nominal_bayar_hidden').value = 'lunas'; updateTotalBayar();">
                                <div class="radio-content">
                                    <span class="radio-label">Bayar COD (Tunai)</span>
                                    <span class="radio-price" id="cod_price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </label>
                        </div>

                        <p class="dp-note" id="dp_note" style="display: none;">
                            <small style="color: #DC3545;">Wajib transfer minimal 50% untuk booking</small>
                        </p>
                        <p class="dp-note" id="cod_note" style="display: none;">
                            <small style="color: #7e9a3e;">Pembayaran dilakukan LUNAS saat pengambilan barang.</small>
                        </p>
                    </div>

                    <div class="summary-divider"></div>

                    <div class="summary-row total-transfer-row">
                        <span id="label_total_transfer">Total Yang Harus Ditransfer</span>
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
    function get(id) { return document.getElementById(id); }
    function safe(el) { return el !== null && el !== undefined; }

    const cart = @json($cart);
    const baseTotal = {{ $total }};
    const itemCount = {{ array_sum(array_column($cart, 'quantity')) }};

    function parseCurrency(string) {
        if (!string) return 0;
        return parseInt(string.replace(/[^0-9]/g, ''));
    }

    function updateNominalBayar(value) {
        const hiddenInput = document.getElementById('nominal_bayar_hidden');
        if (hiddenInput) {
            // Jika COD, backend tetap mencatat sebagai 'lunas', tapi method cod
            hiddenInput.value = (value === 'cod') ? 'lunas' : value;
        }
        document.querySelectorAll('input[name="nominal_bayar"]').forEach(radio => {
            radio.checked = (radio.value === value);
        });
        updateTotalBayar();
    }

    function handleUserTypeChange() {
        const userType = document.querySelector('input[name="user_type"]:checked').value;
        const paymentSection = document.getElementById('payment_section');
        const sectionSuratOrganisasi = document.getElementById('section_surat_organisasi');
        const organisasiSection = document.getElementById('organisasi_section');
        const nominalBayarSection = document.getElementById('nominal_bayar_section');
        const totalFullAmount = document.getElementById('total_full_amount');
        const subtotalElement = document.getElementById('subtotal');
        const biayaTambahanRow = document.getElementById('biaya_tambahan_row');
        const pelunasanNote = document.getElementById('pelunasan_note');
        const pelunasanDpNote = document.getElementById('pelunasan_dp_note');
        const codNote = document.getElementById('cod_note');
        const hiddenNominalBayar = document.getElementById('nominal_bayar_hidden');
        const metodePembayaranRadios = document.querySelectorAll('input[name="metode_pembayaran"]');
        const inputCodMethod = document.getElementById('input_cod_method');

        const namaInstansiInput = document.getElementById('nama_instansi');
        const namaInstansiLabel = document.querySelector('label[for="nama_instansi"]');

        if (userType === 'organisasi') {
            namaInstansiInput.required = true;
            namaInstansiLabel.innerHTML = 'Nama Instansi <span class="required">*</span>';

            paymentSection.style.display = 'none';
            document.getElementById('bukti_transfer').required = false;

            sectionSuratOrganisasi.style.display = 'block';
            document.getElementById('surat_peminjaman').required = true;

            organisasiSection.style.display = 'block';
            nominalBayarSection.style.display = 'none';
            biayaTambahanRow.style.display = 'none';

            // Reset notes
            if(pelunasanNote) pelunasanNote.style.display = 'none';
            if(pelunasanDpNote) pelunasanDpNote.style.display = 'none';
            if(codNote) codNote.style.display = 'none';

            // Reset inputs
            document.querySelectorAll('input[name="nominal_bayar"]').forEach(radio => {
                radio.required = false;
                radio.checked = false;
            });

            metodePembayaranRadios.forEach(radio => {
                radio.required = false;
                radio.checked = false;
            });
            inputCodMethod.disabled = true; // Matikan input hidden COD

            if (hiddenNominalBayar) {
                hiddenNominalBayar.value = '';
                hiddenNominalBayar.removeAttribute('required');
            }

            subtotalElement.innerHTML = '<s>Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal) + '</s>';
            totalFullAmount.textContent = 'Rp 0';
            document.getElementById('total_transfer_amount').textContent = 'Rp 0';

        } else { // Umum
            namaInstansiInput.required = false;
            namaInstansiLabel.innerHTML = 'Nama Instansi';

            sectionSuratOrganisasi.style.display = 'none';
            document.getElementById('surat_peminjaman').required = false;
            organisasiSection.style.display = 'none';
            nominalBayarSection.style.display = 'block';

            document.querySelectorAll('input[name="nominal_bayar"]').forEach(radio => {
                radio.required = true;
            });

            // Set default ke lunas jika belum ada yang terpilih
            if (hiddenNominalBayar) {
                hiddenNominalBayar.setAttribute('required', 'required');
                hiddenNominalBayar.value = 'lunas';
            }
            if (!document.querySelector('input[name="nominal_bayar"]:checked')) {
                updateNominalBayar('lunas');
            } else {
                 // Trigger ulang logika tampilan berdasarkan pilihan saat ini (Lunas/DP/COD)
                const currentNominal = document.querySelector('input[name="nominal_bayar"]:checked').value;
                updateTotalBayar();
            }

            subtotalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(baseTotal);
            calculateTotal();
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
        if (durasi === 4) additionalCost = 5000 * itemCount;
        else if (durasi === 5) additionalCost = 10000 * itemCount;
        else if (durasi > 5) additionalCost = (10000 + (durasi - 5) * 5000) * itemCount;

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
        document.getElementById('cod_price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

        updateTotalBayar();
    }

    // [IMPLEMENTASI 3] Update logika tampilan & required berdasarkan pilihan Lunas/DP/COD
    function updateTotalBayar() {
        const userType = document.querySelector('input[name="user_type"]:checked').value;
        if (userType === 'organisasi') return;

        // Ambil elemen yang tercentang di radio nominal_bayar
        const nominalElement = document.querySelector('input[name="nominal_bayar"]:checked');
        if (!nominalElement) return;

        const nominalOption = nominalElement.value; // 'lunas', 'dp', atau 'cod'

        const totalText = document.getElementById('total_full_amount').textContent;
        const total = parseCurrency(totalText);

        const paymentSection = document.getElementById('payment_section');
        const buktiTransferInput = document.getElementById('bukti_transfer');
        const metodePembayaranRadios = document.querySelectorAll('input[name="metode_pembayaran"]'); // radio bank
        const inputCodMethod = document.getElementById('input_cod_method'); // hidden input cod

        const dpNote = document.getElementById('dp_note');
        const codNote = document.getElementById('cod_note');
        const pelunasanNote = document.getElementById('pelunasan_note');
        const pelunasanDpNote = document.getElementById('pelunasan_dp_note');
        const totalTransferAmount = document.getElementById('total_transfer_amount');
        const labelTotalTransfer = document.getElementById('label_total_transfer');
        const sisaPelunasan = document.getElementById('sisa_pelunasan');

        // Reset display notes
        if(dpNote) dpNote.style.display = 'none';
        if(codNote) codNote.style.display = 'none';
        if(pelunasanNote) pelunasanNote.style.display = 'none';
        if(pelunasanDpNote) pelunasanDpNote.style.display = 'none';

        if (nominalOption === 'cod') {
            paymentSection.style.display = 'none';

            // 2. Matikan required bukti transfer dan radio bank
            buktiTransferInput.required = false;
            metodePembayaranRadios.forEach(r => { r.required = false; r.checked = false; });

            // 3. Aktifkan input hidden COD agar terkirim ke controller
            inputCodMethod.disabled = false;

            // 4. Update Teks Ringkasan
            labelTotalTransfer.textContent = "Total Bayar di Tempat";
            totalTransferAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            if(codNote) codNote.style.display = 'block';

        } else if (nominalOption === 'dp') {
            // --- LOGIKA DP ---
            paymentSection.style.display = 'block';
            buktiTransferInput.required = true;
            metodePembayaranRadios.forEach(r => r.required = true);
            inputCodMethod.disabled = true;

            const dpAmount = total * 0.5;
            labelTotalTransfer.textContent = "Total Yang Harus Ditransfer";
            totalTransferAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(dpAmount);
            sisaPelunasan.textContent = new Intl.NumberFormat('id-ID').format(total - dpAmount);

            if(dpNote) dpNote.style.display = 'block';
            if(pelunasanDpNote) pelunasanDpNote.style.display = 'block';

        } else {
            // --- LOGIKA LUNAS ---
            paymentSection.style.display = 'block';
            buktiTransferInput.required = true;
            metodePembayaranRadios.forEach(r => r.required = true);
            inputCodMethod.disabled = true;

            labelTotalTransfer.textContent = "Total Yang Harus Ditransfer";
            totalTransferAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

            if(pelunasanNote) pelunasanNote.style.display = 'block';
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

    const paymentMethodsData = @json($paymentMethods);

function showPaymentInfo(code) {
    const paymentInfo = document.getElementById('payment_info');
    paymentInfo.style.display = 'block';

    // Cari data metode yang dipilih dari array paymentMethodsData
    const method = paymentMethodsData.find(m => m.code === code);

    if (method) {
        let contentHtml = '';

        if (method.type === 'manual') {
            // Tampilan Transfer Manual
            contentHtml = `
                <div class="payment-details">
                    <h4>Transfer ke Rekening ${method.name}:</h4>
                    <p class="account-number">${method.account_number}</p>
                    <p class="account-name">a.n. ${method.account_name}</p>
                </div>
            `;
        } else if (method.type === 'qr') {
            // Tampilan QR Code
            // Pastikan URL gambar QR benar (jika di storage, tambahkan path storage)
            const qrUrl = "{{ asset('') }}" + method.qr_image;

            contentHtml = `
                <div class="payment-details">
                    <h4>Scan QR Code ${method.name}:</h4>
                    <img src="${qrUrl}" alt="QR ${method.name}" class="qr-code">
                    ${method.account_number ? `<p class="account-number">${method.account_number}</p>` : ''}
                    ${method.account_name ? `<p class="account-name">a.n. ${method.account_name}</p>` : ''}
                </div>
            `;
        }

        paymentInfo.innerHTML = contentHtml;
    }
}

    // Submit Handling Updated
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const submitButton = document.getElementById('submitButton');
        const submitText = document.getElementById('submitText');
        const submitLoading = document.getElementById('submitLoading');

        // Reset button state on validation fail helper
        const stopSubmit = (msg) => {
            e.preventDefault();
            alert(msg);
            submitButton.disabled = false;
            submitText.style.display = 'inline';
            submitLoading.style.display = 'none';
            return false;
        };

        submitButton.disabled = true;
        submitText.style.display = 'none';
        submitLoading.style.display = 'inline-flex';

        if (!this.checkValidity()) {
            e.preventDefault();
            submitButton.disabled = false;
            submitText.style.display = 'inline';
            submitLoading.style.display = 'none';
            this.reportValidity();
            return false;
        }

        const userType = document.querySelector('input[name="user_type"]:checked').value;

        if (userType === 'umum') {
            // Cek Nominal Bayar (Radio)
            const nominalOption = document.querySelector('input[name="nominal_bayar"]:checked');
            if (!nominalOption) return stopSubmit('Silakan pilih Bayar Lunas, DP, atau COD!');

            // Jika BUKAN COD, wajib cek metode pembayaran dan bukti transfer
            if (nominalOption.value !== 'cod') {
                const metodePembayaran = document.querySelector('input[name="metode_pembayaran"]:checked');
                if (!metodePembayaran) return stopSubmit('Silakan pilih metode pembayaran (Bank/E-Wallet) terlebih dahulu!');

                const buktiTransfer = document.getElementById('bukti_transfer').files.length;
                if (!buktiTransfer) return stopSubmit('Silakan upload bukti transfer terlebih dahulu!');
            }
            // Jika COD, validasi di atas dilewati (aman)
        }

        if (userType === 'organisasi') {
            const namaInstansi = document.getElementById('nama_instansi').value;
            if (!namaInstansi || namaInstansi.trim() === '') return stopSubmit('Nama Instansi wajib diisi!');

            const suratPeminjaman = document.getElementById('surat_peminjaman').files.length;
            if (!suratPeminjaman) return stopSubmit('Silakan upload surat peminjaman terlebih dahulu!');
        }

        const dokumenJaminan = document.getElementById('dokumen_jaminan').files.length;
        if (!dokumenJaminan) return stopSubmit('Silakan upload dokumen jaminan (KTP/KTM/SIM) terlebih dahulu!');

        return true;
    });
</script>
@endsection
