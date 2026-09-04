@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="detail-card">

        <div class="detail-header">
            Detail Produk
        </div>

        <div class="detail-body">

            <div class="text-center mb-4">

                <img
                    src="{{ asset('storage/' . $product->foto) }}"
                    alt="{{ $product->nama }}"
                    class="product-image"
                    onerror="this.style.display='none';"
                >

            </div>

            <table class="table table-bordered">

                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $product->nama }}</td>
                </tr>

                <tr>
                    <th>Harga Beli</th>
                    <td>
                        Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <th>Harga Jual</th>
                    <td>
                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $product->stok }}</td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>
                        {{ $product->created_at->format('d-m-Y') }}
                    </td>
                </tr>

            </table>

            <div class="mt-3">

                <a
                    href="{{ route('produk.index') }}"
                    class="btn btn-back"
                >
                    Kembali
                </a>

                @can('update', $product)

                    <a
                        href="{{ route('produk.edit', $product) }}"
                        class="btn btn-edit"
                    >
                        Edit
                    </a>

                @endcan

                @can('delete', $product)

                    <form
                        action="{{ route('produk.destroy', $product) }}"
                        method="POST"
                        class="d-inline"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-delete"
                            onclick="return confirm('Apakah yakin ingin menghapus produk ini?')"
                        >
                            Hapus
                        </button>

                    </form>

                @endcan

            </div>

        </div>

    </div>

</div>


<style>

    body {
        background-color: #fff8fb;
    }

    .detail-card {
        background: white;
        border: 1px solid #f1d5e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .detail-header {
        background-color: #f48fb1;
        color: white;
        font-size: 18px;
        font-weight: 600;
        padding: 14px 20px;
    }

    .detail-body {
        padding: 25px;
    }

    .product-image {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #f1d5e0;
    }

    .table th {
        width: 35%;
        background-color: #fff3f7;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .btn-back {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        color: #555;
    }

    .btn-back:hover {
        background-color: #e9ecef;
    }

    .btn-edit {
        background-color: #f8bbd0;
        color: #7a304d;
        border: none;
    }

    .btn-edit:hover {
        background-color: #f48fb1;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background-color: #bb2d3b;
        color: white;
    }

</style>

@endsection