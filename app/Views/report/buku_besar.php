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
                        <span class="breadcrumb-current text-muted">Buku Besar (General Ledger)</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Buku Besar (General Ledger)</h5>
                </header>
                <div class="card-content">
                    <div class="card-header py-3 px-4">
                        <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
                            <!-- Filter dan Tampilkan Semua -->
                            <form method="get" action="<?= base_url('filter/bukubesar') ?>" class="d-flex align-items-center gap-3 flex-wrap">

                                <!-- Dropdown Select Account -->
                                <div class="d-flex align-items-center">
                                    <label for="coa" class="form-label fw-bold text-primary me-2 mb-0">Akun:</label>
                                    <select name="coa" id="coa" class="form-select form-select-sm">
                                        <option value="">-- Select Account --</option>
                                        <?php foreach ($coaList as $coa): ?>
                                            <option value="<?= $coa['account']; ?>" <?= isset($selectedCoa) && $selectedCoa == $coa['account'] ? 'selected' : ''; ?>>
                                                <?= $coa['account'] . ' - ' . $coa['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
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
                            </form>
                        </div>
                    </div>

                    <!-- Filter Info Header -->
                    <div style="text-align: center; background-color: #007bff; color: white; padding: 20px; margin: 20px;">
                        <h1 style="margin: 0;">TITANIUM CAR REPAIR</h1>
                        <div style="text-align: center; background-color: #fff; color: black; padding: 20px;">
                            <p style="margin: 5px 0;">Buku Besar (General Ledger)</p>
                            <p style="margin: 5px 0;">Account : <?= esc($selectedCoa) ?> - <?= esc($coaList[array_search($selectedCoa, array_column($coaList, 'account'))]['name'] ?? 'N/A') ?></p>
                            <p style="margin: 5px 0;">Periode <?= esc($startDate) ?> s/d <?= esc($endDate) ?></p>
                        </div>
                    </div>

                    <?php
                    // Cek apakah ada data pada reports
                    if (!empty($reports)) {
                        $openingBalance = $reports[0]['balance'] ?? 0;
                    } else {
                        $openingBalance = 0; // Default jika tidak ada data
                    }

                    // Inisialisasi total untuk Ending Balance
                    $totalDebit = 0;
                    $totalCredit = 0;
                    $currentBalance = $openingBalance;
                    ?>

                    <!-- Opening Balance -->
                    <div style="text-align: right; background-color: #007bff; color: white; padding: 10px; margin: 20px;">
                        <p style="margin: 0;"><strong>Opening Balance : <?= number_format($openingBalance, 0, ',', '.') ?></strong></p>
                    </div>

                    <div class="table-responsive" style="margin:20px;">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">Doc. No</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Description</th>
                                    <th style="text-align: center;">Debet</th>
                                    <th style="text-align: center;">Credit</th>
                                    <th style="text-align: center;">Balance</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($reports)) :
                                    foreach ($reports as $report):
                                        // Update balance per baris
                                        $currentBalance += $report['debit'] - $report['kredit'];

                                        // Perhitungan total
                                        $totalDebit += $report['debit'];
                                        $totalCredit += $report['kredit'];
                                ?>
                                        <tr>
                                            <td><?= esc($report['doc_no']) ?></td>
                                            <td><?= esc($report['date']) ?></td>
                                            <td><?= esc($report['description']) ?></td>
                                            <td style="text-align: right;"><?= number_format($report['debit'], 0, ',', '.') ?></td>
                                            <td style="text-align: right;"><?= number_format($report['kredit'], 0, ',', '.') ?></td>
                                            <td style="text-align: right;"><?= number_format($currentBalance, 0, ',', '.') ?></td>
                                            <td>
                                                <a href="<?= base_url('editReport/' . esc($report['id_report'])) ?>" class="btn btn-sm btn-primary">Up Foto</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" style="text-align: right;">Total:</th>
                                    <th style="text-align: right;"><?= number_format($totalDebit, 0, ',', '.') ?></th>
                                    <th style="text-align: right;"><?= number_format($totalCredit, 0, ',', '.') ?></th>
                                    <th style="text-align: right;"><?= number_format($currentBalance, 0, ',', '.') ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Ending Balance -->
                    <div style="text-align: right; background-color: #007bff; color: white; padding: 10px; margin: 20px;">
                        <p style="margin: 0;"><strong>Ending Balance : <?= number_format($currentBalance, 0, ',', '.') ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Table head options end -->
<?= $this->endSection() ?>