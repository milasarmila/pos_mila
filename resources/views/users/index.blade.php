@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')
@include('layouts.navbar')

<!-- Blok CSS Tambahan untuk Kustomisasi Warna Premium -->
<style>
    body {
        background-color: #f8fafc !important; /* Latar belakang abu-abu sangat lembut */
    }
    .shadow-premium {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    }
    .badge-user-admin {
        background-color: #e0f2fe !important;
        color: #0369a1 !important;
        border: 1px solid #bae6fd !important;
        font-weight: 600;
    }
    .badge-user-kasir {
        background-color: #f0fdf4 !important;
        color: #166534 !important;
        border: 1px solid #bbf7d0 !important;
        font-weight: 600;
    }
    .badge-user-lainnya {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 600;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f5f9 !important;
        transition: background-color 0.2s ease;
    }
</style>

<div class="container py-4">
    <!-- Notifikasi Sukses (Jika Ada) -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header & Tombol Tambah User -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom text-gray-800">
        <div>
            <h1 class="h3 mb-1 fw-bold text-dark">Halaman Users</h1>
            <p class="text-muted small mb-0">Kelola hak akses, tingkat jabatan administrator, dan akun operasional kasir Anda.</p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 py-2 shadow-sm fw-medium d-inline-flex align-items-center gap-2">
                <span>➕</span> Create New User
            </a>
        </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="card border-0 shadow-premium mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted">🔍</span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 border-secondary-subtle" placeholder="Search username or email..." aria-label="Search users">
                    <button class="btn btn-primary px-4 fw-medium" type="submit">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Users -->
    <div class="card border-0 shadow-premium">
        <div class="table-responsive rounded-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small tracking-wider text-secondary">
                    <tr>
                        <th scope="col" class="ps-4 py-3" style="width: 70px;">#</th>
                        <th scope="col" class="py-3">Name</th>
                        <th scope="col" class="py-3">Email</th>
                        <th scope="col" class="py-3" style="width: 150px;">Role</th>
                        <th scope="col" class="pe-4 py-3 text-end" style="min-width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Avatar Mini Generator Otomatis Berdasarkan Huruf Depan -->
                                    <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase border" style="width: 32px; height: 32px; font-size: 12px;">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="text-secondary">{{ $user->email }}</td>
                            <td>
                                @php 
                                    // Ambil string role, baik berupa objek relasi maupun string langsung
                                    $roleName = is_object($user->role) ? $user->role->name : (string)$user->role;
                                @endphp

                                @if(strtolower($roleName) == 'admin')
                                    <span class="badge badge-user-admin px-3 py-2 rounded-pill">Admin</span>
                                @elseif(strtolower($roleName) == 'kasir')
                                    <span class="badge badge-user-kasir px-3 py-2 rounded-pill">Kasir</span>
                                @else
                                    <span class="badge badge-user-lainnya px-3 py-2 rounded-pill text-capitalize">{{ $roleName }}</span>
                                @endif
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning px-3 fw-medium">
                                        Edit Akun
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-3 fw-medium" onclick="return confirm('Yakin hapus user ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="mb-2 fs-3">👥</div>
                                <div class="fw-medium">Data user tidak ditemukan</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Footer -->
        @if(method_exists($users, 'hasPages') && $users->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
