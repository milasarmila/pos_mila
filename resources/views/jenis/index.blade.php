@extends('layouts.app') {{-- Sesuaikan dengan nama layout dashboard Anda --}}

@section('content')
<div class="container">
    <h2>Daftar Jenis Produk</h2>
    
    <!-- Tombol Tambah -->
    <a href="{{ route('Jenis.create') }}" class="btn btn-primary mb-3">Tambah Jenis</a>

    <!-- Tabel Data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Perulangan untuk menampilkan data dari database --}}
            @forelse($jenis as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_jenis }}</td>
                    <td>
                        <!-- Tombol Edit & Hapus -->
                        <a href="{{ route('Jenis.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data jenis produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
