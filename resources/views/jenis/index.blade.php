@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="page-title mb-1">
                Daftar Jenis Produk
            </h1>

            <p class="page-subtitle mb-0">
                Kelola kategori atau jenis produk yang tersedia pada sistem POS.
            </p>
        </div>

        <a href="{{ route('Jenis.create') }}" class="btn btn-add">
            <span class="me-1">＋</span>
            Tambah Jenis
        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- STATISTIC CARD --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="stat-card">

                <div class="stat-icon">
                    🏷️
                </div>

                <div>
                    <div class="stat-label">
                        Total Jenis
                    </div>

                    <div class="stat-number">
                        {{ $jenis->count() }}
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- TABLE CARD --}}
    <div class="jenis-card">

        {{-- CARD HEADER --}}
        <div class="jenis-card-header">

            <div>
                <h5 class="mb-1 fw-bold">
                    Data Jenis Produk
                </h5>

                <small class="text-muted">
                    Daftar jenis produk yang tersimpan dalam sistem
                </small>
            </div>


            {{-- SEARCH --}}
            <div class="search-wrapper">

                <span class="search-icon">
                    🔍
                </span>

                <input
                    type="text"
                    id="searchJenis"
                    class="form-control search-input"
                    placeholder="Cari jenis..."
                    autocomplete="off"
                >

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table custom-table mb-0" id="jenisTable">

                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Nama Jenis</th>
                        <th width="220" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="jenisTableBody">

                    @forelse($jenis as $item)

                        <tr class="jenis-row">

                            <td class="fw-semibold nomor">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="jenis-name">
                                    {{ $item->nama_jenis }}
                                </span>
                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('Jenis.edit', $item->id) }}"
                                        class="btn btn-edit"
                                    >
                                        ✏️ Edit
                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('Jenis.destroy', $item->id) }}"
                                        method="POST"
                                        class="delete-form"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-delete"
                                        >
                                            🗑️ Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr id="emptyData">

                            <td colspan="3">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        🏷️
                                    </div>

                                    <h5>
                                        Belum ada jenis produk
                                    </h5>

                                    <p>
                                        Silakan tambahkan jenis produk pertama.
                                    </p>

                                    <a
                                        href="{{ route('Jenis.create') }}"
                                        class="btn btn-add"
                                    >
                                        ＋ Tambah Jenis
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- NO SEARCH RESULT --}}
        <div
            id="noSearchResult"
            class="text-center py-5 d-none"
        >

            <div class="empty-icon">
                🔍
            </div>

            <h5 class="fw-bold">
                Data tidak ditemukan
            </h5>

            <p class="text-muted mb-0">
                Coba gunakan kata pencarian yang berbeda.
            </p>

        </div>

    </div>

</div>


{{-- CSS --}}
<style>

    /* ================================
       GENERAL
    ================================= */

    body {
        background: #fff8fb;
    }


    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #343a40;
    }


    .page-subtitle {
        color: #8a8a8a;
        font-size: 15px;
    }


    /* ================================
       BUTTON TAMBAH
    ================================= */

    .btn-add {
        background: #f48fb1;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }


    .btn-add:hover {
        background: #ec6f9e;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(244, 143, 177, 0.25);
    }


    /* ================================
       STATISTIC
    ================================= */

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid #f8dce7;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }


    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #fde7ef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }


    .stat-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 2px;
    }


    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #ec6f9e;
    }


    /* ================================
       CARD
    ================================= */

    .jenis-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #f3dce5;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }


    .jenis-card-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid #f3e5ea;
    }


    /* ================================
       SEARCH
    ================================= */

    .search-wrapper {
        position: relative;
        width: 260px;
    }


    .search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        font-size: 14px;
    }


    .search-input {
        padding-left: 38px;
        border-radius: 10px;
        border: 1px solid #ead6de;
        height: 42px;
    }


    .search-input:focus {
        border-color: #f48fb1;
        box-shadow: 0 0 0 3px rgba(244, 143, 177, 0.12);
    }


    /* ================================
       TABLE
    ================================= */

    .custom-table thead th {
        background: #fff4f8;
        color: #555;
        font-size: 14px;
        font-weight: 700;
        padding: 15px 18px;
        border-bottom: 1px solid #f0dce4;
    }


    .custom-table tbody td {
        padding: 15px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f4e9ed;
    }


    .jenis-row {
        transition: all 0.15s ease;
    }


    .jenis-row:hover {
        background: #fff9fb;
    }


    .jenis-name {
        font-weight: 600;
        color: #343a40;
    }


    .nomor {
        color: #999;
    }


    /* ================================
       BUTTON EDIT
    ================================= */

    .btn-edit {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffe69c;
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 13px;
        font-weight: 600;
    }


    .btn-edit:hover {
        background: #ffc107;
        color: #212529;
    }


    /* ================================
       BUTTON DELETE
    ================================= */

    .btn-delete {
        background: #fde2e7;
        color: #dc3545;
        border: 1px solid #f5c2c7;
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 13px;
        font-weight: 600;
    }


    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }


    /* ================================
       EMPTY STATE
    ================================= */

    .empty-state {
        padding: 45px 20px;
        text-align: center;
    }


    .empty-icon {
        font-size: 42px;
        margin-bottom: 10px;
    }


    .empty-state h5 {
        font-weight: 700;
        color: #555;
    }


    .empty-state p {
        color: #999;
        margin-bottom: 18px;
    }


    /* ================================
       ALERT
    ================================= */

    .custom-alert {
        border-radius: 10px;
        border: none;
    }


    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 768px) {

        .page-title {
            font-size: 26px;
        }


        .jenis-card-header {
            flex-direction: column;
            align-items: stretch;
        }


        .search-wrapper {
            width: 100%;
        }


        .custom-table {
            min-width: 600px;
        }

    }

</style>


{{-- JAVASCRIPT --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        /* ================================
           SEARCH JENIS
        ================================= */

        const searchInput = document.getElementById('searchJenis');
        const rows = document.querySelectorAll('.jenis-row');
        const noSearchResult = document.getElementById('noSearchResult');


        if (searchInput) {

            searchInput.addEventListener('input', function () {

                const keyword = this.value.toLowerCase().trim();

                let visibleRows = 0;


                rows.forEach(function (row) {

                    const nama = row
                        .querySelector('.jenis-name')
                        .textContent
                        .toLowerCase();


                    if (nama.includes(keyword)) {

                        row.style.display = '';
                        visibleRows++;

                    } else {

                        row.style.display = 'none';

                    }

                });


                if (noSearchResult) {

                    if (visibleRows === 0 && keyword !== '') {

                        noSearchResult.classList.remove('d-none');

                    } else {

                        noSearchResult.classList.add('d-none');

                    }

                }

            });

        }


        /* ================================
           KONFIRMASI HAPUS
        ================================= */

        const deleteForms = document.querySelectorAll('.delete-form');


        deleteForms.forEach(function (form) {

            form.addEventListener('submit', function (event) {

                const yakin = confirm(
                    'Apakah kamu yakin ingin menghapus jenis produk ini?'
                );


                if (!yakin) {

                    event.preventDefault();

                }

            });

        });

    });

</script>

@endsection