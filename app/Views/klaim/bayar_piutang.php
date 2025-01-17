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
<!-- Table Pembayaran Piutang -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Payment</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Payment</h5>
                </header>
                <div class="card-content">
                    <div class="card-header py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                            <!-- Tombol Add dan Export -->
                            <div class="d-flex align-items-center gap-3">
                                <a href="<?= base_url('add_bayar') ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Payment
                                </a>
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a>
                            </div>

                            <!-- Filter dan Tampilkan Semua -->
                            <form method="get" action="<?= base_url('filter/kwitansi') ?>" class="d-flex align-items-center gap-3 flex-wrap">
                                <!-- Input Cari -->
                                <div class="d-flex align-items-center">
                                    <label for="search_keyword" class="form-label fw-bold text-primary me-2 mb-0">Cari:</label>
                                    <input
                                        type="text"
                                        name="search_keyword"
                                        id="search_keyword"
                                        class="form-control form-control-sm"
                                        placeholder="No. Invoice/Nopol"
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

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pembayaran-asuransi" role="tabpanel" aria-labelledby="pembayaran-asuransi-tab">
                            <div class="table-responsive text-center" style="margin: 20px; font-size: 12px;">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor</th>
                                            <th>Kwitansi</th>
                                            <th>Unit</th>
                                            <th>Asuransi</th>
                                            <th>Tanggal</th>
                                            <th>Jasa</th>
                                            <th>Sparepart</th>
                                            <th>Tagihan</th>
                                            <th>Pembayaran</th>
                                            <th>Sisa Tagihan</th>
                                            <th>Keterangan</th>
                                            <th>User ID</th>
                                            <th>Act</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($pemb)) : ?>
                                            <?php
                                            $rowNumber = 1; // Inisialisasi variabel penghitung untuk nomor baris
                                            foreach ($pemb as $item) : ?>
                                                <tr>
                                                    <td><?= $rowNumber++; // Increment nomor baris untuk setiap item yang cocok 
                                                        ?></td>
                                                    <td><a href="<?= base_url('add_bayarprev/' . $item['id_pembayaran']) ?>"><?= esc($item['id_pembayaran']) ?></a></td>
                                                    <td><?= $item['no_invoice'] ?? ''; ?></td>
                                                    <td><?= $item['keterangan_invoice'] ?? ''; ?></td>
                                                    <td><?= $item['asuransi'] ?? ''; ?></td>
                                                    <td><?= $item['tanggal'] ?? ''; ?></td>
                                                    <td><?= isset($item['jasa']) ? number_format($item['jasa'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['sparepart']) ? number_format($item['sparepart'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['total_kredit']) ? number_format($item['total_kredit'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['total_debet']) ? number_format($item['total_debet'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['selisih']) ? number_format($item['selisih'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= $item['keterangan'] ?? ''; ?></td>
                                                    <td></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm delete-user-btn">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="13">Tidak ada data yang tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Pembayaran Piutang end -->

<?= $this->endSection() ?>