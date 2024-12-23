<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Titanium Admin Dashboard</title>
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

                    <form action="<?= base_url('login') ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username"
                                name="username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password"
                                name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end mb-4">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Log in</button>
                    </form>

                    <div class="text-center my-3">
                        <p>Forgot your password? <a href="<?= site_url('forgot-password') ?>">Click here to reset</a>.
                        </p>
                    </div>
                    <div class="text-center">
                        <p>Don't have an account? <a
                                href="https://api.whatsapp.com/send/?phone=6282250706412&text&type=phone_number&app_absent=0">Contact
                                Developer</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>