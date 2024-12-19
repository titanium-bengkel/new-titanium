<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Gudang Salvage</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <form action="/preorder/filter" method="get" class="d-flex align-items-center flex-wrap w-100">
                                <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0" placeholder="Nomor" style="width: 100%; max-width: 130px;">
                                <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2 mb-2 mb-md-0" placeholder="Select date.." style="width: 100%; max-width: 130px;">
                                <select name="month" class="form-control form-control-sm me-2 mb-2 mb-md-0" id="selectMonth" style="width: 100%; max-width: 100px;">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <select name="year" class="form-control form-control-sm mb-2 mb-md-0" id="selectYear" style="width: 100%; max-width: 100px;">
                                    <!-- Tahun akan diisi otomatis -->
                                </select>
                            </form>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin:20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark" style="text-align: center;">
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
                                            <td><?= $index ?></td>
                                            <td><?= $currentDate ?></td> <!-- Format tanggal -->
                                            <td><?= $item['jenis_mobil'] ?></td>
                                            <td><?= $item['no_kendaraan'] ?></td>
                                            <td><?= $item['asuransi'] ?></td>
                                            <td><?= $item['deskripsi'] ?></td>
                                            <td><?= $item['id_terima_po'] ?></td>
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