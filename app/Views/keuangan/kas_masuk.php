<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kas Masuk</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Kas Masuk</h5>
                </header>
                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/kasmasuk') ?>" class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Input Cari -->
                            <div class="d-flex align-items-center">
                                <label for="search_keyword" class="form-label fw-bold text-primary me-2 mb-0">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="Nomor/Keterangan"
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

                            <!-- Filter Dropdown -->
                            <div class="d-flex align-items-center">
                                <label for="filter_account" class="form-label fw-bold text-primary me-2 mb-0">Akun:</label>
                                <select
                                    name="filter_account"
                                    id="filter_account"
                                    class="form-select form-select-sm">
                                    <option value="">Pilih Akun</option>
                                    <option value="KAS BESAR" <?= isset($filterAccount) && $filterAccount === 'KAS BESAR' ? 'selected' : '' ?>>KAS BESAR</option>
                                    <option value="REK BCA" <?= isset($filterAccount) && $filterAccount === 'REK BCA' ? 'selected' : '' ?>>REK BCA</option>
                                </select>
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
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Kas</th>
                                    <th style="text-align: center;">Nama Kas</th>
                                    <th style="text-align: center;">Debet</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kasMasuk)): ?>
                                    <?php
                                    $transactionsByDate = [];
                                    $grandTotal = 0;
                                    foreach ($kasMasuk as $kas) {
                                        if ($kas['debit'] == 0) {
                                            continue;
                                        }
                                        $date = $kas['date'];
                                        if (!isset($transactionsByDate[$date])) {
                                            $transactionsByDate[$date] = ['transactions' => [], 'totalDebit' => 0];
                                        }
                                        $transactionsByDate[$date]['transactions'][] = $kas;
                                        $transactionsByDate[$date]['totalDebit'] += $kas['debit'];
                                        $grandTotal += $kas['debit'];
                                    }
                                    ?>

                                    <?php foreach ($transactionsByDate as $date => $data): ?>
                                        <?php foreach ($data['transactions'] as $index => $kas): ?>
                                            <tr data-nama-kas="<?= $kas['name']; ?>" data-debit="<?= $kas['debit']; ?>" data-is-total="false">
                                                <td style="text-align: center;"><?= $index + 1; ?></td>
                                                <td><?= $kas['doc_no']; ?></td>
                                                <td style="text-align: center;"><?= $kas['date'] ?></td>
                                                <td><?= $kas['account']; ?></td>
                                                <td><?= $kas['name']; ?></td>
                                                <td style="text-align: right;"><?= number_format($kas['debit'], 0, ',', '.'); ?></td>
                                                <td><?= $kas['description']; ?></td>
                                                <td style="text-align: center;"><?= $kas['user_id']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr data-is-total="true" style="color: white;">
                                            <td colspan="5" style="text-align: right; font-weight: bold;">Total Debit pada <?= $date; ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= number_format($data['totalDebit'], 0, ',', '.'); ?></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" style="text-align: center;">Tidak ada data kas masuk.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight: bold;">
                                    <td colspan="5" style="text-align: right;">GRAND TOTAL</td>
                                    <td style="text-align: right;" id="grandTotalFooter"><?= number_format($grandTotal, 0, ',', '.'); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterDropdown = document.getElementById('filterDropdown');
        const tableBody = document.getElementById('kasMasukTable');
        const filteredTotalDebitElement = document.getElementById('filteredTotalDebit');
        let grandTotal = <?= $grandTotal; ?>;

        function calculateTotalDebit() {
            let totalDebit = 0;
            const filterValue = filterDropdown.value;

            Array.from(tableBody.getElementsByTagName('tr')).forEach(row => {
                const namaKas = row.getAttribute('data-nama-kas');
                const debitValue = parseFloat(row.getAttribute('data-debit')) || 0;
                const isTotalRow = row.getAttribute('data-is-total') === 'true';

                if (filterValue === 'all' || isTotalRow || namaKas === filterValue) {
                    row.style.display = '';
                    if (!isTotalRow && (filterValue === 'all' || namaKas === filterValue)) {
                        totalDebit += debitValue;
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            filteredTotalDebitElement.textContent = new Intl.NumberFormat('id-ID', {
                style: 'decimal'
            }).format(filterValue === 'all' ? grandTotal : totalDebit);
        }

        filterDropdown.addEventListener('change', calculateTotalDebit);

        // Inisialisasi tampilan pertama dengan "All"
        calculateTotalDebit();
    });
</script>


<!-- Table head options end -->
<?= $this->endSection() ?>