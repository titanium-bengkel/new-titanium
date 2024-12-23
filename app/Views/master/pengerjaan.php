<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

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
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/klaim/preorder') ?>" class="breadcrumb-link text-primary fw-bold">Pre Order</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pengerjaan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pengerjaan</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px; font-size: 14px;">
                        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Entry Data</button>
                        <table class="table table-bordered table-striped table-hover mb-0 text-center" id="tablePengerjaan">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Kode</th>
                                    <th class="text-center">Nama Pengerjaan</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">User Input</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (isset($kategori) && !empty($kategori)) : ?>
                                    <?php foreach ($kategori as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($item['kode_pengerjaan']); ?></td>
                                            <td style="text-align: left;"><?= esc($item['nama_pengerjaan']); ?></td>
                                            <td><?= esc($item['keterangan_pengerjaan']); ?></td>
                                            <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id_pengerjaan']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Pengerjaan -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Pengerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createPengerjaan'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_pengerjaan" class="form-label">Kode Pengerjaan</label>
                        <input type="text" class="form-control" id="kode_pengerjaan" name="kode_pengerjaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pengerjaan" class="form-label">Nama Pengerjaan</label>
                        <input type="text" class="form-control" id="nama_pengerjaan" name="nama_pengerjaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan_pengerjaan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan_pengerjaan" name="keterangan_pengerjaan" rows="3" required></textarea>
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
<!-- Modal Edit Pengerjaan -->
<?php foreach ($kategori as $item) : ?>
    <div class="modal fade" id="modalEdit<?= $item['id_pengerjaan']; ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Pengerjaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updatePengerjaan/' . $item['id_pengerjaan']); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_pengerjaan" value="<?= $item['id_pengerjaan']; ?>">
                        <div class="mb-3">
                            <label for="edit_kode_pengerjaan<?= $item['id_pengerjaan']; ?>" class="form-label">Kode Pengerjaan</label>
                            <input type="text" class="form-control" id="edit_kode_pengerjaan<?= $item['id_pengerjaan']; ?>" name="kode_pengerjaan" value="<?= esc($item['kode_pengerjaan']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_pengerjaan<?= $item['id_pengerjaan']; ?>" class="form-label">Nama Pengerjaan</label>
                            <input type="text" class="form-control" id="edit_nama_pengerjaan<?= $item['id_pengerjaan']; ?>" name="nama_pengerjaan" value="<?= esc($item['nama_pengerjaan']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_keterangan_pengerjaan<?= $item['id_pengerjaan']; ?>" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="edit_keterangan_pengerjaan<?= $item['id_pengerjaan']; ?>" name="keterangan_pengerjaan" rows="3" required><?= esc($item['keterangan_pengerjaan']); ?></textarea>
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
<?php endforeach; ?>

<!-- Link ke jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Pastikan tabel dengan ID 'tablePengerjaan' ada sebelum menginisialisasi DataTable
        if ($('#tablePengerjaan').length) {
            $('#tablePengerjaan').DataTable({
                "paging": true,
                "pageLength": 20,
                "lengthMenu": [20, 50, 100],
                "ordering": true,
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries"
                },
                "pagingType": "full_numbers"
            });
        }
    });
</script>


<?= $this->endSection() ?>