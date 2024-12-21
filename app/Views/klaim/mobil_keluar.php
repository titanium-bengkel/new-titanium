<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- SweetAlert2 and Flatpickr CDN -->
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

<!-- Main Section -->
<section id="horizontal-input">
    <div class="col-12">
        <div class="row" id="table-head">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Mobil Keluar</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Mobil Keluar</h5>
                </header>
                <div class="card-header py-3 px-4 border-muted" style="font-size: 12px;">
                    <div class="d-flex flex-column">
                        <!-- Top: Buttons and Period Input -->
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <!-- Left: Buttons -->
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>

                            <!-- Right: Period Input (Pojok Kanan Atas) -->
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
                    <table class="table table-bordered table-striped table-hover mb-0" id="repairOrdersTable">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">No. Klaim</th>
                                <th class="text-center">Tgl. Klaim</th>
                                <th class="text-center">Tgl. Acc</th>
                                <th class="text-center">Tgl. Masuk</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Status Bayar</th>
                                <th class="text-center">Est. Keluar</th>
                                <th class="text-center">Nopol</th>
                                <th class="text-center">Jenis Mobil</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">Bengkel</th>
                                <th class="text-center">User ID</th>
                            </tr>
                        </thead>
                        <tbody id="repairOrdersTableBody" class="text-center">

                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <td colspan="12"><strong>Total Per Halaman</strong></td>
                                <td id="totalPerPage"><strong>0</strong></td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="12"><strong>Grand Total</strong></td>
                                <td id="grandTotal"><strong>0</strong></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Repair Order end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>


<script>
    // Data from PHP
    const repairOrders = <?= json_encode($repairOrders); ?>; // Assuming the PHP variable contains repair order data
    let filteredData = [...repairOrders]; // Data that will be filtered based on date
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
            filteredData = repairOrders.filter(item => {
                const tglKlaim = new Date(item.tgl_klaim);
                return tglKlaim >= startDate && tglKlaim <= endDate;
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

    function updateTable() {
        const tableBody = document.getElementById('repairOrdersTableBody');
        tableBody.innerHTML = ''; // Clear the existing table content

        let totalPerPageEstimasi = 0; // Total untuk halaman saat ini
        let totalPerPageAcc = 0; // Total untuk halaman saat ini
        let grandTotalEstimasi = 0; // Total untuk semua data
        let grandTotalAcc = 0; // Total untuk semua data

        // Loop semua data untuk menghitung grand total
        filteredData.forEach(item => {
            if (item.asuransi === 'UMUM/PRIBADI') {
                grandTotalEstimasi += item.harga_estimasi ? parseFloat(item.harga_estimasi) : 0;
            } else {
                grandTotalAcc += item.harga_acc ? parseFloat(item.harga_acc) : 0;
            }
        });

        // Data yang akan ditampilkan pada halaman ini (maksimal 20 data)
        const dataToDisplay = filteredData.slice(0, rowsPerPage);
        dataToDisplay.forEach((item, index) => {
            // Perhitungan total untuk halaman ini
            let hargaEstimasi = 0;
            let hargaAcc = 0;

            if (item.asuransi === 'UMUM/PRIBADI') {
                hargaEstimasi = item.harga_estimasi ? parseFloat(item.harga_estimasi) : 0;
                totalPerPageEstimasi += hargaEstimasi;
            } else {
                hargaAcc = item.harga_acc ? parseFloat(item.harga_acc) : 0;
                totalPerPageAcc += hargaAcc;
            }

            // Buat baris tabel
            const row = `<tr class="text-center">
            <td>${index + 1}</td>
            <td><a href="<?= base_url('order_repair') ?>/${item.id_terima_po}">${item.id_terima_po}</a></td>
            <td>${item.tgl_klaim || '-'}</td>
            <td>${item.tgl_acc || '-'}</td>
            <td>${item.tgl_masuk || '-'}</td>
            <td>${item.progres_pengerjaan}</td>
            <td>${getStatusBadge(item.status_bayar)}</td>
            <td>${item.tgl_keluar || '-'}</td>
            <td>${item.no_kendaraan}</td>
            <td>${item.jenis_mobil}</td>
            <td>${item.asuransi}</td>
            <td>${item.customer_name}</td>
            <td class="harga-acc">${hargaAcc ? hargaAcc.toLocaleString('id-ID') : (hargaEstimasi ? hargaEstimasi.toLocaleString('id-ID') : '-')}</td>
            <td>${item.bengkel}</td>
            <td>${item.username}</td>
        </tr>`;

            tableBody.innerHTML += row;
        });

        // Update total untuk halaman ini dan grand total
        document.getElementById('totalPerPage').innerText = (totalPerPageEstimasi + totalPerPageAcc).toLocaleString('id-ID');
        document.getElementById('grandTotal').innerText = (grandTotalEstimasi + grandTotalAcc).toLocaleString('id-ID');
    }


    // Function to get the status badge for each item
    function getStatusBadge(status) {
        if (!status) {
            // Jika status null atau kosong, return string kosong untuk tidak menampilkan apa-apa
            return '';
        }

        switch (status) {
            case 'Belum Bayar':
                return '<span class="badge bg-warning text-dark">Belum Bayar</span>';
            case 'Sudah Kwitansi OR':
                return '<span class="badge bg-primary text-dark">Sudah Kwitansi OR</span>';
            case 'Sudah Kwitansi':
                return '<span class="badge bg-secondary text-dark">Sudah Kwitansi</span>';
            case 'Pernah Bayar':
                return '<span class="badge bg-danger text-dark">Pernah Bayar</span>';
            case 'Lunas':
                return '<span class="badge bg-success">Lunas</span>';
            default:
                return status; // Jika ada status lain yang tidak terdefinisi
        }
    }


    // Function to export the table data to an Excel file
    function exportToExcel() {
        const table = document.getElementById('repairOrdersTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "Repair Orders"
        });

        // Generate a file name with the current date and time
        const date = new Date();
        const formattedDate = date.toISOString().replace(/[-:.]/g, "").slice(0, 14);
        const fileName = `Repair_Orders_${formattedDate}.xlsx`;

        // Download the Excel file
        XLSX.writeFile(wb, fileName);
    }

    // Initial call to load the table when the page is loaded
    updateTable();
</script>

<?= $this->endSection() ?>