@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
{{-- Judul Halaman --}}
<h2 style="font-family: 'Merriweather', serif; font-size: 2rem; margin-bottom: 2rem; font-weight: 900;">
    Informasi Akun
</h2>

<form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Bagian Foto Profil --}}
    <div style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem;">
        {{-- Avatar Circle --}}
        <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 2px solid #7e9a3e; flex-shrink: 0;">
            @if($user->photo)
                <img src="{{ Storage::url($user->photo) }}" alt="Foto Profil" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <div style="width: 100%; height: 100%; background-color: #7e9a3e; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 50px; height: 50px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
            @endif
        </div>

        <div style="position: relative;">
            <label for="photo_input" style="
                border: 2px solid #7e9a3e;
                color: #7e9a3e;
                padding: 0.5rem 1.5rem;
                border-radius: 2rem;
                font-weight: 700;
                cursor: pointer;
                transition: 0.2s;
                ">
                Ganti Foto
            </label>
            <input type="file" name="photo" id="photo_input" style="display: none;" accept="image/*">
        </div>
    </div>

    {{-- Grid Form (Email & Username) --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
        {{-- Email (Readonly - Hijau) --}}
        <div>
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Email</label>
            <input type="email" value="{{ $user->email }}" readonly
                style="width: 100%; padding: 0.8rem 1rem; border-radius: 1rem; border: none; background-color: rgba(126, 154, 62, 0.4); color: #1F2937; font-weight: 500;">
        </div>

        {{-- Username --}}
        <div>
            <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Username <span style="color: red;">*</span></label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                placeholder="Contoh: budi01"
                style="width: 100%; padding: 0.8rem 1rem; border-radius: 1rem; border: 2px solid #7e9a3e; outline: none;">
        </div>
    </div>

    {{-- Nama Lengkap --}}
    <div style="margin-bottom: 1.5rem;">
        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Nama Lengkap <span style="color: red;">*</span></label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}"
            placeholder="Contoh: Budi Santoso"
            style="width: 100%; padding: 0.8rem 1rem; border-radius: 1rem; border: 2px solid #7e9a3e; outline: none;">
    </div>

    {{-- Nomor Telepon --}}
    <div style="margin-bottom: 1.5rem;">
        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Nomor Telepon <span style="color: red;">*</span></label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
            placeholder="Contoh: 0812xxxxxxxx"
            style="width: 100%; padding: 0.8rem 1rem; border-radius: 1rem; border: 2px solid #7e9a3e; outline: none;">
    </div>

    {{-- Nama Instansi --}}
    <div style="margin-bottom: 2rem;">
        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem;">Nama Instansi</label>
        <input type="text" name="institution" value="{{ old('institution', $user->institution) }}"
            placeholder="Contoh: AMKT Semayang"
            style="width: 100%; padding: 0.8rem 1rem; border-radius: 1rem; border: 2px solid #7e9a3e; outline: none;">
    </div>

    {{-- Tombol Simpan --}}
    <div style="text-align: right;">
        <button type="submit" style="
            background-color: #7e9a3e;
            color: white;
            padding: 0.8rem 2.5rem;
            border-radius: 1rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-size: 1rem;">
            Simpan Perubahan
        </button>
    </div>
</form>

{{-- Responsif untuk Grid Form di Layar Kecil --}}
<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
