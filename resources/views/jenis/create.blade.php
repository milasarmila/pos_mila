@extends('layouts.app')

@section('content')

<style>
    .jenis-container {
        max-width: 850px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .jenis-card {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #f5d9e5;
    }

    /* HEADER PINK MUDA */
    .jenis-header {
        background: linear-gradient(135deg, #f8c4d8, #f5b6cf);
        color: #ffffff;
        padding: 25px 30px;
    }

    .jenis-header h2 {
        margin: 0;
        font-weight: 700;
    }

    .jenis-header p {
        margin: 6px 0 0;
        opacity: 0.95;
    }

    /* BODY PUTIH */
    .jenis-body {
        padding: 30px;
        background: #ffffff;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 10px;
        padding: 11px 14px;
        border: 1px solid #dddddd;
    }

    .form-control:focus {
        border-color: #f5b6cf;
        box-shadow: 0 0 0 0.2rem rgba(245, 182, 207, 0.20);
    }

    /* AREA UPLOAD */
    .upload-area {
        border: 2px dashed #f2c9d9;
        border-radius: 14px;
        padding: 25px;
        text-align: center;
        background: #fffafd;
        transition: 0.2s;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #f5b6cf;
        background: #fff5f9;
    }

    .upload-icon {
        font-size: 42px;
        margin-bottom: 10px;
    }

    .preview-wrapper {
        display: none;
        margin-top: 20px;
        text-align: center;
    }

    .preview-wrapper img {
        max-width: 260px;
        max-height: 220px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #f2d5e1;
        padding: 4px;
        background: white;
    }

    /* BUTTON */
    .button-area {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .button-area .btn {
        border-radius: 9px;
        padding: 10px 20px;
        font-weight: 500;
    }

    /* TOMBOL SIMPAN PINK MUDA */
    .btn-pink {
        background: #f5b6cf;
        border: 1px solid #f5b6cf;
        color: #ffffff;
    }

    .btn-pink:hover {
        background: #efa2bf;
        border-color: #efa2bf;
        color: #ffffff;
    }

    /* TOMBOL KEMBALI */
    .btn-secondary {
        background: #6c757d;
        border-color: #6c757d;
    }
</style>


<div class="jenis-container">

    <div class="jenis-card">

        {{-- HEADER --}}
        <div class="jenis-header">
            <h2>Tambah Jenis Baru</h2>
            <p>Tambahkan jenis produk beserta foto.</p>
        </div>


        {{-- BODY --}}
        <div class="jenis-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('Jenis.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                {{-- NAMA JENIS --}}
                <div class="mb-4">

                    <label for="nama_jenis" class="form-label">
                        Nama Jenis
                    </label>

                    <input
                        type="text"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        id="nama_jenis"
                        name="nama_jenis"
                        value="{{ old('nama_jenis') }}"
                        placeholder="Contoh: Minuman, Makanan, Snack"
                        required
                    >

                    @error('nama_jenis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- FOTO --}}
                <div class="mb-4">

                    <label class="form-label">
                        Foto Jenis
                    </label>

                    <label for="foto" class="upload-area w-100">

                        <div class="upload-icon">
                            📷
                        </div>

                        <div>
                            <strong>Klik untuk memilih foto</strong>
                        </div>

                        <small class="text-muted">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </small>

                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            accept="image/jpeg,image/png,image/webp"
                            class="d-none"
                        >

                    </label>


                    @error('foto')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror


                    {{-- PREVIEW FOTO --}}
                    <div id="previewWrapper" class="preview-wrapper">

                        <p class="fw-semibold mb-2">
                            Preview Foto
                        </p>

                        <img
                            id="previewImage"
                            src="#"
                            alt="Preview"
                        >

                        <div>
                            <button
                                type="button"
                                id="removeImage"
                                class="btn btn-sm btn-outline-danger mt-2">
                                Hapus Foto
                            </button>
                        </div>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="button-area">

                    <button type="submit" class="btn btn-pink">
                        💾 Simpan Jenis
                    </button>

                    <a href="{{ route('Jenis.index') }}"
                       class="btn btn-secondary">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PREVIEW FOTO --}}
<script>

    const fotoInput = document.getElementById('foto');
    const previewWrapper = document.getElementById('previewWrapper');
    const previewImage = document.getElementById('previewImage');
    const removeImage = document.getElementById('removeImage');

    fotoInput.addEventListener('change', function(event) {

        const file = event.target.files[0];

        if (!file) {
            previewWrapper.style.display = 'none';
            return;
        }

        // Pastikan file adalah gambar
        if (!file.type.startsWith('image/')) {

            alert('File yang dipilih harus berupa gambar.');

            fotoInput.value = '';
            previewWrapper.style.display = 'none';

            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {

            previewImage.src = e.target.result;

            previewWrapper.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });


    // Hapus foto yang dipilih
    removeImage.addEventListener('click', function() {

        fotoInput.value = '';

        previewImage.src = '#';

        previewWrapper.style.display = 'none';
    });

</script>

@endsection