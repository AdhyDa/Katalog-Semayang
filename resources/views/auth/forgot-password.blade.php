<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - AMKT Semayang</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="auth">
    <div class="auth-container">
        <div class="left-section">
            <div class="auth-left-content">
                <div class="back-link">
                    <a href="{{ route('login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Login
                    </a>
                </div>

                <!-- Hero Text -->
                <div class="hero-text">
                    <h1>Lupa Password?</h1>
                    <p style="color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 15px;">Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk reset password.</p>
                </div>

                <!-- Brand Logo -->
                <div class="brand-footer-forgot">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo AMKT Semayang" class="brand-logo">
                    <span class="brand-name">AMKT Semayang</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Form Section -->
        <div class="right-section">
            <div class="form-wrapper">
                <div class="form-header">
                    <h2>Reset Password</h2>
                    <p>Masukkan email yang terdaftar</p>
                </div>

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

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="input-group">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required>
                        <label for="email">Email</label>
                        <span class="input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit">Kirim Link Reset Password</button>
                </form>

                <!-- Back to Login Link -->
                <div class="auth-footer">
                    <p>Ingat password Anda? <a href="{{ route('login') }}">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
