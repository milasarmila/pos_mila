@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Detail Produk
        </div>

        <div class="card-body">

            @if($produk->foto)
                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="img-fluid mb-3"
                     width="200">
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $produk->nama }}</td>
                </tr>

                <tr>
                    <th>Harga Beli</th>
                    <td>Rp {{ number_format($produk->harga_beli) }}</td>
                </tr>

                <tr>
                    <th>Harga Jual</th>
                    <td>Rp {{ number_format($produk->harga_jual) }}</td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $produk->stok }}</td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>{{ $produk->created_at->format('d-m-Y') }}</td>
                </tr>
            </table>

            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>
@endsection
