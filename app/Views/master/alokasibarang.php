<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Alokasi Barang -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Alokasi Barang</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Alokasi Barang</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama Alokasi</th>
                                    <th>Kode perkiraan</th>
                                    <th>Keterangan</th>
                                    <th>User Input</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (isset($kategori) && !empty($kategori)) : ?>
                                    <?php foreach ($kategori as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($item['kode_alokasi']); ?></td>
                                            <td><?= esc($item['nama_alokasi']); ?></td>
                                            <td><?= isset($item['kode_perkiraan']) ? esc($item['kode_perkiraan']) : 'N/A'; ?></td>
                                            <td><?= esc($item['keterangan_alokasi']); ?></td>
                                            <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id_alokasi']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7">No data available</td>
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

<!-- Modal Tambah Alokasi -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Alokasi Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createAlokasi'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_alokasi" class="form-label">Kode Alokasi</label>
                        <input type="text" class="form-control" id="kode_alokasi" name="kode_alokasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_alokasi" class="form-label">Nama Alokasi</label>
                        <input type="text" class="form-control" id="nama_alokasi" name="nama_alokasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_perkiraan" class="form-label">Kode Perkiraan</label>
                        <input type="text" class="form-control" id="kode_perkiraan" name="kode_perkiraan" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan_alokasi" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan_alokasi" name="keterangan_alokasi" rows="3" required></textarea>
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

<!-- Modal Edit Alokasi -->
<?php foreach ($kategori as $item) : ?>
    <div class="modal fade" id="modalEdit<?= $item['id_alokasi']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $item['id_alokasi']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $item['id_alokasi']; ?>">Edit Alokasi Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updateAlokasi/' . $item['id_alokasi']); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_alokasi" value="<?= $item['id_alokasi']; ?>">
                        <div class="mb-3">
                            <label for="edit_kode_alokasi" class="form-label">Kode Alokasi</label>
                            <input type="text" class="form-control" id="edit_kode_alokasi" name="kode_alokasi" value="<?= $item['kode_alokasi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_alokasi" class="form-label">Nama Alokasi</label>
                            <input type="text" class="form-control" id="edit_nama_alokasi" name="nama_alokasi" value="<?= $item['nama_alokasi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kode_perkiraan" class="form-label">Kode Perkiraan</label>
                            <input type="text" class="form-control" id="edit_kode_perkiraan" name="kode_perkiraan" value="<?= isset($item['kode_perkiraan']) ? esc($item['kode_perkiraan']) : ''; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_keterangan_alokasi" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="edit_keterangan_alokasi" name="keterangan_alokasi" rows="3" required><?= $item['keterangan_alokasi']; ?></textarea>
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