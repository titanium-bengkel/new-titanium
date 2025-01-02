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
<!-- Table Jasa -->
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">List Jasa RM</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Jasa RM</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Jasa RM</h5>
                </header>

                <div class="table-responsive" style="margin: 20px; font-size:14px;">
                    <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahJasa">
                        Entry Data
                    </button>
                    <table class="table table-bordered table-hover table-striped text-center mb-0">
                        <thead class="thead-dark table-secondary">
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Jasa</th>
                                <th>Kode Biaya</th>
                                <th>Ket. Biaya</th>
                                <th>Kode Alokasi</th>
                                <th>Ket. Alokasi</th>
                                <th>Keterangan</th>
                                <th>User ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($jasa as $key => $item) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $item['kode'] ?></td>
                                    <td><?= $item['nama_jasa'] ?></td>
                                    <td><?= $item['kode_biaya'] ?></td>
                                    <td><?= $item['ket_biaya'] ?></td>
                                    <td><?= $item['kode_alokasi'] ?></td>
                                    <td><?= $item['ket_alokasi'] ?></td>
                                    <td><?= $item['keterangan'] ?></td>
                                    <td><?= $item['user_id'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="populateEditModal(
                                            '<?= $item['id_jasa']; ?>',
                                            '<?= $item['kode']; ?>',
                                            '<?= $item['nama_jasa']; ?>',
                                            '<?= $item['kode_biaya']; ?>',
                                            '<?= $item['ket_biaya']; ?>',
                                            '<?= $item['kode_alokasi']; ?>',
                                            '<?= $item['ket_alokasi']; ?>',
                                            '<?= $item['keterangan']; ?>',
                                            '<?= $item['user_id']; ?>'
                                        )" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="fas fa-edit"></i>
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
</section>
<!-- End Table Jasa -->

