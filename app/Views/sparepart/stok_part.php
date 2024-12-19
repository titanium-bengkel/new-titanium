<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>KARTU STOK SPAREPART</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                            <!-- Input Pencarian -->
                            <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0 mt-2" placeholder="Cari Kode/Nama Barang" style="width: 100%; max-width: 200px;" value="<?= $search ?? '' ?>">
                            <!-- Input Tanggal -->
                            <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2 mb-2 mb-md-0 mt-2" placeholder="Select date.." style="width: 100%; max-width: 130px;" value="<?= $date ?? '' ?>">
                            <div>
                                <select id="bengkelSelect" class="form-select form-select-sm me-2 mb-2 mb-md-0 mt-2" style="width: auto;">
                                    <option value="GUDANG STOK SPAREPART">GUDANG STOK SPAREPART</option>
                                    <option value="GUDANG SUPPLY ASURANSI">GUDANG SUPPLY ASURANSI</option>
                                    <option value="GUDANG WAITING">GUDANG WAITING</option>
                                    <option value="GUDANG SALVAGE">GUDANG SALVAGE</option>
                                </select>
                            </div>
                    </div>

                    <!-- stok -->
                    <div class="tab-pane fade show active" id="kartuS1" role="tabpanel" aria-labelledby="kartuS1-tab">
                        <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                            <table class="table table-bordered mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="text-align: center;">Tanggal</th>
                                        <th style="text-align: center;">Nomor</th>
                                        <th style="text-align: center;">Transaksi</th>
                                        <th style="text-align: center;">Debet</th>
                                        <th style="text-align: center;">Kredit</th>
                                        <th style="text-align: center;">Saldo</th>
                                    </tr>
                                </thead>
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="text-align: start;" colspan="6">GUDANG - ID KODE BARANG - NOPOL</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php if (!empty($stok)) : ?>
                                        <?php foreach ($stok as $index => $data) : ?>
                                            <tr>
                                                <td hidden><?= $data['gudang'] ?></td>
                                                <td><?= $data['tanggal'] ?></td>
                                                <td><?= $data['nomor'] ?></td>
                                                <td><?= $data['transaksi'] ?></td>
                                                <td><?= $data['debit'] ?></td>
                                                <td><?= $data['credit'] ?></td>
                                                <td><?= $data['saldo'] ?></td>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">Data tidak tersedia</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="3" style="text-align: end;"></th>
                                        <th>0</th>
                                        <th>0</th>
                                        <th>0</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <div class="card-body">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-primary">
                                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>





<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        const now = new Date();
        const currentMonth = now.getMonth() + 1; // Months are 0-based in JavaScript
        const currentYear = now.getFullYear();

        // Set the current month in the select
        const monthSelect = document.getElementById('selectMonth');
        monthSelect.value = currentMonth;

        // Set the current year and populate the year select
        const yearSelect = document.getElementById('selectYear');
        for (let year = 2020; year <= 2030; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.text = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }
    });
</script>
<?= $this->endSection() ?>