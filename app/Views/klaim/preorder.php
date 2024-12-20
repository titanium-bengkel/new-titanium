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

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card shadow-lg rounded-3">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pre Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold text-primary">Pre Order</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <a href="<?= base_url('order_pos') ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Pre Order
                                </a>
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <label for="start-date" class="form-label mb-0 text-muted fw-bold">Periode:</label>
                                <input type="text" id="start-date" class="form-control form-control-sm rounded-2 w-auto" style="width: 120px;" placeholder="Start Date" readonly />
                                <span class="mx-1 text-muted fw-bold">to</span>
                                <input type="text" id="end-date" class="form-control form-control-sm rounded-2 w-auto" style="width: 120px;" placeholder="End Date" readonly />
                                <button class="btn btn-primary btn-sm rounded-2" id="filter-btn">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>

                        <!-- Bottom: Search and Rows Per Page -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <!-- Left: Search -->
                            <div class="d-flex align-items-center gap-2">
                                <input type="text" id="search-bar" class="form-control form-control-sm rounded-2" placeholder="Search data..." />
                                <button class="btn btn-outline-secondary btn-sm rounded-2" id="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <!-- Right: Rows Per Page -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="rows-per-page" class="form-label mb-0 text-muted fw-bold">Tampilkan:</label>
                                <select id="rows-per-page" class="form-select form-select-sm rounded-2 w-auto">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- Table -->
                <div class="table-responsive" style="font-size: 11px; margin: 20px;">
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
                                <th class="text-center">Jenis Mobil</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Harga Estimasi</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">Bengkel</th>
                                <th class="text-center">User ID</th>
                            </tr>
                        </thead>
                        <tbody id="claimTableBody">
                            <!-- Data will be inserted by JavaScript -->
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="10" class="text-end fw-bold">Grand Total:</td>
                                <td id="grand-total-estimasi" class="text-center fw-bold"></td>
                                <td id="grand-total-acc" class="text-center fw-bold"></td>
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
    const poData = <?= json_encode($po); ?>; // Data from PHP
    let filteredData = [...poData]; // Filtered data
    let rowsPerPage = 20; // Default number of rows per page

    // Initialize Flatpickr for date range selection
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#start-date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1), // Start of current month
        });

        flatpickr("#end-date", {
            dateFormat: "Y-m-d",
            defaultDate: new Date(), // Current date
        });

        // Filter button click event
        document.getElementById('filter-btn').addEventListener('click', function() {
            const startDate = new Date(document.getElementById('start-date').value);
            const endDate = new Date(document.getElementById('end-date').value);

            filteredData = poData.filter(item => {
                const claimDate = new Date(item.tgl_klaim);
                return claimDate >= startDate && claimDate <= endDate;
            });

            applySearch(); // Apply search after filtering
        });

        // Rows per page dropdown change event
        document.getElementById('rows-per-page').addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? filteredData.length : parseInt(this.value);
            updateTable();
        });

        // Search button click event
        document.getElementById('search-btn').addEventListener('click', applySearch);
    });

    function applySearch() {
        const searchTerm = document.getElementById('search-bar').value.toLowerCase();
        filteredData = filteredData.filter(item => {
            return Object.values(item).some(value =>
                String(value).toLowerCase().includes(searchTerm)
            );
        });
        updateTable();
    }

    function updateTable() {
        const tableBody = document.getElementById('claimTableBody');
        tableBody.innerHTML = ''; // Clear existing table content

        let grandTotalEstimasi = 0;
        let grandTotalAcc = 0;

        const dataToDisplay = filteredData.slice(0, rowsPerPage);
        let currentRowNumber = 1; // Initialize row number

        dataToDisplay.forEach((item) => {
            if (item.status === 'Repair Order') return; // Skip 'Repair Order' status

            const hargaEstimasi = item.total_biaya ? parseFloat(item.total_biaya) : 0;
            const hargaAcc = item.harga_acc ? parseFloat(item.harga_acc) : 0;

            grandTotalEstimasi += hargaEstimasi;
            grandTotalAcc += hargaAcc;

            const row = `
            <tr class="text-center">
                <td>${currentRowNumber}</td>
                <td><a href="<?= base_url('order_posprev') ?>/${item.id_terima_po}">${item.id_terima_po}</a></td>
                <td>${item.tgl_klaim}</td>
                <td>${item.tgl_acc || '-'}</td>
                <td>${getStatusBadge(item.status)}</td>
                <td>${item.progres}</td>
                <td>${item.no_kendaraan}</td>
                <td>${item.jenis_mobil}</td>
                <td>${item.asuransi}</td>
                <td>${item.customer_name}</td>
                <td>${formatNumber(hargaEstimasi)}</td>
                <td>${formatNumber(hargaAcc)}</td>
                <td>${item.bengkel}</td>
                <td>${item.user_id}</td>
            </tr>`;

            tableBody.innerHTML += row;

            currentRowNumber++;
        });

        // Update totals in the footer
        document.getElementById('grand-total-estimasi').innerText = formatNumber(grandTotalEstimasi);
        document.getElementById('grand-total-acc').innerText = formatNumber(grandTotalAcc);
    }


    function getStatusBadge(status) {
        switch (status) {
            case 'Pre-Order':
                return '<span class="badge bg-danger">' + status + '</span>';
            case 'Repair Order':
                return '<span class="badge bg-success">' + status + '</span>';
            case 'Acc Asuransi':
                return '<span class="badge bg-warning text-dark">' + status + '</span>';
            default:
                return '<span class="badge bg-secondary">' + status + '</span>';
        }
    }

    function formatNumber(value) {
        return value ? new Intl.NumberFormat('id-ID').format(value) : '-';
    }

    function exportToExcel() {
        const table = document.getElementById('claimTable');
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Pre Order"
        });
        XLSX.writeFile(workbook, 'Pre_Order.xlsx');
    }

    updateTable(); // Initial load
</script>

<?= $this->endSection() ?>