<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- SweetAlert2 for success/error notifications -->
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
                        <span class="breadcrumb-current text-muted">Kelola Role</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Kelola Role</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive px-4">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="m-0">Daftar Role</h5>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addRoleModal">
                                Tambah
                            </button>
                        </div>
                        <table class="table table-bordered" id="roleTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Label Role</th>
                                    <th class="d-flex justify-content-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($label as $role): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($role['label']) ?></td>
                                    <td class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editRoleModal" data-id="<?= $role['id'] ?>"
                                            data-label="<?= $role['label'] ?>"
                                            data-fitur="<?= htmlspecialchars($role['fitur']) ?>">
                                            Edit
                                        </button>
                                        <a href="<?= base_url('/superadmin/deleteRole/'.$role['id']) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus role ini?');">
                                            Hapus
                                        </a>
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

<!-- Modal untuk menambahkan Role -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Tambah Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('superadmin/createRole') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="mb-0 mt-2">Label Role:</p>
                    <input type="text" class="form-control mb-2" name="label" placeholder="Label Role" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Mengedit Role -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editRoleForm" action="<?= base_url('superadmin/updateRole') ?>" method="post">
                <input type="hidden" id="edit_role_id" name="id">
                <div class="modal-body">
                    <p class="mb-0 mt-2">Label Role:</p>
                    <input type="text" class="form-control mb-2" id="edit_label" name="label" required>
                    <!-- <p class="mb-0 mt-2">Fitur (JSON):</p>
                    <textarea class="form-control mb-2" id="edit_fitur" name="fitur" rows="5" readonly></textarea> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('editRoleModal').addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const label = button.getAttribute('data-label');
    const fitur = button.getAttribute('data-fitur');
    document.getElementById('edit_role_id').value = id;
    document.getElementById('edit_label').value = label;
    document.getElementById('edit_fitur').value = fitur;
});
</script>


<?= $this->endSection() ?>