<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<!-- Table Gudang -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Gudang</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambahGudang">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Gudang</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Gudang Pos</th>
                                    <th>Nama Gudang</th>
                                    <th>Contact Person</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Fax</th>
                                    <th>User Input</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (isset($kategori) && !empty($kategori)) : ?>
                                    <?php foreach ($kategori as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($item['kode']) ?></td>
                                            <td><?= esc($item['gudangpos']) ?></td>
                                            <td><?= esc($item['nama']) ?></td>
                                            <td><?= esc($item['contactperson']) ?></td>
                                            <td><?= esc($item['alamat']) ?></td>
                                            <td><?= esc($item['kota']) ?></td>
                                            <td><?= esc($item['fax']) ?></td>
                                            <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                            <td><?= esc($item['keterangan']) ?></td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditGudang<?= $item['id_gudang'] ?>" data-id="<?= $item['id_gudang']; ?>" data-kode="<?= $item['kode']; ?>" data-gudangpos="<?= $item['gudangpos']; ?>" data-nama="<?= $item['nama']; ?>" data-contactperson="<?= $item['contactperson']; ?>" data-alamat="<?= $item['alamat']; ?>" data-kota="<?= $item['kota']; ?>" data-telp="<?= $item['telp']; ?>" data-fax="<?= $item['fax']; ?>" data-keterangan="<?= $item['keterangan']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11">No data available</td>
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
<!-- Table Gudang -->
<!-- Modal Add -->
<div class="modal fade" id="modalTambahGudang" tabindex="-1" aria-labelledby="modalTambahGudangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahGudangLabel">Tambah Gudang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createGudang'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <!-- Sisi Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Gudang</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gudangpos" class="col-sm-4 col-form-label">Gudang Pos</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="gudangpos" name="gudangpos" required>
                                        <option value="Y">Y</option>
                                        <option value="N">N</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="alamat" name="alamat" rows="3" required></input>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kota" name="kota" required>
                                </div>
                            </div>

                        </div>
                        <!-- Sisi Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3 row">
                                <label for="contactperson" class="col-sm-4 col-form-label">Contact</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="contactperson" name="contactperson" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="telp" class="col-sm-4 col-form-label">Telp</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telp" name="telp" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fax" class="col-sm-4 col-form-label">Fax</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="fax" name="fax" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="keterangan" name="keterangan" rows="3" required></input>
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


<!-- Modal Edit -->
<?php foreach ($kategori as $item) : ?>
    <div class="modal fade" id="modalEditGudang<?= $item['id_gudang'] ?>" tabindex="-1" aria-labelledby="modalEditGudangLabel<?= $item['id_gudang'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditGudangLabel<?= $item['id_gudang'] ?>">Edit Gudang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updateGudang/' . $item['id_gudang']); ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Sisi Kiri -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="edit_kode" class="col-sm-4 col-form-label">Kode</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_kode" name="kode" value="<?= $item['kode'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_nama" class="col-sm-4 col-form-label">Nama Gudang</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_nama" name="nama" value="<?= $item['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_gudangpos" class="col-sm-4 col-form-label">Gudang Pos</label>
                                    <div class="col-sm-8">
                                        <select class="form-select" id="edit_gudangpos" name="edit_gudangpos" required>
                                            <option value="Y" <?= ($item['gudangpos'] == 'Y') ? 'selected' : '' ?>>Y</option>
                                            <option value="N" <?= ($item['gudangpos'] == 'N') ? 'selected' : '' ?>>N</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_alamat" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required><?= $item['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_kota" class="col-sm-4 col-form-label">Kota</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_kota" name="kota" value="<?= $item['kota'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Sisi Kanan -->
                            <div class="col-md-6">
                                <div class="mb-3 row">
                                    <label for="edit_contactperson" class="col-sm-4 col-form-label">Contact Person</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_contactperson" name="contactperson" value="<?= $item['contactperson'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_telp" class="col-sm-4 col-form-label">Telp</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_telp" name="telp" value="<?= $item['telp'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_fax" class="col-sm-4 col-form-label">Fax</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="edit_fax" name="fax" value="<?= $item['fax'] ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="edit_keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="3" required><?= $item['keterangan'] ?></textarea>
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