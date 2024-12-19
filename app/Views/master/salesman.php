<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Salesman -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Salesman</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambahSalesman">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Salesman</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>User ID</th>
                                    <th>Keterangan</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Telp</th>
                                    <th>Target</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (isset($salesmen) && !empty($salesmen)) : ?>
                                    <?php foreach ($salesmen as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['kode']) ?></td>
                                            <td><?= esc($item['nama']) ?></td>
                                            <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                            <td><?= esc($item['keterangan']) ?></td>
                                            <td><?= esc($item['alamat']) ?></td>
                                            <td><?= esc($item['kota']) ?></td>
                                            <td><?= esc($item['telp']) ?></td>
                                            <td><?= esc($item['target']) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSalesman<?= $item['id_salesman'] ?>"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="10">No data available</td>
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

<!-- Modal Tambah Salesman -->
<div class="modal fade" id="modalTambahSalesman" tabindex="-1" aria-labelledby="modalTambahSalesmanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSalesmanLabel">Tambah Salesman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createSalesman'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kota" name="kota" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="telp" class="col-sm-4 col-form-label">Telp</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telp" name="telp" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="target" class="col-sm-4 col-form-label">Target</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="target" name="target" required>
                                </div>
                            </div>
                        </div>
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

<!-- Modal Edit Salesman -->
<?php if (isset($salesmen) && !empty($salesmen)) : ?>
    <?php foreach ($salesmen as $item) : ?>
        <div class="modal fade" id="modalEditSalesman<?= $item['id_salesman'] ?>" tabindex="-1" aria-labelledby="modalEditSalesmanLabel<?= $item['id_salesman'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditSalesmanLabel<?= $item['id_salesman'] ?>">Edit Salesman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('updateSalesman/' . $item['id_salesman']); ?>" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label for="edit_kode" class="col-sm-4 col-form-label">Kode</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_kode" name="kode" value="<?= esc($item['kode']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="edit_nama" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_nama" name="nama" value="<?= esc($item['nama']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="edit_keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_keterangan" name="keterangan" value="<?= esc($item['keterangan']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="edit_alamat" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_alamat" name="alamat" value="<?= esc($item['alamat']) ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 row">
                                        <label for="edit_kota" class="col-sm-4 col-form-label">Kota</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_kota" name="kota" value="<?= esc($item['kota']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="edit_telp" class="col-sm-4 col-form-label">Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_telp" name="telp" value="<?= esc($item['telp']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="edit_target" class="col-sm-4 col-form-label">Target</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="edit_target" name="target" value="<?= esc($item['target']) ?>" required>
                                        </div>
                                    </div>
                                </div>
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
<?php endif; ?>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Script untuk menampilkan SweetAlert Toast -->
<?php if (session()->getFlashdata('alert')) : ?>
    <script>
        $(document).ready(function() {
            const alert = <?= json_encode(session()->getFlashdata('alert')) ?>;
            Swal.fire(alert);
        });
    </script>
<?php endif; ?>
<script>
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '<?= session()->getFlashdata('error') ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>