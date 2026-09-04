

<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">

    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h1 class="page-title mb-1">
                Produk
            </h1>

            <p class="page-subtitle mb-0">
                Kelola data produk, harga, dan stok barang.
            </p>
        </div>


        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>

            <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-add">
                <span class="plus-icon">＋</span>
                Tambah Produk
            </a>

        <?php endif; ?>

    </div>


    
    <?php if(session('success')): ?>

        <div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">

            <strong>Berhasil!</strong>
            <?php echo e(session('success')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    
    <?php if(session('error')): ?>

        <div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">

            <strong>Gagal!</strong>
            <?php echo e(session('error')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    
    <div class="row g-3 mb-4">

        
        <div class="col-md-4">

            <div class="stat-card">

                <div class="stat-icon pink-icon">
                    📦
                </div>

                <div>

                    <div class="stat-label">
                        Total Produk
                    </div>

                    <div class="stat-number">
                        <?php echo e($products->total()); ?>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="col-md-4">

            <div class="stat-card">

                <div class="stat-icon purple-icon">
                    📊
                </div>

                <div>

                    <div class="stat-label">
                        Stok di Halaman Ini
                    </div>

                    <div class="stat-number purple-text">
                        <?php echo e($products->sum('stok')); ?>

                    </div>

                </div>

            </div>

        </div>


        
        <div class="col-md-4">

            <div class="stat-card">

                <div class="stat-icon warning-icon">
                    ⚠️
                </div>

                <div>

                    <div class="stat-label">
                        Stok Rendah
                    </div>

                    <div class="stat-number warning-text">

                        <?php echo e($products->where('stok', '<=', 10)->count()); ?>


                    </div>

                </div>

            </div>

        </div>

    </div>


    
    <div class="product-card">


        
        <div class="product-card-header">

            <div>

                <h5 class="fw-bold mb-1">
                    Daftar Produk
                </h5>

                <small class="text-muted">
                    Data produk yang tersedia pada sistem POS
                </small>

            </div>


            
            <form
                action="<?php echo e(route('produk.index')); ?>"
                method="GET"
                class="search-form"
            >

                <div class="search-wrapper">

                    <span class="search-icon">
                        🔍
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        class="form-control search-input"
                        placeholder="Cari nama produk..."
                        autocomplete="off"
                    >

                </div>


                <button
                    class="btn btn-search"
                    type="submit"
                >
                    Cari
                </button>


                <?php if(request('search')): ?>

                    <a
                        href="<?php echo e(route('produk.index')); ?>"
                        class="btn btn-reset"
                    >
                        Reset
                    </a>

                <?php endif; ?>

            </form>

        </div>


        
        <?php if(request('search')): ?>

            <div class="search-info">

                🔎 Menampilkan hasil pencarian untuk:

                <strong>
                    "<?php echo e(request('search')); ?>"
                </strong>

            </div>

        <?php endif; ?>


        
        <div class="table-responsive">

            <table class="table product-table mb-0">

                <thead>

                    <tr>

                        <th width="65">
                            #
                        </th>

                        <th width="180">
                            User
                        </th>

                        <th width="100">
                            Foto
                        </th>

                        <th>
                            Nama Produk
                        </th>

                        <th width="150">
                            Harga Beli
                        </th>

                        <th width="150">
                            Harga Jual
                        </th>

                        <th width="100">
                            Stok
                        </th>

                        <th width="250" class="text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="product-row">


                            
                            <td>

                                <span class="product-number">

                                    <?php echo e($products->firstItem() + $loop->index); ?>


                                </span>

                            </td>


                            
                            <td>

                                <div class="user-name">

                                    <?php echo e($product->user->name); ?>


                                </div>

                            </td>


                            
                            <td>

                                <div class="product-image-wrapper">

                                    <img
                                        src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                                        alt="<?php echo e($product->nama); ?>"
                                        class="product-image"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                    >

                                    <div
                                        class="image-placeholder"
                                        style="display:none;"
                                    >
                                        📦
                                    </div>

                                </div>

                            </td>


                            
                            <td>

                                <div class="product-name">

                                    <?php echo e($product->nama); ?>


                                </div>

                            </td>


                            
                            <td>

                                <span class="price-text">

                                    Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?>


                                </span>

                            </td>


                            
                            <td>

                                <span class="price-sale">

                                    Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>


                                </span>

                            </td>


                            
                            <td>

                                <?php if($product->stok <= 0): ?>

                                    <span class="stock-badge stock-empty">
                                        Habis
                                    </span>

                                <?php elseif($product->stok <= 10): ?>

                                    <span class="stock-badge stock-low">
                                        <?php echo e($product->stok); ?> pcs
                                    </span>

                                <?php else: ?>

                                    <span class="stock-badge stock-safe">
                                        <?php echo e($product->stok); ?> pcs
                                    </span>

                                <?php endif; ?>

                            </td>


                            
                            <td>

                                <div class="action-buttons">


                                    
                                    <a
                                        href="<?php echo e(route('produk.show', $product->id)); ?>"
                                        class="btn btn-detail"
                                    >
                                        👁️ Detail
                                    </a>


                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>

                                        <a
                                            href="<?php echo e(route('produk.edit', $product)); ?>"
                                            class="btn btn-edit"
                                        >
                                            ✏️ Edit
                                        </a>

                                    <?php endif; ?>


                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>

                                        <form
                                            action="<?php echo e(route('produk.destroy', $product)); ?>"
                                            method="POST"
                                            class="delete-form d-inline"
                                        >

                                            <?php echo csrf_field(); ?>

                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                            >
                                                🗑️ Hapus
                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="8">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        📦
                                    </div>

                                    <h4>
                                        Data produk tidak tersedia
                                    </h4>

                                    <?php if(request('search')): ?>

                                        <p>
                                            Tidak ada produk yang cocok dengan pencarian
                                            <strong>"<?php echo e(request('search')); ?>"</strong>.
                                        </p>

                                        <a
                                            href="<?php echo e(route('produk.index')); ?>"
                                            class="btn btn-reset"
                                        >
                                            Tampilkan Semua Produk
                                        </a>

                                    <?php else: ?>

                                        <p>
                                            Belum ada produk yang tersimpan.
                                        </p>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>

                                            <a
                                                href="<?php echo e(route('produk.create')); ?>"
                                                class="btn btn-add"
                                            >
                                                ＋ Tambah Produk
                                            </a>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>


        
        <?php if($products->hasPages()): ?>

            <div class="pagination-wrapper">

                <div class="pagination-info">

                    Menampilkan

                    <strong>
                        <?php echo e($products->firstItem() ?? 0); ?>

                    </strong>

                    sampai

                    <strong>
                        <?php echo e($products->lastItem() ?? 0); ?>

                    </strong>

                    dari

                    <strong>
                        <?php echo e($products->total()); ?>

                    </strong>

                    produk

                </div>


                <div>

                    <?php echo e($products->appends(request()->query())->links()); ?>


                </div>

            </div>

        <?php endif; ?>

    </div>

</div>



<style>

    /* ========================================
       BACKGROUND
    ======================================== */

    body {
        background: #fff8fb;
    }


    /* ========================================
       HEADER
    ======================================== */

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #343a40;
    }


    .page-subtitle {
        color: #888;
        font-size: 15px;
    }


    /* ========================================
       BUTTON TAMBAH
    ======================================== */

    .btn-add {
        background: #f48fb1;
        color: #ffffff;
        border: none;
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }


    .btn-add:hover {
        background: #ec6f9e;
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(244, 143, 177, 0.25);
    }


    .plus-icon {
        font-size: 18px;
        vertical-align: middle;
    }


    /* ========================================
       ALERT
    ======================================== */

    .custom-alert {
        border-radius: 12px;
        border: none;
    }


    /* ========================================
       STAT CARD
    ======================================== */

    .stat-card {
        background: #ffffff;
        border: 1px solid #f3dce5;
        border-radius: 15px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }


    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }


    .pink-icon {
        background: #fde7ef;
    }


    .purple-icon {
        background: #eee8ff;
    }


    .warning-icon {
        background: #fff3cd;
    }


    .stat-label {
        font-size: 13px;
        color: #888;
        margin-bottom: 3px;
    }


    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: #ec6f9e;
    }


    .purple-text {
        color: #8e72d8;
    }


    .warning-text {
        color: #d89b00;
    }


    /* ========================================
       PRODUCT CARD
    ======================================== */

    .product-card {
        background: #ffffff;
        border: 1px solid #f3dce5;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }


    /* ========================================
       CARD HEADER
    ======================================== */

    .product-card-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid #f3e5ea;
    }


    /* ========================================
       SEARCH
    ======================================== */

    .search-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }


    .search-wrapper {
        position: relative;
        width: 280px;
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
        height: 42px;
        padding-left: 38px;
        border-radius: 10px;
        border: 1px solid #ead6de;
    }


    .search-input:focus {
        border-color: #f48fb1;
        box-shadow: 0 0 0 3px rgba(244, 143, 177, 0.12);
    }


    .btn-search {
        height: 42px;
        background: #f48fb1;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 0 18px;
        font-weight: 600;
    }


    .btn-search:hover {
        background: #ec6f9e;
        color: white;
    }


    .btn-reset {
        background: #f8f9fa;
        color: #666;
        border: 1px solid #ddd;
        border-radius: 9px;
        padding: 9px 14px;
        text-decoration: none;
    }


    .btn-reset:hover {
        background: #eeeeee;
        color: #333;
    }


    .search-info {
        padding: 12px 20px;
        background: #fff7fa;
        border-bottom: 1px solid #f5e3ea;
        font-size: 14px;
        color: #777;
    }


    /* ========================================
       TABLE
    ======================================== */

    .product-table {
        min-width: 1100px;
    }


    .product-table thead th {
        background: #fff4f8;
        color: #555;
        font-size: 13px;
        font-weight: 700;
        padding: 15px 14px;
        border-bottom: 1px solid #efdce5;
        white-space: nowrap;
    }


    .product-table tbody td {
        padding: 13px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f3e9ed;
    }


    .product-row {
        transition: all 0.15s ease;
    }


    .product-row:hover {
        background: #fff9fb;
    }


    /* ========================================
       NOMOR
    ======================================== */

    .product-number {
        color: #999;
        font-weight: 600;
    }


    /* ========================================
       USER
    ======================================== */

    .user-name {
        font-size: 13px;
        color: #555;
        font-weight: 500;
    }


    /* ========================================
       FOTO
    ======================================== */

    .product-image-wrapper {
        width: 58px;
        height: 58px;
        border-radius: 10px;
        overflow: hidden;
        background: #fff4f8;
        border: 1px solid #f3dce5;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    .image-placeholder {
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: #fff4f8;
    }


    /* ========================================
       NAMA PRODUK
    ======================================== */

    .product-name {
        font-weight: 600;
        color: #343a40;
    }


    /* ========================================
       HARGA
    ======================================== */

    .price-text {
        color: #777;
        font-size: 13px;
    }


    .price-sale {
        color: #ec6f9e;
        font-weight: 700;
        font-size: 13px;
    }


    /* ========================================
       STOK
    ======================================== */

    .stock-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }


    .stock-safe {
        background: #e8f7ee;
        color: #198754;
    }


    .stock-low {
        background: #fff3cd;
        color: #997404;
    }


    .stock-empty {
        background: #f8d7da;
        color: #b02a37;
    }


    /* ========================================
       ACTION BUTTON
    ======================================== */

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }


    .action-buttons .btn {
        font-size: 12px;
        font-weight: 600;
        border-radius: 8px;
        padding: 7px 10px;
        text-decoration: none;
    }


    /* DETAIL */

    .btn-detail {
        background: #e3f7fb;
        color: #087990;
        border: 1px solid #b6effb;
    }


    .btn-detail:hover {
        background: #0dcaf0;
        color: #ffffff;
    }


    /* EDIT */

    .btn-edit {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffe69c;
    }


    .btn-edit:hover {
        background: #ffc107;
        color: #212529;
    }


    /* DELETE */

    .btn-delete {
        background: #fde2e7;
        color: #dc3545;
        border: 1px solid #f5c2c7;
    }


    .btn-delete:hover {
        background: #dc3545;
        color: #ffffff;
    }


    /* ========================================
       EMPTY STATE
    ======================================== */

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }


    .empty-icon {
        font-size: 50px;
        margin-bottom: 12px;
    }


    .empty-state h4 {
        font-weight: 700;
        color: #555;
    }


    .empty-state p {
        color: #999;
        margin-bottom: 20px;
    }


    /* ========================================
       PAGINATION
    ======================================== */

    .pagination-wrapper {
        padding: 18px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        border-top: 1px solid #f3e5ea;
    }


    .pagination-info {
        color: #888;
        font-size: 13px;
    }


    .pagination-info strong {
        color: #555;
    }


    /* ========================================
       RESPONSIVE
    ======================================== */

    @media (max-width: 768px) {

        .page-title {
            font-size: 27px;
        }


        .product-card-header {
            flex-direction: column;
            align-items: stretch;
        }


        .search-form {
            width: 100%;
            flex-wrap: wrap;
        }


        .search-wrapper {
            width: 100%;
            flex: 1;
        }


        .btn-search,
        .btn-reset {
            flex: 1;
        }


        .pagination-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }

    }

</style>



<script>

    document.addEventListener('DOMContentLoaded', function () {


        /* ========================================
           KONFIRMASI HAPUS
        ======================================== */

        const deleteForms = document.querySelectorAll('.delete-form');


        deleteForms.forEach(function (form) {

            form.addEventListener('submit', function (event) {

                const yakin = confirm(
                    'Apakah kamu yakin ingin menghapus produk ini?'
                );


                if (!yakin) {

                    event.preventDefault();

                }

            });

        });


        /* ========================================
           AUTO FOCUS SEARCH
        ======================================== */

        const searchInput = document.querySelector('.search-input');


        if (searchInput) {

            searchInput.addEventListener('keydown', function (event) {

                if (event.key === 'Escape') {

                    this.value = '';

                }

            });

        }


    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_mila\resources\views/produk/index.blade.php ENDPATH**/ ?>