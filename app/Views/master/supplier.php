<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<!-- Table  Data Supplier -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Supplier</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambahSupplier">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Supplier</h6>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>CP</th>
                                    <th>Telp</th>
                                    <th>Kota</th>
                                    <th>Fax</th>
                                    <th>Hp</th>
                                    <th>Rekening</th>
                                    <th>NPWP</th>
                                    <th>Status</th>
                                    <th>Inisial</th>
                                    <th>User Input</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($suppliers as $index => $supplier) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSupplier<?= $supplier['id_supplier']; ?>"><i class="fas fa-edit"></i></button>
                                        </td>
                                        <td><?= $supplier['kode']; ?></td>
                                        <td><?= $supplier['nama']; ?></td>
                                        <td><?= $supplier['alamat']; ?></td>
                                        <td><?= $supplier['email']; ?></td>
                                        <td><?= $supplier['contactperson']; ?></td>
                                        <td><?= $supplier['telp']; ?></td>
                                        <td><?= $supplier['kota']; ?></td>
                                        <td><?= $supplier['fax']; ?></td>
                                        <td><?= $supplier['hp']; ?></td>
                                        <td><?= $supplier['rekening']; ?></td>
                                        <td><?= $supplier['npwp']; ?></td>
                                        <td><?= $supplier['status']; ?></td>
                                        <td><?= $supplier['inisial']; ?></td>
                                        <td><?= $supplier['username']; ?></td>
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
<!-- Modal Tambah Supplier -->
<div class="modal fade" id="modalTambahSupplier" tabindex="-1" aria-labelledby="modalTambahSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSupplierLabel">Tambah Supplier Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="<?= base_url('createSupplier') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Form bagian kiri -->
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control" id="kota" name="kota">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="contactperson" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contactperson" name="contactperson">
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telp" name="telp">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <!-- Form bagian kanan -->
                                <div class="mb-3">
                                    <label for="fax" class="form-label">Fax</label>
                                    <input type="text" class="form-control" id="fax" name="fax">
                                </div>
                                <div class="mb-3">
                                    <label for="hp" class="form-label">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp">
                                </div>
                                <div class="mb-3">
                                    <label for="rekening" class="form-label">Rekening</label>
                                    <input type="text" class="form-control" id="rekening" name="rekening">
                                </div>
                                <div class="mb-3">
                                    <label for="npwp" class="form-label">NPWP</label>
                                    <input type="text" class="form-control" id="npwp" name="npwp">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status">
                                </div>
                                <div class="mb-3">
                                    <label for="inisial" class="form-label">Inisial</label>
                                    <input type="text" class="form-control" id="inisial" name="inisial">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" rows="1" name="keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($suppliers as $supplier) : ?>
    <div class="modal fade" id="modalEditSupplier<?= $supplier['id_supplier']; ?>" tabindex="-1" aria-labelledby="modalEditSupplierLabel<?= $supplier['id_supplier']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSupplierLabel<?= $supplier['id_supplier']; ?>">Edit Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="<?= base_url('updateSupplier/' . $supplier['id_supplier']) ?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Form bagian kiri -->
                                    <div class="mb-3">
                                        <label for="kode<?= $supplier['id_supplier']; ?>" class="form-label">Kode</label>
                                        <input type="text" class="form-control" id="kode<?= $supplier['id_supplier']; ?>" name="kode" value="<?= $supplier['kode']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama<?= $supplier['id_supplier']; ?>" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama<?= $supplier['id_supplier']; ?>" name="nama" value="<?= $supplier['nama']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat<?= $supplier['id_supplier']; ?>" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="alamat<?= $supplier['id_supplier']; ?>" name="alamat" value="<?= $supplier['alamat']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email<?= $supplier['id_supplier']; ?>" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email<?= $supplier['id_supplier']; ?>" name="email" value="<?= $supplier['email']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="contactperson<?= $supplier['id_supplier']; ?>" class="form-label">Contact Person</label>
                                        <input type="text" class="form-control" id="contactperson<?= $supplier['id_supplier']; ?>" name="contactperson" value="<?= $supplier['contactperson']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telp<?= $supplier['id_supplier']; ?>" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" id="telp<?= $supplier['id_supplier']; ?>" name="telp" value="<?= $supplier['telp']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kota<?= $supplier['id_supplier']; ?>" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota<?= $supplier['id_supplier']; ?>" name="kota" value="<?= $supplier['kota']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Form bagian kanan -->
                                    <div class="mb-3">
                                        <label for="fax<?= $supplier['id_supplier']; ?>" class="form-label">Fax</label>
                                        <input type="text" class="form-control" id="fax<?= $supplier['id_supplier']; ?>" name="fax" value="<?= $supplier['fax']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="hp<?= $supplier['id_supplier']; ?>" class="form-label">HP</label>
                                        <input type="text" class="form-control" id="hp<?= $supplier['id_supplier']; ?>" name="hp" value="<?= $supplier['hp']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="rekening<?= $supplier['id_supplier']; ?>" class="form-label">Rekening</label>
                                        <input type="text" class="form-control" id="rekening<?= $supplier['id_supplier']; ?>" name="rekening" value="<?= $supplier['rekening']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="npwp<?= $supplier['id_supplier']; ?>" class="form-label">NPWP</label>
                                        <input type="text" class="form-control" id="npwp<?= $supplier['id_supplier']; ?>" name="npwp" value="<?= $supplier['npwp']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status<?= $supplier['id_supplier']; ?>" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="status<?= $supplier['id_supplier']; ?>" name="status" value="<?= $supplier['status']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inisial<?= $supplier['id_supplier']; ?>" class="form-label">Inisial</label>
                                        <input type="text" class="form-control" id="inisial<?= $supplier['id_supplier']; ?>" name="inisial" value="<?= $supplier['inisial']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="keterangan<?= $supplier['id_supplier']; ?>" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan<?= $supplier['id_supplier']; ?>" name="keterangan"><?= $supplier['keterangan']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
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