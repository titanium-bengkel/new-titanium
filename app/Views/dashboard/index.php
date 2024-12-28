<?= $this->extend('layout/template'); ?>
<?= $this->section('content');  ?>

<div class="page-heading">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <!-- Card Bengkel Titanium -->
                <div class="col-6">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon purple mb-2 me-3">
                                <i class="bi bi-wrench mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold"><a href="<?= base_url('/klaim/preorder') ?>" style="text-decoration: none; color: inherit;">Bengkel Titanium</a></h6>
                                <h6 class="font-extrabold mb-0"><?= $bengkelTitaniumCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Bengkel Tandem -->
                <div class="col-6">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon green mb-2 me-3">
                                <i class="bi bi-tools mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold"><a href="<?= base_url('/klaim/preorder?tandem=true') ?>" style="text-decoration: none; color: inherit;">Bengkel Tandem</a></h6>
                                <h6 class="font-extrabold mb-0"><?= $bengkelTandameCount; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                <div class="col">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon purple mb-2 me-3">
                                <i class="bi bi-calendar2-plus mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Pre-Order</h6>
                                <h6 class="font-extrabold mb-0"><?= $preOrderCount; ?></h6>
                            </div>
                            <!-- Button Accordion di sebelah kanan -->
                            <button class="btn btn-link accordion-toggle " data-bs-toggle="collapse" data-bs-target="#collapsePreOrder">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Konten Accordion -->
                    <div id="collapsePreOrder" class="collapse">
                        <div class="card card-body">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Kategori</th>
                                        <th style="font-size: 12px; text-align: center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('/klaim/preorder') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">PROSES KLAIM</a></td>
                                        <td style="font-size: 12px; text-align: center;"><?= $prosesKlaimCount; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon blue mb-2 me-3">
                                <i class="bi bi-card-checklist mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Acc Asuransi</h6>
                                <h6 class="font-extrabold mb-0"><?= $accAsuransiCount; ?></h6>
                            </div>
                            <button class="btn btn-link accordion-toggle " data-bs-toggle="collapse" data-bs-target="#collapseasuransi">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Konten Accordion -->
                    <div id="collapseasuransi" class="collapse">
                        <div class="card card-body">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Kategori</th>
                                        <th style="font-size: 12px; text-align: center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('/klaim/preorder') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Menunggu sparepart</a></td>
                                        <td style="font-size: 12px; text-align: center;"><?= $menungguSparepartCount; ?></td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('/klaim/preorder') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Menunggu Part Supply</a></td>
                                        <td style="font-size: 12px; text-align: center;"><?= $menungguSupplyCount; ?></td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('/klaim/preorder') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Siap Masuk</a></td>
                                        <td style="font-size: 12px; text-align: center;"><?= $siapMasukCount; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon green mb-2 me-3">
                                <i class="bi bi-car-front mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Repair Order</h6>

                            </div>
                            <button class="btn btn-link accordion-toggle " data-bs-toggle="collapse" data-bs-target="#collapserepair">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                    <div id="collapserepair" class="collapse">
                        <div class="card card-body">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Kategori</th>
                                        <th style="font-size: 12px; text-align: center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Ketok</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Dempul</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Epoxy</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Cat</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Poles</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Beres Pengerjaan</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Menunggu Sparepart Tambahan</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('repair_order') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Menunggu Comment User</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>


                <div class="col">
                    <div class="card h-70">
                        <div class="card-body d-flex align-items-center">
                            <div class="stats-icon red mb-2 me-3">
                                <i class="bi bi-car-front-fill mb-4 me-2"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold">Repair Done</h6>
                                <h6 class="font-extrabold mb-0"></h6>
                            </div>
                            <button class="btn btn-link accordion-toggle " data-bs-toggle="collapse" data-bs-target="#collapsecomplete">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                    </div>
                    <div id="collapsecomplete" class="collapse">
                        <div class="card card-body">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th><a href="<?= base_url('/index') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Kategori</a></th>
                                        <th style="font-size: 12px; text-align: center;">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="<?= base_url('/index') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Batal Klaim</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('/index') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Batal Mobil Masuk</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                    <tr>
                                        <td><a href="<?= base_url('/index') ?>" style="font-size: 12px; text-decoration: none; color: inherit;">Data Complete</a></td>
                                        <td style="font-size: 12px; text-align: center;">24</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header" style="background-color:rgb(63, 94, 121);">
                            <h5 class="font-semibold" style="color: #ffffff !important;">Daily Report Bengkel</h5>
                        </div>
                        <div class="card-body">
                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="font-extrabold mb-0">Mobil Masuk</h6>
                                    <h4 id="mobilMasuk" class="mt-2 font-bold text-primary"><?= $mobilMasuk; ?></h4>
                                    <p class="text-muted mt-1">Data per hari ini</p>
                                </div>
                                <div>
                                    <span class="badge bg-secondary p-3 rounded-circle">
                                        <i class="bi bi-car-front-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header" style="background-color: #1e88e5;">
                            <h5 class="font-semibold" style="color: #ffffff !important;">Daily Report Invoice</h5>
                        </div>
                        <div class="card-body">
                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="font-extrabold mb-0">Invoice</h6>
                                    <h4 id="mobilMasuk" class="mt-2 font-bold text-primary"><?= $mobilMasuk; ?></h4>
                                    <p class="text-muted mt-1">Data per hari ini</p>
                                </div>
                                <div>
                                    <span class="badge bg-secondary p-3 rounded-circle">
                                        <i class="bi bi-car-front-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="col-12">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header" style="background-color: #1e88e5;">
                            <h5 class="font-semibold" style="color: #ffffff !important;">Daily Report Pendapatan</h5>
                        </div>
                        <div class="card-body">
                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                            <table class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="padding: 6px; text-align: center;">Tanggal</th>
                                        <th style="padding: 6px; text-align: center;">Jasa</th>
                                        <th style="padding: 6px; text-align: center;">Cat</th>
                                        <th style="padding: 6px; text-align: center;">Non Cat</th>
                                        <th style="padding: 6px; text-align: center;">Sparepart</th>
                                        <th style="padding: 6px; text-align: center;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grandTotal = 0;

                                    foreach ($reportPendapatan as $row) {
                                        $tanggal = $row['tanggal'];
                                        $total = $row['total'];
                                        $grandTotal += $total;

                                        echo "<tr>
                                                <td style='padding: 6px;'>$tanggal</td>
                                                <td style='padding: 6px; text-align: right;'>" . number_format($row['jasa'], 2) . "</td>
                                                <td style='padding: 6px; text-align: right;'>" . number_format($row['cat'], 2) . "</td>
                                                <td style='padding: 6px; text-align: right;'>" . number_format($row['non_cat'], 2) . "</td>
                                                <td style='padding: 6px; text-align: right;'>" . number_format($row['sparepart'], 2) . "</td>
                                                <td style='padding: 6px; text-align: right;'>" . number_format($total, 2) . "</td>
                                            </tr>";
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="padding: 6px; text-align: right; font-weight: bold;">Total</td>
                                        <td style="padding: 6px; text-align: right; font-weight: bold;">
                                            <?= number_format($grandTotal, 2); ?>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <hr class="my-3" style="border-top: 4px solid #1e88e5;">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .table-sm td,
        .table-sm th {
            font-size: 12px;
            /* Ukuran font lebih kecil */
            padding: 4px;
            /* Padding lebih kecil */
        }
    </style>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('tandem') === 'true') {
                // Pindah ke tab Tandem
                const tandemTab = document.getElementById('tandem-tab');
                if (tandemTab) {
                    tandemTab.click();
                }
            }
        });






        document.querySelectorAll('.stats-icon').forEach(function(icon) {
            const colorClass = icon.classList.contains('purple') ? '#6a1b9a' :
                icon.classList.contains('blue') ? '#1e88e5' :
                icon.classList.contains('green') ? '#43a047' :
                icon.classList.contains('red') ? '#e53935' : '#000';

            icon.style.backgroundColor = colorClass;
            icon.style.color = 'white';
            icon.style.width = '50px';
            icon.style.height = '50px';
            icon.style.display = 'flex';
            icon.style.alignItems = 'center';
            icon.style.justifyContent = 'center';
            icon.style.borderRadius = '10px';
            icon.style.fontSize = '30px';
        });


        // Memuat data harian
        document.addEventListener('DOMContentLoaded', function() {
            // Ganti URL ini dengan API atau endpoint server Anda
            const apiUrl = '/api/getDailyReport';

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Menampilkan jumlah mobil masuk
                    document.getElementById('mobilMasuk').textContent = data.mobilMasuk || 0;
                })
                .catch(error => {
                    console.error('Error fetching daily report:', error);
                });
        });
    </script>


    <!-- end card -->



    <?= $this->endSection(); ?>