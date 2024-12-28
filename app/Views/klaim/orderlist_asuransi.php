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
                        <!-- Top: Buttons and Period Input -->
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <!-- Left: Buttons -->
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>

                            <!-- Letak Rentang Waktu -->
                            <div class="dropdown position-relative">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span id="dropdown-label">30 hari terakhir</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#" data-period="7hari">7 hari terakhir</a></li>
                                    <li><a class="dropdown-item" href="#" data-period="30hari">30 hari terakhir</a></li>
                                    <li><a class="dropdown-item" href="#" data-period="perminggu">Per Minggu</a></li>
                                    <li><a class="dropdown-item" href="#" data-period="perbulan">Per Bulan</a></li>
                                </ul>
                                <div id="selected-period" class="mt-2 text-muted">
                                    <span>27 Okt - 25 Nov 2024</span>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dropdownItems = document.querySelectorAll('.dropdown-item');
                                    const dropdownLabel = document.getElementById('dropdown-label');
                                    const selectedPeriod = document.getElementById('selected-period');

                                    // Fungsi untuk menghitung tanggal yang dimulai dari N hari terakhir
                                    function getDateRange(days) {
                                        const endDate = new Date(); // Tanggal hari ini
                                        const startDate = new Date();
                                        startDate.setDate(endDate.getDate() - days); // Hitung tanggal N hari yang lalu

                                        const options = {
                                            year: 'numeric',
                                            month: '2-digit',
                                            day: '2-digit'
                                        };
                                        const start = startDate.toLocaleDateString('id-ID', options);
                                        const end = endDate.toLocaleDateString('id-ID', options);

                                        return `${start} - ${end}`;
                                    }

                                    // Fungsi untuk memperbarui label dan konten
                                    dropdownItems.forEach(item => {
                                        item.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            const period = this.getAttribute('data-period');

                                            // Update label dropdown
                                            dropdownLabel.textContent = this.textContent;

                                            // Update content below dropdown based on selection
                                            if (period === '7hari') {
                                                selectedPeriod.innerHTML = `<span>${getDateRange(7)}</span>`;
                                            } else if (period === '30hari') {
                                                selectedPeriod.innerHTML = `<span>${getDateRange(30)}</span>`;
                                            } else if (period === 'perminggu') {
                                                selectedPeriod.innerHTML = '<span>Pilih minggu di kalender</span>';
                                                renderWeeklyCalendar();
                                            } else if (period === 'perbulan') {
                                                selectedPeriod.innerHTML = '<span>Pilih bulan di kalender</span>';
                                                renderMonthlyCalendar();
                                            }
                                        });
                                    });

                                    // Fungsi untuk menampilkan kalender mingguan
                                    function renderWeeklyCalendar() {
                                        // Logic untuk menampilkan kalender mingguan
                                    }

                                    // Fungsi untuk menampilkan kalender bulanan
                                    function renderMonthlyCalendar() {
                                        // Logic untuk menampilkan kalender bulanan
                                    }
                                });
                            </script>

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
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">Customer</th>
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
                                            <td><?= isset($acc['username']) ? esc($acc['username']) : 'N/A'; ?></td>
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