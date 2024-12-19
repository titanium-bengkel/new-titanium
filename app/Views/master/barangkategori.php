<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<h4><?= $title; ?></h4>
<div class="container mt-2">
    <div class="card">
        <div class="card-header d-flex align-items-center gap-3">
            <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">Entry Data</button>
            <h6 class="mb-0 ms-auto">List Barang Kategori</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
                        <th>User Input</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($kategori) && !empty($kategori)) : ?>
                        <?php foreach ($kategori as $index => $item) : ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= $item['kode']; ?></td>
                                <td><?= $item['nama']; ?></td>
                                <td><?= $item['stok']; ?></td>
                                <td><?= $item['keterangan']; ?></td>
                                <td><?= isset($item['username']) ? $item['username'] : 'N/A'; ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $item['id']; ?>">
                                        <i class="fas fa-edit" style="color: white;"></i>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Barang Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('master/createBarang'); ?>" method="post">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <select class="form-select" id="stok" name="stok" required>
                            <option value="Y">Ya</option>
                            <option value="N">Tidak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($kategori as $item) : ?>
    <div class="modal fade" id="modalEdit<?= $item['id']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $item['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $item['id']; ?>">Edit Barang Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('master/updateBarang/' . $item['id']); ?>" method="post">
                        <input type="hidden" name="id" value="<?= $item['id']; ?>">
                        <div class="mb-3">
                            <label for="editKode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="editKode" name="kode" value="<?= $item['kode']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama" value="<?= $item['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="editStok" name="stok" value="<?= $item['stok']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="editKeterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="editKeterangan" name="keterangan" rows="3"><?= $item['keterangan']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
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

<?= $this->endSection() ?>