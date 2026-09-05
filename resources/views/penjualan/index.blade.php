@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    /* =========================
       WARNA UTAMA
    ========================= */
    :root {
        --pink: #f5b6cf;
        --pink-light: #fff5f9;
        --pink-soft: #fde8f0;
        --pink-border: #f3d4e1;
        --pink-dark: #df8faf;
        --text-dark: #333;
        --text-muted: #888;
    }

    * {
        box-sizing: border-box;
    }

    .penjualan-page {
        background: #fff;
        min-height: 100vh;
    }

    /* =========================
       HEADER
    ========================= */
    .penjualan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .penjualan-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #222;
        margin: 0 0 5px;
    }

    .penjualan-header p {
        color: var(--text-muted);
        margin: 0;
        font-size: 14px;
    }

    .btn-pink {
        background: var(--pink);
        border: 1px solid var(--pink);
        color: white;
        border-radius: 9px;
        padding: 11px 20px;
        font-weight: 600;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .btn-pink:hover {
        background: var(--pink-dark);
        border-color: var(--pink-dark);
        color: white;
    }

    /* =========================
       CARD STATISTIK
    ========================= */
    .stat-card {
        background: white;
        border: 1px solid var(--pink-border);
        border-radius: 15px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--pink-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 12px;
    }

    .stat-title {
        color: #777;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .stat-value {
        color: #222;
        font-size: 22px;
        font-weight: 700;
        margin: 0;
    }

    /* =========================
       SEARCH
    ========================= */
    .search-card {
        background: white;
        border: 1px solid var(--pink-border);
        border-radius: 15px;
        padding: 18px;
        margin-top: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .search-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .search-input {
        border: 1px solid #ddd;
        border-radius: 9px 0 0 9px;
        padding: 11px 14px;
    }

    .search-input:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 0.15rem rgba(245, 182, 207, 0.2);
    }

    .btn-search {
        background: var(--pink);
        border: 1px solid var(--pink);
        color: white;
        padding: 0 22px;
        border-radius: 0 9px 9px 0;
        font-weight: 600;
    }

    .btn-search:hover {
        background: var(--pink-dark);
        border-color: var(--pink-dark);
        color: white;
    }

    /* =========================
       TABLE CARD
    ========================= */
    .table-card {
        background: white;
        border: 1px solid var(--pink-border);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .table-title {
        padding: 18px 20px;
        border-bottom: 1px solid var(--pink-border);
        background: white;
    }

    .table-title h5 {
        margin: 0;
        font-weight: 700;
        color: #222;
    }

    .table-title p {
        margin: 4px 0 0;
        color: #888;
        font-size: 13px;
    }

    /* =========================
       PEMBUNGKUS TABEL
    ========================= */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    /* =========================
       TABLE
    ========================= */
    .table {
        width: 100%;
        min-width: 1050px;
        margin: 0;
        border-collapse: collapse;
    }

    .table thead {
        background: var(--pink-light);
    }

    .table thead th {
        color: #555;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 15px 14px;
        border-bottom: 1px solid var(--pink-border);
        white-space: nowrap;
        vertical-align: middle;
    }

    .table tbody td {
        padding: 15px 14px;
        border-bottom: 1px solid #f1f1f1;
        color: #444;
        font-size: 14px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr:hover {
        background: #fffafd;
    }

    /* =========================
       LEBAR KOLOM
    ========================= */
    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 60px;
    }

    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 125px;
    }

    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 200px;
    }

    .table th:nth-child(4),
    .table td:nth-child(4) {
        width: 180px;
    }

    .table th:nth-child(5),
    .table td:nth-child(5) {
        width: 120px;
    }

    .table th:nth-child(6),
    .table td:nth-child(6) {
        width: 120px;
    }

    .table th:nth-child(7),
    .table td:nth-child(7) {
        width: 220px;
    }

    /* =========================
       NOMOR TRANSAKSI
    ========================= */
    .sale-number {
        font-weight: 700;
        color: var(--pink-dark);
    }

    /* =========================
       TANGGAL
    ========================= */
    .sale-date {
        display: flex;
        flex-direction: column;
        line-height: 1.4;
    }

    .sale-date strong {
        color: #333;
        font-size: 14px;
    }

    .sale-date small {
        color: #888;
        font-size: 12px;
    }

    /* =========================
       KASIR
    ========================= */
    .cashier-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--pink-soft);
        color: #c96f91;
        border: 1px solid var(--pink-border);
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        max-width: 190px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* =========================
       TOTAL
    ========================= */
    .total-payment {
        font-weight: 700;
        color: #333;
        white-space: nowrap;
    }

    /* =========================
       METODE PEMBAYARAN
    ========================= */
    .payment-badge {
        display: inline-block;
        background: #f8f8f8;
        border: 1px solid #e5e5e5;
        color: #555;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    /* =========================
       STATUS
    ========================= */
    .status-selesai {
        display: inline-block;
        background: #eaf8ef;
        color: #2e8b57;
        border: 1px solid #bfe5cc;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-pending {
        display: inline-block;
        background: #fff8e6;
        color: #b8860b;
        border: 1px solid #f1df9c;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-other {
        display: inline-block;
        background: #f2f2f2;
        color: #666;
        border: 1px solid #ddd;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       TOMBOL AKSI
    ========================= */
    .action-wrapper {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .action-btn {
        border-radius: 7px;
        padding: 7px 11px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .btn-detail {
        background: var(--pink);
        color: white;
        border: 1px solid var(--pink);
    }

    .btn-detail:hover {
        background: var(--pink-dark);
        border-color: var(--pink-dark);
        color: white;
    }

    .btn-edit {
        background: #fff3cd;
        color: #9a7600;
        border: 1px solid #f1dc8b;
    }

    .btn-edit:hover {
        background: #ffe69c;
        color: #806200;
    }

    .btn-delete {
        background: #fff0f0;
        color: #d9534f;
        border: 1px solid #f0c5c5;
    }

    .btn-delete:hover {
        background: #f8d7da;
        color: #b52b27;
    }

    /* =========================
       EMPTY STATE
    ========================= */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: var(--pink-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 28px;
    }

    .empty-state h5 {
        font-weight: 700;
        color: #444;
        margin-bottom: 5px;
    }

    .empty-state p {
        color: #999;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* =========================
       PAGINATION
    ========================= */
    .pagination-wrapper {
        padding: 15px 20px;
        border-top: 1px solid var(--pink-border);
        display: flex;
        justify-content: center;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {

        .penjualan-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .penjualan-header .btn-pink {
            width: 100%;
            text-align: center;
        }

        .table-title {
            padding: 15px;
        }

        .table {
            min-width: 1050px;
        }

        .search-card {
            padding: 15px;
        }
    }
</style>


<div class="penjualan-page">

    <div class="container py-4">

        {{-- NOTIFIKASI ERROR --}}
        @if(session('errors'))

            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">

                <strong>Gagal!</strong>
                {{ session('errors') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
                </button>

            </div>

        @endif


        {{-- HEADER --}}
        <div class="penjualan-header">

            <div>

                <h1>Halaman Penjualan</h1>

                <p>
                    Kelola dan pantau seluruh transaksi penjualan Anda.
                </p>

            </div>

            <a
                href="{{ route('penjualan.create') }}"
                class="btn btn-pink">

                + Buat Penjualan

            </a>

        </div>


        {{-- STATISTIK --}}
        <div class="row g-3">

            {{-- TOTAL TRANSAKSI --}}
            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        🧾
                    </div>

                    <div class="stat-title">
                        Total Transaksi
                    </div>

                    <p class="stat-value">
                        {{ $sales->total() }}
                    </p>

                </div>

            </div>


            {{-- TRANSAKSI SELESAI --}}
            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        ✅
                    </div>

                    <div class="stat-title">
                        Transaksi Selesai
                    </div>

                    <p class="stat-value">

                        {{
                            collect($sales->items())
                                ->filter(function ($sale) {

                                    return in_array(
                                        strtolower($sale->status),
                                        ['selesai', 'success', 'completed']
                                    );

                                })
                                ->count()
                        }}

                    </p>

                </div>

            </div>


            {{-- TOTAL PEMBAYARAN --}}
            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        💰
                    </div>

                    <div class="stat-title">
                        Total Pembayaran
                    </div>

                    <p class="stat-value">

                        Rp {{
                            number_format(
                                collect($sales->items())
                                    ->sum('total_pembayaran'),
                                0,
                                ',',
                                '.'
                            )
                        }}

                    </p>

                </div>

            </div>

        </div>


        {{-- SEARCH --}}
        <div class="search-card">

            <div class="search-title">
                🔎 Cari Transaksi
            </div>

            <form
                action="{{ route('penjualan.index') }}"
                method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="{{ request()->search }}"
                        class="form-control search-input"
                        placeholder="Cari berdasarkan transaksi atau kasir..."
                        aria-label="Search penjualan"
                    >

                    <button
                        class="btn btn-search"
                        type="submit">

                        Cari

                    </button>

                    @if(request()->search)

                        <a
                            href="{{ route('penjualan.index') }}"
                            class="btn btn-outline-secondary">

                            Reset

                        </a>

                    @endif

                </div>

            </form>

        </div>


        {{-- TABEL --}}
        <div class="table-card">

            {{-- JUDUL TABEL --}}
            <div class="table-title">

                <h5>
                    Riwayat Transaksi
                </h5>

                <p>
                    Daftar transaksi penjualan yang tersimpan dalam sistem.
                </p>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th class="ps-4">
                                #
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Kasir
                            </th>

                            <th>
                                Total Pembayaran
                            </th>

                            <th>
                                Metode
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-end pe-4">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($sales as $sale)

                            <tr>

                                {{-- NOMOR --}}
                                <td class="ps-4">

                                    <span class="sale-number">

                                        #{{ $sales->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    <div class="sale-date">

                                        <strong>
                                            {{ $sale->created_at->translatedFormat('d-m-Y') }}
                                        </strong>

                                        <small>
                                            {{ $sale->created_at->translatedFormat('H:i') }}
                                        </small>

                                    </div>

                                </td>


                                {{-- KASIR --}}
                                <td>

                                    <span class="cashier-badge">

                                        👤 {{ $sale->user->name ?? 'User tidak tersedia' }}

                                    </span>

                                </td>


                                {{-- TOTAL PEMBAYARAN --}}
                                <td>

                                    <span class="total-payment">

                                        Rp {{ number_format(
                                            $sale->total_pembayaran,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </td>


                                {{-- METODE --}}
                                <td>

                                    <span class="payment-badge">

                                        {{ $sale->metode_pembayaran }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if(
                                        in_array(
                                            strtolower($sale->status),
                                            ['selesai', 'success', 'completed']
                                        )
                                    )

                                        <span class="status-selesai">

                                            ✓ Selesai

                                        </span>

                                    @elseif(
                                        in_array(
                                            strtolower($sale->status),
                                            ['pending', 'open']
                                        )
                                    )

                                        <span class="status-pending">

                                            ⏳ {{ ucfirst($sale->status) }}

                                        </span>

                                    @else

                                        <span class="status-other">

                                            {{ $sale->status }}

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="text-end pe-4">

                                    <div class="action-wrapper">

                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('penjualan.show', $sale) }}"
                                            class="btn action-btn btn-detail">

                                            Detail

                                        </a>


                                        {{-- EDIT --}}
                                        @can('view', $sale)

                                            <a
                                                href="{{ route('penjualan.edit', $sale) }}"
                                                class="btn action-btn btn-edit">

                                                Edit

                                            </a>

                                        @endcan


                                        {{-- HAPUS --}}
                                        @can('delete', $sale)

                                            <form
                                                action="{{ route('penjualan.destroy', $sale) }}"
                                                method="POST"
                                                class="d-inline m-0">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn action-btn btn-delete"
                                                    onclick="return confirm('Apakah Anda yakin akan menghapus penjualan ini?')">

                                                    Hapus

                                                </button>

                                            </form>

                                        @endcan

                                    </div>

                                </td>

                            </tr>

                        @empty

                            {{-- DATA KOSONG --}}
                            <tr>

                                <td colspan="7">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            🧾
                                        </div>

                                        <h5>
                                            Belum Ada Transaksi
                                        </h5>

                                        <p>
                                            Belum ada data penjualan yang tersimpan.
                                        </p>

                                        <a
                                            href="{{ route('penjualan.create') }}"
                                            class="btn btn-pink">

                                            + Buat Penjualan Pertama

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($sales->hasPages())

                <div class="pagination-wrapper">

                    {{ $sales->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection