<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - <?= $title ?></title>
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="16x16">
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="32x32">
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="48x48">
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="64x64">
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="128x128">

    <link rel="stylesheet" crossorigin href="<?= base_url('./dist/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" crossorigin href="<?= base_url('./dist/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" crossorigin href="<?= base_url('./dist/assets/compiled/css/auth.css') ?>">
</head>

<body>
    <script src="<?= base_url('./dist/assets/static/js/initTheme.js') ?>"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="<?= base_url('./dist/assets/img/titanium.webp') ?>" alt="Titanium Workshop Background"
                        style="width:100%; height:auto;">
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo text-center mb-0">
                        <a href="#">
                            <img src="<?= base_url('./dist/assets/img/titanium.png') ?>" alt="Logo"
                                style="width:150px; height:auto;">
                        </a>
                    </div>
                    <h2 class="text-center">Lupa Password</h2>

                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
                    <?php endif; ?>

                    <!-- Forgot Password Form -->
                    <form action="<?= site_url('forgotPasswordSubmit') ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="Masukkan email Anda"
                                name="email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Kirim Instruksi Reset</button>
                    </form>

                    <div class="text-center my-3">
                        <p>Ingat password Anda? <a href="<?= site_url('/') ?>">Kembali ke login</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>