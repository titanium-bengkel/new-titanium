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
<!-- Table Repair Order -->
<section id="horizontal-input">
    <div class="col-12">
        <div class="row" id="table-head">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Order</h5>
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

                <!-- table head dark -->
                <div class="table-responsive" style="text-align: center; margin: 20px; font-size: 12px;">
                    <table class="table table-bordered mb-0" id="repairOrdersTable">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">No. Klaim</th>
                                <th class="text-center">Tgl. Klaim</th>
                                <th class="text-center">Tgl. Acc</th>
                                <th class="text-center">Tgl. Masuk</th>
                                <th class="text-center">Progres Pengerjaan</th>
                                <th class="text-center">Status Bayar</th>
                                <th class="text-center">Est. Keluar</th>
                                <th class="text-center">Nopol</th>
                                <th class="text-center">Jenis Mobil</th>
                                <th class="text-center">Asuransi</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Harga Acc</th>
                                <th class="text-center">User ID</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            if (!empty($repairOrders)) :
                                foreach ($repairOrders as $index => $order) :
                                    // Tentukan nilai Harga Acc sesuai dengan kondisi asuransi
                                    $harga_acc = ($order['asuransi'] === 'UMUM/PRIBADI' && !empty($order['total_biaya'])) ? $order['total_biaya'] : $order['harga_acc'];
                            ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><a href="<?= base_url('order_repair/' . $order['id_terima_po']) ?>"><?= esc($order['id_terima_po']) ?></a></td>
                                        <td><?= !empty($order['tgl_klaim']) ? date('Y-m-d', strtotime($order['tgl_klaim'])) : '-'; ?></td>
                                        <td>
                                            <?php if ($order['asuransi'] === 'UMUM/PRIBADI'): ?>
                                                -
                                            <?php else: ?>
                                                <?= !empty($order['tgl_acc']) ? date('Y-m-d', strtotime($order['tgl_acc'])) : '-'; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= !empty($order['tgl_masuk']) ? date('Y-m-d', strtotime($order['tgl_masuk'])) : '-'; ?></td>
                                        <td><?= esc($order['progres_pengerjaan']) ?></td>
                                        <td>
                                            <?php if ($order['status_bayar'] === 'Belum Bayar') : ?>
                                                <span class="badge bg-warning text-dark">Belum Bayar</span>
                                            <?php elseif ($order['status_bayar'] === 'Sudah Bayar OR') : ?>
                                                <span class="badge bg-primary text-dark">Sudah Bayar OR</span>
                                            <?php elseif ($order['status_bayar'] === 'Sudah Bayar') : ?>
                                                <span class="badge bg-secondary text-dark">Sudah Bayar</span>
                                            <?php elseif ($order['status_bayar'] === 'Pernah Bayar') : ?>
                                                <span class="badge bg-danger text-dark">Pernah Bayar</span>
                                            <?php elseif ($order['status_bayar'] === 'Lunas') : ?>
                                                <span class="badge bg-success">Lunas</span>
                                            <?php else : ?>
                                                <?= esc($order['status_bayar']) ?>
                                            <?php endif; ?>
                                        </td>


                                        <td><?= !empty($order['tgl_keluar']) ? date('Y-m-d', strtotime($order['tgl_keluar'])) : '-'; ?></td>
                                        <td><?= esc($order['no_kendaraan']) ?></td>
                                        <td><?= esc($order['jenis_mobil']) ?></td>
                                        <td><?= esc($order['asuransi']) ?></td>
                                        <td><?= esc($order['customer_name']) ?></td>
                                        <td class="harga-acc"><?= !empty($harga_acc) ? esc(number_format($harga_acc, 0, ',', '.')) : '-'; ?></td>
                                        <td><?= esc($order['username']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm delete-user-btn"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="15">No data available.</td>
                                </tr>
                            <?php endif; ?>
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        const table = document.getElementById('repairOrdersTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "List Repair Orders"
        });

        // Format nama file
        const date = new Date();
        const formattedDate = date.toISOString().replace(/[-:.]/g, "").slice(0, 14);
        const fileName = `List_Repair_Orders_${formattedDate}.xlsx`;

        // Unduh file Excel
        XLSX.writeFile(wb, fileName);
    }
</script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100],
            "ordering": true,
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "info": "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            "pagingType": "full_numbers"
        });
    });
</script>
<script>
    // Initialize dropdowns on page load
    document.getElementById('bulan').value = new Date().getMonth() + 1; // default to current month
    document.getElementById('tahun').value = new Date().getFullYear(); // default to current year

    function updateTable() {
        const selectedBengkel = document.getElementById('bengkelSelect').value;
        const selectedMonth = document.getElementById('bulan').value;
        const selectedYear = document.getElementById('tahun').value;

        // Fetch all rows in the table body
        const tableRows = document.querySelectorAll('#repairOrdersTable tbody tr');

        tableRows.forEach(row => {
            const tglKlaimCell = row.cells[2].textContent.trim(); // Tgl. Klaim cell
            const bengkelCell = row.cells[10].textContent.trim(); // Bengkel (asuransi) cell

            const tglKlaim = tglKlaimCell ? new Date(tglKlaimCell) : null;
            const rowMonth = tglKlaim ? (tglKlaim.getMonth() + 1).toString().padStart(2, '0') : '';
            const rowYear = tglKlaim ? tglKlaim.getFullYear().toString() : '';

            // Show or hide rows based on filters
            if (
                (selectedBengkel === "Bengkel" || bengkelCell === selectedBengkel) &&
                (selectedMonth === "" || rowMonth === selectedMonth) &&
                (selectedYear === "" || rowYear === selectedYear)
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listeners to call updateTable() when any dropdown changes
    document.getElementById('bulan').addEventListener('change', updateTable);
    document.getElementById('tahun').addEventListener('change', updateTable);
    document.getElementById('bengkelSelect').addEventListener('change', updateTable);

    // Initialize table on page load
    updateTable();
</script>
<script>
    // JavaScript untuk menghitung Total Per Halaman dan Grand Total
    document.addEventListener("DOMContentLoaded", function() {
        function formatCurrency(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function calculateTotals() {
            let totalPerPage = 0;
            let grandTotal = 0;

            // Ambil semua elemen dengan kelas "harga-acc"
            const hargaAccElements = document.querySelectorAll('.harga-acc');

            hargaAccElements.forEach(el => {
                // Ambil nilai Harga Acc dari teks elemen, hapus tanda titik, dan ubah ke integer
                const hargaAcc = parseInt(el.textContent.replace(/\./g, '').trim()) || 0;

                // Tambahkan ke total per halaman
                totalPerPage += hargaAcc;
            });

            // Untuk contoh ini, grand total diatur sama dengan total per halaman
            grandTotal = totalPerPage;

            // Update hasil perhitungan ke elemen footer
            document.getElementById('totalPerPage').innerHTML = `<strong>${formatCurrency(totalPerPage)}</strong>`;
            document.getElementById('grandTotal').innerHTML = `<strong>${formatCurrency(grandTotal)}</strong>`;
        }

        // Panggil fungsi untuk menghitung total setelah konten dimuat
        calculateTotals();
    });
</script>


<?= $this->endSection() ?>