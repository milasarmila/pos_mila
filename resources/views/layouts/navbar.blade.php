<!-- Background diubah menjadi bg-maroon kustom, teks default putih -->
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-transparent shadow-sm py-2 custom-navbar-maroon">
  <div class="container-fluid px-4">
    <!-- Brand POS (Putih Tebal) -->
    <a class="navbar-brand fw-bold text-white fs-4 me-4" href="#">POS</a>
    
    <button class="navbar-toggler border-white-50" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Menu Navigasi di Atas Latar Belakang Maroon -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
        <li class="nav-item">
          <!-- Halaman Aktif: Tombol Putih | Tidak Aktif: Teks Putih Transparan -->
          <a class="nav-link px-3 rounded-2 {{ Request::is('dashboard') ? 'active bg-white text-dark fw-bold' : 'text-white-50 custom-nav-item' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>  
        
        @if(auth()->check() && auth()->user()->role_id == 1)
        <li class="nav-item">
          <a class="nav-link px-3 rounded-2 {{ Request::is('admin/users') ? 'active bg-white text-dark fw-bold' : 'text-white-50 custom-nav-item' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
        @endif
        
        <li class="nav-item">
          <a class="nav-link px-3 rounded-2 {{ Request::is('produk') ? 'active bg-white text-dark fw-bold' : 'text-white-50 custom-nav-item' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link px-3 rounded-2 {{ Request::is('jenis') ? 'active bg-white text-dark fw-bold' : 'text-white-50 custom-nav-item' }}" href="{{ route('Jenis.index') }}">Jenis</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link px-3 rounded-2 {{ Request::is('penjualan') ? 'active bg-white text-dark fw-bold' : 'text-white-50 custom-nav-item' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>
      
      <!-- Tombol Logout Diubah Menjadi Warna Abu-abu Netral Padat -->
      <form action="{{ route('logout') }}" method="POST" class="d-flex m-0">
        @csrf
        <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-medium border-0 custom-logout-gray" style="background-color: #6c757d;">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>

<!-- Tambahkan atau perbarui CSS di file app.blade.php Anda -->
<style>
  /* Menyetel latar belakang seluruh baris navbar menjadi Maroon Polos */
  .custom-navbar-maroon {
    background-color: #800020 !important;
  }

  /* Efek saat menu teks putih transparan disorot kursor (hover) */
  .navbar-nav .nav-link.custom-nav-item:hover {
    color: #ffffff !important; 
    background-color: rgba(255, 255, 255, 0.1); 
    transition: all 0.2s ease-in-out;
  }

  /* Efek Hover Tombol Logout Abu-abu agar sedikit menggelap saat didekati kursor */
  .custom-logout-gray:hover {
    background-color: #5a6268 !important;
    transition: background-color 0.15s ease-in-out;
  }
</style>
