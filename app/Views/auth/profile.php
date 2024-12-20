<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="page-heading">
    <section class="section">
        <div class="row">
            <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                <div class="breadcrumb-wrapper" style="font-size: 14px;">
                    <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
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
                                <img src="<?= base_url('./dist/assets/compiled/jpg/2.jpg') ?>" alt="Avatar">
                            </div>

                            <h3 class="mt-3"><?= esc($user['nama_user']) ?></h3>
                            <p class="text-small"><?= esc($user['level']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('updateProfile') ?>" method="post">
                            <div class="form-group">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Your Username" value="<?= esc($user['username']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Your Password" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_user" class="form-label">Name</label>
                                <input type="text" name="nama_user" id="nama_user" class="form-control" placeholder="Your Name" value="<?= esc($user['nama_user']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Address</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Your Address" value="<?= esc($user['alamat']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="kontak" class="form-label">Phone</label>
                                <input type="text" name="kontak" id="kontak" class="form-control" placeholder="Your Phone" value="<?= esc($user['kontak']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" value="<?= esc($user['email']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" name="status" id="status" class="form-control" placeholder="Your Status" value="<?= esc($user['status']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" name="level" id="level" class="form-control" placeholder="Your Level" value="<?= esc($user['level']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="foto" class="form-label">Profile Photo URL</label>
                                <input type="text" name="foto" id="foto" class="form-control" placeholder="Your Photo URL" value="<?= esc($user['foto']) ?>">
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<!-- Modal for Editing Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('updateProfile') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="username" value="<?= $user['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editNamaDepan">Nama</label>
                        <input type="text" class="form-control" id="editNamaDepan" name="nama" value="<?= $user['nama_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="editPassword" name="password" value="<?= $user['password']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text" id="toggleEditPassword">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editAlamat">Alamat</label>
                        <input type="text" class="form-control" id="editAlamat" name="alamat" value="<?= $user['alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="<?= $user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="editTelp">Telp</label>
                        <input type="text" class="form-control" id="editTelp" name="telp" value="<?= $user['kontak']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!-- Script to toggle password visibility -->
<script>
    $(document).ready(function() {
        $('#togglePassword').on('click', function() {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#toggleEditPassword').on('click', function() {
            var passwordField = $('#editPassword');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
<?= $this->endSection() ?>