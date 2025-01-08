<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
<!-- Table acc Asuransi -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Acc Asuransi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Acc Asuransi</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Form Filter -->
                    <form method="get" action="<?= base_url('filter/asuransi') ?>" class="form-inline mt-2">
                        <div class="row g-3 align-items-center">
                            <!-- Cari -->
                            <div class="col-md-8 col-sm-6">
                                <label for="search_keyword" class="form-label fw-bold text-primary mb-1">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="No. Acc/Nopol"
                                    value="<?= $searchKeyword ?? '' ?>">
                            </div>

                            <!-- Tanggal Mulai dan Akhir -->
                            <div class="col-md-4 col-sm-12 d-flex justify-content-end align-items-end gap-2">
                                <div>
                                    <label for="start_date" class="form-label fw-bold text-primary mb-1">Mulai:</label>
                                    <input
                                        type="date"
                                        name="start_date"
                                        id="start_date"
                                        class="form-control form-control-sm"
                                        value="<?= $startDate ?? date('Y-m-01') ?>">
                                </div>
                                <div>
                                    <label for="end_date" class="form-label fw-bold text-primary mb-1">Akhir:</label>
                                    <input
                                        type="date"
                                        name="end_date"
                                        id="end_date"
                                        class="form-control form-control-sm"
                                        value="<?= $endDate ?? date('Y-m-d') ?>">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="card-content">
                    <div class="table-responsive" style="font-size: 11px; margin: 20px;">
                        <table class="table table-bordered table-striped table-hover text-center mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">No Asuransi</th>
                                    <th class="text-center">Tgl. Acc</th>
                                    <th class="text-center">Asuransi</th>
                                    <th class="text-center">No. Order</th>
                                    <th class="text-center">Jasa</th>
                                    <th class="text-center">Sparepart</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Tgl. Masuk</th>
                                    <th class="text-center">Car Model</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">Pelanggan</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Tgl. Input</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            // Urutkan data berdasarkan tgl_acc (descending)
                            if (!empty($accData)) {
                                usort($accData, function ($a, $b) {
                                    // Urutkan descending berdasarkan tgl_acc
                                    return strtotime($b['tgl_acc']) <=> strtotime($a['tgl_acc']);
                                });
                            }
                            ?>
                            <tbody class="text-center">
                                <?php if (!empty($accData)): ?>
                                    <?php foreach ($accData as $index => $acc): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('order_pos_asprev/' . $acc['id_terima_po']) ?>"><?= $acc['id_acc_asuransi'] ?></a></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_acc'])) ?></td>
                                            <td><?= $acc['asuransi'] ?></td>
                                            <td><?= $acc['id_terima_po'] ?></td>
                                            <td><?= number_format($acc['biaya_jasa'], 0, ',', '.') ?></td>
                                            <td><?= number_format($acc['biaya_sparepart'], 0, ',', '.') ?></td>
                                            <td><?= number_format($acc['biaya_total'], 0, ',', '.') ?></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_masuk'])) ?></td>
                                            <td><?= $acc['jenis_mobil'] ?></td>
                                            <td><?= $acc['no_kendaraan'] ?></td>
                                            <td><?= $acc['customer_name'] ?></td>
                                            <td><?= isset($acc['user_id']) ? esc($acc['user_id']) : 'N/A'; ?></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_acc'])) ?></td>
                                            <td>
                                                <div class="d-flex justify-content-between" style="height: 30px;">
                                                    <button type="button" class="btn me-1" onclick="lihatPdf()" style="height: 100%; width: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </button>
                                                    <button type="button" class="btn" style="height: 100%; width: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="15" class="text-center">No data available.</td>
                                    </tr>
                                <?php endif; ?>
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
    const accData = <?= json_encode($accData); ?>; // Assuming the PHP variable contains repair order data
    let filteredData = [...accData]; // Data that will be filtered based on date
    let rowsPerPage = 20; // Default number of rows per page

    // Initialize Flatpickr for date range picker
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#start-date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1), // Default start date is the first day of the current month
        });

        flatpickr("#end-date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date(), // Default end date is today's date
        });

        // Handle filter button click event
        document.getElementById('filter-btn').addEventListener('click', function() {
            const startDate = new Date(document.getElementById('start-date').value);
            const endDate = new Date(document.getElementById('end-date').value);

            // Filter the data based on the selected date range
            filteredData = accData.filter(item => {
                const tglAcc = new Date(item.tgl_acc);
                return tglAcc >= startDate && tglAcc <= endDate;
            });

            applySearch(); // Apply search after filter
        });

        // Handle rows per page change event
        document.getElementById('rows-per-page').addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? filteredData.length : parseInt(this.value);
            updateTable(); // Update the table with new number of rows per page
        });

        // Handle search button click event
        document.getElementById('search-btn').addEventListener('click', applySearch);
    });

    // Function to apply search filter
    function applySearch() {
        const searchTerm = document.getElementById('search-bar').value.toLowerCase();

        // Filter the data based on the search term
        filteredData = filteredData.filter(item => {
            return Object.values(item).some(value =>
                String(value).toLowerCase().includes(searchTerm)
            );
        });

        updateTable(); // Update the table with the filtered data
    }


    function exportToExcel() {
        const table = document.getElementById('accAsuransiTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "List Acc Asuransi"
        });

        // Format nama file
        const date = new Date();
        const formattedDate = date.toISOString().replace(/[-:.]/g, "").slice(0, 14);
        const zipFileName = `List_Acc_Asuransi_${formattedDate}.xlsx`;

        // Unduh file Excel
        XLSX.writeFile(wb, zipFileName);
    }
</script>

<?= $this->endSection() ?>