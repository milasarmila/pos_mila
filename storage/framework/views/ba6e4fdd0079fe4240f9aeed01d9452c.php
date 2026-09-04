

<?php $__env->startSection('title', 'Detail Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">

    <div class="detail-card">

        <div class="detail-header">
            Detail Produk
        </div>

        <div class="detail-body">

            <div class="text-center mb-4">

                <img
                    src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                    alt="<?php echo e($product->nama); ?>"
                    class="product-image"
                    onerror="this.style.display='none';"
                >

            </div>

            <table class="table table-bordered">

                <tr>
                    <th>Nama Produk</th>
                    <td><?php echo e($product->nama); ?></td>
                </tr>

                <tr>
                    <th>Harga Beli</th>
                    <td>
                        Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr>
                    <th>Harga Jual</th>
                    <td>
                        Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                    </td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td><?php echo e($product->stok); ?></td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>
                        <?php echo e($product->created_at->format('d-m-Y')); ?>

                    </td>
                </tr>

            </table>

            <div class="mt-3">

                <a
                    href="<?php echo e(route('produk.index')); ?>"
                    class="btn btn-back"
                >
                    Kembali
                </a>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>

                    <a
                        href="<?php echo e(route('produk.edit', $product)); ?>"
                        class="btn btn-edit"
                    >
                        Edit
                    </a>

                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>

                    <form
                        action="<?php echo e(route('produk.destroy', $product)); ?>"
                        method="POST"
                        class="d-inline"
                    >

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button
                            type="submit"
                            class="btn btn-delete"
                            onclick="return confirm('Apakah yakin ingin menghapus produk ini?')"
                        >
                            Hapus
                        </button>

                    </form>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>


<style>

    body {
        background-color: #fff8fb;
    }

    .detail-card {
        background: white;
        border: 1px solid #f1d5e0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .detail-header {
        background-color: #f48fb1;
        color: white;
        font-size: 18px;
        font-weight: 600;
        padding: 14px 20px;
    }

    .detail-body {
        padding: 25px;
    }

    .product-image {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #f1d5e0;
    }

    .table th {
        width: 35%;
        background-color: #fff3f7;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .btn-back {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        color: #555;
    }

    .btn-back:hover {
        background-color: #e9ecef;
    }

    .btn-edit {
        background-color: #f8bbd0;
        color: #7a304d;
        border: none;
    }

    .btn-edit:hover {
        background-color: #f48fb1;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background-color: #bb2d3b;
        color: white;
    }

</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_mila\resources\views/produk/show.blade.php ENDPATH**/ ?>