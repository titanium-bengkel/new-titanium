<!-- File: app/Views/sparepart/permintaan_part.php -->
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
                        <span class="breadcrumb-current text-muted">Report Jurnal</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Report Jurnal</h5>
                </header>
                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/reportjurnal') ?>" class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Input Cari -->
                            <div class="d-flex align-items-center">
                                <label for="search_keyword" class="form-label fw-bold text-primary me-2 mb-0">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="No. Document/Deskripsi"
                                    value="<?= $searchKeyword ?? '' ?>">
                            </div>

                            <!-- Input Tanggal Mulai -->
                            <div class="d-flex align-items-center">
                                <label for="start_date" class="form-label fw-bold text-primary me-2 mb-0">Mulai:</label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    class="form-control form-control-sm"
                                    value="<?= $startDate ?? date('Y-m-01') ?>">
                            </div>

                            <!-- Input Tanggal Akhir -->
                            <div class="d-flex align-items-center">
                                <label for="end_date" class="form-label fw-bold text-primary me-2 mb-0">Akhir:</label>
                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    class="form-control form-control-sm"
                                    value="<?= $endDate ?? date('Y-m-d') ?>">
                            </div>

                            <!-- Tombol Filter -->
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm fw-bold">Filter</button>
                            </div>

                            <!-- Tombol Tampilkan Semua -->
                            <div>
                                <button type="submit" name="show_all" value="1" class="btn btn-secondary btn-sm fw-bold">Tampilkan Semua</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px; font-size: 12px;" ;>
                        <table id="reportTable" class="table table-bordered table-striped tabel-hover mb-0 text-center">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Doc. no</th>
                                    <th class="text-center">Account</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            usort($reports, function ($a, $b) {
                                return strtotime($b['date']) - strtotime($a['date']);
                            });
                            ?>

                            <tbody>
                                <?php foreach ($reports as $index => $report): ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= esc($report['date']); ?></td>
                                        <td><?= esc($report['doc_no']); ?></td>
                                        <td><?= esc($report['account']); ?></td>
                                        <td style="text-align: left;"><?= esc($report['name']); ?></td>
                                        <td style="text-align: left;"><?= esc($report['description']); ?></td>
                                        <td style="text-align: right;"><?= number_format($report['debit'], 0, ',', '.'); ?></td>
                                        <td style="text-align: right;"><?= number_format($report['kredit'], 0, ',', '.'); ?></td>
                                        <td><?= esc($report['aksi']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right"><strong>Total All:</strong></td>
                                    <td id="totalDebitFooter" style="text-align: right;">0</td>
                                    <td id="totalKreditFooter" style="text-align: right;">0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Menghancurkan DataTable yang sudah ada, jika ada
        if ($.fn.dataTable.isDataTable('#reportTable')) {
            $('#reportTable').DataTable().destroy();
        }

        // Menghitung total debit dan kredit
        function calculateTotals() {
            let totalDebit = 0;
            let totalKredit = 0;

            // Iterasi setiap baris dalam tabel
            $('#reportTable tbody tr').each(function() {
                const debit = $(this).find('td:nth-child(7)').text().replace(/\./g, '').replace(',', '.'); // Ambil nilai debit dan format
                const kredit = $(this).find('td:nth-child(8)').text().replace(/\./g, '').replace(',', '.'); // Ambil nilai kredit dan format

                totalDebit += parseFloat(debit) || 0; // Tambahkan ke total debit
                totalKredit += parseFloat(kredit) || 0; // Tambahkan ke total kredit
            });

            // Tampilkan total ke dalam elemen HTML
            $('#totalDebitFooter').text(numberWithCommas(Math.round(totalDebit))); // Tampilkan total debit
            $('#totalKreditFooter').text(numberWithCommas(Math.round(totalKredit))); // Tampilkan total kredit
        }

        // Menghitung total per halaman
        function calculatePageTotals() {
            let totalDebitPage = 0;
            let totalKreditPage = 0;

            // Ambil data dari DataTables
            const pageData = $('#reportTable').DataTable().rows({
                page: 'current'
            }).data();

            // Iterasi setiap baris pada halaman saat ini
            $.each(pageData, function(index, value) {
                const debit = parseFloat(value[6].replace(/\./g, '').replace(',', '.')) || 0; // Kolom Debit
                const kredit = parseFloat(value[7].replace(/\./g, '').replace(',', '.')) || 0; // Kolom Kredit

                totalDebitPage += debit; // Tambahkan ke total debit halaman
                totalKreditPage += kredit; // Tambahkan ke total kredit halaman
            });

            // Tampilkan total per halaman
            $('#totalDebitPage').text(numberWithCommas(Math.round(totalDebitPage))); // Tampilkan total debit per halaman
            $('#totalKreditPage').text(numberWithCommas(Math.round(totalKreditPage))); // Tampilkan total kredit per halaman
        }

        // Fungsi untuk format angka dengan koma
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format angka
        }

        // Panggil fungsi calculateTotals setelah data dimuat
        calculateTotals();
    });
</script>



<?= $this->endSection() ?>