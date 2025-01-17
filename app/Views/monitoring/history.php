<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Jurnal Kas & Bank</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Jurnal Kas & Bank</h5>
                </header>
                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                        <!-- Tombol Add dan Export -->
                        <div class="d-flex align-items-center gap-3">
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/kas_bank') ?>" class="d-flex align-items-center gap-3 flex-wrap">
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
                    <div class="table-responsive" style="margin:20px; font-size: 14px;">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">User ID</th>
                                    <th style="text-align: center;">Nama Progres</th>
                                    <th style="text-align: center;">Nomor RO/No Jurnal/PO/Pembelian</th>
                                    <th style="text-align: center;">Tanggal Edit</th>
                                    <th style="text-align: center;">Nilai Sebelum Edit</th>
                                    <th style="text-align: center;">Nilai Sesudah Edit</th>
                                    <th style="text-align: center;">Deskripsi</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php if (!empty($logs)): ?>
                                    <?php foreach ($logs as $index => $log): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($log['username']); ?></td>
                                            <td><?= esc($log['table_name']); ?></td>
                                            <td><?= esc($log['record_id']); ?></td>
                                            <td><?= esc($log['updated_at'] ?? $log['created_at']); ?></td>
                                            <td><?= esc($log['old_value']); ?></td>
                                            <td><?= esc($log['new_value']); ?></td>
                                            <td><?= esc($log['description']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10">Tidak ada data log yang tersedia.</td>
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
<?= $this->endSection() ?>