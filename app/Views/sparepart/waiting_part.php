<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Sparepart Dalam Pesanan</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <form action="/preorder/filter" method="get" class="d-flex align-items-center flex-wrap w-100">
                                <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0" placeholder="Nama Supplier" style="width: 100%; max-width: 130px;">
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
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Mobil</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Asuransi</th>
                                    <th style="text-align: center;">Nama Part</th>
                                    <th style="text-align: center;">No Part</th>
                                    <th style="text-align: center;">Harga</th>
                                    <th style="text-align: center;">Supplier</th>
                                    <th style="text-align: center;">No. PO</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($part)) : ?>
                                    <?php
                                    $previousDate = '';
                                    $index = 1;
                                    foreach ($part as $detail) :
                                        $currentDate = $detail['tanggal'];

                                        // Jika tanggal berbeda, tambahkan baris kosong
                                        if ($previousDate != '' && $previousDate != $currentDate) : ?>
                                            <tr>
                                                <td colspan="10" style="height: 10px; background-color: dark;"></td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td><?= $index ?></td>
                                            <td><?= $detail['tanggal'] ?></td>
                                            <td><?= $detail['jenis_mobil'] ?></td>
                                            <td><?= $detail['no_kendaraan'] ?></td>
                                            <td><?= $detail['asuransi'] ?></td>
                                            <td><?= $detail['nama_barang'] ?></td>
                                            <td><?= $detail['id_kode_barang'] ?></td>
                                            <td class="harga"><?= 'Rp ' . number_format($detail['harga'], 0, ',', '.') ?></td>
                                            <td><?= $detail['supplier'] ?></td>
                                            <td><?= $detail['id_pesan'] ?></td>
                                        </tr>

                                        <?php
                                        // Update previous date untuk pengecekan berikutnya
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
                                    <th colspan="7" style="text-align:right;">Total</th>
                                    <th id="totalHarga" style="text-align: center;"></th>
                                    <th colspan="2"></th>
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