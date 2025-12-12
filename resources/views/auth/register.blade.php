<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280">
    <title>Daftar - AMKT Semayang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="auth">
    <div class="auth-container">
        <div class="left-section">
            <div class="auth-tabs">
                <a href="{{ route('daftar') }}" class="tab-link active">Daftar</a>
                <a href="{{ route('login') }}" class="tab-link">Masuk</a>
            </div>
            <div class="left-content">
                <h1>Temukan Gaya<br>Adatmu Di Sini</h1>
                <p>Bergabunglah dan lestarikan budaya bersama AMKT Semayang.</p>
            </div>
            <div class="brand-footer">
                <img src="{{ asset('images/logo.png') }}" alt="Logo AMKT Semayang" class="brand-logo">
                <span class="brand-name">AMKT Semayang</span>
            </div>
        </div>


        <div class="right-section">
            <div class="form-wrapper">
                <div class="form-title">Buat Akun Baru</div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('daftar') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <input
                            type="text"
                            name="nama_lengkap"
                            id="nama"
                            value="{{ old('nama_lengkap') }}"
                            placeholder="Contoh: Budi Hartono"
                            required
                        >
                        <label for="nama">Nama Lengkap</label>
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                    </div>

                    <div class="input-group">
                        <input
                            type="tel"
                            name="nomor_telepon"
                            id="phone"
                            value="{{ old('nomor_telepon') }}"
                            placeholder="Contoh: 0123xxxxxx"
                            required
                        >
                        <label for="phone">Nomor Telepon</label>
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </span>
                    </div>

                    <div class="input-group">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            placeholder="Contoh: budi01@gmail.com"
                            required
                        >
                        <label for="email">Email</label>
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                    </div>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan Password Anda"
                            required
                            autocomplete="new-password"
                        >
                        <label for="password">Password</label>
                        <button type="button"
                            class="toggle-password"
                            data-target="password"
                            aria-pressed="false"
                            aria-label="Tampilkan password"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon-open">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon-off">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </button>
                    </div>

                    <div class="input-group">
                        <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Konfirmasi Password Anda"
                        required
                        autocomplete="new-password"
                    >
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <button type="button"
                            class="toggle-password"
                            data-target="password_confirmation"
                            aria-pressed="false"
                            aria-label="Tampilkan konfirmasi password"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon-open">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="eye-icon-off">
                                <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                                <path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="btn-submit">Daftar Sekarang</button>

                    <div class="bottom-text">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Event delegation: satu listener untuk semua tombol toggle
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.toggle-password');
        if (!btn) return;

        const targetId = btn.dataset.target;
        if (!targetId) return;

        const field = document.getElementById(targetId);
        if (!field) return;

        // apakah saat ini tipe password? kalau iya -> kita tunjukkan (text)
        const willShow = field.type === 'password';

        // toggle tipe
        field.type = willShow ? 'text' : 'password';

        // visual + aksesibilitas
        btn.classList.toggle('active', willShow);
        btn.setAttribute('aria-pressed', willShow ? 'true' : 'false');
        btn.setAttribute('aria-label', willShow ? 'Sembunyikan password' : 'Tampilkan password');
    });

    // Validasi input nomor telepon: hanya angka, diawali 08, panjang 8-13 digit
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value;

        // Hapus karakter non-digit
        value = value.replace(/\D/g, '');

        // Pastikan diawali dengan 08
        if (value.length > 0 && !value.startsWith('08')) {
            value = '08' + value.replace(/^0?8?/, '');
        }

        // Batasi panjang maksimal 13 digit
        if (value.length > 13) {
            value = value.substring(0, 13);
        }

        e.target.value = value;
    });
    </script>

</body>
</html>
