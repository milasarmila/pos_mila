@csrf

<style>
    .form-card {
        background: #ffffff;
        border: 1px solid #f3dce6;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(225, 150, 180, 0.10);
    }

    .form-title {
        color: #5c3d49;
        font-weight: 700;
    }

    .form-label-custom {
        color: #684854;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .form-control {
        border-color: #eadde3;
        border-radius: 9px;
    }

    .form-control:focus {
        border-color: #f1a5c2;
        box-shadow: 0 0 0 0.2rem rgba(241, 165, 194, 0.15);
    }

    .image-box {
        width: 180px;
        height: 180px;
        border: 2px dashed #f1bfd2;
        border-radius: 14px;
        background: #fff8fb;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-placeholder {
        text-align: center;
        color: #b58b9b;
        font-size: 13px;
    }

    .btn-pink {
        background: #f28fb5;
        border-color: #f28fb5;
        color: white;
        border-radius: 9px;
        padding: 9px 20px;
        font-weight: 600;
    }

    .btn-pink:hover {
        background: #e97da6;
        border-color: #e97da6;
        color: white;
    }

    .btn-back {
        border-radius: 9px;
        padding: 9px 20px;
        font-weight: 600;
    }
</style>


<div class="form-card">

    {{-- JUDUL --}}
    <div class="mb-4">
        <h5 class="form-title mb-1">
            {{ isset($produk) ? 'Edit Data Produk' : 'Tambah Produk Baru' }}
        </h5>

        <small class="text-muted">
            {{ isset($produk)
                ? 'Ubah informasi produk sesuai kebutuhan.'
                : 'Masukkan informasi produk yang akan ditambahkan.' }}
        </small>
    </div>


    {{-- FOTO --}}
    <div class="mb-4">

        <label class="form-label-custom">
            Foto Produk
        </label>

        <div class="image-box">

            @if (!empty($produk->foto))

                <img
                    id="preview"
                    src="{{ asset('storage/' . $produk->foto) }}"
                    alt="{{ $produk->nama }}">

            @else

                <img
                    id="preview"
                    src=""
                    alt="Preview"
                    style="display: none;">

                <div id="placeholder" class="image-placeholder">
                    📦
                    <br>
                    Belum ada foto
                </div>

            @endif

        </div>


        <input
            type="file"
            name="foto"
            class="form-control @error('foto') is-invalid @enderror"
            accept="image/*"
            onchange="previewImage(this)">

        <small class="text-muted">
            Pilih gambar produk. Format JPG, JPEG, atau PNG.
        </small>

        @error('foto')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- NAMA PRODUK --}}
    <div class="mb-3">

        <label class="form-label-custom">
            Nama Produk
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $produk->nama ?? '') }}"
            placeholder="Masukkan nama produk">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- HARGA BELI --}}
    <div class="mb-3">

        <label class="form-label-custom">
            Harga Beli
        </label>

        <input
            type="number"
            name="purchase_price"
            class="form-control @error('purchase_price') is-invalid @enderror"
            value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
            placeholder="Masukkan harga beli"
            min="0">

        @error('purchase_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- HARGA JUAL --}}
    <div class="mb-3">

        <label class="form-label-custom">
            Harga Jual
        </label>

        <input
            type="number"
            name="selling_price"
            class="form-control @error('selling_price') is-invalid @enderror"
            value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
            placeholder="Masukkan harga jual"
            min="0">

        @error('selling_price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- STOK --}}
    <div class="mb-4">

        <label class="form-label-custom">
            Stok
        </label>

        <input
            type="number"
            name="stock"
            class="form-control @error('stock') is-invalid @enderror"
            value="{{ old('stock', $produk->stok ?? '') }}"
            placeholder="Masukkan jumlah stok"
            min="0">

        @error('stock')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- TOMBOL --}}
    <div class="d-flex gap-2">

        <button
            class="btn btn-pink"
            type="submit">

            💾 Simpan

        </button>

        <a
            href="{{ route('produk.index') }}"
            class="btn btn-secondary btn-back">

            ← Kembali

        </a>

    </div>

</div>


<script>
    function previewImage(input) {

        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');

        if (input.files && input.files[0]) {

            const file = input.files[0];

            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

            if (placeholder) {
                placeholder.style.display = 'none';
            }
        }
    }
</script>