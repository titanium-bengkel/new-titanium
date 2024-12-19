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
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Batal Masuk</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Batal Masuk</h5>
                </header>
                <div class="card-header d-flex align-items-center justify-content-between p-3">
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Dropdown Bulan -->
                        <select id="bulan" class="form-select" style="width: auto;">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>

                        <!-- Dropdown Tahun -->
                        <select id="tahun" class="form-select" style="width: auto;">
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>

                        <!-- Dropdown Bengkel -->
                        <select id="bengkelSelect" class="form-select" style="width: auto;">
                            <option value="Bengkel" disabled selected>--Pilih Bengkel--</option>
                            <option value="Titanium">Titanium</option>
                            <option value="Tandem">Tandem</option>
                            <option value="K3 Karoseri">K3 Karoseri</option>
                        </select>
                    </div>
                </div>

                <!-- Tabel untuk Pre Order -->
                <div class="table-responsive" style="font-size: 12px; margin: 20px;">
                    <table id="claimTable" class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">No. Klaim</th>
                                <th class="text-center">Tgl Klaim</th>
                                <th class="text-center">Tgl Acc</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Nopol</th>
                                <th class="text-center">Jenis Mobil</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Harga Estimasi</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">User ID</th>
                            </tr>
                        </thead>
                        <tbody id="claimTableBody">
                            <!-- Data di sini akan diisi oleh JavaScript -->
                        </tbody>
                        <tfoot>
                            <!-- Area untuk menampilkan total -->
                        </tfoot>
                    </table>
                    <footer style="text-align: center; margin-top: 20px;">
                        <p>&copy; 2024 All rights reserved.</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    const poData = <?= json_encode($po); ?>; // Fetch data from PHP
    console.log('Data PO:', poData); // Debugging log

    // Set default month and year to November 2024
    const currentMonth = '11';
    const currentYear = '2024';

    // Select elements for dropdowns
    const monthSelect = document.getElementById('bulan');
    const yearSelect = document.getElementById('tahun');

    // Set default values for month and year dropdowns
    monthSelect.value = currentMonth;
    yearSelect.value = currentYear;

    // Add event listeners for month and year dropdowns
    monthSelect.addEventListener('change', function() {
        const selectedBengkel = document.getElementById('bengkelSelect').value;
        const selectedMonth = this.value;
        const selectedYear = yearSelect.value;

        if (selectedBengkel) {
            updateTable(selectedBengkel, selectedMonth, selectedYear);
        }
    });

    yearSelect.addEventListener('change', function() {
        const selectedBengkel = document.getElementById('bengkelSelect').value;
        const selectedMonth = monthSelect.value;
        const selectedYear = this.value;

        if (selectedBengkel) {
            updateTable(selectedBengkel, selectedMonth, selectedYear);
        }
    });

    // Function to update table based on bengkel, month, and year
    function updateTable(bengkel, month = null, year = null) {
        const tableBody = document.getElementById('claimTableBody');
        tableBody.innerHTML = ''; // Clear previous content

        // Filter data by bengkel, month, and year
        const filteredData = poData.filter(item => {
            const claimDate = new Date(item.tgl_klaim);
            const claimMonth = (claimDate.getMonth() + 1).toString().padStart(2, '0'); // MM format
            const claimYear = claimDate.getFullYear().toString();

            return (
                item.bengkel === bengkel &&
                item.status !== 'Repair Order' &&
                (!month || claimMonth === month) &&
                (!year || claimYear === year)
            );
        });

        console.log('Filtered Data:', filteredData); // Log filtered data

        // Sort data by claim date (newest first)
        filteredData.sort((a, b) => new Date(b.tgl_klaim) - new Date(a.tgl_klaim));

        let grandTotalHargaEstimasi = 0;
        let grandTotalHargaAcc = 0;

        // Add rows to the table based on filtered data
        if (filteredData.length > 0) {
            filteredData.forEach((po_item, index) => {
                // Cek apakah progres adalah "Batal Mobil Masuk"
                if (po_item.progres === "Batal Mobil Masuk") {
                    const hargaEstimasi = po_item.harga_estimasi ? parseFloat(po_item.harga_estimasi.toString().replace(/\./g, '').replace(',', '.')) : 0;
                    const hargaAcc = (po_item.harga_acc && po_item.asuransi !== 'UMUM/PRIBADI') ? parseFloat(po_item.harga_acc.toString().replace(/\./g, '').replace(',', '.')) : 0;

                    grandTotalHargaEstimasi += hargaEstimasi;
                    grandTotalHargaAcc += hargaAcc;

                    const row = `<tr class="text-center">
                <td>${index + 1}</td>
                <td><a href="<?= base_url('order_posprev') ?>/${po_item.id_terima_po}">${po_item.id_terima_po}</a></td>
                <td>${new Date(po_item.tgl_klaim).toISOString().split('T')[0]}</td>
                <td>${po_item.asuransi === 'UMUM/PRIBADI' ? '-' : (po_item.tgl_acc ? new Date(po_item.tgl_acc).toISOString().split('T')[0] : '-')}</td>
                <td>${getStatusBadge(po_item.status)}</td>
                <td>${po_item.progres}</td>
                <td>${po_item.no_kendaraan}</td>
                <td>${po_item.jenis_mobil}</td>
                <td>${po_item.asuransi}</td>
                <td>${po_item.customer_name}</td>
                <td>${po_item.harga_estimasi ? new Intl.NumberFormat('id-ID').format(po_item.harga_estimasi) : '-'}</td>
                <td>${po_item.asuransi === 'UMUM/PRIBADI' ? new Intl.NumberFormat('id-ID').format(po_item.harga_estimasi) : (po_item.harga_acc ? new Intl.NumberFormat('id-ID').format(po_item.harga_acc) : '-')}</td>
                <td>${po_item.username}</td>
            </tr>`;
                    tableBody.innerHTML += row;
                }
            });
        }

        // Jika tidak ada data yang ditampilkan, tampilkan pesan "No data available"
        if (tableBody.innerHTML === '') {
            tableBody.innerHTML = '<tr><td colspan="13">No data available.</td></tr>';
        }


        $('#claimTable').DataTable().destroy(); // Destroy existing DataTable instance
        const table = $('#claimTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [20, 50, 100, -1],
            "ordering": true,
            "drawCallback": function(settings) {
                let pageTotalHargaEstimasi = 0;
                let pageTotalHargaAcc = 0;

                const pageData = this.api().rows({
                    page: 'current'
                }).data();
                pageData.each(function(rowData) {
                    const hargaEstimasi = rowData[10] !== '-' ? parseFloat(rowData[10].toString().replace(/\./g, '').replace(',', '.')) : 0;
                    const hargaAcc = rowData[11] !== '-' ? parseFloat(rowData[11].toString().replace(/\./g, '').replace(',', '.')) : 0;

                    pageTotalHargaEstimasi += hargaEstimasi;
                    pageTotalHargaAcc += hargaAcc;
                });

                const allData = this.api().rows().data();
                grandTotalHargaEstimasi = 0;
                grandTotalHargaAcc = 0;

                allData.each(function(rowData) {
                    const hargaEstimasi = rowData[10] !== '-' ? parseFloat(rowData[10].toString().replace(/\./g, '').replace(',', '.')) : 0;
                    const hargaAcc = rowData[11] !== '-' ? parseFloat(rowData[11].toString().replace(/\./g, '').replace(',', '.')) : 0;

                    grandTotalHargaEstimasi += hargaEstimasi;
                    grandTotalHargaAcc += hargaAcc;
                });

                const totalRow = `
                <tr>
                    <td colspan="10" style="text-align: right; font-weight: bold;">Total Per Halaman:</td>
                    <td class="text-center" style="font-weight: bold;">${new Intl.NumberFormat('id-ID').format(pageTotalHargaEstimasi)}</td>
                    <td class="text-center" style="font-weight: bold;">${new Intl.NumberFormat('id-ID').format(pageTotalHargaAcc)}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="10" style="text-align: right; font-weight: bold;">Grand Total:</td>
                    <td class="text-center" style="font-weight: bold;">${new Intl.NumberFormat('id-ID').format(grandTotalHargaEstimasi)}</td>
                    <td class="text-center" style="font-weight: bold;">${new Intl.NumberFormat('id-ID').format(grandTotalHargaAcc)}</td>
                    <td></td>
                </tr>`;
                $('#claimTable tfoot').html(totalRow);
            },
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "search": "Search:",
                "zeroRecords": "Tidak ada hasil ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
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

    document.getElementById('bengkelSelect').addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue) {
            updateTable(selectedValue, currentMonth, currentYear);
        } else {
            document.getElementById('claimTableBody').innerHTML = '<tr><td colspan="13">Silakan pilih bengkel.</td></tr>';
        }
    });

    // Load data for default bengkel on page load
    updateTable('Titanium', currentMonth, currentYear);

    function exportToExcel() {
        const table = document.getElementById('claimTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "Pre Order"
        });

        const now = new Date();
        const formattedDate = now.toISOString().replace(/[-:T]/g, '').split('.')[0];
        const fileName = `PRE_ORDER_${formattedDate}.xlsx`;

        XLSX.writeFile(wb, fileName);
    }
</script>





<?= $this->endSection() ?>