

<?php $__env->startSection('title', 'Login POS'); ?>

<?php $__env->startSection('content'); ?>
<!-- Blok CSS Khusus untuk Tampilan Login Premium Netral -->
<style>
    body {
        background-color: #f8fafc !important; /* Latar belakang abu-abu sangat soft, netral di mata */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .login-container {
        max-width: 420px;
        width: 100%;
        margin: auto;
        padding: 20px;
    }
    .card-login {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03); /* Bayangan tipis natural */
    }
    .form-control-custom {
        display: block;
        width: 100%;
        padding: 0.65rem 0.85rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.5;
        color: #1e293b;
        background-color: #fff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .form-control-custom:focus {
        color: #1e293b;
        background-color: #fff;
        border-color: #475569; /* Fokus abu-abu gelap netral */
        outline: 0;
        box-shadow: 0 0 0 2px rgba(71, 85, 105, 0.1);
    }
    .form-control-custom.is-invalid {
        border-color: #ef4444;
    }
    .btn-login-custom {
        background-color: #0f172a; /* Warna Slate Gelap, sangat netral dan profesional */
        color: #ffffff;
        border: none;
        padding: 0.65rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 8px;
        width: 100%;
        transition: background-color 0.2s ease;
    }
    .btn-login-custom:hover {
        background-color: #1e293b;
        color: #ffffff;
    }
    .alert-custom {
        background-color: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="login-container">
    <!-- Notifikasi Alert Berhasil Logout -->
    <?php if(session('status') || session('success') || request()->has('logout')): ?>
        <div class="alert-custom shadow-sm" role="alert">
            <span>✅</span> Anda telah berhasil logout dari sistem.
        </div>
    <?php endif; ?>

    <!-- Notifikasi Alert Jika Ada Error -->
    <?php if(session('errors')): ?>
        <div class="alert-custom" style="background-color: #fef2f2; border-color: #fca5a5; color: #991b1b;">
            <span>⚠️</span> <?php echo e(is_object(session('errors')) ? session('errors')->first() : session('errors')); ?>

        </div>
    <?php endif; ?>

    <!-- Card Login Box -->
    <div class="card card-login border-0 p-4">
        <div class="text-center mb-4">
            <h1 class="h4 fw-bold text-dark mb-1">Login POS</h1>
            <p class="text-muted small mb-0">Masukkan akun Anda untuk masuk ke dashboard kasir</p>
        </div>

        <!-- PERBAIKAN FATAL: Menggunakan route('auth') sesuai file web.php Anda agar tidak error 405 -->
        <form action="<?php echo e(route('auth')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <!-- Input Email -->
            <div class="mb-3">
                <label for="email" class="form-label small fw-medium text-secondary mb-1">Email address</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="form-control-custom <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="name@company.com" required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small mt-1" style="font-size: 0.75rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="form-label small fw-medium text-secondary mb-1">Password</label>
                <input type="password" name="password" id="password" class="form-control-custom <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="••••••••" required>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small mt-1" style="font-size: 0.75rem;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn-login-custom shadow-sm">
                Sign In
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_mila\resources\views/login.blade.php ENDPATH**/ ?>