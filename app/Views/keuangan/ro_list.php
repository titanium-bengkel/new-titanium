<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Order List</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Order List</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center">
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Form Filter -->
                        <form method="get" action="<?= base_url('filter/rolist') ?>" class="d-flex gap-3 align-items-center">
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
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <table class="table table-bordered table-striped table-hover mb-0" id="roList">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">No. Order</th>
                                    <th style="text-align: center;">Tgl. Masuk</th>
                                    <th style="text-align: center;">Tgl. Acc</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Jenis Mobil</th>
                                    <th style="text-align: center;">Nama Pelanggan</th>
                                    <th style="text-align: center;">Harga Acc</th>
                                    <th style="text-align: center;">Jasa</th>
                                    <th style="text-align: center;">Sparepart</th>
                                    <th style="text-align: center;">Bahan</th>
                                    <th style="text-align: center;">Pemakaian</th>
                                    <th style="text-align: center;">Profit</th>
                                    <th style="text-align: center;">No. Faktur</th>
                                    <!-- <th style="text-align: center;">Tgl. Faktur</th> -->
                                    <!-- <th style="text-align: center;">Keterangan</th> -->
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                <?php foreach ($rodata as $row): ?>
                                    <?php
                                    // Hitung pemakaian
                                    $pemakaian = ($row['jasa_total'] ?? 0) + ($row['sparepart_total'] ?? 0) + ($row['bahan_total'] ?? 0);

                                    // Tentukan harga berdasarkan jenis asuransi
                                    if (isset($row['asuransi']) && $row['asuransi'] === "UMUM/PRIBADI") {
                                        // Jika asuransi UMUM/PRIBADI, ambil total_biaya
                                        $harga = $row['total_biaya'] ?? 0;
                                        $tgl_masuk = $row['tgl_masuk'];
                                    } else {
                                        // Jika bukan UMUM/PRIBADI, ambil biaya_total
                                        $harga = $row['biaya_total'] ?? 0;
                                        $tgl_masuk = $row['tgl_masuk_as'];
                                    }

                                    // Hitung profit
                                    $profit = $harga - $pemakaian;
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><a href="<?= base_url('ro_listprev/' . $row['id_terima_po']); ?>"><?= $row['id_terima_po']; ?></a></td>
                                        <td><?= $tgl_masuk ?></td>
                                        <td><?= $row['tgl_acc'] ?? '-'; ?></td>
                                        <td><?= $row['progres_pengerjaan']; ?></td>
                                        <td><?= $row['no_kendaraan']; ?></td>
                                        <td><?= $row['jenis_mobil']; ?></td>
                                        <td><?= $row['customer_name']; ?></td>
                                        <td><?= number_format($harga, 0, ',', '.'); ?></td> <!-- Harga sesuai dengan kondisi asuransi -->
                                        <td><?= number_format($row['jasa_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['sparepart_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['bahan_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pemakaian, 0, ',', '.'); ?></td>
                                        <td><?= number_format($profit, 0, ',', '.'); ?></td>
                                        <td><?= $row['no_faktur']; ?></td>
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
<!-- Table head options end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    // Function to export the table data to an Excel file
    function exportToExcel() {
        const table = document.getElementById('roList');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "Repair Order List"
        });

        // Generate a file name with the current date and time
        const date = new Date();
        const formattedDate = date.toISOString().replace(/[-:.]/g, "").slice(0, 14);
        const fileName = `ROList_${formattedDate}.xlsx`;

        // Download the Excel file
        XLSX.writeFile(wb, fileName);
    }

    // Initial call to load the table when the page is loaded
    updateTable();
</script>

<?= $this->endSection() ?>