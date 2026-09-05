@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

<style>
    body {
        background-color: #fff9fc !important;
    }

    .shadow-premium {
        box-shadow: 0 4px 15px rgba(225, 150, 180, 0.10) !important;
    }

    /* Tombol utama */
    .btn-pink {
        background-color: #f28fb5 !important;
        border-color: #f28fb5 !important;
        color: #fff !important;
        transition: 0.2s;
    }

    .btn-pink:hover {
        background-color: #e97da6 !important;
        border-color: #e97da6 !important;
        color: #fff !important;
    }

    /* Badge Admin */
    .badge-user-admin {
        background-color: #ffe4ef !important;
        color: #c85d82 !important;
        border: 1px solid #f7c5d9 !important;
        font-weight: 600;
    }

    /* Badge Kasir */
    .badge-user-kasir {
        background-color: #f0faf5 !important;
        color: #4d9470 !important;
        border: 1px solid #c7ead7 !important;
        font-weight: 600;
    }

    /* Badge lainnya */
    .badge-user-lainnya {
        background-color: #f7f3f5 !important;
        color: #806d76 !important;
        border: 1px solid #e5dce0 !important;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #fff5f9 !important;
        transition: background-color 0.2s ease;
    }

    .search-card {
        border: 1px solid #f3dce6 !important;
        border-radius: 10px;
    }

    .search-input {
        border-color: #eadde3 !important;
    }

    .search-input:focus {
        border-color: #f2a6c4 !important;
        box-shadow: 0 0 0 0.2rem rgba(242, 166, 196, 0.15) !important;
    }

    .btn-edit {
        color: #d77b9d !important;
        border-color: #eeb4ca !important;
    }

    .btn-edit:hover {
        background-color: #fff0f6 !important;
        color: #c85d82 !important;
        border-color: #e7a0bb !important;
    }

    .btn-delete {
        color: #dc6f7c !important;
        border-color: #e9aab2 !important;
    }

    .btn-delete:hover {
        background-color: #fff1f2 !important;
        color: #c95461 !important;
        border-color: #dc8e98 !important;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        font-size: 12px;
        background-color: #fff1f6 !important;
        color: #c85d82 !important;
        border: 1px solid #f3cddd !important;
    }

    .users-table {
        border-color: #f0e2e8;
    }

    .users-table thead th {
        background-color: #fff7fa !important;
        color: #765b67 !important;
        border-bottom: 1px solid #efdce5;
    }

    .users-table tbody td {
        border-color: #f1e4e9;
    }

    .alert-success {
        background-color: #f0faf5 !important;
        border-color: #c9e9d8 !important;
        color: #4d8064 !important;
    }
</style>


<div class="container py-4">

    {{-- NOTIFIKASI SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close">
            </button>
        </div>
    @endif


    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">

        <div>
            <h1 class="h3 mb-1 fw-bold text-dark">
                Halaman Users
            </h1>

            <p class="text-muted small mb-0">
                Kelola hak akses, tingkat jabatan administrator,
                dan akun operasional kasir Anda.
            </p>
        </div>

        <div>
            <a
                href="{{ route('admin.users.create') }}"
                class="btn btn-pink px-4 py-2 shadow-sm fw-medium d-inline-flex align-items-center gap-2">

                <span>➕</span>
                Create New User

            </a>
        </div>

    </div>


    {{-- PENCARIAN --}}
    <div class="card border-0 shadow-premium search-card mb-4">

        <div class="card-body p-3">

            <form action="{{ route('admin.users') }}" method="GET">

                <div class="input-group">

                    <span class="input-group-text bg-white border-end-0 text-muted">
                        🔍
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0 search-input"
                        placeholder="Search username or email..."
                        aria-label="Search users">

                    <button
                        class="btn btn-pink px-4 fw-medium"
                        type="submit">

                        Search

                    </button>

                    @if(request('search'))

                        <a
                            href="{{ route('admin.users') }}"
                            class="btn btn-outline-secondary">

                            Reset

                        </a>

                    @endif

                </div>

            </form>

        </div>

    </div>


    {{-- TABEL USERS --}}
    <div class="card border-0 shadow-premium">

        <div class="table-responsive rounded-3">

            <table class="table table-hover align-middle mb-0 users-table">

                <thead class="text-uppercase small">

                    <tr>

                        <th
                            scope="col"
                            class="ps-4 py-3"
                            style="width: 70px;">

                            #

                        </th>

                        <th scope="col" class="py-3">
                            Name
                        </th>

                        <th scope="col" class="py-3">
                            Email
                        </th>

                        <th
                            scope="col"
                            class="py-3"
                            style="width: 150px;">

                            Role

                        </th>

                        <th
                            scope="col"
                            class="pe-4 py-3 text-end"
                            style="min-width: 200px;">

                            Aksi

                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- NOMOR --}}
                            <td class="ps-4 fw-bold text-muted">

                                {{ $users->firstItem() + $loop->index }}

                            </td>


                            {{-- NAMA --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="user-avatar rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase">

                                        {{ substr($user->name, 0, 2) }}

                                    </div>

                                    <span class="fw-semibold text-dark">
                                        {{ $user->name }}
                                    </span>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td class="text-secondary">

                                {{ $user->email }}

                            </td>


                            {{-- ROLE --}}
                            <td>

                                @php
                                    $roleName = is_object($user->role)
                                        ? $user->role->name
                                        : (string) $user->role;
                                @endphp


                                @if(strtolower($roleName) == 'admin')

                                    <span class="badge badge-user-admin px-3 py-2 rounded-pill">
                                        Admin
                                    </span>

                                @elseif(strtolower($roleName) == 'kasir')

                                    <span class="badge badge-user-kasir px-3 py-2 rounded-pill">
                                        Kasir
                                    </span>

                                @else

                                    <span class="badge badge-user-lainnya px-3 py-2 rounded-pill text-capitalize">
                                        {{ $roleName }}
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="pe-4 py-3 text-end">

                                <div class="d-inline-flex gap-2">

                                    {{-- EDIT --}}
                                    <a
                                        href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-sm btn-outline-warning btn-edit px-3 fw-medium">

                                        Edit Akun

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger btn-delete px-3 fw-medium"
                                            onclick="return confirm('Yakin hapus user ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-5 text-muted">

                                <div class="mb-2 fs-3">
                                    👥
                                </div>

                                <div class="fw-medium">
                                    Data user tidak ditemukan
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if(method_exists($users, 'hasPages') && $users->hasPages())

            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">

                {{ $users->links() }}

            </div>

        @endif

    </div>

</div>

@endsection