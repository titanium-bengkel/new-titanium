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
                        <a href="<?= base_url('po_bahan') ?>" class="breadcrumb-link text-primary fw-bold">List Pemesanan Bahan (PO)</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pemesanan Bahan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pemesanan Bahan</h5>
                </header>
                <div class="card-body">
                    <h5>Data Pesan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="id_po_bahan">Nomor (auto)</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="id_po_bahan" class="form-control" name="id_po_bahan" value="<?= $bahan['id_po_bahan']; ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal">Tanggal</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= $bahan['tanggal']; ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="supplier">Supplier</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="supplier" class="form-control" name="supplier" value="<?= $bahan['supplier']; ?>" readonly>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <textarea class="form-control" id="keterangan" rows="1" name="keterangan" readonly><?= $bahan['keterangan']; ?></textarea>
                        </div>
                    </div>
                    <!-- tabel detail barang  -->
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped -table-hover mb-0" style="font-size: 14px;">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>No Faktur</th>
                                    <th>Tgl. Faktur</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="detail-barang-body">
                                <?php if (!empty($detail_barang)) : ?>
                                    <?php foreach ($detail_barang as $detail) : ?>
                                        <tr>
                                            <td><input type="text" name="id_kode_barang[]" value="<?= $detail['id_kode_barang']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="nama_barang[]" value="<?= $detail['nama_barang']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="kategori[]" value="<?= $detail['kategori']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="qty[]" value="<?= $detail['qty']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="satuan[]" value="<?= $detail['satuan']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="harga[]" value="<?= number_format($detail['harga'], 2, ',', '.'); ?>" class="form-control"></td>
                                            <td><input type="text" name="jumlah[]" value="<?= number_format($detail['jumlah'], 2, ',', '.'); ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="no_faktur[]" value="<?= $detail['no_faktur']; ?>" class="form-control" readonly></td>
                                            <td><input type="text" name="tgl_faktur[]" value="<?= $detail['tgl_faktur']; ?>" class="form-control" readonly></td>
                                            <td><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" value="1" <?= $detail['ceklis'] == 1 ? 'checked' : ''; ?> disabled></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11">Tidak ada data barang</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" style="text-align: end;">Total Qty</td>
                                    <td><input type="number" name="total_qty_b" value="<?= $total_qty_b; ?>" class="form-control" readonly></td>
                                    <td colspan="2" style="text-align: end;">Total Jumlah</td>
                                    <td><input type="text" name="total_jumlah" value="<?= number_format($total_jumlah, 2, ',', '.'); ?>" class="form-control" readonly></td>
                                    <td colspan="7"></td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <div class="form-group row align-items-center mt-3">
                        <div class="col-lg-10 col-9">
                            <a href="<?= base_url('order_bahan'); ?>" class="btn btn-primary btn-sm">Input Baru</a>
                            <!-- Tombol Batal -->
                            <a href="<?= base_url('po_bahan'); ?>" class="btn btn-danger btn-sm">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->






<?= $this->endSection() ?>