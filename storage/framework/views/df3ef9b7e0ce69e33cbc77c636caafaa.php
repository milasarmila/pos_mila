 

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h2>Tambah Jenis Baru</h2>
    <hr>

    
    <form action="<?php echo e(route('Jenis.store')); ?>" method="POST">
        <?php echo csrf_field(); ?> 
        
        <div class="mb-3">
            <label for="nama_jenis" class="form-label">Nama Jenis</label>
            <input type="text" class="form-control <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nama_jenis" name="nama_jenis" placeholder="Masukkan nama jenis baru" required>
            
            <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="<?php echo e(route('Jenis.index')); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_mila\resources\views/jenis/create.blade.php ENDPATH**/ ?>