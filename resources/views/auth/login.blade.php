<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280">
    <title>Login - AMKT Semayang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="auth">
    <div class="auth-container">
        <div class="left-section">
            <div class="auth-tabs">
                <a href="{{ route('daftar') }}" class="tab-link">Daftar</a>
                <a href="{{ route('login') }}" class="tab-link active">Masuk</a>
            </div>
            <div class="left-content-login">
                <h1>Siap Tampil<br>Memukau Lagi?</h1>
                <p>Selamat datang kembali di Katalog Semayang.</p>
            </div>
            <div class="brand-footer">
                <img src="{{ asset('images/logo.png') }}" alt="Logo AMKT Semayang" class="brand-logo">
                <span class="brand-name">AMKT Semayang</span>
            </div>
        </div>

        <div class="right-section">
            <div class="form-wrapper">
                <div class="form-title">Login</div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required>
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
                        >
                        <label for="password">Password</label>
                        <button type="button"
                            class="toggle-password"
                            data-target="password"
                            aria-pressed="false"
                            aria-label="Tampilkan password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="eye-icon">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat Saya</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">Masuk</button>
                </form>

                <!-- Register Link -->
                <div class="auth-footer">
                    <p>Belum punya akun? <a href="{{ route('daftar') }}">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
    function togglePassword(button, fieldId) {
        const field = document.getElementById(fieldId);
        if (!field) return;

        const show = field.type === 'password';
        field.type = show ? 'text' : 'password';

        button.classList.toggle('active', show);

        button.setAttribute('aria-pressed', show ? 'true' : 'false');
        const label = show ? 'Sembunyikan password' : 'Tampilkan password';
        button.setAttribute('aria-label', label);

        const svg = button.querySelector('.eye-icon');
        if (svg) svg.classList.toggle('open', show);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toggle-password').forEach(btn => {
        const target = btn.getAttribute('data-target');
        if (target) {
            btn.addEventListener('click', () => togglePassword(btn, target));
        }
        });
    });
    </script>
</body>
</html>
