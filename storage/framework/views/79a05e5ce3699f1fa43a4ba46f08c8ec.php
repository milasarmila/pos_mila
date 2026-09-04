

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">
    <!-- Notifikasi Error -->
    <?php if(session('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong>Gagal!</strong> <?php echo e(session('errors')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Header & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-b text-gray-800">
        <div>
            <h1 class="h3 mb-1 fw-bold">Halaman Penjualan</h1>
            <p class="text-muted small mb-0">Kelola dan pantau seluruh riwayat transaksi kasir Anda.</p>
        </div>
        <div>
            <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary px-4 shadow-sm fw-medium">
                Create New Sale
            </a>
        </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="<?php echo e(route('penjualan.index')); ?>" method="GET">
                <div class="input-group">
                    <input type="text" name="search" value="<?php echo e(request()->search); ?>" class="form-control border-secondary-subtle" placeholder="Search penjualan..." aria-label="Search penjualan">
                    <button class="btn btn-primary px-4" type="submit">
                        Search
                    </button>
                    <?php if(request()->search): ?>
                        <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline-secondary">Reset</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Transaksi -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small text-muted">
                    <tr>
                        <th scope="col" class="ps-4 py-3" style="width: 60px;">#</th>
                        <th scope="col" class="py-3">Tanggal Transaksi</th>
                        <th scope="col" class="py-3">Kasir</th>
                        <th scope="col" class="py-3">Total Pembayaran</th>
                        <th scope="col" class="py-3">Metode Pembayaran</th>
                        <th scope="col" class="py-3">Status</th>
                        <th scope="col" class="pe-4 py-3 text-end" style="min-width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-4 fw-bold text-muted"><?php echo e($sales->firstItem() + $loop->index); ?></td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-medium"><?php echo e($sale->created_at->translatedFormat('d-m-Y')); ?></span>
                                    <span class="text-muted small"><?php echo e($sale->created_at->translatedFormat('H:i:s')); ?></span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    <?php echo e($sale->user->name); ?>

                                </span>
                            </td>
                            <td class="fw-bold text-dark">
                                Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?>

                            </td>
                            <td>
                                <span class="text-capitalize"><?php echo e($sale->metode_pembayaran); ?></span>
                            </td>
                            <td>
                                <?php if($sale->status == 'selesai' || $sale->status == 'success' || $sale->status == 'Selesai'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success px-2 py-1 rounded">Selesai</span>
                                <?php elseif($sale->status == 'pending' || $sale->status == 'Pending'): ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning px-2 py-1 rounded">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary px-2 py-1 rounded"><?php echo e($sale->status); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4 py-3 text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn btn-sm btn-primary px-3">
                                        Detail
                                    </a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $sale)): ?>
                                        <a href="<?php echo e(route('penjualan.edit', $sale)); ?>" class="btn btn-sm btn-warning px-3">
                                            Edit
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                        <form action="<?php echo e(route('penjualan.destroy', $sale)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger px-3" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="mb-2 fs-3">🔍</div>
                                <div>Data Tidak Ditemukan</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Footer -->
        <?php if($sales->hasPages()): ?>
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                <?php echo e($sales->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_mila\resources\views/penjualan/index.blade.php ENDPATH**/ ?>