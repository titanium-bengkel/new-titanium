<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<!-- Table Asuransi -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <h4 class="mb-0 ms-3 mb-3">Asuransi</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah">Entry Data</button>
                    <h6 class="mb-0 ms-auto">List Data Asuransi</h6>
                </div>
                <div class="card-content">
                    <!-- Table -->
                    <div class="table-responsive" style="margin: 20px; font-size: 10px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Asuransi</th>
                                    <th>Group</th>
                                    <th>Alamat</th>
                                    <th>Kodepos</th>
                                    <th>Kota</th>
                                    <th>Telp</th>
                                    <th>Fax</th>
                                    <th>Hp</th>
                                    <th>Email</th>
                                    <th>Person</th>
                                    <th>Discount</th>
                                    <th>NPWP</th>
                                    <th>Plafond</th>
                                    <th>Max Bill</th>
                                    <th>Customer</th>
                                    <th>Gudang</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>User ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($asuransi as $item) : ?>
                                    <tr>
                                        <td><?= $item['id_asuransi'] ?></td>
                                        <td><?= $item['kode'] ?></td>
                                        <td><?= $item['nama_asuransi'] ?></td>
                                        <td><?= $item['kode_group'] ?></td>
                                        <td><?= $item['alamat'] ?></td>
                                        <td><?= $item['kodepos'] ?></td>
                                        <td><?= $item['kota'] ?></td>
                                        <td><?= $item['telp'] ?></td>
                                        <td><?= $item['fax'] ?></td>
                                        <td><?= $item['no_hp_whatsapp'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['contact_person'] ?></td>
                                        <td><?= $item['discount'] ?></td>
                                        <td><?= $item['npwp'] ?></td>
                                        <td><?= $item['plafond'] ?></td>
                                        <td><?= $item['max_bill'] ?></td>
                                        <td><?= $item['customer_pos'] ?></td>
                                        <td><?= $item['kode_gudang'] ?></td>
                                        <td><?= $item['status'] ?></td>
                                        <td><?= $item['keterangan'] ?></td>
                                        <td><?= isset($item['username']) ? esc($item['username']) : 'N/A'; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="fas fa-edit"></i></button>
                                            <!-- Tambahkan tombol untuk menghapus jika diperlukan -->
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
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah Data Asuransi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('createAsuransi') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <!-- Bagian kiri -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode">
                            </div>
                            <div class="mb-3">
                                <label for="nama_asuransi" class="form-label">Nama Asuransi</label>
                                <input type="text" class="form-control" id="nama_asuransi" name="nama_asuransi">
                            </div>
                            <div class="mb-3">
                                <label for="status_member" class="form-label">Status Member</label>
                                <input type="text" class="form-control" id="status_member" name="status_member">
                            </div>
                            <div class="mb-3">
                                <label for="kode_alokasi" class="form-label">Kode Alokasi</label>
                                <input type="text" class="form-control" id="kode_alokasi" name="kode_alokasi">
                            </div>
                            <div class="mb-3">
                                <label for="kode_group" class="form-label">Kode Group</label>
                                <input type="text" class="form-control" id="kode_group" name="kode_group">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input class="form-control" id="alamat" name="alamat" rows="3"></input>
                            </div>
                            <div class="mb-3">
                                <label for="kodepos" class="form-label">Kodepos</label>
                                <input type="text" class="form-control" id="kodepos" name="kodepos">
                            </div>
                        </div>
                        <!-- Bagian tengah -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota">
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp">
                            </div>
                            <div class="mb-3">
                                <label for="fax" class="form-label">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp_whatsapp" class="form-label">No HP / WhatsApp</label>
                                <input type="text" class="form-control" id="no_hp_whatsapp" name="no_hp_whatsapp">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person">
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="text" class="form-control" id="discount" name="discount">
                            </div>
                        </div>
                        <!-- Bagian kanan -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" class="form-control" id="npwp" name="npwp">
                            </div>
                            <div class="mb-3">
                                <label for="plafond" class="form-label">Plafond</label>
                                <input type="text" class="form-control" id="plafond" name="plafond">
                            </div>
                            <div class="mb-3">
                                <label for="max_bill" class="form-label">Max Bill</label>
                                <input type="text" class="form-control" id="max_bill" name="max_bill">
                            </div>
                            <div class="mb-3">
                                <label for="customer_pos" class="form-label">Customer Pos</label>
                                <input type="text" class="form-control" id="customer_pos" name="customer_pos">
                            </div>
                            <div class="mb-3">
                                <label for="kode_gudang" class="form-label">Kode Gudang</label>
                                <input type="text" class="form-control" id="kode_gudang" name="kode_gudang">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input class="form-control" id="keterangan" name="keterangan" rows="3"></input>
                            </div>
                            <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
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
<?php foreach ($asuransi as $item) : ?>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Data Asuransi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('updateAsuransi/' . $item['id_asuransi']); ?>" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Bagian kiri -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="<?= $item['kode'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_asuransi" class="form-label">Nama Asuransi</label>
                                    <input type="text" class="form-control" id="nama_asuransi" name="nama_asuransi" value="<?= $item['nama_asuransi'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="status_member" class="form-label">Status Member</label>
                                    <input type="text" class="form-control" id="status_member" name="status_member" value="<?= $item['status_member'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_alokasi" class="form-label">Kode Alokasi</label>
                                    <input type="text" class="form-control" id="kode_alokasi" name="kode_alokasi" value="<?= $item['kode_alokasi'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_group" class="form-label">Kode Group</label>
                                    <input type="text" class="form-control" id="kode_group" name="kode_group" value="<?= $item['kode_group'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input class="form-control" id="alamat" name="alamat" rows="3" value="<?= $item['alamat'] ?>"></input>
                                </div>
                                <div class="mb-3">
                                    <label for="kodepos" class="form-label">Kodepos</label>
                                    <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?= $item['kodepos'] ?>">
                                </div>
                            </div>
                            <!-- Bagian tengah -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control" id="kota" name="kota" value="<?= $item['kota'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="telp" class="form-label">Telp</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="<?= $item['telp'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="fax" class="form-label">Fax</label>
                                    <input type="text" class="form-control" id="fax" name="fax" value="<?= $item['fax'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="no_hp_whatsapp" class="form-label">No HP / WhatsApp</label>
                                    <input type="text" class="form-control" id="no_hp_whatsapp" name="no_hp_whatsapp" value="<?= $item['no_hp_whatsapp'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $item['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_person" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?= $item['contact_person'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="text" class="form-control" id="discount" name="discount" value="<?= $item['discount'] ?>">
                                </div>
                            </div>
                            <!-- Bagian kanan -->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="npwp" class="form-label">NPWP</label>
                                    <input type="text" class="form-control" id="npwp" name="npwp" value="<?= $item['npwp'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="plafond" class="form-label">Plafond</label>
                                    <input type="text" class="form-control" id="plafond" name="plafond" value="<?= $item['plafond'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="max_bill" class="form-label">Max Bill</label>
                                    <input type="text" class="form-control" id="max_bill" name="max_bill" value="<?= $item['max_bill'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="customer_pos" class="form-label">Customer Pos</label>
                                    <input type="text" class="form-control" id="customer_pos" name="customer_pos" value="<?= $item['customer_pos'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_gudang" class="form-label">Kode Gudang</label>
                                    <input type="text" class="form-control" id="kode_gudang" name="kode_gudang" value="<?= $item['kode_gudang'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="status" name="status" value="<?= $item['status'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input class="form-control" id="keterangan" name="keterangan" rows="3" value="<?= $item['keterangan'] ?>"></input>
                                </div>
                                <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
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