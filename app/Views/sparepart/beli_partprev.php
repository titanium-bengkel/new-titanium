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
    <div style="margin-top: 15px; margin-bottom: 10px; font-size: 12px; padding: 10px 20px; border-radius: 8px; display: inline-block;">
        <div style="font-size: 14px; font-weight: bold;">
            <a href="<?= base_url('/index') ?>" style="text-decoration: none; color: #007bff;">Dashboard</a>
            <span style="color: #6c757d; margin: 0 8px;">/</span>
            <span style="color: #6c757d; font-weight: 500;">Pemesanan PO</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="ms-3 mb-3 mt-4">Data Pemesanan</h5>
                <hr>
                <div class="card-body">
                    <!-- Section ID -->
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
                            <input type="text" id="no_ro" class="form-control" name="no_ro" value="<?= $sparepart['no_repair_order'] ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="nama_pemilik">Customer</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik" value="<?= $sparepart['nama_pemilik'] ?>" readonly>
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
                            <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= $sparepart['no_kendaraan'] ?>" readonly>
                        </div>
                    </div>

                    <!-- Section Detail Barang -->
                    <h5>Detail Barang</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered my-table-class">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Qty Beli</th>
                                    <th>Qty Sisa</th>
                                    <th>No Faktur</th>
                                    <th>Tgl Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail_barang as $barang): ?>
                                    <tr>
                                        <td><?= esc($barang['id_kode_barang']) ?></td>
                                        <td><?= esc($barang['nama_barang']) ?></td>
                                        <td><?= esc($barang['qty']) ?></td>
                                        <td><?= esc($barang['satuan']) ?></td>
                                        <td><?= number_format($barang['harga'], 0, ',', '.') ?></td> <!-- Format Rupiah -->
                                        <td><?= number_format($barang['jumlah'], 0, ',', '.') ?></td> <!-- Format Rupiah -->
                                        <td><?= esc($barang['qty_beli']) ?></td>
                                        <td><?= esc($barang['qty_sisa']) ?></td>
                                        <td><?= esc($barang['no_faktur']) ?></td>
                                        <td><?= esc($barang['tgl_faktur']) ?></td>
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