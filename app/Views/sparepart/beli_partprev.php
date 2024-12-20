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

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('pesan_part') ?>" class="breadcrumb-link text-primary fw-bold">Pemesanan Part</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Detail Pemesanan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Detail Pemesanan</h5>
                </header>
                <div class="card-body">
                    <h5>ID</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="id_pesan">No. Penerima</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="id_pesan" class="form-control" name="id_pesan" value="<?= $sparepart['id_pesan'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal">Tanggal</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= $sparepart['tanggal'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="supplier">Supplier</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="supplier" class="form-control" name="supplier" value="<?= $sparepart['supplier'] ?>" readonly>
                        </div>
                        <!-- <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jatuh_tempo">Jatuh Tempo</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" value="<?= $sparepart['jatuh_tempo'] ?>" readonly>
                        </div> -->
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="1" readonly><?= $sparepart['keterangan'] ?></textarea>
                        </div>
                    </div>

                    <!-- Section Data -->
                    <h5>Data</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no_ro">No. Repair Order</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="no_ro" class="form-control" name="no_ro" value="<?= $sparepart['wo'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="nama_pemilik">Customer</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik" value="<?= $sparepart['customer'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= $sparepart['asuransi'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jenis_mobil">Jenis Mobil</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="jenis_mobil" class="form-control" name="jenis_mobil" value="<?= $sparepart['jenis_mobil'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="warna" class="form-control" name="warna" value="<?= $sparepart['warna'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no_kendaraan">Nopol</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= $sparepart['nopol'] ?>" readonly>
                        </div>
                    </div>

                    <!-- Section Detail Barang -->
                    <h5>Detail Part</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th>Kode Part</th>
                                    <th>Nama Part</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>No Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_barang as $barang): ?>
                                    <tr>
                                        <td><?= esc($barang['id_kode_barang']) ?></td>
                                        <td><?= esc($barang['nama_barang']) ?></td>
                                        <td><?= esc($barang['qty']) ?></td>
                                        <td><?= esc($barang['satuan']) ?></td>
                                        <td><?= number_format($barang['harga'], 0, ',', '.') ?></td>
                                        <td><?= number_format($barang['jumlah'], 0, ',', '.') ?></td>
                                        <td><?= esc($barang['no_faktur']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total Qty</td>
                                    <td><?= esc($total_qty) ?></td>
                                    <td colspan="2">Total Jumlah</td>
                                    <td><?= number_format($total_jumlah, 0, ',', '.') ?></td> <!-- Format Rupiah -->
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Action Buttons -->
                    <div class="form-group row align-items-center">
                        <div class="col-lg-10 col-9">
                            <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">Kembali</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="window.location.href='<?= site_url('cetakpopart') ?>'">Cetak Permintaan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Horizontal Input end -->


<!-- js tgl -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl').value = todayString;
    });
</script>

<?= $this->endSection() ?>