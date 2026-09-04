@extends('layouts.app') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('content')
<div class="container mt-4">
    <h2>Tambah Jenis Baru</h2>
    <hr>

    {{-- Form mengarah ke fungsi store di JenisController --}}
    <form action="{{ route('Jenis.store') }}" method="POST">
        @csrf {{-- Token keamanan wajib Laravel --}}
        
        <div class="mb-3">
            <label for="nama_jenis" class="form-label">Nama Jenis</label>
            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama_jenis" name="nama_jenis" placeholder="Masukkan nama jenis baru" required>
            
            @error('nama_jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="{{ route('Jenis.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
