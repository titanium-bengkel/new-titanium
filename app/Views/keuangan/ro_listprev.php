<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/ro_list') ?>" class="breadcrumb-link text-primary fw-bold">Repair Order List</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Data Repair Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Data Repair Order</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label">Bengkel</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3 d-flex align-items-center" style="font-weight: 500; color: #333;">
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-titanium" name="bengkel" value="Titanium" class="form-check-input"
                                    <?= (isset($rodata['bengkel']) && $rodata['bengkel'] === 'Titanium') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="bengkel-titanium" style="color: inherit;">Titanium</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="bengkel-tandem" name="bengkel" value="Tandem" class="form-check-input"
                                    <?= (isset($rodata['bengkel']) && $rodata['bengkel'] === 'Tandem') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="bengkel-tandem" style="color: inherit;">Tandem</label>
                            </div>
                        </div>

                        <h5>Kendaraan</h5>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tanggal-masuk">Tanggal Masuk</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="date" id="tanggal-masuk" class="form-control form-control-sm"
                                name="tanggal-masuk" value="<?= isset($rodata['tgl_masuk']) ? $rodata['tgl_masuk'] : ''; ?>" onclick="openDatepicker(this);">
                        </div>

                        <!-- Pre-Order ID -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="pre-order-id">Pre-Order ID</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="pre-order-id" class="form-control form-control-sm"
                                name="pre-order-id" value="<?= isset($rodata['id_terima_po']) ? $rodata['id_terima_po'] : ''; ?>" disabled>
                        </div>

                        <!-- No. Kendaraan -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="no-kendaraan">No. Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="no-kendaraan" class="form-control form-control-sm"
                                name="no-kendaraan" value="<?= isset($rodata['no_kendaraan']) ? $rodata['no_kendaraan'] : ''; ?>">
                        </div>

                        <!-- Jenis Mobil -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="jenis-mobil">Jenis Mobil</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="jenis-mobil" class="form-control form-control-sm" name="jenis-mobil"
                                value="<?= isset($rodata['jenis_mobil']) ? $rodata['jenis_mobil'] : ''; ?>">
                        </div>

                        <!-- Warna -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="warna" class="form-control form-control-sm" name="warna"
                                value="<?= isset($rodata['warna']) ? $rodata['warna'] : ''; ?>">
                        </div>

                        <!-- Tahun Kendaraan -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tahun-kendaraan">Tahun Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="tahun-kendaraan" class="form-control form-control-sm"
                                name="tahun-kendaraan" value="<?= isset($rodata['tahun_kendaraan']) ? $rodata['tahun_kendaraan'] : ''; ?>">
                        </div>
                    </div>

                    <hr>
                    <h5>Data Customer</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="customer-name">Customer Name</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="customer-name" class="form-control form-control-sm"
                                name="customer-name" value="<?= isset($rodata['customer_name']) ? $rodata['customer_name'] : ''; ?>" required>
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="no-contact">No. Contact</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="no-contact" class="form-control form-control-sm"
                                name="no-contact" value="<?= isset($rodata['no_contact']) ? $rodata['no_contact'] : ''; ?>">
                        </div>
                    </div>

                    <hr>
                    <h5>Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="asuransi" class="form-control form-control-sm" name="asuransi"
                                value="<?= isset($rodata['asuransi']) ? $rodata['asuransi'] : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="id_acc_asuransi">Nomor Acc</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="text" id="id_acc_asuransi" class="form-control form-control-sm"
                                name="id_acc_asuransi" value="<?= isset($rodata['id_acc_asuransi']) ? $rodata['id_acc_asuransi'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tgl_acc">Tanggal Acc</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="date" id="tgl_acc" class="form-control form-control-sm" name="tgl_acc"
                                value="<?= isset($rodata['tgl_acc']) ? $rodata['tgl_acc'] : ''; ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="no_kwitansi">Nomor Kwitansi</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="text" id="no_kwitansi" class="form-control form-control-sm" name="no_kwitansi"
                                value="<?= isset($rodata['no_faktur']) ? $rodata['no_faktur'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tgl_kwitansi">Tanggal Kwitansi</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="date" id="tgl_kwitansi" class="form-control form-control-sm" name="tgl_kwitansi"
                                value="<?= isset($rodata['tgl_faktur']) ? $rodata['tgl_faktur'] : ''; ?>">
                        </div>
                    </div>

                    <hr>
                    <h5>Biaya</h5>
                    <?php
                    // Hitung pemakaian
                    $pemakaian = 0;
                    if (isset($rodata['jasa_total']) && isset($rodata['sparepart_total']) && isset($rodata['bahan_total'])) {
                        $pemakaian = $rodata['jasa_total'] + $rodata['sparepart_total'] + $rodata['bahan_total'];
                    }

                    // Tentukan harga estimasi atau harga acc
                    $harga_estimasi = (isset($rodata['asuransi']) && $rodata['asuransi'] === 'UMUM/PRIBADI')
                        ? $rodata['total_biaya']
                        : $rodata['harga_acc'];

                    // Hitung profit berdasarkan jenis asuransi
                    $profit = 0;
                    if (isset($rodata['asuransi'])) {
                        if ($rodata['asuransi'] === 'UMUM/PRIBADI') {
                            $profit = $harga_estimasi - $pemakaian;
                        } else {
                            $profit = $rodata['harga_acc'] - $pemakaian;
                        }
                    }
                    ?>

                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="harga-estimasi">Harga Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="harga-estimasi" class="form-control form-control-sm"
                                name="harga_estimasi" value="<?= number_format($harga_estimasi, 0, ',', '.'); ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="harga-acc">Harga Acc</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="harga-acc" class="form-control form-control-sm"
                                name="harga_acc" value="<?= isset($rodata['harga_acc']) ? number_format($rodata['harga_acc'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-sparepart">Total Sparepart</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-sparepart" class="form-control form-control-sm"
                                name="total_sparepart" value="<?= isset($rodata['sparepart_total']) ? number_format($rodata['sparepart_total'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-bahan">Total Bahan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-bahan" class="form-control form-control-sm"
                                name="total_bahan" value="<?= isset($rodata['bahan_total']) ? number_format($rodata['bahan_total'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-jasa">Total Jasa</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-jasa" class="form-control form-control-sm"
                                name="total_jasa" value="<?= isset($rodata['jasa_total']) ? number_format($rodata['jasa_total'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-pemakaian">Total Pemakaian</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-pemakaian" class="form-control form-control-sm"
                                name="total_pemakaian" value="<?= number_format($pemakaian, 0, ',', '.'); ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="profit">Profit</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="profit" class="form-control form-control-sm"
                                name="profit" value="<?= number_format($profit, 0, ',', '.'); ?>" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Jasa -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Jasa</th>
                                    <th>Harga</th>
                                    <th>Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($roJasa)): ?>
                                    <?php foreach ($roJasa as $index => $jasa): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($jasa['kode_jasa']); ?></td>
                                            <td><?= number_format($jasa['harga'], 0, ',', '.'); ?></td>
                                            <td><?= esc($jasa['nama_jasa']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">Tidak ada data jasa ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Input Pengerjaan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Pengerjaan -->
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Bahan</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sperpat -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class=" table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Sparepart</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Horizontal Input end -->








<?= $this->endSection() ?>