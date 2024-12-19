<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Barang Group</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahGroup">
                        Entry Data
                    </button>
                    <h6 class="mb-0 ms-auto">List Data Barang Group</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kode Perkiraan</th>
                                    <th>User Input</th>
                                    <th>Keterangan</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                <?php foreach ($groups as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['kodegroup']; ?></td>
                                        <td><?= $row['namagroup']; ?></td>
                                        <td><?= isset($row['nama_kategori']) ? $row['nama_kategori'] : 'N/A'; ?></td>
                                        <td><?= $row['kodeperkiraan']; ?></td>
                                        <td><?= isset($row['username']) ? $row['username'] : 'N/A'; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id_group']; ?>"><i class="fas fa-edit"></i></button>
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

<!-- Modal Tambah Group Barang -->
<div class="modal fade" id="modalTambahGroup" tabindex="-1" aria-labelledby="modalTambahGroupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahGroupLabel">Tambah Group Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('/master/createBarangGroup') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kodegroup" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kodegroup" name="kodegroup" required>
                    </div>
                    <div class="mb-3">
                        <label for="namagroup" class="form-label">Nama Group</label>
                        <input type="text" class="form-control" id="namagroup" name="namagroup" required>
                    </div>
                    <div class="mb-3">
                        <label for="kodekategori" class="form-label">Kategori:</label>
                        <select class="form-select" id="kodekategori" name="kodekategori" required>
                            <option value="" disabled selected>Pilih</option>
                            <?php if (!empty($categories)) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['kode'] ?>"><?= $category['nama'] ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="">No categories found</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kodeperkiraan" class="form-label">Kode Perkiraan</label>
                        <input type="text" class="form-control" id="kodeperkiraan" name="kodeperkiraan" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Group Barang -->
<?php foreach ($groups as $row) : ?>
    <div class="modal fade" id="modalEdit<?= $row['id_group']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $row['id_group']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $row['id_group']; ?>">Edit Group Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('master/updateBarangGroup/' . $row['id_group']); ?>" method="post">
                        <input type="hidden" name="edit_id" value="<?= $row['id_group']; ?>">
                        <div class="mb-3">
                            <label for="edit_kodegroup" class="form-label">Kode Group</label>
                            <input type="text" class="form-control" id="edit_kodegroup" name="edit_kodegroup" value="<?= $row['kodegroup']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_namagroup" class="form-label">Nama Group</label>
                            <input type="text" class="form-control" id="edit_namagroup" name="edit_namagroup" value="<?= $row['namagroup']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kodekategori" class="form-label">Kategori:</label>
                            <select class="form-select" id="edit_kodekategori" name="edit_kodekategori" required>
                                <option value="" disabled>Pilih</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['kode']; ?>" <?= ($category['kode'] == $row['kodekategori']) ? 'selected' : ''; ?>><?= $category['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_kodeperkiraan" class="form-label">Kode Perkiraan</label>
                            <input type="text" class="form-control" id="edit_kodeperkiraan" name="edit_kodeperkiraan" value="<?= $row['kodeperkiraan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3"><?= $row['keterangan']; ?></textarea>
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


<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php if (session()->getFlashdata('alert')) : ?>
    <script>
        $(document).ready(function() {
            const alert = <?= json_encode(session()->getFlashdata('alert')) ?>;
            Swal.fire(alert);
        });
    </script>
<?php endif; ?>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        var errorMessage = <?= json_encode(session()->getFlashdata('error')) ?>;
        if (Array.isArray(errorMessage)) {
            errorMessage = errorMessage.join('<br>');
        }

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: errorMessage,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
<?php endif; ?>




<?= $this->endSection() ?>