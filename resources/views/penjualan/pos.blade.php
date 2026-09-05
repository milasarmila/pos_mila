@extends('layouts.app')

@section('title', 'POS')

@section('content')

<style>
    :root {
        --pink: #f5b6cf;
        --pink-light: #fff5f9;
        --pink-soft: #fde8f0;
        --pink-border: #f2d3df;
        --pink-dark: #df8faf;
    }

    body {
        background: #fff;
    }

    .pos-container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    /* =========================
       HEADER
    ========================= */
    .pos-header {
        margin-bottom: 25px;
    }

    .pos-header h2 {
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
    }

    .pos-header p {
        color: #888;
        margin: 0;
        font-size: 14px;
    }

    /* =========================
       CARD
    ========================= */
    .pos-card {
        background: #fff;
        border: 1px solid var(--pink-border);
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .pos-card-header {
        padding: 18px 20px;
        background: var(--pink-light);
        border-bottom: 1px solid var(--pink-border);
    }

    .pos-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #333;
    }

    .pos-card-header p {
        margin: 4px 0 0;
        color: #888;
        font-size: 13px;
    }

    /* =========================
       PRODUK
    ========================= */
    .product-list {
        max-height: 600px;
        overflow-y: auto;
        padding: 18px;
    }

    .product-item {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .product-info {
        flex: 1;
    }

    .product-button {
        width: 100%;
        background: #fff;
        border: 1px solid var(--pink-border);
        border-radius: 10px;
        padding: 12px;
        text-align: left;
        color: #333;
        transition: 0.2s;
    }

    .product-button:hover {
        background: var(--pink-light);
        border-color: var(--pink);
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .product-price {
        color: var(--pink-dark);
        font-size: 13px;
        font-weight: 600;
    }

    .quantity-input {
        width: 75px;
        border-radius: 9px;
    }

    .quantity-input:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 0.15rem rgba(245, 182, 207, 0.2);
    }

    .btn-add {
        width: 48px;
        background: var(--pink);
        border: 1px solid var(--pink);
        color: #fff;
        border-radius: 9px;
        font-size: 20px;
        font-weight: 600;
    }

    .btn-add:hover {
        background: var(--pink-dark);
        border-color: var(--pink-dark);
        color: #fff;
    }

    /* =========================
       SEARCH
    ========================= */
    .search-box {
        padding: 18px 18px 0;
    }

    .search-box input {
        border-radius: 10px;
        padding: 11px 14px;
        border: 1px solid #ddd;
    }

    .search-box input:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 0.15rem rgba(245, 182, 207, 0.2);
    }

    /* =========================
       KERANJANG
    ========================= */
    .cart-body {
        padding: 0;
    }

    .cart-table {
        margin-bottom: 0;
    }

    .cart-table thead {
        background: var(--pink-light);
    }

    .cart-table th {
        font-size: 12px;
        text-transform: uppercase;
        color: #555;
        padding: 13px 10px;
        border-bottom: 1px solid var(--pink-border);
        white-space: nowrap;
    }

    .cart-table td {
        padding: 12px 10px;
        vertical-align: middle;
        font-size: 13px;
    }

    .cart-product {
        font-weight: 600;
        color: #333;
    }

    .cart-price {
        color: #777;
        white-space: nowrap;
    }

    .cart-subtotal {
        font-weight: 700;
        color: #333;
        white-space: nowrap;
    }

    .btn-delete {
        background: #fff0f0;
        color: #d9534f;
        border: 1px solid #f0c5c5;
        border-radius: 7px;
        font-size: 12px;
    }

    .btn-delete:hover {
        background: #f8d7da;
        color: #b52b27;
    }

    /* =========================
       EMPTY CART
    ========================= */
    .empty-cart {
        text-align: center;
        padding: 45px 20px;
        color: #999;
    }

    .empty-cart-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--pink-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 26px;
    }

    .empty-cart h6 {
        font-weight: 700;
        color: #555;
        margin-bottom: 5px;
    }

    .empty-cart p {
        margin: 0;
        font-size: 13px;
    }

    /* =========================
       CHECKOUT
    ========================= */
    .checkout-area {
        padding: 20px;
        border-top: 1px solid var(--pink-border);
        background: #fff;
    }

    .total-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 2px;
    }

    .total-price {
        color: var(--pink-dark);
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .payment-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .payment-select {
        border-radius: 9px;
        padding: 10px 12px;
        margin-bottom: 12px;
    }

    .payment-select:focus {
        border-color: var(--pink);
        box-shadow: 0 0 0 0.15rem rgba(245, 182, 207, 0.2);
    }

    .btn-checkout {
        width: 100%;
        background: var(--pink);
        border: 1px solid var(--pink);
        color: white;
        border-radius: 9px;
        padding: 11px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .btn-checkout:hover {
        background: var(--pink-dark);
        border-color: var(--pink-dark);
        color: white;
    }

    .btn-cancel {
        width: 100%;
        background: white;
        border: 1px solid #e3a5a5;
        color: #d9534f;
        border-radius: 9px;
        padding: 10px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #fff0f0;
        color: #c9302c;
    }

    /* =========================
       ALERT
    ========================= */
    .alert-danger {
        border-radius: 10px;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {

        .pos-container {
            margin-top: 20px;
        }

        .product-list {
            max-height: 450px;
        }

        .quantity-input {
            width: 65px;
        }

        .cart-table {
            min-width: 650px;
        }
    }
</style>


<div class="pos-container">

    {{-- ALERT ERROR --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <strong>Gagal!</strong>
            {{ session('errors') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- HEADER --}}
    <div class="pos-header">
        <h2>Buat Transaksi Penjualan</h2>
        <p>Pilih produk, masukkan jumlah, lalu lakukan pembayaran.</p>
    </div>


    <div class="row g-4">

        {{-- =================================================
             DAFTAR PRODUK
        ================================================== --}}
        <div class="col-lg-6">

            <div class="pos-card">

                <div class="pos-card-header">
                    <h5>🛍️ Daftar Produk</h5>
                    <p>Pilih produk yang ingin dimasukkan ke keranjang.</p>
                </div>


                {{-- SEARCH --}}
                <div class="search-box">

                    <form
                        method="GET"
                        action="{{ route('penjualan.create') }}">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="🔎 Cari produk..."
                            autocomplete="off"
                        >

                    </form>

                </div>


                {{-- LIST PRODUK --}}
                <div class="product-list">

                    @forelse ($products as $product)

                        <form
                            method="POST"
                            action="{{ route('itempenjualan.store') }}"
                            class="product-item">

                            @csrf

                            <input
                                type="hidden"
                                name="product_id"
                                value="{{ $product->id }}"
                            >


                            {{-- NAMA + HARGA --}}
                            <div class="product-info">

                                <button
                                    type="submit"
                                    class="product-button"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                    <div class="product-name">
                                        {{ $product->nama }}
                                    </div>

                                    <div class="product-price">
                                        Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                    </div>

                                </button>

                            </div>


                            {{-- JUMLAH --}}
                            <div>

                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    class="form-control quantity-input"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}
                                >

                            </div>


                            {{-- TAMBAH --}}
                            <div>

                                <button
                                    type="submit"
                                    class="btn btn-add"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                    +

                                </button>

                            </div>

                        </form>

                    @empty

                        <div class="empty-cart">

                            <div class="empty-cart-icon">
                                🔎
                            </div>

                            <h6>Produk Tidak Ditemukan</h6>

                            <p>
                                Coba gunakan kata pencarian yang berbeda.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- =================================================
             KERANJANG
        ================================================== --}}
        <div class="col-lg-6">

            <div class="pos-card">

                <div class="pos-card-header">

                    <h5>🛒 Keranjang Belanja</h5>

                    <p>
                        Produk yang akan diproses dalam transaksi.
                    </p>

                </div>


                {{-- TABEL KERANJANG --}}
                <div class="cart-body">

                    <div class="table-responsive">

                        <table class="table cart-table">

                            <thead>

                                <tr>

                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($sale->itemPenjualan as $item)

                                    <tr>

                                        {{-- PRODUK --}}
                                        <td>

                                            <div class="cart-product">
                                                {{ $item->produk->nama }}
                                            </div>

                                        </td>


                                        {{-- HARGA --}}
                                        <td>

                                            <span class="cart-price">
                                                Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                            </span>

                                        </td>


                                        {{-- JUMLAH --}}
                                        <td>

                                            <form
                                                method="POST"
                                                action="{{ route('itempenjualan.update', $item->id) }}">

                                                @csrf
                                                @method('PUT')

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item->kuantitas }}"
                                                    min="1"
                                                    class="form-control form-control-sm"
                                                    onchange="this.form.submit()"
                                                >

                                            </form>

                                        </td>


                                        {{-- SUBTOTAL --}}
                                        <td>

                                            <span class="cart-subtotal">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </span>

                                        </td>


                                        {{-- HAPUS --}}
                                        <td>

                                            @can('delete', $item)

                                                <form
                                                    method="POST"
                                                    action="{{ route('itempenjualan.destroy', $item->id) }}">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-delete btn-sm"
                                                        onclick="return confirm('Hapus produk ini dari keranjang?')">

                                                        Hapus

                                                    </button>

                                                </form>

                                            @endcan

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="5">

                                            <div class="empty-cart">

                                                <div class="empty-cart-icon">
                                                    🛒
                                                </div>

                                                <h6>Keranjang Masih Kosong</h6>

                                                <p>
                                                    Pilih produk di sebelah kiri untuk memulai transaksi.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- =================================================
                     CHECKOUT
                ================================================== --}}
                <div class="checkout-area">

                    <div class="total-label">
                        Total Pembayaran
                    </div>

                    <div class="total-price">
                        Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                    </div>


                    {{-- CHECKOUT --}}
                    <form
                        method="POST"
                        action="{{ route('penjualan.update', $sale->id) }}"
                        onsubmit="return confirm('Yakin ingin checkout?')">

                        @csrf
                        @method('PUT')


                        <div class="payment-label">
                            Metode Pembayaran
                        </div>

                        <select
                            name="payment_method"
                            class="form-select payment-select"
                            required
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                            <option value="">
                                Pilih Pembayaran
                            </option>

                            <option value="CASH">
                                💵 Cash
                            </option>

                            <option value="QRIS">
                                📱 QRIS
                            </option>

                        </select>


                        <button
                            type="submit"
                            class="btn btn-checkout"
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                            ✓ Checkout

                        </button>

                    </form>


                    {{-- BATAL TRANSAKSI --}}
                    @can('delete', $sale)

                        <form
                            method="POST"
                            action="{{ route('penjualan.destroy', $sale->id) }}"
                            onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-cancel">

                                ✕ Batalkan Transaksi

                            </button>

                        </form>

                    @endcan

                </div>

            </div>

        </div>

    </div>

</div>

@endsection