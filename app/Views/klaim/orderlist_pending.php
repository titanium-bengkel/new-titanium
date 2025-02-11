<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pending Invoice</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pending Invoice</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Form Filter -->
                        <form method="get" action="<?= base_url('filter/pendinginvoice') ?>" class="d-flex gap-3 align-items-center">
                            <!-- Nama Bengkel -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="filter_name" class="form-label fw-bold text-primary mb-0">Bengkel:</label>
                                <select name="filter_name" id="filter_name" class="form-select form-select-sm">
                                    <option value="" <?= empty($filterName) ? 'selected' : '' ?>>Semua</option>
                                    <option value="Titanium" <?= ($filterName == 'Titanium') ? 'selected' : '' ?>>Titanium</option>
                                    <option value="K3 Karoseri" <?= ($filterName == 'K3 Karoseri') ? 'selected' : '' ?>>K3 Karoseri</option>
                                    <option value="Tandem" <?= ($filterName == 'Tandem') ? 'selected' : '' ?>>Tandem</option>
                                    <option value="Vortex" <?= ($filterName == 'Vortex') ? 'selected' : '' ?>>Vortex</option>
                                </select>
                            </div>

                            <!-- Pencarian -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="search_keyword" class="form-label fw-bold text-primary mb-0">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="No. Order/Nopol"
                                    value="<?= $searchKeyword ?? '' ?>">
                            </div>

                            <!-- Input Tanggal Mulai -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="start_date" class="form-label fw-bold text-primary mb-0">Mulai:</label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    class="form-control form-control-sm"
                                    value="<?= $startDate ?? date('Y-m-01') ?>">
                            </div>

                            <!-- Input Tanggal Akhir -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="end_date" class="form-label fw-bold text-primary mb-0">Akhir:</label>
                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    class="form-control form-control-sm"
                                    value="<?= $endDate ?? date('Y-m-d') ?>">
                            </div>

                            <!-- Tombol Filter -->
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Filter</button>

                            <!-- Tombol Tampilkan Semua -->
                            <button type="submit" name="show_all" value="1" class="btn btn-secondary btn-sm fw-bold">Tampilkan Semua</button>
                        </form>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px; font-size: 12px;">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <thead class="thead-dark table-secondary text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Acc</th>
                                    <th>Progres Pengerjaan</th>
                                    <th>Est. Keluar</th>
                                    <th>Harga Acc</th>
                                    <th>Nopol</th>
                                    <th>Car Model</th>
                                    <th>Pelanggan</th>
                                    <th>Asuransi</th>
                                    <th>Keterangan</th>
                                    <th>User ID</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php
                                $totalPerPageEstimasi = 0;
                                $totalPerPageAcc = 0;
                                $grandTotalEstimasi = 0;
                                $grandTotalAcc = 0;

                                if (!empty($pending)) {
                                    foreach ($pending as $key => $item) {
                                        if ($item['asuransi'] === 'UMUM/PRIBADI') {
                                            $grandTotalEstimasi += isset($item['harga_estimasi']) ? floatval($item['harga_estimasi']) : 0;
                                        } else {
                                            $grandTotalAcc += isset($item['harga_acc']) ? floatval($item['harga_acc']) : 0;
                                        }
                                ?>
                                        <tr>
                                            <th><?= $key + 1 ?></th>
                                            <td>
                                                <a href="<?= base_url('order_repair/' . esc($item['id_terima_po'])) ?>">
                                                    <?= esc($item['id_terima_po']) ?>
                                                </a>
                                            </td>
                                            <th><?= esc($item['tgl_masuk']) ?></th>
                                            <th><?= !empty($item['tgl_acc']) ? esc($item['tgl_acc']) : '-' ?></th>
                                            <th><?= esc($item['progres_pengerjaan']) ?></th>
                                            <th><?= esc($item['tgl_keluar']) ?></th>
                                            <td>
                                                <?= number_format($item['harga_acc'] ?? $item['harga_estimasi'] ?? 0, 0, ',', '.') ?: '-' ?>
                                            </td>
                                            <th><?= esc($item['no_kendaraan']) ?></th>
                                            <th><?= esc($item['jenis_mobil']) ?></th>
                                            <th><?= esc($item['customer_name']) ?></th>
                                            <th><?= esc($item['asuransi']) ?></th>
                                            <th>
                                                <?php
                                                if ($item['progres_pengerjaan'] === 'Beres Pengerjaan') {
                                                    echo 'Status: ' . esc($item['status_bayar']);
                                                } elseif ($item['progres_pengerjaan'] === 'Kurang Dokumen') {
                                                    echo esc($item['progres_dokumen']);
                                                } elseif ($item['progres_pengerjaan'] === 'Sparepart') {
                                                    echo esc($item['progres_sparepart']);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </th>
                                            <th><?= esc($item['user_id']) ?></th>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Grand Total:</strong></td>
                                    <td class="text-center">
                                        <strong><?= number_format($grandTotalEstimasi + $grandTotalAcc, 0, ',', '.') ?></strong>
                                    </td>
                                    <td colspan="6"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Pending Invoice end -->



<?= $this->endSection() ?>