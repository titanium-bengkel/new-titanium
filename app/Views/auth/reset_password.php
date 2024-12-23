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
        background: url('<?= base_url("./dist/assets/img/TITANIUM.webp") ?>') no-repeat center center/cover;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1;
    }

    .form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        z-index: 2;
    }

    .form-container h2 {
        color: #fff;
        margin-bottom: 20px;
        font-size: 24px;
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
    }

    .form-control::placeholder {
        color: #ccc;
    }

    .btn-submit {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        color: #fff;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-submit:hover {
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
    <div class="overlay"></div>

    <div class="form-container">
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
            <div class="form-group">
                <label for="confirm-password">Konfirmasi Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm-password"
                    placeholder="Konfirmasi password baru" required>
            </div>
            <button type="submit" class="btn-submit">Reset Password</button>
        </form>
    </div>
</body>

</html>