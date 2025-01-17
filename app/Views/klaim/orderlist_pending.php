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
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px; font-size: 12px;">
                        <table class="table table-bordered table-hover table-striped mb-0 text-center">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tgl. Masuk</th>
                                    <th class="text-center">Progres Pengerjaan</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Est. Keluar</th>
                                    <th class="text-center">Harga Acc</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">Car Model</th>
                                    <th class="text-center">Pelanggan</th>
                                    <th class="text-center">Asuransi</th>
                                    <th class="text-center">Tgl. Acc</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($pending as $key => $order): ?>
                                    <tr>
                                        <th style=" font-weight: normal;"><?= $key + 1 ?></th>
                                        <td style=" font-weight: normal;"><a href="<?= base_url('order_pospending/' . $order['id_terima_po']) ?>"><?= esc($order['id_terima_po']) ?></a></td>
                                        <th style=" font-weight: normal;"><?= $order['tgl_masuk'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['progres_pengerjaan'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['user_id'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['tgl_keluar'] ?></th>

                                        <!-- Logika untuk menampilkan harga estimasi atau harga acc -->
                                        <th style=" font-weight: normal;" class="harga-acc">
                                            <?php if ($order['asuransi'] == 'UMUM/PRIBADI'): ?>
                                                <?= number_format($order['harga_estimasi'], 0, ',', '.') ?>
                                            <?php else: ?>
                                                <?= number_format($order['harga_acc'], 0, ',', '.') ?>
                                            <?php endif; ?>
                                        </th>

                                        <th style=" font-weight: normal;"><?= $order['no_kendaraan'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['jenis_mobil'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['customer_name'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['asuransi'] ?></th>
                                        <th style=" font-weight: normal;"><?= $order['tgl_acc'] ?></th>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" class="text-center"><strong>Total Harga per Halaman:</strong></td>
                                    <td id="totalHarga" class="text-center"></td>
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-center"><strong>Grand Total:</strong></td>
                                    <td id="grandTotal" class="text-center"></td>
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Table Pending Invoice end -->



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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

    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotals() {
            // Selecting the rows that have class `harga-acc` where the prices are displayed
            const rows = document.querySelectorAll('tbody tr');
            let totalHargaPerHalaman = 0;
            let grandTotal = 0;

            rows.forEach(row => {
                const hargaCell = row.querySelector('.harga-acc');
                if (hargaCell && hargaCell.textContent.trim() !== '') {
                    // Convert text content to number after removing any formatting (thousand separators, etc.)
                    const harga = parseFloat(hargaCell.textContent.replace(/\./g, '').replace(',', '.'));
                    if (!isNaN(harga)) {
                        totalHargaPerHalaman += harga;
                    }
                }
            });

            // Update the total per page cell
            const totalHargaElement = document.getElementById('totalHarga');
            totalHargaElement.textContent = new Intl.NumberFormat('id-ID').format(totalHargaPerHalaman);

            // In this example, grand total is assumed to be the same as total per page
            // If you have multiple pages, you would adjust this logic
            grandTotal = totalHargaPerHalaman; // Adjust if there is more logic for multiple pages

            // Update the grand total cell
            const grandTotalElement = document.getElementById('grandTotal');
            grandTotalElement.textContent = new Intl.NumberFormat('id-ID').format(grandTotal);
        }

        // Call the function to calculate totals on page load
        calculateTotals();
    });
</script>


<?= $this->endSection() ?>