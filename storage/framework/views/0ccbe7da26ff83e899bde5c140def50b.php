<!-- Navbar dengan gradasi pink muda ke putih -->
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-transparent shadow-sm py-2 custom-navbar-pink">
  <div class="container-fluid px-4">

    <!-- Brand POS -->
    <a class="navbar-brand fw-bold text-white fs-4 me-4" href="#">
      POS
    </a>

    <!-- Tombol Navbar Mobile -->
    <button
      class="navbar-toggler border-white-50"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Menu Navigasi -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">

        <!-- Dashboard -->
        <li class="nav-item">
          <a
            class="nav-link px-3 rounded-2 <?php echo e(Request::is('dashboard') ? 'active bg-white text-dark fw-bold' : 'text-white custom-nav-item'); ?>"
            href="<?php echo e(route('dashboard')); ?>"
          >
            Dashboard
          </a>
        </li>

        <!-- Users khusus Admin -->
        <?php if(auth()->check() && auth()->user()->role_id == 1): ?>
        <li class="nav-item">
          <a
            class="nav-link px-3 rounded-2 <?php echo e(Request::is('admin/users') ? 'active bg-white text-dark fw-bold' : 'text-white custom-nav-item'); ?>"
            href="<?php echo e(route('admin.users')); ?>"
          >
            Users
          </a>
        </li>
        <?php endif; ?>

        <!-- Produk -->
        <li class="nav-item">
          <a
            class="nav-link px-3 rounded-2 <?php echo e(Request::is('produk') ? 'active bg-white text-dark fw-bold' : 'text-white custom-nav-item'); ?>"
            href="<?php echo e(route('produk.index')); ?>"
          >
            Produk
          </a>
        </li>

        <!-- Jenis -->
        <li class="nav-item">
          <a
            class="nav-link px-3 rounded-2 <?php echo e(Request::is('Jenis') ? 'active bg-white text-dark fw-bold' : 'text-white custom-nav-item'); ?>"
            href="<?php echo e(route('Jenis.index')); ?>"
          >
            Jenis
          </a>
        </li>

        <!-- Penjualan -->
        <li class="nav-item">
          <a
            class="nav-link px-3 rounded-2 <?php echo e(Request::is('penjualan') ? 'active bg-white text-dark fw-bold' : 'text-white custom-nav-item'); ?>"
            href="<?php echo e(route('penjualan.index')); ?>"
          >
            Penjualan
          </a>
        </li>

      </ul>

      <!-- Tombol Logout -->
      <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-flex m-0">
        <?php echo csrf_field(); ?>

        <button
          type="submit"
          class="btn text-white px-4 py-2 rounded-3 fw-medium border-0 custom-logout-pink"
        >
          Logout
        </button>
      </form>

    </div>
  </div>
</nav>


<!-- CSS Navbar -->
<style>

  /* ========================================
     NAVBAR PINK MUDA → PUTIH
     ======================================== */

  .custom-navbar-pink {
    background: linear-gradient(
      90deg,
      #f48fb1 0%,
      #f8bbd0 45%,
      #fce4ec 75%,
      #ffffff 100%
    ) !important;
  }


  /* ========================================
     BRAND POS
     ======================================== */

  .custom-navbar-pink .navbar-brand {
    color: #ffffff !important;
    font-weight: 700;
  }


  /* ========================================
     MENU NAVBAR
     ======================================== */

  .navbar-nav .nav-link.custom-nav-item {
    color: #ffffff !important;
    transition: all 0.2s ease-in-out;
  }


  /* Hover menu */
  .navbar-nav .nav-link.custom-nav-item:hover {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.30);
    transition: all 0.2s ease-in-out;
  }


  /* ========================================
     MENU AKTIF
     ======================================== */

  .navbar-nav .nav-link.active {
    background-color: #ffffff !important;
    color: #ec6f9e !important;
    font-weight: 700 !important;
  }


  /* ========================================
     TOMBOL LOGOUT
     ======================================== */

  .custom-logout-pink {
    background-color: #f48fb1 !important;
    color: #ffffff !important;
    border: none !important;
  }


  /* Hover Logout */
  .custom-logout-pink:hover {
    background-color: #ec6f9e !important;
    color: #ffffff !important;
    transition: background-color 0.15s ease-in-out;
  }

</style><?php /**PATH C:\laragon\www\pos_mila\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>