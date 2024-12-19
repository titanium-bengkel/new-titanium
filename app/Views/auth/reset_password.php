<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - TITANIUM</title>
    <link rel="icon" href="<?= base_url('./dist/assets/img/titanium.png') ?>" type="image/x-icon" sizes="64x64">

    <!-- Styles -->
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        color: #fff;
    }

    /* Fullscreen Background */
    .background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('<?= base_url("./dist/assets/img/TITANIUM.webp") ?>') no-repeat center center/cover;
        z-index: -1;
    }

    /* Semi-transparent Overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: -1;
    }

    /* Login Container */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        z-index: 1;
    }

    .login-box {
        background: rgba(0, 0, 0, 0.4);
        padding: 40px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 20px;
        font-size: 1.8rem;
        color: #ffffff;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        margin-top: 10px;
    }

    .form-control::placeholder {
        color: #ccc;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        color: #fff;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .text-center a {
        color: #00bcd4;
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        margin-bottom: 15px;
    }

    .success-message {
        color: green;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="overlay"></div>

    <div class="login-container">
        <div class="login-box">
            <h2>Reset Password</h2>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= session()->getFlashdata('error') ?>
            </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('message')): ?>
            <div class="success-message">
                <?= session()->getFlashdata('message') ?>
            </div>
            <?php endif; ?>

            <!-- Reset Password Form -->
            <form action="<?= site_url('resetPasswordSubmit') ?>" method="POST">
                <input type="hidden" name="token" value="<?= $token ?>">
                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Masukkan password baru" required>
                </div>
                <button type="submit" class="btn-primary">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html>