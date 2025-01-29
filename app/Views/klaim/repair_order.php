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

<!-- Main Section -->
<section id="horizontal-input">
    <div class="col-12">
        <div class="row" id="table-head">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
                    style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Order</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Form Filter -->
                        <form method="get" action="<?= base_url('filter/repairorder') ?>" class="d-flex gap-3 align-items-center">
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

                <!-- Table -->
                <div class="table-responsive" style="font-size: 11px; margin: 20px;">
                    <?php
                    $totalPerPageEstimasi = 0;
                    $totalPerPageAcc = 0;
                    $grandTotalEstimasi = 0;
                    $grandTotalAcc = 0;
                    if (!empty($repairOrders)) {
                        foreach ($repairOrders as $item) {
                            if ($item['asuransi'] === 'UMUM/PRIBADI') {
                                $grandTotalEstimasi += $item['harga_estimasi'] ? floatval($item['harga_estimasi']) : 0;
                            } else {
                                $grandTotalAcc += $item['harga_acc'] ? floatval($item['harga_acc']) : 0;
                            }
                        }
                    }
                    ?>
                    <table class="table table-bordered table-striped table-hover mb-0" id="repairOrdersTable">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">No. Klaim</th>
                                <th class="text-center">Tgl. Masuk</th>
                                <th class="text-center">Tgl. Acc</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Status Bayar</th>
                                <th class="text-center">Est. Keluar</th>
                                <th class="text-center">Nopol</th>
                                <th class="text-center">Car Model</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Pelanggan</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">Bengkel</th>
                                <th class="text-center">User ID</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($repairOrders)) : ?>
                                <?php $counter = 1; ?>
                                <?php foreach ($repairOrders as $item) : ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><a href="<?= base_url('order_repair/' . $item['id_terima_po']) ?>"><?= $item['id_terima_po']; ?></a></td>
                                        <td><?= $item['tgl_masuk'] ?? '-'; ?></td>
                                        <td><?= $item['tgl_acc'] ?? '-'; ?></td>
                                        <td><?= $item['progres_pengerjaan']; ?></td>
                                        <td>
                                            <?= match ($item['status_bayar']) {
                                                'Belum Bayar' => '<span class="badge bg-warning text-dark">Belum Bayar</span>',
                                                'Belum Kwitansi' => '<span class="badge bg-primary text-dark">Belum Kwitansi</span>',
                                                'Sudah Kwitansi' => '<span class="badge bg-secondary text-dark">Sudah Kwitansi</span>',
                                                'Pernah Bayar' => '<span class="badge bg-danger text-dark">Pernah Bayar</span>',
                                                'Lunas' => '<span class="badge bg-success">Lunas</span>',
                                                default => $item['status_bayar'],
                                            }; ?>
                                        </td>
                                        <td><?= $item['tgl_estimasi'] ?? '-'; ?></td>
                                        <td><?= $item['no_kendaraan']; ?></td>
                                        <td><?= $item['jenis_mobil']; ?></td>
                                        <td><?= $item['asuransi']; ?></td>
                                        <td><?= $item['customer_name']; ?></td>
                                        <td
                                            data-value="<?= $item['harga_acc'] ?? $item['harga_estimasi'] ?? 0; ?>">
                                            <?= number_format($item['harga_acc'] ?? $item['harga_estimasi'] ?? 0, 0, ',', '.') ?: '-'; ?>
                                        </td>
                                        <td><?= $item['bengkel']; ?></td>
                                        <td><?= $item['user_id']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="14" class="text-center">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <tfoot class="text-center">
                            <tr>
                                <td colspan="11"><strong>Total Per Halaman</strong></td>
                                <td
                                    data-value="<?= $totalPerPageEstimasi + $totalPerPageAcc; ?>">
                                    <strong><?= number_format($totalPerPageEstimasi + $totalPerPageAcc, 0, ',', '.'); ?></strong>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="11"><strong>Grand Total</strong></td>
                                <td
                                    data-value="<?= $grandTotalEstimasi + $grandTotalAcc; ?>">
                                    <strong><?= number_format($grandTotalEstimasi + $grandTotalAcc, 0, ',', '.'); ?></strong>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Repair Order end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        const table = document.getElementById("repairOrdersTable").closest("table");

        // Clone tabel untuk memodifikasi salinan
        const clonedTable = table.cloneNode(true);
        const rows = clonedTable.querySelectorAll("tr");

        // Ubah nilai nominal menjadi angka murni dari atribut data-value
        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            cells.forEach(cell => {
                const originalValue = cell.getAttribute("data-value");
                if (originalValue) {
                    cell.textContent = originalValue; // Ganti teks dengan nilai asli
                }
            });
        });

        // Gunakan XLSX untuk ekspor tabel
        const workbook = XLSX.utils.table_to_book(clonedTable, {
            sheet: "Repair Order"
        });
        XLSX.writeFile(workbook, "Repair_Order.xlsx");
    }
</script>


<?= $this->endSection() ?>