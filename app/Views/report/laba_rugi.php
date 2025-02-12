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
                        <span class="breadcrumb-current text-muted">Laporan Laba Rugi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Laporan Laba Rugi</h5>
                </header>
                <div class="card-content">
                    <div class="card-header py-3 px-4">
                        <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
                            <!-- Filter dan Tampilkan Semua -->
                            <form method="get" action="<?= base_url('filter/labarugi') ?>" class="d-flex align-items-center gap-3 flex-wrap">

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
                    <!-- table head dark -->
                    <div style="text-align: center; background-color: #007bff; color: white; padding: 20px; margin: 20px;">
                        <h1 style="margin: 0;">TITANIUM CAR REPAIR</h1>
                        <div style="text-align: center; background-color: #fff; color: black; padding: 20px;">
                            <p style="margin: 5px 0;">Laba Rugi (Income Statement)</p>
                            <p style="margin: 5px 0;">Periode <?= esc($startDate) ?> s/d <?= esc($endDate) ?></p>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin:20px" ;>
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <!-- Pendapatan Penjualan Usaha -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Pendapatan (Penjualan) Usaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalPendapatan = 0; ?>
                                <?php foreach ($pendapatan as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['kredit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalPendapatan += $item['kredit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td><strong>Total Pendapatan (Penjualan) Usaha</strong></td>
                                    <td><strong><?= number_format($totalPendapatan, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>


                            <!-- Pendapatan Lain-Lain -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Pendapatan Lain-Lain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalPendapatanLain = 0; ?>
                                <?php foreach ($pendapatanLain as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['kredit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalPendapatanLain += $item['kredit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td><strong>Total Pendapatan Lain-Lain</strong></td>
                                    <td><strong><?= number_format($totalPendapatanLain, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>


                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Titanium</th>
                                </tr>
                            </thead>

                            <!-- Harga Pokok Penjualan (Beban Langsung) Titanium -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Harga Pokok Penjualan (Beban Langsung) Titanium</th>
                                </tr>
                            </thead>

                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Langsung Produksi Kendaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanUsaha = 0; ?>
                                <?php foreach ($bebanUsaha as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanUsaha += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td><strong>Total Beban Langsung Produksi/Kendaraan</strong></td>
                                    <td><strong><?= number_format($totalBebanUsaha, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Harga Pokok Penjualan (Beban Langsung) Titanium -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Langsung Produksi Non Kendaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanNon = 0; ?>
                                <?php foreach ($bebanNon as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanNon += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Beban Langsung Produksi Non Kendaraan</td>
                                    <td><strong><?= number_format($totalBebanNon, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Beban Penjualan -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanPenjualan = 0; ?>
                                <?php foreach ($bebanPenjualan as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanPenjualan += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Beban Penjualan</td>
                                    <td><strong><?= number_format($totalBebanPenjualan, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Beban Pemasaran -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Pemasaran/Promosi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanPemasaran = 0; ?>
                                <?php foreach ($bebanPemasaran as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanPemasaran += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Beban Pemasaran/Promosi</td>
                                    <td><strong><?= number_format($totalBebanPemasaran, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Beban Pemasaran -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Administrasi dan Umum serta Pegawai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanAdministrasi = 0; ?>
                                <?php foreach ($bebanAdministrasi as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanAdministrasi += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Beban Administrasi dan Umum serta Pegawai</td>
                                    <td><strong><?= number_format($totalBebanAdministrasi, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Biaya Transportasi -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Biaya Transportasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanTransportasi = 0; ?>
                                <?php foreach ($bebanTransportasi as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanTransportasi += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Biaya Transportasi</td>
                                    <td><strong><?= number_format($totalBebanTransportasi, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Biaya Penyusutan -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Biaya Penyusutan dan Amortisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBiayaPenyusutan = 0; ?>
                                <?php foreach ($biayaPenyusutan as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBiayaPenyusutan += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Biaya Penyusutan dan Amortisasi</td>
                                    <td><strong><?= number_format($totalBiayaPenyusutan, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Biaya Sewa -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Biaya Sewa dan Berhubungan Jasa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBiayaSewa = 0; ?>
                                <?php foreach ($biayaSewa as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBiayaSewa += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Biaya Sewa dan Berhubungan Jasa</td>
                                    <td><strong><?= number_format($totalBiayaSewa, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Biaya Office Lainnya -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Biaya Office Lainnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBiayaOffice = 0; ?>
                                <?php foreach ($biayaOffice as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBiayaOffice += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Biaya Office Lainnya</td>
                                    <td><strong><?= number_format($totalBiayaOffice, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Biaya Lain-Lain -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Biaya Lain-Lain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBiayaLain = 0; ?>
                                <?php foreach ($biayaLain as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBiayaLain += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Biaya Lain-Lain</td>
                                    <td><strong><?= number_format($totalBiayaLain, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Pendapatan Lain-Lain -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Pendapatan Lain-Lain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalPendapatanLainLain = 0; ?>
                                <?php foreach ($pendapatanLainLain as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['kredit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalPendapatanLainLain += $item['kredit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Pendapatan Lain-Lain</td>
                                    <td><strong><?= number_format($totalPendapatanLainLain, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>

                            <!-- Beban Lain-Lain -->
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="2" style="text-align: center;">Beban Lain-Lain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $totalBebanLain = 0; ?>
                                <?php foreach ($bebanLain as $item) : ?>
                                    <tr>
                                        <td><?= esc($item['kode_head']) ?> - <?= esc($item['nama_account']) ?></td>
                                        <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php $totalBebanLain += $item['debit']; ?>
                                <?php endforeach; ?>
                                <tr class="bg-primary">
                                    <td>Total Beban Lain-Lain</td>
                                    <td><strong><?= number_format($totalBebanLain, 0, ',', '.') ?></strong></td>
                                </tr>
                            </tbody>


                            <!-- Laba Rugi -->
                            <thead class="thead-dark" style="background-color: blue; color: white;">
                                <tr>
                                    <th colspan="2" style="text-align: center;">LABA RUGI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Laba Rugi</strong></td>
                                    <td><strong><?= number_format($LabaRugiBersih, 0, ',', '.') ?></strong></td>
                                </tr>
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