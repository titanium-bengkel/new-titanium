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
                        <span class="breadcrumb-current text-muted">Salvage</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Salvage</h5>
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
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mobil</th>
                                    <th>Nopol</th>
                                    <th>Asuransi</th>
                                    <th>Nama part</th>
                                    <th>Nomor RO</th>
                                    <th>Foto kerusakan</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($dataPogambar)): ?>
                                    <?php
                                    $previousDate = '';
                                    $index = 1;
                                    foreach ($dataPogambar as $item):
                                        $currentDate = date('Y-m-d', strtotime($item['created_at']));

                                        // Jika tanggal berbeda dari sebelumnya, tambahkan baris kosong sebagai pemisah
                                        if ($previousDate != '' && $previousDate != $currentDate): ?>
                                            <tr>
                                                <td colspan="9" style="height: 40px; background-color: dark;"></td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td class="text-center"><?= $index ?></td>
                                            <td class="text-start"><?= $currentDate ?></td> <!-- Format tanggal -->
                                            <td class="text-start"><?= $item['jenis_mobil'] ?></td>
                                            <td class="text-start"><?= $item['no_kendaraan'] ?></td>
                                            <td class="text-start"><?= $item['asuransi'] ?></td>
                                            <td class="text-start"><?= $item['deskripsi'] ?></td>
                                            <td class="text-start"><?= $item['id_terima_po'] ?></td>
                                            <td hidden><?= $item['keterangan'] ?></td>
                                            <td>
                                                <img src="<?= base_url('uploads/' . $item['gambar']) ?>" alt="Foto Kerusakan" style="width: 100px; height: auto;">
                                            </td>
                                        </tr>

                                    <?php
                                        // Simpan tanggal saat ini untuk perbandingan berikutnya
                                        $previousDate = $currentDate;
                                        $index++;
                                    endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">Tidak ada data untuk ditampilkan.</td>
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