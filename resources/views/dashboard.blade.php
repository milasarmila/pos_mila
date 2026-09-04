@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('layouts.navbar')

<!-- Blok CSS Tambahan untuk Kustomisasi Warna Modern -->
<style>
    body {
        background-color: #f8fafc !important; /* Latar belakang abu-abu sangat lembut */
    }
    .text-gradient-primary {
        background: linear-gradient(45deg, #1e3a8a, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .card-sales-total {
        background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        border-left: 5px solid #22c55e !important;
    }
    .card-sales-count {
        background: linear-gradient(135deg, #ffffff 0%, #eff6ff 100%);
        border-left: 5px solid #3b82f6 !important;
    }
    .card-pay-cash {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-top: 4px solid #10b981 !important;
    }
    .card-pay-non-cash {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-top: 4px solid #06b6d4 !important;
    }
    .badge-stok-rendah {
        background-color: #fef3c7 !important;
        color: #d97706 !important;
        border: 1px solid #fde68a;
    }
    .badge-stok-habis {
        background-color: #770202 !important;
        color: #940404 !important;
        border: 1px solid #990d0d;
    }
    .table-custom text-muted-thead {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
    }
    .shadow-premium {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    }
</style>

<div class="container py-4">
    <!-- Judul Ringkasan Hari Ini -->
    <div class="text-center text-md-start border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="h2 fw-bold text-dark mb-1">Ringkasan Hari Ini</h1>
            <p class="text-muted mb-0 fw-medium">
                <i class="bi bi-calendar3 me-1 text-primary"></i> {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm">Live Monitoring</span>
    </div>

    @can('viewAny', App\Models\User::class)
        <!-- Section 1: Today's Sales -->
        <div class="mb-5">
            <h2 class="h5 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <span class="p-2 bg-white rounded-3 shadow-premium text-primary fs-6">📊</span> 
                <span class="text-secondary">Today's Sales</span>
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-premium card-sales-total">
                        <div class="card-body p-4">
                            <p class="text-muted text-uppercase small fw-bold tracking-wider mb-2">Total Nilai Penjualan Hari Ini</p>
                            <h3 class="fw-extrabold text-success mb-0 fs-2">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-premium card-sales-count">
                        <div class="card-body p-4">
                            <p class="text-muted text-uppercase small fw-bold tracking-wider mb-2">Jumlah Transaksi Hari Ini</p>
                            <h3 class="fw-extrabold text-primary mb-0 fs-2">{{ number_format($ringkasan['total_transaksi']) }} <small class="text-muted fs-6 fw-normal">Struk</small></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Cash & Payment Status -->
        <div class="mb-5">
            <h2 class="h5 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <span class="p-2 bg-white rounded-3 shadow-premium text-success fs-6">💳</span>
                <span class="text-secondary">Cash & Payment Status</span>
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-premium card-pay-cash">
                        <div class="card-body p-4">
                            <p class="text-muted text-uppercase small fw-bold tracking-wider mb-2">Total Pembayaran Tunai (Cash)</p>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-premium card-pay-non-cash">
                        <div class="card-body p-4">
                            <p class="text-muted text-uppercase small fw-bold tracking-wider mb-2">Total Pembayaran Non-Tunai</p>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Section 3: Critical Inventory Status -->
    <div class="mb-5">
        <h2 class="h5 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
            <span class="p-2 bg-white rounded-3 shadow-premium text-warning fs-6">⚠️</span>
            <span class="text-secondary">Critical Inventory Status</span>
        </h2>
        <div class="row g-4">
            <!-- Daftar Produk Stok Rendah -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-premium h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h6 fw-bold text-dark mb-0">Daftar Produk Stok Rendah</h3>
                            <span class="badge badge-stok-rendah px-2 py-1 small">Perlu Restock</span>
                        </div>
                        <div class="table-responsive rounded border border-light">
                            <table class="table table-hover align-middle mb-0 text-sm">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th scope="col" class="ps-3" style="width: 50px;">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col" class="text-end pe-3" style="width: 100px;">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-3 fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-end pe-3 fw-bold text-warning fs-6">{{ $produk->stok }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-success small fw-medium">
                                                <i class="bi bi-check-circle-fill me-1"></i> Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($produkStokRendah->hasPages())
                            <div class="d-flex justify-content-center mt-3 small">
                                {{ $produkStokRendah->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Produk Habis Stok -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-premium h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h6 fw-bold text-dark mb-0">Produk Habis Stok</h3>
                            <span class="badge badge-stok-habis px-2 py-1 small">Kritis 0</span>
                        </div>
                        <div class="table-responsive rounded border border-light">
                            <table class="table table-hover align-middle mb-0 text-sm">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th scope="col" class="ps-3" style="width: 50px;">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col" class="text-end pe-3" style="width: 100px;">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-3 fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-end pe-3 fw-bold text-danger fs-6">{{ $produk->stok }}</td>
@empty
Tidak ada produk yang habis stok.
@endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($produkStokHabis->hasPages())
                            <div class="d-flex justify-content-center mt-3 small">
                                {{ $produkStokHabis->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection