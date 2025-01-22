<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/ro_list') ?>" class="breadcrumb-link text-primary fw-bold">Order List</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Detail Order List</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Detail Order List</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label">Bengkel</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-titanium" name="bengkel" value="Titanium" class="form-check-input" <?= isset($dataro['bengkel']) && $dataro['bengkel'] == 'Titanium' ? 'checked' : ''; ?> disabled>
                                <label class="form-check-label" for="bengkel-titanium">Titanium</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-tandem" name="bengkel" value="Tandem" class="form-check-input" <?= isset($dataro['bengkel']) && $dataro['bengkel'] == 'Tandem' ? 'checked' : ''; ?> disabled>
                                <label class="form-check-label" for="bengkel-tandem">Tandem</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-k3karoseri" name="bengkel" value="K3 Karoseri" class="form-check-input" <?= isset($dataro['bengkel']) && $dataro['bengkel'] == 'K3 Karoseri' ? 'checked' : ''; ?> disabled>
                                <label class="form-check-label" for="bengkel-k3karoseri">K3 Karoseri</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-vortex" name="bengkel" value="Vortex" class="form-check-input" <?= isset($dataro['bengkel']) && $dataro['bengkel'] == 'Vortex' ? 'checked' : ''; ?> disabled>
                                <label class="form-check-label" for="bengkel-vortex">Vortex</label>
                            </div>
                            <!-- Inputan Tanggal dan Jam -->
                            <div class="d-flex ms-auto">
                                <input type="date" id="tanggal" class="form-control me-2" name="tanggal_klaim" style="max-width: 180px;" value="<?= isset($dataro['tgl_keluar']) ? $dataro['tgl_keluar'] : ''; ?>" readonly>
                                <input type="time" id="jam" name="jam_klaim" class="form-control" style="max-width: 120px;" value="<?= isset($dataro['jam_keluar']) ? $dataro['jam_keluar'] : ''; ?>" readonly>
                            </div>
                        </div>

                        <hr>
                        <h5>Data Kendaraan</h5>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tanggal-masuk">Tgl. Masuk</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="date" id="tanggal-masuk" class="form-control form-control-sm"
                                name="tanggal-masuk" value="<?= isset($dataro['tgl_masuk']) ? $dataro['tgl_masuk'] : ''; ?>" onclick="openDatepicker(this);">
                        </div>

                        <!-- Pre-Order ID -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="pre-order-id">No. Order</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="pre-order-id" class="form-control form-control-sm"
                                name="pre-order-id" value="<?= isset($dataro['id_terima_po']) ? $dataro['id_terima_po'] : ''; ?>">
                        </div>

                        <!-- No. Kendaraan -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="no-kendaraan">No. Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="no-kendaraan" class="form-control form-control-sm"
                                name="no-kendaraan" value="<?= isset($dataro['no_kendaraan']) ? $dataro['no_kendaraan'] : ''; ?>">
                        </div>

                        <!-- No. Rangka -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for=no_rangka">No. Rangka</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id=no_rangka" class="form-control form-control-sm"
                                name=no_rangka" value="<?= isset($dataro['no_rangka']) ? $dataro['no_rangka'] : ''; ?>">
                        </div>

                        <!-- Jenis Mobil -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="jenis-mobil">Car Model</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="jenis-mobil" class="form-control form-control-sm" name="jenis-mobil"
                                value="<?= isset($dataro['jenis_mobil']) ? $dataro['jenis_mobil'] : ''; ?>">
                        </div>

                        <!-- Warna -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-2">
                            <input type="text" id="warna" class="form-control form-control-sm" name="warna"
                                value="<?= isset($dataro['warna']) ? $dataro['warna'] : ''; ?>">
                        </div>

                        <!-- Tahun Kendaraan -->
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tahun-kendaraan">Tahun</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="tahun-kendaraan" class="form-control form-control-sm"
                                name="tahun-kendaraan" value="<?= isset($dataro['tahun_kendaraan']) ? $dataro['tahun_kendaraan'] : ''; ?>">
                        </div>
                    </div>

                    <hr>
                    <h5>Data Pelanggan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="customer-name">Nama Pelanggan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="customer-name" class="form-control form-control-sm"
                                name="customer-name" value="<?= isset($dataro['customer_name']) ? $dataro['customer_name'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="no-contact">Kontak</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="no-contact" class="form-control form-control-sm"
                                name="no-contact" value="<?= isset($dataro['no_contact']) ? $dataro['no_contact'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="alamat">Alamat</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="alamat" class="form-control form-control-sm"
                                name="alamat" value="<?= isset($dataro['alamat']) ? $dataro['alamat'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="kota">Kota</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="kota" class="form-control form-control-sm"
                                name="kota" value="<?= isset($dataro['kota']) ? $dataro['kota'] : ''; ?>">
                        </div>
                    </div>

                    <hr>
                    <h5>Data Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="asuransi" class="form-control form-control-sm" name="asuransi"
                                value="<?= isset($dataro['asuransi']) ? $dataro['asuransi'] : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="id_acc_asuransi">Nomor Acc</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="text" id="id_acc_asuransi" class="form-control form-control-sm"
                                name="id_acc_asuransi" value="<?= isset($dataro['id_acc_asuransi']) ? $dataro['id_acc_asuransi'] : ''; ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="tgl_acc">Tanggal Acc</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-2">
                            <input type="date" id="tgl_acc" class="form-control form-control-sm" name="tgl_acc"
                                value="<?= isset($dataro['tgl_acc']) ? $dataro['tgl_acc'] : ''; ?>">
                        </div>

                        <!-- <div class="col-lg-2 col-3 mb-2">
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
                        </div> -->
                    </div>

                    <hr>
                    <h5>Rincian Biaya</h5>
                    <?php
                    // Hitung pemakaian
                    $pemakaian = 0;
                    if (isset($dataro['jasa_total']) && isset($dataro['sparepart_total']) && isset($dataro['bahan_total'])) {
                        $pemakaian = $dataro['jasa_total'] + $dataro['sparepart_total'] + $dataro['bahan_total'];
                    }

                    // Tentukan harga estimasi atau harga acc
                    $harga_estimasi = 0;
                    if (isset($dataro['asuransi']) && $dataro['asuransi'] === 'UMUM/PRIBADI') {
                        // Pastikan kunci 'total_biaya' ada sebelum diakses
                        $harga_estimasi = isset($dataro['total_biaya']) ? $dataro['total_biaya'] : 0;
                    } else {
                        // Pastikan kunci 'biaya_total' ada sebelum diakses
                        $harga_estimasi = isset($dataro['biaya_total']) ? $dataro['biaya_total'] : 0;
                    }

                    // Hitung profit berdasarkan jenis asuransi
                    $profit = 0;
                    if (isset($dataro['asuransi'])) {
                        if ($dataro['asuransi'] === 'UMUM/PRIBADI') {
                            $profit = $harga_estimasi - $pemakaian;
                        } else {
                            // Pastikan kunci 'harga_acc' ada sebelum diakses
                            $profit = isset($dataro['biaya_total']) ? $dataro['biaya_total'] - $pemakaian : 0;
                        }
                    }
                    ?>

                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="harga-estimasi">Nilai ACC</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="harga-estimasi" class="form-control form-control-sm"
                                name="harga_estimasi" value="<?= number_format($harga_estimasi, 0, ',', '.'); ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-jasa">RM Jasa</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-jasa" class="form-control form-control-sm"
                                name="total_jasa" value="<?= isset($dataro['jasa_total']) ? number_format($dataro['jasa_total'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-sparepart">RM Sparepart</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-sparepart" class="form-control form-control-sm"
                                name="total_sparepart" value="<?= isset($dataro['sparepart_total']) ? number_format($dataro['sparepart_total'], 0, ',', '.') : ''; ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-2">
                            <label class="col-form-label col-form-label-sm" for="total-bahan">RM Bahan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-2">
                            <input type="text" id="total-bahan" class="form-control form-control-sm"
                                name="total_bahan" value="<?= isset($dataro['bahan_total']) ? number_format($dataro['bahan_total'], 0, ',', '.') : ''; ?>" readonly>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Jasa</th>
                                    <th>Keterangan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rodata)): ?>
                                    <?php $no = 1;
                                    $totalHarga = 0;
                                    $prevKodeJasa = ''; ?> <!-- Initialize prevKodeJasa to track duplicates -->
                                    <?php foreach ($rodata as $jasa): ?>
                                        <?php if (is_array($jasa)): ?>
                                            <?php
                                            // Check if the current kode_jasa is the same as the previous one
                                            if ($jasa['kode_jasa'] != $prevKodeJasa):
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= esc($jasa['kode_jasa'] ?? ''); ?></td>
                                                    <td><?= esc($jasa['nama_jasa'] ?? ''); ?></td>
                                                    <td><?= number_format($jasa['harga'] ?? 0, 0, ',', '.'); ?></td>
                                                </tr>
                                                <?php
                                                // Add the price to the total if 'harga' exists
                                                $totalHarga += ($jasa['harga'] ?? 0);
                                                $prevKodeJasa = $jasa['kode_jasa']; // Update prevKodeJasa
                                                ?>
                                            <?php else: ?>
                                                <!-- Skip duplicate rows, do not output anything -->
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4">Data tidak valid.</td>
                                            </tr>
                                        <?php endif; ?>
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
                                    <td><strong>Total</strong></td>
                                    <td><?= number_format($totalHarga, 0, ',', '.'); ?></td> <!-- Display the total price -->
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
                        <table class="table table-bordered table-striped table-hover text-center mt-2">
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
                                <?php $no = 1;
                                $prevKodeBarang = ''; ?> <!-- Initialize prevKodeBarang to track duplicates -->
                                <?php foreach ($rodata as $sparepart): ?>
                                    <?php
                                    // Check if the current 'id_kode_barang' is different from the previous one
                                    if ($sparepart['id_kode_barang'] != $prevKodeBarang):
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td> <!-- Increment row number -->
                                            <td><?= esc($sparepart['id_kode_barang']) ?></td> <!-- Display Kode Sparepart -->
                                            <td><?= esc($sparepart['nama_barang']) ?></td> <!-- Display Nama -->
                                            <td><?= esc($sparepart['qty_B']) ?></td> <!-- Display Qty -->
                                            <td><?= number_format($sparepart['hpp'], 0, ',', '.') ?></td> <!-- Display Harga with formatting -->
                                            <td><?= number_format($sparepart['qty_B'] * $sparepart['hpp'], 0, ',', '.') ?></td> <!-- Calculate Subtotal -->
                                        </tr>
                                        <?php
                                        // Update prevKodeBarang to avoid duplicate rows
                                        $prevKodeBarang = $sparepart['id_kode_barang'];
                                        ?>
                                    <?php else: ?>
                                        <!-- Skip the duplicate row (do nothing) -->
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td><strong>Total</strong></td>
                                    <td>
                                        <?php
                                        $total = 0;
                                        $prevKodeBarang = '';  // Reset to track unique rows for the total
                                        foreach ($rodata as $sparepart) {
                                            // Sum up all subtotals, but only include unique rows
                                            if ($sparepart['id_kode_barang'] != $prevKodeBarang) {
                                                $total += $sparepart['qty_B'] * $sparepart['hpp'];  // Calculate subtotal
                                                $prevKodeBarang = $sparepart['id_kode_barang'];  // Track the processed row
                                            }
                                        }
                                        echo number_format($total, 0, ',', '.');  // Display total
                                        ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Input Bahan -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Bahan -->
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped table-hover text-center">
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
                                <?php $no = 1;
                                $seen = []; ?> <!-- Initialize an empty array to track displayed ids -->
                                <?php foreach ($rodata as $detail): ?>
                                    <?php
                                    // If the current 'id_kode_bahan' is not in the 'seen' array, display it
                                    if (!in_array($detail['id_kode_bahan'], $seen)):
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= esc($detail['id_kode_bahan']) ?></td> <!-- Display Kode Bahan -->
                                            <td><?= esc($detail['nama_bahan']) ?></td> <!-- Display Nama -->
                                            <td><?= esc($detail['qty_bahan']) ?></td> <!-- Display Qty -->
                                            <td><?= number_format($detail['hpp_bahan'], 2, ',', '.') ?></td> <!-- Display Harga with formatting -->
                                            <td><?= number_format($detail['nilai_bahan'], 2, ',', '.') ?></td> <!-- Calculate Subtotal -->
                                        </tr>
                                <?php
                                        // Add the 'id_kode_bahan' to the 'seen' array to avoid future duplicates
                                        $seen[] = $detail['id_kode_bahan'];
                                    endif;  // End of check to skip duplicates
                                endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td><strong>Total</strong></td>
                                    <td>
                                        <?php
                                        $total = 0;
                                        $seen = [];  // Reset 'seen' array for total calculation
                                        foreach ($rodata as $detail) {
                                            // Sum up all subtotals, but only include unique rows
                                            if (!in_array($detail['id_kode_bahan'], $seen)) {
                                                $total += $detail['nilai_bahan'];  // Calculate subtotal
                                                $seen[] = $detail['id_kode_bahan'];  // Track the processed row
                                            }
                                        }
                                        echo number_format($total, 2, ',', '.');  // Apply number_format for Total
                                        ?>
                                    </td>
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