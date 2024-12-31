<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="page-heading">
    <section class="section">
        <div class="row">
            <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
                style="border-color: #6c757d; padding: 15px 20px;">
                <div class="breadcrumb-wrapper" style="font-size: 14px;">
                    <a href="<?= base_url('dashboard/index') ?>"
                        class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                    <span class="breadcrumb-divider text-muted mx-3">/</span>
                    <span class="breadcrumb-current text-muted">Profile</span>
                </div>
                <h5 class="page-title mb-0 fw-bold">Profile</h5>
            </header>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="avatar avatar-2xl">
                                <img src="<?= base_url('uploads/profile/' . (session()->get('foto') ?: 'default.jpg')) . '?t=' . time() ?>"
                                    alt="Foto Profil" style="width: 100px; height: 100px; border-radius: 50%;">
                            </div>
                            <h3 class="mt-3"><?= esc($user['nama_user']) ?></h3>
                            <p class="text-small"><?= esc($user['level']) ?></p>
                            <form action="<?= base_url('updateProfile') ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="fotoProfil" class="form-label">Ganti Foto Profil</label>
                                    <input type="file" name="fotoProfil" id="fotoProfil" class="form-control"
                                        accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Upload Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('updateProfile') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Your Username" value="<?= esc($user['username']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_user" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama_user" class="form-control"
                                    placeholder="Nama Anda" value="<?= esc($user['nama_user']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control"
                                    placeholder="Alamat Anda" value="<?= esc($user['alamat']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" name="telp" id="kontak" class="form-control"
                                    placeholder="Nomor Telepon Anda" value="<?= esc($user['kontak']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Email Anda" value="<?= esc($user['email']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="current_password" class="form-label">Kata Sandi Lama</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="form-control" placeholder="Masukkan Kata Sandi Lama" required />
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Kata Sandi Baru" />
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Konfirmasi Kata Sandi Baru" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Update Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= session()->getFlashdata('success') ?>',
    confirmButtonText: 'OK'
});
<?php elseif (session()->getFlashdata('error')): ?>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?= session()->getFlashdata('error') ?>',
    confirmButtonText: 'OK'
});
<?php elseif (session()->getFlashdata('info')): ?>
Swal.fire({
    icon: 'info',
    title: 'Info',
    text: '<?= session()->getFlashdata('info') ?>',
    confirmButtonText: 'OK'
});
<?php endif; ?>
</script>

<?= $this->endSection(); ?>