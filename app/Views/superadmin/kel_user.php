<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if (session()->getFlashdata('success')) : ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '<?= session()->getFlashdata('success') ?>',
    showConfirmButton: false,
    timer: 3000
});
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: '<?= session()->getFlashdata('error') ?>',
    showConfirmButton: false,
    timer: 3000
});
<?php endif; ?>
</script>
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
                    style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kelola User</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Kelola User</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive px-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="m-0">Daftar Pengguna</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                Tambah
                            </button>
                        </div>
                        <table class="table table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['nama_user']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['status']) ?></td>
                                    <td><?= esc($user['role_label']) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-id="<?= $user['id'] ?>"
                                            data-username="<?= esc($user['username']) ?>"
                                            data-password="<?= esc($user['password']) ?>"
                                            data-nama-user="<?= esc($user['nama_user']) ?>"
                                            data-alamat="<?= esc($user['alamat']) ?>"
                                            data-kontak="<?= esc($user['kontak']) ?>"
                                            data-email="<?= esc($user['email']) ?>"
                                            data-status="<?= esc($user['status']) ?>"
                                            data-level="<?= esc($user['level']) ?>"
                                            data-role="<?= esc($user['id_role']) ?>">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Modal untuk menambahkan User/Super -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('supercontroller/createUser') ?>" method="post">
                <div class="modal-body">
                    <p class="mb-0 mt-2">Username :</p>
                    <input type="text" class="form-control mb-2" name="username" placeholder="Username" required>

                    <p class="mb-0 mt-2">Password :</p>
                    <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
                    <small class="text-danger">Password harus diisi.</small>

                    <p class="mb-0 mt-2">Nama User :</p>
                    <input type="text" class="form-control mb-2" name="nama_user" placeholder="Nama User" required>

                    <p class="mb-0 mt-2">Alamat :</p>
                    <input type="text" class="form-control mb-2" name="alamat" placeholder="Alamat" required>

                    <p class="mb-0 mt-2">Kontak :</p>
                    <input type="text" class="form-control mb-2" name="kontak" placeholder="Kontak" required>

                    <p class="mb-0 mt-2">Email :</p>
                    <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>

                    <p class="mb-0 mt-2">Status :</p>
                    <select class="form-select mb-2" name="status" required>
                        <option value="">- Pilih Status -</option>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>

                    <p class="mb-0 mt-2">Level :</p>
                    <select class="form-select mb-2" name="level" required>
                        <option value="">- Pilih Level -</option>
                        <option value="direktur">Direktur</option>
                        <option value="manager">Manager</option>
                        <option value="keuangan">Keuangan</option>
                        <option value="admin">Admin</option>
                    </select>

                    <p class="mb-0 mt-2">Role :</p>
                    <select class="form-select" name="id_role" required>
                        <option value="">- Pilih Role -</option>
                        <?php foreach ($roles as $role): ?>
                        <option value="<?= esc($role['id']) ?>"><?= esc($role['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal for Editing User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('supercontroller/updateUser') ?>" method="post">
                <input type="hidden" id="edit_user_id" name="edit_user_id">
                <div class="modal-body">
                    <p class="mb-0">Username :</p>
                    <input type="text" class="form-control" id="edit_username" name="username" required>

                    <p class="mb-0 mt-2">Password :</p>
                    <input type="password" class="form-control" id="edit_password" name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah">
                    <small class="text-danger">Biarkan kosong jika Anda tidak ingin mengubah
                        password.</small>

                    <p class="mb-0 mt-2">Nama User :</p>
                    <input type="text" class="form-control" id="edit_nama_user" name="nama_user" required>

                    <p class="mb-0 mt-2">Alamat :</p>
                    <input type="text" class="form-control" id="edit_alamat" name="alamat" required>

                    <p class="mb-0 mt-2">Kontak :</p>
                    <input type="text" class="form-control" id="edit_kontak" name="kontak" required>

                    <p class="mb-0 mt-2">Email :</p>
                    <input type="email" class="form-control" id="edit_email" name="email" required>

                    <p class="mb-0 mt-2">Status :</p>
                    <select class="form-select" id="edit_status" name="status" required>
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>

                    <p class="mb-0 mt-2">Level :</p>
                    <select class="form-select" id="edit_level" name="level" required>
                        <option value="direktur">Direktur</option>
                        <option value="manager">Manager</option>
                        <option value="keuangan">Keuangan</option>
                        <option value="admin">Admin</option>
                    </select>

                    <p class="mb-0 mt-2">Role :</p>
                    <select class="form-select" id="edit_role" name="id_role" required>
                        <option value="">- Pilih Role -</option>
                        <?php foreach ($roles as $role): ?>
                        <option value="<?= esc($role['id']) ?>"><?= esc($role['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
document.getElementById('editUserModal').addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const username = button.getAttribute('data-username');
    // const password = button.getAttribute('data-password');
    const namaUser = button.getAttribute('data-nama-user');
    const alamat = button.getAttribute('data-alamat');
    const kontak = button.getAttribute('data-kontak');
    const email = button.getAttribute('data-email');
    const status = button.getAttribute('data-status');
    const level = button.getAttribute('data-level');
    const idRole = button.getAttribute('data-role');
    document.getElementById('edit_user_id').value = id;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_password').value = '';
    document.getElementById('edit_nama_user').value = namaUser;
    document.getElementById('edit_alamat').value = alamat;
    document.getElementById('edit_kontak').value = kontak;
    document.getElementById('edit_email').value = email;
    const statusDropdown = document.getElementById('edit_status');
    for (let option of statusDropdown.options) {
        if (option.value === status) {
            option.selected = true;
        }
    }
    const levelDropdown = document.getElementById('edit_level');
    for (let option of levelDropdown.options) {
        if (option.value === level) {
            option.selected = true;
        }
    }
    document.getElementById('edit_role').value = idRole;
});


$(document).ready(function() {
    $('#userTable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [10, 25, 50, -1],
        "ordering": false,
        "language": {
            "lengthMenu": "Tampilkan _MENU_ entri",
            "search": "Search:",
            "zeroRecords": "Tidak ada hasil ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(disaring dari _MAX_ total entri)",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        }
    });
});
</script>

<?= $this->endSection() ?>