<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-0" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Sparepart Masuk</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Sparepart Masuk</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <form method="GET" action="">
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <label for="start-date" class="form-label mb-0 text-muted fw-bold">Periode:</label>
                                    <input type="date" id="start-date" name="start_date" class="form-control form-control-sm rounded-2 w-auto" onclick="this.showPicker()"
                                        value="<?= isset($start_date) ? $start_date : date('Y-m-01'); ?>" />
                                    <span class=" mx-1 text-muted fw-bold">to</span>
                                    <input type="date" id="end-date" name="end_date" class="form-control form-control-sm rounded-2 w-auto" onclick="this.showPicker()"
                                        value="<?= isset($end_date) ? $end_date : date('Y-m-t'); ?>" />
                                    <button type="submit" class="btn btn-primary btn-sm rounded-2">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <p class="mt-3" style="font-size: 11px;">jika data tidak keluar silahkan masukan periode tanggalnya</p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin:20px;">
                        <table class="table table-bordered table-striped -table-hover mb-0" id="po_bahan_table">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center; cursor: pointer;" onclick="sortTable(1)">Tanggal</th>
                                    <th style="text-align: center;">Mobil</th>
                                    <th style="text-align: center;">No. Polisi</th>
                                    <th style="text-align: center;">Supplier</th>
                                    <th style="text-align: center;">Nama Part</th>
                                    <th style="text-align: center;">No Part</th>
                                    <th style="text-align: center; cursor: pointer;" onclick="sortTable(7)">Harga</th>
                                    <th style="text-align: center;">Asuransi</th>
                                    <th style="text-align: center;">Nota</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($part)) : ?>
                                    <?php
                                    $previousDate = '';
                                    $index = 1;
                                    foreach ($part as $detail) :
                                        $currentDate = $detail['tanggal'];

                                        if ($previousDate != '' && $previousDate != $currentDate) : ?>
                                            <tr>
                                                <td colspan="10" style="height: 10px; background-color: dark;"></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td class="text-center"><?= $index ?></td>
                                            <td class="text-start"><?= $detail['tanggal'] ?></td>
                                            <td class="text-start"><?= $detail['jenis_mobil'] ?></td>
                                            <td class="text-start"><?= $detail['nopol'] ?></td>
                                            <td class="text-start"><?= $detail['supplier'] ?></td>
                                            <td class="text-start"><?= $detail['id_kode_barang'] ?></td>
                                            <td class="text-start"><?= $detail['nama_barang'] ?></td>
                                            <td class="harga text-end"><?= 'Rp ' . number_format($detail['harga'], 0, ',', '.') ?></td>
                                            <td class="text-start"><?= $detail['asuransi'] ?></td>
                                            <td class="text-start"><?= $detail['id_penerimaan'] ?></td>
                                        </tr>
                                        <?php
                                        $previousDate = $currentDate;
                                        $index++;
                                        ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="10">Data tidak tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="7" style="text-align: end;">Total</th>
                                    <th class="text-end" id="totalHarga" style="text-align: center;">0</th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->

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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let total = 0;

        // Ambil semua elemen dengan kelas "harga"
        const hargaElements = document.querySelectorAll('.harga');

        // Loop untuk menjumlahkan harga
        hargaElements.forEach(function(element) {
            const harga = parseInt(element.textContent.replace(/[^0-9]/g, ''));
            if (!isNaN(harga)) {
                total += harga;
            }
        });

        // Tampilkan total dalam format Rupiah
        document.getElementById('totalHarga').textContent = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>

<?= $this->endSection() ?>