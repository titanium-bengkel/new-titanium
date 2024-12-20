<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Pengelolaan User</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <!-- Tombol Tambah -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        Tambah
                    </button>
                    <h6 class="mb-0 ms-auto">List Data User</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px;">
                        <table id="userTable" class="table table-bordered mb-0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Kontak</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['nama_user'] ?></td>
                                        <td><?= $user['alamat'] ?></td>
                                        <td><?= $user['kontak'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['status'] ?></td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-primary btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="<?= $user['id'] ?>" data-username="<?= $user['username'] ?>" data-password="<?= $user['password'] ?>" data-nama-user="<?= $user['nama_user'] ?>" data-alamat="<?= $user['alamat'] ?>" data-kontak="<?= $user['kontak'] ?>" data-email="<?= $user['email'] ?>" data-status="<?= $user['status'] ?>" data-level="<?= $user['level'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal untuk menambahkan User/Super -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Masukan Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('supercontroller/createUser') ?>" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="username" class="form-control" name="username" required>
                        </div>
                        <div class="col-md-4">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-4">
                            <label for="nama_user">Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="nama_user" class="form-control" name="nama_user" required>
                        </div>
                        <div class="col-md-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="alamat" class="form-control" name="alamat" required>
                        </div>
                        <div class="col-md-4">
                            <label for="kontak">Kontak</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="kontak" class="form-control" name="kontak" required>
                        </div>
                        <div class="col-md-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-select" id="status" name="status" required>
                                <option value="-">-</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="level">Level</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-select" id="level" name="level" required>
                                <option value=""></option>
                                <option value="direktur">Direktur</option>
                                <option value="manager">Manager</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="superadvisor">Super Advisor</option>
                                <option value="admingudang">Admin Gudang</option>
                                <option value="adminsparepart">Admin Sparepart</option>
                                <option value="salesman">Salesman</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing User -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('supercontroller/updateUser') ?>" method="post">
                    <input type="hidden" id="edit_user_id" name="edit_user_id">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="edit_username">Username</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="edit_username" class="form-control" name="username" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_password">Password</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="password" id="edit_password" class="form-control" name="password">
                        </div>
                        <div class="col-md-4">
                            <label for="edit_nama_user">Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="edit_nama_user" class="form-control" name="nama_user" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_alamat">Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="edit_alamat" class="form-control" name="alamat" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_kontak">Kontak</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="edit_kontak" class="form-control" name="kontak" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_email">Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="edit_email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_status">Status</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="-">-</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="edit_level">Level</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-select" id="edit_level" name="level" required>
                                <option value=""></option>
                                <option value="direktur">Direktur</option>
                                <option value="manager">Manager</option>
                                <option value="keuangan">Keuangan</option>
                                <option value="superadvisor">Super Advisor</option>
                                <option value="admingudang">Admin Gudang</option>
                                <option value="adminsparepart">Admin Sparepart</option>
                                <option value="salesman">Salesman</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<!-- <script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 10,
        });
    });
</script> -->
<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            "paging": true,
            "searching": true,
            "lengthChange": true,
            "ordering": false,
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const namaUser = this.getAttribute('data-nama-user');
                const alamat = this.getAttribute('data-alamat');
                const kontak = this.getAttribute('data-kontak');
                const email = this.getAttribute('data-email');
                const status = this.getAttribute('data-status');
                const level = this.getAttribute('data-level');

                document.getElementById('edit_user_id').value = userId;
                document.getElementById('edit_username').value = username;
                document.getElementById('edit_nama_user').value = namaUser;
                document.getElementById('edit_alamat').value = alamat;
                document.getElementById('edit_kontak').value = kontak;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_status').value = status;
                document.getElementById('edit_level').value = level;
            });
        });

        const deleteButtons = document.querySelectorAll('.delete-user-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const deleteUrl = `<?= base_url('supercontroller/deleteUser/') ?>${userId}`;

                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data yang telah dihapus tidak dapat kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yo, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
</script>


<?= $this->endSection() ?>