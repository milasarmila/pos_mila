@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    .detail-page {
        background: #fff8fb;
        min-height: calc(100vh - 60px);
        padding: 30px 0 50px;
    }

    .page-title {
        color: #4a303b;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #9a7c88;
        margin-bottom: 25px;
    }

    .detail-card {
        background: #ffffff;
        border: 1px solid #f5dce7;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(232, 160, 185, 0.10);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .detail-card-header {
        background: #fff1f6;
        border-bottom: 1px solid #f5dce7;
        padding: 16px 20px;
        color: #6b3f50;
        font-weight: 700;
    }

    .detail-card-body {
        padding: 20px;
    }

    .info-table {
        margin-bottom: 0;
    }

    .info-table th {
        width: 220px;
        color: #5d4650;
        font-weight: 600;
        padding: 10px 5px;
    }

    .info-table td {
        color: #6f5a63;
        padding: 10px 5px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        background: #ffe1ed;
        color: #c85d82;
        font-size: 13px;
        font-weight: 600;
    }

    .payment-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        background: #f4e8ff;
        color: #895ca8;
        font-size: 13px;
        font-weight: 600;
    }

    .total-box {
        background: #fff1f6;
        border: 1px solid #f5dce7;
        border-radius: 10px;
        padding: 15px 18px;
        text-align: right;
    }

    .total-label {
        color: #8c6c79;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .total-value {
        color: #d35f87;
        font-size: 22px;
        font-weight: 700;
    }

    .product-table {
        margin-bottom: 0;
    }

    .product-table thead th {
        background: #fff1f6;
        color: #684554;
        border-color: #f3dce6;
        font-size: 14px;
        padding: 13px 12px;
    }

    .product-table tbody td {
        border-color: #f1e2e8;
        color: #62535a;
        padding: 13px 12px;
        vertical-align: middle;
    }

    .product-name {
        color: #4e3741;
        font-weight: 600;
    }

    .product-table tfoot th {
        background: #fff8fb;
        border-color: #f1dce6;
        color: #543d47;
        padding: 14px 12px;
    }

    .btn-back {
        background: #f3a9c5;
        border: none;
        color: white;
        border-radius: 9px;
        padding: 9px 18px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #e995b5;
        color: white;
        transform: translateY(-1px);
    }

    .empty-item {
        color: #9b858e;
        padding: 25px !important;
    }

    @media (max-width: 768px) {
        .detail-page {
            padding: 20px 12px 40px;
        }

        .info-table th {
            width: 150px;
        }

        .product-table {
            min-width: 700px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .total-box {
            text-align: left;
        }
    }
</style>

<div class="detail-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="mb-4">
            <h2 class="page-title">Detail Penjualan</h2>
            <p class="page-subtitle">
                Lihat informasi lengkap dari transaksi penjualan
            </p>
        </div>


        {{-- INFORMASI TRANSAKSI --}}
        <div class="detail-card">

            <div class="detail-card-header">
                Informasi Transaksi
            </div>

            <div class="detail-card-body">

                <table class="table table-borderless info-table">

                    <tr>
                        <th>Kasir</th>
                        <td>
                            {{ $penjualan->user->name ?? 'User tidak tersedia' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>
                            <span class="payment-badge">
                                {{ $penjualan->metode_pembayaran }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="status-badge">
                                {{ ucfirst($penjualan->status) }}
                            </span>
                        </td>
                    </tr>

                </table>

                {{-- TOTAL --}}
                <div class="total-box mt-3">

                    <div class="total-label">
                        Total Pembayaran
                    </div>

                    <div class="total-value">
                        Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                    </div>

                </div>

            </div>
        </div>


        {{-- PRODUK YANG DIBELI --}}
        <div class="detail-card">

            <div class="detail-card-header">
                Produk Yang Dibeli
            </div>

            <div class="detail-card-body">

                <div class="table-responsive">

                    <table class="table product-table">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th width="100">Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($penjualan->itemPenjualan as $item)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="product-name">
                                        {{ $item->produk->nama ?? 'Produk tidak tersedia' }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $item->kuantitas }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center empty-item">
                                        Tidak ada item penjualan
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                        <tfoot>

                            <tr>
                                <th colspan="4" class="text-end">
                                    Total
                                </th>

                                <th>
                                    Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                                </th>
                            </tr>

                        </tfoot>

                    </table>

                </div>

            </div>
        </div>


        {{-- TOMBOL KEMBALI --}}
        <a href="{{ route('penjualan.index') }}" class="btn-back">
            ← Kembali ke Penjualan
        </a>

    </div>

</div>

@endsection