<!-- Modal Tambah Jasa -->
<div class="modal fade" id="modalTambahJasa" tabindex="-1" aria-labelledby="modalTambahJasaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="modalTambahJasaLabel">Tambah Data Jasa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createJasa') ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode">
                    </div>
                    <div class="mb-3">
                        <label for="nama_jasa" class="form-label">Nama Jasa</label>
                        <input type="text" class="form-control" id="nama_jasa" name="nama_jasa">
                    </div>
                    <div class="mb-3">
                        <label for="kode_biaya" class="form-label">Kode Biaya</label>
                        <select class="form-control" id="kode_biaya" name="kode_biaya" onchange="updateKetBiaya()">
                            <option value="">Pilih Kode Biaya</option>
                            <?php foreach ($coa as $item) : ?>
                                <option value="<?= $item['kode']; ?>" data-nama="<?= $item['nama_account']; ?>">
                                    <?= $item['kode']; ?> - <?= $item['nama_account']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="ket_biaya" name="ket_biaya">
                    <div class="mb-3">
                        <label for="kode_alokasi" class="form-label">Kode Alokasi</label>
                        <select class="form-control" id="kode_alokasi" name="kode_alokasi" onchange="updateKetAlokasi()">
                            <option value="">Pilih Kode Alokasi</option>
                            <?php foreach ($coa as $item) : ?>
                                <option value="<?= $item['kode']; ?>" data-nama="<?= $item['nama_account']; ?>">
                                    <?= $item['kode']; ?> - <?= $item['nama_account']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="ket_alokasi" name="ket_alokasi">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Data Jasa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditJasa" action="<?= base_url('updateJasa'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_id_jasa" name="edit_id_jasa">
                    <div class="row">
                        <!-- Kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="edit_kode" name="edit_kode" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="edit_nama_jasa" class="form-label">Nama Jasa</label>
                                <input type="text" class="form-control" id="edit_nama_jasa" name="edit_nama_jasa">
                            </div>
                        </div>
                        <!-- Tengah -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kode_biaya" class="form-label">Kode Biaya</label>
                                <select class="form-control" id="edit_kode_biaya" name="edit_kode_biaya">
                                    <option value="">Pilih Kode Biaya</option>
                                    <?php foreach ($coa as $item) : ?>
                                        <option value="<?= $item['kode']; ?>"><?= $item['kode']; ?> - <?= $item['nama_account']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_kode_alokasi" class="form-label">Kode Alokasi</label>
                                <select class="form-control" id="edit_kode_alokasi" name="edit_kode_alokasi">
                                    <option value="">Pilih Kode Alokasi</option>
                                    <?php foreach ($coa as $item) : ?>
                                        <option value="<?= $item['kode']; ?>"><?= $item['kode']; ?> - <?= $item['nama_account']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" name="edit_keterangan">
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
<?php foreach ($jasa as $item) : ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit<?= $item['id_jasa']; ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $item['id_jasa']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $item['id_jasa']; ?>">Edit Data Jasa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updateJasa/' . $item['id_jasa']); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_jasa" name="edit_id_jasa" value="<?= $item['id_jasa']; ?>">
                        <div class="row">
                            <!-- Kiri -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="edit_kode" name="edit_kode" value="<?= $item['kode']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_nama_jasa" class="form-label">Nama Jasa</label>
                                    <input type="text" class="form-control" id="edit_nama_jasa" name="edit_nama_jasa" value="<?= $item['nama_jasa']; ?>">
                                </div>
                            </div>
                            <!-- Tengah -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_kode_biaya" class="form-label">Kode Biaya</label>
                                    <select class="form-control" id="edit_kode_biaya" name="edit_kode_biaya">
                                        <option value="">Pilih Kode Biaya</option>
                                        <?php foreach ($coa as $coa_item) : ?>
                                            <option value="<?= $coa_item['kode']; ?>" <?= ($item['kode_biaya'] == $coa_item['kode']) ? 'selected' : ''; ?>>
                                                <?= $coa_item['kode']; ?> - <?= $coa_item['nama_account']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_kode_alokasi" class="form-label">Kode Alokasi</label>
                                    <select class="form-control" id="edit_kode_alokasi" name="edit_kode_alokasi">
                                        <option value="">Pilih Kode Alokasi</option>
                                        <?php foreach ($coa as $coa_item) : ?>
                                            <option value="<?= $coa_item['kode']; ?>" <?= ($item['kode_alokasi'] == $coa_item['kode']) ? 'selected' : ''; ?>>
                                                <?= $coa_item['kode']; ?> - <?= $coa_item['nama_account']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Kanan -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edit_keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="edit_keterangan" name="edit_keterangan" value="<?= $item['keterangan']; ?>">
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

<script>
    function populateEditModal(id, kode, nama_jasa, kode_biaya, kode_alokasi, keterangan) {
        // Isi nilai-nilai dari parameter ke dalam form modal edit
        document.getElementById('edit_id_jasa').value = id;
        document.getElementById('edit_kode').value = kode;
        document.getElementById('edit_nama_jasa').value = nama_jasa;
        document.getElementById('edit_kode_biaya').value = kode_biaya;
        document.getElementById('edit_kode_alokasi').value = kode_alokasi;
        document.getElementById('edit_keterangan').value = keterangan;

        // Tampilkan modal edit
        var modal = new bootstrap.Modal(document.getElementById('modalEdit'));
        modal.show();
    }
</script>
<script>
    function updateKetBiaya() {
        var kodeBiaya = document.getElementById('kode_biaya').value;
        var optionSelected = document.getElementById('kode_biaya').querySelector(`option[value="${kodeBiaya}"]`);
        var namaBiaya = optionSelected.getAttribute('data-nama');
        document.getElementById('ket_biaya').value = namaBiaya;
    }

    function updateKetAlokasi() {
        var kodeAlokasi = document.getElementById('kode_alokasi').value;
        var optionSelected = document.getElementById('kode_alokasi').querySelector(`option[value="${kodeAlokasi}"]`);
        var namaAlokasi = optionSelected.getAttribute('data-nama');
        document.getElementById('ket_alokasi').value = namaAlokasi;
    }
</script>

<!-- Script untuk menampilkan SweetAlert Toast -->
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