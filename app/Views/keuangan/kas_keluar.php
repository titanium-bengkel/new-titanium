<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kas Keluar</span>
                    </div>
                    <h4 class="breadcrumb-item active">Kas Keluar</h4>
                </header>

                <div class="card-content">
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <div class="container-fluid">
                            <form method="get" action="<?= base_url('filter/kaskeluar') ?>" class="mb-3">
                                <div class="row g-2 align-items-center px-3">
                                    <!-- Nama Kas -->
                                    <div class="col-md-1 col-4">
                                        <label for="filter_name" class="form-label fw-bold text-primary mb-1">Nama Kas:</label>
                                        <select name="filter_name" id="filter_name" class="form-select form-select-sm">
                                            <option value="" <?= empty($filterName) ? 'selected' : '' ?>>Semua</option>
                                            <option value="KAS BESAR" <?= ($filterName == 'KAS BESAR') ? 'selected' : '' ?>>Besar</option>
                                            <option value="KAS KECIL" <?= ($filterName == 'KAS KECIL') ? 'selected' : '' ?>>Kecil</option>
                                            <option value="REK BCA" <?= ($filterName == 'REK BCA') ? 'selected' : '' ?>>BCA</option>
                                        </select>
                                    </div>

                                    <!-- Cari -->
                                    <div class="col-md-2 col-6">
                                        <label for="search_keyword" class="form-label fw-bold text-primary mb-1">Cari:</label>
                                        <input
                                            type="text"
                                            name="search_keyword"
                                            id="search_keyword"
                                            class="form-control form-control-sm"
                                            placeholder="Keterangan/Nomor"
                                            value="<?= $searchKeyword ?? '' ?>">
                                    </div>

                                    <!-- Tanggal Mulai -->
                                    <div class="col-md-1 col-4">
                                        <label for="start_date" class="form-label fw-bold text-primary mb-1">Mulai:</label>
                                        <input
                                            type="date"
                                            name="start_date"
                                            id="start_date"
                                            class="form-control form-control-sm"
                                            value="<?= $startDate ?? date('Y-m-01') ?>">
                                    </div>

                                    <!-- Tanggal Akhir -->
                                    <div class="col-md-1 col-4">
                                        <label for="end_date" class="form-label fw-bold text-primary mb-1">Akhir:</label>
                                        <input
                                            type="date"
                                            name="end_date"
                                            id="end_date"
                                            class="form-control form-control-sm"
                                            value="<?= $endDate ?? date('Y-m-d') ?>">
                                    </div>

                                    <!-- Bulan -->
                                    <div class="col-md-2 col-4">
                                        <label for="filter_month" class="form-label fw-bold text-primary mb-1">Bulan:</label>
                                        <select name="filter_month" id="filter_month" class="form-select form-select-sm">
                                            <?php
                                            $currentMonth = date('m');
                                            $months = [
                                                '01' => 'Januari',
                                                '02' => 'Februari',
                                                '03' => 'Maret',
                                                '04' => 'April',
                                                '05' => 'Mei',
                                                '06' => 'Juni',
                                                '07' => 'Juli',
                                                '08' => 'Agustus',
                                                '09' => 'September',
                                                '10' => 'Oktober',
                                                '11' => 'November',
                                                '12' => 'Desember',
                                            ];

                                            foreach ($months as $key => $monthName): ?>
                                                <option value="<?= $key ?>" <?= ($filterMonth ?? $currentMonth) == $key ? 'selected' : '' ?>>
                                                    <?= $monthName ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Tahun -->
                                    <div class="col-md-2 col-4">
                                        <label for="filter_year" class="form-label fw-bold text-primary mb-1">Tahun:</label>
                                        <select name="filter_year" id="filter_year" class="form-select form-select-sm">
                                            <?php
                                            $currentYear = date('Y');
                                            for ($i = $currentYear; $i >= $currentYear - 10; $i--): ?>
                                                <option value="<?= $i ?>" <?= ($filterYear ?? $currentYear) == $i ? 'selected' : '' ?>>
                                                    <?= $i ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>

                                    <!-- Tombol Filter -->
                                    <div class="col-md-auto col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-sm fw-bold w-100">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Kas</th>
                                    <th style="text-align: center;">Nama Kas</th>
                                    <th style="text-align: center;">Kredit</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($groupedData)): ?>
                                    <?php foreach ($groupedData as $tanggal => $data): ?>
                                        <?php
                                        $displayIndex = 1;
                                        foreach ($data['transactions'] as $transaction): ?>
                                            <tr>
                                                <td><?= $displayIndex++; ?></td>
                                                <td><?= $transaction['doc_no']; ?></td>
                                                <td class="text-center"><?= $transaction['date']; ?></td>
                                                <td class="text-center"><?= $transaction['account']; ?></td>
                                                <td class="text-center"><?= $transaction['name']; ?></td>
                                                <td style="text-align: right;"><?= number_format($transaction['kredit'], 0, ',', '.'); ?></td>
                                                <td><?= $transaction['description']; ?></td>
                                                <td class="text-center"><?= $transaction['user_id']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="5" style="text-align: right;" class="fw-bold">Total Pengeluaran:</td>
                                            <td colspan="3" style="text-align: left;"><?= number_format($data['total'], 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="text-center">
                                        <td colspan="8">Tidak ada data kas keluar.</td>
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








<?= $this->endSection() ?>