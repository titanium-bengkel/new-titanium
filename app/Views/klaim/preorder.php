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

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card shadow-lg rounded-3">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pre Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold text-primary">Pre Order</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <!-- Tombol Pre Order dan Export -->
                        <div class="d-flex align-items-center gap-2">
                            <a href="<?= base_url('order_pos') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Pre Order
                            </a>
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Form Filter -->
                        <form method="get" action="<?= base_url('filter/preorder') ?>" class="d-flex flex-wrap justify-content-end align-items-center gap-2">
                            <div class="d-flex flex-wrap justify-content-end align-items-center gap-2">
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
                            </div>
                        </form>
                    </div>
                </div>



                <!-- Table -->
                <div class="table-responsive" style="font-size: 11px; margin: 20px;">
                    <?php
                    // Assume the data is fetched from the database in the controller and passed to the view
                    $totalEstimasi = 0;
                    $totalAcc = 0;
                    ?>

                    <table id="claimTable" class="table table-bordered table-striped table-hover mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">No. Klaim</th>
                                <th class="text-center">Tgl. Klaim</th>
                                <th class="text-center">Tgl. Acc</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Nopol</th>
                                <th class="text-center">Car Model</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Pelanggan</th>
                                <th class="text-center">Harga Estimasi</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">Bengkel</th>
                                <th class="text-center">User ID</th>
                            </tr>
                        </thead>
                        <tbody id="claimTableBody">
                            <?php if (!empty($po)) : ?>
                                <?php $counter = 1; ?>
                                <?php foreach ($po as $item) : ?>
                                    <?php if ($item['status'] !== 'Repair Order') : ?>
                                        <tr class="text-center">
                                            <td><?= $counter++; ?></td>
                                            <td><a href="<?= base_url('order_posprev/' . $item['id_terima_po']) ?>"><?= $item['id_terima_po']; ?></a></td>
                                            <td><?= $item['tgl_klaim']; ?></td>
                                            <td><?= $item['tgl_acc'] ?? '-'; ?></td>
                                            <td>
                                                <?php
                                                switch ($item['status']) {
                                                    case 'Pre-Order':
                                                        echo '<span class="badge bg-danger">Pre-Order</span>';
                                                        break;
                                                    case 'Acc Asuransi':
                                                        echo '<span class="badge bg-warning text-dark">Acc Asuransi</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge bg-secondary">' . $item['status'] . '</span>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td><?= $item['progres']; ?></td>
                                            <td><?= $item['no_kendaraan']; ?></td>
                                            <td><?= $item['jenis_mobil']; ?></td>
                                            <td><?= $item['asuransi']; ?></td>
                                            <td><?= $item['customer_name']; ?></td>
                                            <td><?= number_format($item['total_biaya'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($item['harga_acc'], 0, ',', '.'); ?></td>
                                            <td><?= $item['bengkel']; ?></td>
                                            <td><?= $item['user_id']; ?></td>
                                        </tr>
                                        <?php
                                        $totalEstimasi += $item['total_biaya'];
                                        $totalAcc += $item['harga_acc'];
                                        ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="14" class="text-center">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="10" class="text-end fw-bold">Grand Total:</td>
                                <td class="text-center fw-bold"><?= number_format($totalEstimasi, 0, ',', '.'); ?></td>
                                <td class="text-center fw-bold"><?= number_format($totalAcc, 0, ',', '.'); ?></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Footer -->
                <footer style="text-align: center; margin-top: 20px;">
                    <p>&copy; 2024 All rights reserved.</p>
                </footer>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        const table = document.getElementById("claimTable");
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Pre Order"
        });
        XLSX.writeFile(workbook, "Pre_Order.xlsx");
    }
</script>


<?= $this->endSection() ?>