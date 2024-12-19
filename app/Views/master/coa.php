<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Chart Of Accounts -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Chart Of Account</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambahCoa">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Chart Of Account</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive text-center" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Account</th>
                                    <th>Level</th>
                                    <th>Kode Head</th>
                                    <th>Kelompok</th>
                                    <th>Posisi</th>
                                    <th>Keterangan</th>
                                    <th>Update by</th>
                                    <th>Transaksi</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($coa as $index => $item) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $item['kode'] ?></td>
                                        <td><?= $item['nama_account'] ?></td>
                                        <td><?= $item['level'] ?></td>
                                        <td><?= $item['kode_head'] ?></td>
                                        <td><?= $item['kelompok'] ?></td>
                                        <td><?= $item['posisi'] ?></td>
                                        <td><?= $item['keterangan'] ?></td>
                                        <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                        <td><?= $item['transaksi'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditCoa<?= $item['id_coa'] ?>"><i class="fas fa-edit"></i></button>
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
<!-- Tabel Chart Of Accounts -->

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahCoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Chart Of Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createCoa') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_account" class="form-label">Nama Account</label>
                        <input type="text" class="form-control" id="nama_account" name="nama_account" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelompok" class="form-label">Jenis Akun</label>
                        <select class="form-select" id="kelompok" name="kelompok" required>
                            <option value="Neraca">Neraca</option>
                            <option value="Rugi Laba">Rugi Laba</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <select class="form-select" id="posisi" name="posisi" required>
                            <option value="Debet">Debet</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <div class="mb-3">
                        <label for="transaksi" class="form-label">Transaksi</label>
                        <select class="form-select" id="transaksi" name="transaksi" required>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
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
<!-- Modal Edit -->
<?php foreach ($coa as $item) : ?>
    <div class="modal fade" id="modalEditCoa<?= $item['id_coa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Chart Of Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updateCoa/' . $item['id_coa']) ?>" method="post">
                    <div class="modal-body">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $item['kode'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_account" class="form-label">Nama Account</label>
                            <input type="text" class="form-control" id="nama_account" name="nama_account" value="<?= $item['nama_account'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelompok" class="form-label">Kelompok</label>
                            <select class="form-select" id="kelompok" name="kelompok" required>
                                <option value="Neraca" <?= ($item['kelompok'] == 'Neraca') ? 'selected' : '' ?>>Neraca</option>
                                <option value="Rugi Laba" <?= ($item['kelompok'] == 'Rugi Laba') ? 'selected' : '' ?>>Rugi Laba</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-select" id="posisi" name="posisi" required>
                                <option value="Debet" <?= ($item['posisi'] == 'Debet') ? 'selected' : '' ?>>Debet</option>
                                <option value="Kredit" <?= ($item['posisi'] == 'Kredit') ? 'selected' : '' ?>>Kredit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $item['keterangan'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="transaksi" class="form-label">Transaksi</label>
                            <select class="form-select" id="transaksi" name="transaksi" required>
                                <option value="Ya" <?= ($item['transaksi'] == 'Ya') ? 'selected' : '' ?>>Ya</option>
                                <option value="Tidak" <?= ($item['transaksi'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
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
<?php endforeach; ?>



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