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

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <form action="<?= base_url('update_ro/' . esc($ro['id_terima_po'])) ?>" method="POST">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/repair_order') ?>" class="breadcrumb-link text-primary fw-bold">Repair Order</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Data Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Data Order</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-1">
                            <label class="col-form-label">Bengkel</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-1 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-titanium" name="bengkel" value="Titanium" class="form-check-input"
                                    <?= (isset($ro['bengkel']) && esc($ro['bengkel']) === 'Titanium') ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="bengkel-titanium">Titanium</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-tandem" name="bengkel" value="Tandem" class="form-check-input"
                                    <?= (isset($ro['bengkel']) && esc($ro['bengkel']) === 'Tandem') ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="bengkel-tandem">Tandem</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-k3karoseri" name="bengkel" value="K3 Karoseri" class="form-check-input"
                                    <?= (isset($ro['bengkel']) && esc($ro['bengkel']) === 'K3 Karoseri') ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="bengkel-k3karoseri">K3 Karoseri</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="bengkel-vortex" name="bengkel" value="Vortex" class="form-check-input"
                                    <?= (isset($ro['bengkel']) && esc($ro['bengkel']) === 'Vortex') ? 'checked' : '' ?> disabled>
                                <label class="form-check-label" for="bengkel-vortex">Vortex</label>
                            </div>
                            <div class="d-flex ms-auto">
                                <input type="hidden" id="tgl-masuk" class="form-control me-2" name="tgl_masuk" value="<?= isset($ro['tgl_masuk']) ? esc($ro['tgl_masuk']) : '' ?>">
                                <input type="date" id="tanggal-estimasi" class="form-control me-2" name="tgl_keluar" style=" max-width: 180px;" value="<?= isset($tgl_estimasi) ? esc($tgl_estimasi) : '' ?>">
                                <input type="time" id="jam" name="jam_keluar" class="form-control me-2" style="max-width: 120px;" value="" />

                                <script>
                                    // Fungsi untuk mendapatkan waktu saat ini dan mengupdate input jika belum ada value
                                    window.onload = function() {
                                        var jamInput = document.getElementById('jam');

                                        // Jika tidak ada value di input, set jam saat ini
                                        if (!jamInput.value) {
                                            var now = new Date();
                                            var hours = now.getHours().toString().padStart(2, '0'); // Format dua digit jam
                                            var minutes = now.getMinutes().toString().padStart(2, '0'); // Format dua digit menit
                                            jamInput.value = hours + ':' + minutes;
                                        }

                                        // Update setiap detik untuk memastikan waktu berjalan otomatis
                                        setInterval(function() {
                                            var now = new Date();
                                            var hours = now.getHours().toString().padStart(2, '0');
                                            var minutes = now.getMinutes().toString().padStart(2, '0');
                                            if (!jamInput.value) {
                                                jamInput.value = hours + ':' + minutes;
                                            }
                                        }, 1000);
                                    };
                                </script>
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-primary" id="mobilKeluarBtn"
                                        data-id_terima_po="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>"><i class="fas fa-sign-out"></i></button>
                                </div>
                            </div>

                            <!-- Countdown Timer Card -->
                            <div id="countdown-card" style="
                                position: fixed;
                                top: 20px;
                                right: 20px;
                                width: 250px;
                                border: 1px solid #ccc;
                                border-radius: 10px;
                                background-color: #f8f9fa;
                                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                                z-index: 9999;
                                padding: 10px;
                            ">
                                <div id="countdown-timer" style="
                                    text-align: center;
                                    font-weight: bold;
                                    font-size: 16px;
                                    color: #333;
                                "></div>
                            </div>

                        </div>
                    </div>
                    <hr>

                    <h5 class="text-center mb-3">Data Kendaraan</h5>
                    <div class="form-group row align-items-center">
                        <input type="hidden" id="id-terima-po" name="id_terima_po" value="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="pre-order-id">No. Order</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" class="form-control" name="no_order" value="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-rangka">No. Rangka</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-rangka" class="form-control" name="no-rangka" value="<?= isset($ro['no_rangka']) ? esc($ro['no_rangka']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-kendaraan">Nopol</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= isset($ro['no_kendaraan']) ? esc($ro['no_kendaraan']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jenis-mobil">Car Model</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil" value="<?= isset($ro['jenis_mobil']) ? esc($ro['jenis_mobil']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="warna" class="form-control" name="warna" value="<?= isset($ro['warna']) ? esc($ro['warna']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tahun-kendaraan">Tahun</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="tahun-kendaraan" class="form-control" name="tahun-kendaraan" value="<?= isset($ro['tahun_kendaraan']) ? esc($ro['tahun_kendaraan']) : '' ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="panel">Panel</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="panel" class="form-control" name="panel" value="<?= isset($ro['panel']) ? esc($ro['panel']) : '' ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tingkat">Tingkat Kerusakan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <select id="tingkat" class="form-select" name="tingkat">
                                <option value="" disabled <?= empty($ro['tingkat']) ? 'selected' : '' ?>>Pilih Tingkat Kerusakan</option>
                                <option value="Heavy" <?= isset($ro['tingkat']) && $ro['tingkat'] === 'HEAVY' ? 'selected' : '' ?>>HEAVY</option>
                                <option value="Medium" <?= isset($ro['tingkat']) && $ro['tingkat'] === 'MEDIUM' ? 'selected' : '' ?>>MEDIUM</option>
                                <option value="Light" <?= isset($ro['tingkat']) && $ro['tingkat'] === 'LIGHT' ? 'selected' : '' ?>>LIGHT</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3">Data Pelanggan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="customer-name">Nama Pelanggan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="customer-name" class="form-control" name="customer-name" value="<?= isset($ro['customer_name']) ? esc($ro['customer_name']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-contact">Kontak</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-contact" class="form-control" name="no-contact" value="<?= isset($ro['no_contact']) ? esc($ro['no_contact']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="alamat">Alamat</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="alamat" class="form-control" name="alamat" value="<?= isset($ro['alamat']) ? esc($ro['alamat']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="kota">Kota</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="kota" class="form-control" name="kota" value="<?= isset($ro['kota']) ? esc($ro['kota']) : '' ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3">Data Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="asuransi" class="form-control" name="asuransi"
                                value="<?= isset($ro['asuransi']) ? esc($ro['asuransi']) : '' ?>"
                                oninput="updateNoPolisVisibility()" readonly>
                        </div>
                        <div id="no-polis-section" class="row">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-polis" id="no-polis-label">No Polis</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3" id="no-polis-container">
                                <input type="text" id="no-polis" class="form-control" name="no-polis"
                                    value="<?= isset($ro['no_polis']) ? esc($ro['no_polis']) : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= isset($ro['keterangan']) ? esc($ro['keterangan']) : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3">Rincian Biaya</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="nilai-jasa">Biaya Jasa</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="nilai-jasa" class="form-control" name="nilai_jasa" readonly>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Ambil elemen total harga dan input nilai jasa
                                const totalHargaElement = document.getElementById('total-harga-pengerjaan');
                                const nilaiJasaInput = document.getElementById('nilai-jasa'); // Menggunakan ID 'nilai-jasa'

                                if (totalHargaElement && nilaiJasaInput) {
                                    // Ambil teks dari total harga, hapus format dan konversi ke angka
                                    const totalHargaText = totalHargaElement.textContent || totalHargaElement.innerText;
                                    const totalHarga = parseInt(totalHargaText.replace(/\./g, '').trim(), 10);

                                    // Format ulang dan masukkan ke input nilai jasa
                                    nilaiJasaInput.value = totalHarga.toLocaleString('id-ID');
                                }
                            });
                        </script>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="harga-estimasi">Biaya Sparepart</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="nilai-sparepart" class="form-control" name="nilai_sparepart" readonly>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Ambil elemen total harga sparepart dan input nilai sparepart
                                const totalHargaSparepartElement = document.getElementById('total-harga-sparepart');
                                const nilaiSparepartInput = document.getElementById('nilai-sparepart');

                                if (totalHargaSparepartElement && nilaiSparepartInput) {
                                    // Ambil teks dari total harga sparepart, hapus format titik dan konversi ke angka
                                    const totalHargaSparepartText = totalHargaSparepartElement.textContent || totalHargaSparepartElement.innerText;
                                    const totalHargaSparepart = parseInt(totalHargaSparepartText.replace(/\./g, '').trim(), 10);

                                    // Pastikan totalHargaSparepart valid dan bukan NaN
                                    if (!isNaN(totalHargaSparepart)) {
                                        // Format ulang dan masukkan ke input nilai sparepart (format Indonesia)
                                        nilaiSparepartInput.value = totalHargaSparepart.toLocaleString('id-ID');
                                    }
                                }
                            });
                        </script>
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="harga-estimasi" hidden>Harga Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="hidden" class="form-control" name="harga-estimasi" value="<?= isset($ro['harga_estimasi']) ? number_format((float)$ro['harga_estimasi'], 0, ',', '.') : '' ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="harga-acc">Total Biaya</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="harga-estimasi" class="form-control" name="harga-acc"
                                value="" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Checklist Proses Klaim</h5>
                    <div class="form-group" id="repairOrderForm">
                        <?php
                        // Daftar value yang menyebabkan langkah pengerjaan (Ketok, Dempul, dll.) disembunyikan
                        $hide_steps = ['Beres Pengerjaan', 'Menunggu Comment User', 'Kurang Dokumen', 'Sparepart', 'Data Completed'];
                        $hide_progress_steps = in_array($ro['progres_pengerjaan'], $hide_steps);
                        ?>

                        <!-- Ketok, Dempul, Epoxy, Cat, Poles -->
                        <?php if (!$hide_progress_steps): ?>
                            <div id="progress-steps">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="ketok" name="progres_pengerjaan" value="Ketok"
                                        <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Ketok') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="ketok">Ketok</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="dempul" name="progres_pengerjaan" value="Dempul"
                                        <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Dempul') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="dempul">Dempul</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="epoxy" name="progres_pengerjaan" value="Epoxy"
                                        <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Epoxy') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="epoxy">Epoxy</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="cat" name="progres_pengerjaan" value="Cat"
                                        <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Cat') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="cat">Cat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="poles" name="progres_pengerjaan" value="Poles"
                                        <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Poles') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="poles">Poles</label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Beres Pengerjaan -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="beres-pengerjaan" name="progres_pengerjaan" value="Beres Pengerjaan"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Beres Pengerjaan') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="beres-pengerjaan">Beres Pengerjaan</label>
                        </div>

                        <!-- Menunggu Comment User -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="comment-user" name="progres_pengerjaan" value="Menunggu Comment User"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Menunggu Comment User') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="comment-user">Menunggu Comment User</label>
                        </div>

                        <!-- Kurang Dokumen -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="kurang-dokumen" name="progres_pengerjaan" value="Kurang Dokumen"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Kurang Dokumen') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kurang-dokumen">Kurang Dokumen</label>
                        </div>

                        <!-- Sparepart -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="sparepart" name="progres_pengerjaan" value="Sparepart"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Sparepart') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="sparepart">Sparepart</label>
                        </div>

                        <!-- Data Completed -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="data-completed" name="progres_pengerjaan" value="Data Completed"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Data Completed') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="data-completed">Data Completed</label>
                        </div>
                    </div>

                    <!-- Pilihan untuk Kurang Dokumen -->
                    <div id="dokumen-options" style="display:none; margin-top: 15px;">
                        <label>Pilihan Kurang Dokumen:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="foto-epoxy" name="dokumen_detail[]" value="Kurang Foto Epoxy">
                            <label class="form-check-label" for="foto-epoxy">Kurang Foto Epoxy</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="foto-finishing" name="dokumen_detail[]" value="Kurang Foto Finishing">
                            <label class="form-check-label" for="foto-finishing">Kurang Foto Finishing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tt-salvage" name="dokumen_detail[]" value="Menunggu TT Salvage">
                            <label class="form-check-label" for="tt-salvage">Menunggu TT Salvage</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="stample-puas" name="dokumen_detail[]" value="Menunggu Stample Puas">
                            <label class="form-check-label" for="stample-puas">Menunggu Stample Puas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gesek-rangka" name="dokumen_detail[]" value="Gesek Rangka">
                            <label class="form-check-label" for="gesek-rangka">Gesek Rangka</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="problem-asuransi" name="dokumen_detail[]" value="Problem Asuransi">
                            <label class="form-check-label" for="problem-asuransi">Problem Asuransi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="kurang-no-mesin" name="dokumen_detail[]" value="Kurang No Mesin/Rangka">
                            <label class="form-check-label" for="kurang-no-mesin">Kurang No Mesin/Rangka</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="banding-jasa" name="dokumen_detail[]" value="Banding Tambahan Jasa">
                            <label class="form-check-label" for="banding-jasa">Banding Tambahan Jasa</label>
                        </div>
                    </div>

                    <!-- Pilihan untuk Sparepart -->
                    <div id="sparepart-options" style="display:none; margin-top: 15px;">
                        <label>Pilihan Sparepart:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="menunggu-sparepart" name="sparepart_detail[]" value="Menunggu Sparepart Tambahan">
                            <label class="form-check-label" for="menunggu-sparepart">Menunggu Sparepart Tambahan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="banding-sparepart" name="sparepart_detail[]" value="Banding Sparepart">
                            <label class="form-check-label" for="banding-sparepart">Banding Sparepart</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="menunggu-cust-pasang" name="sparepart_detail[]" value="Menunggu Cust Pasang Sparepart">
                            <label class="form-check-label" for="menunggu-cust-pasang">Menunggu Cust Pasang Sparepart</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sparepart-retur" name="sparepart_detail[]" value="Sparepart Retur">
                            <label class="form-check-label" for="sparepart-retur">Sparepart Retur</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sparepart-supply-lama" name="sparepart_detail[]" value="Sparepart Supply Lama Datang">
                            <label class="form-check-label" for="sparepart-supply-lama">Sparepart Supply Lama Datang</label>
                        </div>
                    </div>

                    <script>
                        // Fungsi untuk menampilkan atau menyembunyikan opsi berdasarkan status yang dipilih
                        document.querySelectorAll('input[name="progres_pengerjaan"]').forEach(input => {
                            input.addEventListener('change', function() {
                                // Menyembunyikan semua pilihan Kurang Dokumen dan Sparepart
                                document.getElementById('dokumen-options').style.display = 'none';
                                document.getElementById('sparepart-options').style.display = 'none';

                                // Menampilkan sesuai pilihan yang dipilih
                                if (this.value === 'Kurang Dokumen') {
                                    document.getElementById('dokumen-options').style.display = 'block';
                                }
                                if (this.value === 'Sparepart') {
                                    document.getElementById('sparepart-options').style.display = 'block';
                                }
                            });
                        });
                    </script>


                    <div class="mt-3" style="position: relative;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                        <a href="<?= base_url('cetakPKB/' . $ro['id_terima_po']) ?>" target="_blank" class="btn btn-secondary">Cetak PKB</a>

                        <?php if (isset($ro['progres_pengerjaan'])): ?>
                            <?php if (in_array($ro['progres_pengerjaan'], ['Beres Pengerjaan', 'Menunggu Sparepart Tambahan', 'Menunggu Comment User', 'Data Completed'])): ?>
                                <button type="button" class="btn btn-warning" style="margin-left: 20px;"
                                    onclick="handleKwitansiClick(<?= isset($ro['is_sent']) ? $ro['is_sent'] : 0; ?>)">
                                    Kwitansi
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <script>
                        function handleKwitansiClick(isSent) {
                            if (isSent == 1) {
                                Swal.fire({
                                    title: "Peringatan!",
                                    text: "Cetak Kwitansi Sudah Dilakukan",
                                    icon: "warning",
                                    confirmButtonText: "Tutup"
                                });
                            } else {
                                // Jika is_sent 0, arahkan ke modal kwitansi
                                $('#kwitansiModal').modal('show');
                            }
                        }
                    </script>
                </div>
            </div>
        </form>


        <!-- Modal Kwitansi -->
        <div class="modal fade" id="kwitansiModal" tabindex="-1" aria-labelledby="kwitansiModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kwitansiModalLabel">Cetak Kwitansi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Foto Epoxy dan Finish sudah diupload?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <form action="<?= base_url('cetakKwitansi/' . $ro['id_terima_po']) ?>" method="POST">
                            <!-- Hidden field untuk is_sent -->
                            <input type="hidden" name="is_sent" value="1">

                            <!-- Input fields untuk data -->
                            <input type="hidden" class="form-control" name="noOrder" value="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>">
                            <input type="hidden" class="form-control" name="noRangka" value="<?= isset($ro['no_rangka']) ? esc($ro['no_rangka']) : '' ?>">
                            <input type="hidden" class="form-control" name="asuransi" value="<?= isset($ro['asuransi']) ? esc($ro['asuransi']) : '' ?>">
                            <input type="hidden" class="form-control" name="customerName" value="<?= isset($ro['customer_name']) ? esc($ro['customer_name']) : '' ?>">
                            <input type="hidden" class="form-control" name="jenisMobil" value="<?= isset($ro['jenis_mobil']) ? esc($ro['jenis_mobil']) : '' ?>">
                            <input type="hidden" class="form-control" name="noKendaraan" value="<?= isset($ro['no_kendaraan']) ? esc($ro['no_kendaraan']) : '' ?>">
                            <input type="hidden" class="form-control" name="warna" value="<?= isset($ro['warna']) ? esc($ro['warna']) : '' ?>">
                            <input type="hidden" class="form-control" name="tahunKendaraan" value="<?= isset($ro['tahun_kendaraan']) ? esc($ro['tahun_kendaraan']) : '' ?>">
                            <input type="hidden" class="form-control" name="noContact" value="<?= isset($ro['no_contact']) ? esc($ro['no_contact']) : '' ?>">
                            <input type="hidden" class="form-control" name="keterangan" value="<?= isset($ro['keterangan']) ? esc($ro['keterangan']) : '' ?>">

                            <!-- Tanggal Masuk dan Tanggal Keluar -->
                            <input type="hidden" class="form-control" name="tglMasuk" value="<?= isset($ro['tgl_masuk']) ? esc($ro['tgl_masuk']) : '' ?>">
                            <input type="hidden" class="form-control" name="tglKeluar" value="<?= isset($ro['tgl_keluar']) ? esc($ro['tgl_keluar']) : '' ?>">

                            <!-- Nilai OR dan Qty OR -->
                            <input type="hidden" class="form-control" name="nilaiOr" value="<?= isset($nilai_or) ? number_format($nilai_or, 0, ',', '.') : '0' ?>">
                            <input type="hidden" class="form-control" name="qtyOr" value="<?= isset($qty_or) ? esc($qty_or) : '0' ?>">

                            <!-- Biaya Jasa, Sparepart, dan Harga Total -->
                            <input type="hidden" class="form-control" name="nilaiJasa" value="<?= isset($nilai_jasa) ? esc($nilai_jasa) : '' ?>">
                            <input type="hidden" class="form-control" name="nilaiSparepart" value="<?= isset($nilai_sparepart) ? esc($nilai_sparepart) : '' ?>">
                            <input type="hidden" class="form-control" name="hargaAcc" value="<?= isset($harga_total) ? esc($harga_total) : '' ?>">

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Sudah</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Form Input Pengerjaan -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pengerjaan</h5>
                </div>
                <div class="card-body">
                    <!-- Button Accordion -->
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapsePengerjaan" id="togglePengerjaanButton">
                        Add
                    </button>
                    <!-- Form Pengerjaan -->
                    <div id="collapsePengerjaan" class="collapse mt-2">
                        <form id="pengerjaanForm" method="post" action="<?= base_url('createPengerjaanPo') ?>">
                            <input type="hidden" name="id_terima_po" value="<?= esc($ro['id_terima_po']) ?>">
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-5">
                                    <label for="kodePengerjaan" class="col-form-label">Kode Pengerjaan</label>
                                </div>
                                <div class="col-md-6 col-sm-4">
                                    <input type="text" class="form-control form-control-sm" id="kodePengerjaan" name="kodePengerjaan" readonly>
                                </div>
                                <div class="col-md-3 col-sm-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#pengerjaanModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-5">
                                    <label for="pengerjaan" class="col-form-label">Pengerjaan</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="pengerjaan" name="pengerjaan">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-5">
                                    <label for="harga" class="col-form-label">Harga</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="harga" name="harga">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm" id="cancelPengerjaanButton">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tabel Pengerjaan -->
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Pengerjaan</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalHargaPengerjaan = 0;
                                if (!empty($pengerjaan)) :
                                    foreach ($pengerjaan as $index => $p) :
                                        $totalHargaPengerjaan += $p['harga'];
                                ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($p['kode_pengerjaan']) ?></td>
                                            <td style="text-align: left;"><?= esc($p['nama_pengerjaan']) ?></td>
                                            <td><?= number_format((float)$p['harga'], 0, ',', '.') ?></td>
                                            <td class="d-flex">
                                                <a href="#" class="btn btn-sm me-2 btn-edit" data-kode-pengerjaan="<?= esc($p['id_pengerjaan_po']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-delete" data-url="<?= base_url('deletePengerjaanPo/' . esc($p['id_pengerjaan_po'])) ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data pengerjaan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><strong>Total Harga Pengerjaan</strong></td>
                                    <td id="total-harga-pengerjaan"><strong><?= number_format($totalHargaPengerjaan, 0, ',', '.') ?></strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Sparepart -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Sparepart</h5>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#collapseSparepart" id="toggleSparepartButton">
                        Add Sparepart
                    </button>
                    <div id="collapseSparepart" class="collapse mt-2">
                        <form id="sparepartForm" action="<?= base_url('/createSparepart/' . esc($id_terima_po)) ?>" method="post">
                            <input type="hidden" name="id_terima_po" value="<?= esc($id_terima_po) ?>">

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="kodeSparepart" class="col-form-label">Kode Sparepart</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" id="kodeSparepart" name="kodeSparepart" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#kodepart">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="sparepartNama" class="col-form-label">Nama</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="sparepartNama" name="sparepartNama" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="sparepartQty" class="col-form-label">Qty</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="sparepartQty" name="sparepartQty">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="hargaSparepart" class="col-form-label">Harga</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="hargaSparepart" name="hargaSparepart" onkeyup="formatRupiah(this)" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="jenisPart" class="col-form-label">Jenis Part</label>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <select class="form-select form-select-sm" id="jenisPart" name="jenisPart">
                                            <option value="NON-SUPPLY">NON-SUPPLY</option>
                                            <option value="SUPPLY">SUPPLY</option>
                                            <option value="TIDAK JADI GANTI">TIDAK JADI GANTI</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="keterangan" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="keterangan" name="keterangan">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm" id="cancelSparepartButton">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content mt-2" id="myTabContent">
                        <!-- Tabel Sparepart -->
                        <div class="tab-pane fade show active" id="sparepartTable" role="tabpanel" aria-labelledby="sparepart-tab">
                            <div class="table-responsive text-center" style="font-size: 14px;">
                                <table class="table table-bordered mt-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>PO</th>
                                            <th>Beli</th>
                                            <th>Keluar</th>
                                            <th>Sisa</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalHargaSparepart = 0;
                                        if (!empty($sparepartPesanan)) :
                                            foreach ($sparepartPesanan as $index => $sparepart) :
                                                // Hitung total harga
                                                $totalHargaSparepart += $sparepart['harga'] * $sparepart['qty'];

                                                // Hitung qty_sisa
                                                $qty_sisa = ($sparepart['qty_repair'] > 0) ? max($sparepart['qty'] - $sparepart['qty_repair'], 0) : 0;
                                        ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= esc($sparepart['kode_sparepart']) ?></td>
                                                    <td><?= esc($sparepart['nama_sparepart']) ?></td>
                                                    <td><?= esc($sparepart['qty']) ?></td>
                                                    <td><?= number_format($sparepart['harga'], 0, ',', '.') ?></td>
                                                    <td><?= esc($sparepart['qty_pesan']) ?></td>
                                                    <td><?= esc($sparepart['qty_beli']) ?></td>
                                                    <td><?= esc($sparepart['qty_repair']) ?></td>
                                                    <td><?= esc($qty_sisa) ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm me-2 btn-edit-sparepart" data-id-sparepart="<?= esc($sparepart['id_sparepart_po']) ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="<?= base_url('deleteSparepartPo/' . esc($sparepart['id_sparepart_po'])) ?>" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada data sparepart</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="4"><strong>Total Harga Sparepart</strong></td>
                                            <td id="total-harga-sparepart"><strong><?= number_format($totalHargaSparepart, 0, ',', '.') ?></strong></td>
                                            <td colspan="5"></td>
                                        </tr>
                                    </tfoot>
                                    <script>
                                        // JavaScript to calculate and update Harga Estimasi
                                        function updateHargaEstimasi() {
                                            // Get values of total pengerjaan and sparepart prices
                                            const totalHargaPengerjaan = <?= $totalHargaPengerjaan ?>;
                                            const totalHargaSparepart = <?= $totalHargaSparepart ?>;

                                            // Calculate the total harga estimasi
                                            const hargaEstimasi = totalHargaPengerjaan + totalHargaSparepart;

                                            // Format harga estimasi to Indonesian format
                                            const formattedHargaEstimasi = new Intl.NumberFormat('id-ID').format(hargaEstimasi);

                                            // Update the harga estimasi input field
                                            document.getElementById('harga-estimasi').value = formattedHargaEstimasi;
                                        }

                                        // Call the function to set initial value on page load
                                        updateHargaEstimasi();
                                    </script>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('jenisPart').addEventListener('change', function() {
            const hargaSparepart = document.getElementById('hargaSparepart');
            if (this.value === 'SUPPLY') {
                hargaSparepart.value = '0';
                hargaSparepart.setAttribute('readonly', 'readonly');
            } else {
                hargaSparepart.removeAttribute('readonly');
            }
        });
    </script>
    <!-- Upload Foto -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#gambar">
                    Upload foto
                </button>

                <div class="table-responsive text-center">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($gambarData)) : ?>
                                <?php foreach ($gambarData as $index => $gambar) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($gambar['keterangan']) ?></td>
                                        <td>
                                            <img src="<?= base_url('uploads/' . htmlspecialchars($gambar['gambar'])) ?>" alt="<?= htmlspecialchars($gambar['keterangan']) ?>" style="max-width: 200px;">
                                        </td>
                                        <td><?= htmlspecialchars($gambar['deskripsi']) ?></td>
                                        <td>
                                            <form action="<?= base_url('deleteGambarPo/' . $gambar['id_gambar_po']) ?>" method="post" style="display:inline;">
                                                <?= csrf_field() ?> <!-- Jika menggunakan CSRF protection -->
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">Tidak ada gambar yang di-upload.</td>
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
<!-- Horizontal Input end -->

<!-- modal pengerjaan -->
<div class="modal fade" id="pengerjaanModal" tabindex="-1" aria-labelledby="pengerjaanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pengerjaanModalLabel">Pilih Pengerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form pencarian tanpa tombol -->
                <div class="mb-3">
                    <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari kode atau nama pengerjaan" oninput="searchPengerjaan()">
                </div>
                <!-- Tabel data pengerjaan -->
                <table class="table table-bordered text-center mt-3" style="font-size: 0.85rem;">
                    <thead>
                        <tr>
                            <th>Kode Pengerjaan</th>
                            <th>Nama Pengerjaan</th>
                        </tr>
                    </thead>
                    <tbody id="pengerjaan-list">
                        <?php if (!empty($addpengerjaan)) : ?>
                            <?php foreach ($addpengerjaan as $p) : ?>
                                <tr data-kode="<?= $p['kode_pengerjaan'] ?>" data-nama="<?= $p['nama_pengerjaan'] ?>">
                                    <td><?= $p['kode_pengerjaan'] ?></td>
                                    <td><?= $p['nama_pengerjaan'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Tidak ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal SparePart -->
<div class="modal fade text-left" id="kodepart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Sparepart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <input type="text" id="search-input" class="form-control form-control-sm" placeholder="Cari SparePart...">
                    </div>
                </div>
                <div class="table-responsive text-center">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga Beli</th>
                            </tr>
                        </thead>
                        <tbody id="sparepart-list">
                            <?php if (!empty($addsparepart)) : ?>
                                <?php foreach ($addsparepart as $sparepart) : ?>
                                    <tr data-id="<?= esc($sparepart['kode_part']) ?>" data-nama="<?= esc($sparepart['nama_part']) ?>" data-harga="<?= esc($sparepart['harga_beliawal']) ?>">
                                        <td><?= esc($sparepart['kode_part']) ?></td>
                                        <td><?= esc($sparepart['nama_part']) ?></td>
                                        <td><?= number_format(esc($sparepart['harga_beliawal']), 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">Tidak ada data sparepart.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Foto -->
<form id="uploadForm" action="<?= base_url('/createGambarPo') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_terima_po" value="<?= $id_terima_po; ?>">
    <div class="modal fade" id="gambar" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Upload Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="drop-zone" class="border border-dashed p-5 text-center">
                        <p>Drag & drop gambar di sini atau klik untuk upload.</p>
                        <input type="file" id="file-input" name="gambar[]" class="d-none" multiple accept=".jpg,.jpeg,.png,.svg">
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Deskripsi</th>
                                    <th>File Foto</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="table-body" class="table-debet">
                                <!-- Table rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</form>
<style>
    #drop-zone {
        border: 2px dashed #007bff;
        border-radius: 5px;
        padding: 20px;
        background-color: #f8f9fa;
        text-align: center;
        min-height: 200px;
        margin-bottom: 20px;
        width: 100%;
    }

    #drop-zone.dragging {
        border-color: #0056b3;
        background-color: #e9ecef;
    }
</style>
<script>
    document.getElementById('drop-zone').addEventListener('click', function() {
        document.getElementById('file-input').click();
    });

    document.getElementById('file-input').addEventListener('change', function(event) {
        handleFiles(event.target.files);
    });

    document.getElementById('drop-zone').addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.add('dragging');
    });

    document.getElementById('drop-zone').addEventListener('dragleave', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.remove('dragging');
    });

    document.getElementById('drop-zone').addEventListener('drop', function(event) {
        event.preventDefault();
        event.stopPropagation();
        this.classList.remove('dragging');
        handleFiles(event.dataTransfer.files);
    });

    function handleFiles(files) {
        const tableBody = document.getElementById('table-body');
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'svg'];

        // Clear existing rows
        tableBody.innerHTML = '';

        Array.from(files).forEach(file => {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (allowedExtensions.includes(fileExtension)) {
                const newRow = `<tr>
                <td>
                    <select class="form-select" name="keterangan[]">
                        <option>Sebelum</option>
                        <option>Epoxy</option>
                        <option>Finish</option>
                    </select>
                </td>
                <td><input type="text" name="deskripsi[]" class="form-control"></td>
                <td>
                    <p>${file.name}</p>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                </td>
            </tr>`;
                tableBody.insertAdjacentHTML('beforeend', newRow);

                // Append file to the hidden input
                // const fileInput = document.getElementById('file-input');
                // const dataTransfer = new DataTransfer();
                // Array.from(fileInput.files).forEach(f => dataTransfer.items.add(f));
                // dataTransfer.items.add(file);
                // fileInput.files = dataTransfer.files;
            } else {
                alert('Format file tidak diizinkan: ' + file.name);
            }
        });

        // Attach event listener to remove buttons
        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const fileName = row.querySelector('p').textContent;

                // Remove file from input
                const fileInput = document.getElementById('file-input');
                const dataTransfer = new DataTransfer();
                Array.from(fileInput.files).forEach(file => {
                    if (file.name !== fileName) {
                        dataTransfer.items.add(file);
                    }
                });
                fileInput.files = dataTransfer.files;

                row.remove();
            });
        });

    }
</script>


<!-- Pengerjaan Edit-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengatur event listener untuk tombol edit
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const kodePengerjaan = this.getAttribute('data-kode-pengerjaan');

                // Mengambil data dari server
                fetch(`<?= base_url('getPengerjaanData/') ?>${kodePengerjaan}`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi form dengan data yang diperoleh
                        document.getElementById('kodePengerjaan').value = data.kode_pengerjaan;
                        document.getElementById('pengerjaan').value = data.nama_pengerjaan;
                        document.getElementById('harga').value = data.harga;

                        // Set form action untuk edit
                        document.getElementById('pengerjaanForm').action = `<?= base_url('updatePengerjaanPo') ?>/${data.kode_pengerjaan}`;

                        // Buka accordion
                        const accordion = document.getElementById('collapsePengerjaan');
                        if (accordion.classList.contains('collapse')) {
                            new bootstrap.Collapse(accordion, {
                                toggle: true
                            });
                        }
                    });
            });
        });
    });
</script>

<!-- Sparepart Edit -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengatur event listener untuk tombol edit sparepart
        document.querySelectorAll('.btn-edit-sparepart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const idSparepart = this.getAttribute('data-id-sparepart');

                if (!idSparepart) {
                    console.error('ID Sparepart tidak ditemukan.');
                    return;
                }

                // Debugging: log ID sparepart
                console.log('ID Sparepart:', idSparepart);

                // Mengambil data dari server
                fetch(`<?= base_url('getSparepartDataRepair/') ?>${idSparepart}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) {
                            console.error('Data kosong diterima dari server.');
                            return;
                        }

                        // Debugging: log data yang diterima
                        console.log('Data Received:', data);

                        // Isi form dengan data yang diperoleh
                        document.getElementById('kodeSparepart').value = data.id_kode_barang || '';
                        document.getElementById('sparepartNama').value = data.nama_barang || '';
                        document.getElementById('sparepartQty').value = data.qty || '';
                        document.getElementById('hargaSparepart').value = data.harga || '';
                        document.getElementById('kodePengerjaan').value = data.no_po || '';
                        document.getElementById('jenisPart').value = data.is_sent ? 'Sent' : 'Not Sent';

                        // Set form action untuk edit
                        const form = document.getElementById('sparepartForm');
                        if (form) {
                            form.action = `<?= base_url('updateSparepartPo') ?>/${data.id}`;
                        }

                        // Buka accordion jika tidak terlihat
                        const accordion = document.getElementById('collapseSparepart');
                        if (accordion && accordion.classList.contains('collapse')) {
                            new bootstrap.Collapse(accordion, {
                                toggle: true
                            });
                        }
                    })
                    .catch(error => {
                        // Debugging: log error jika terjadi
                        console.error('Error fetching data:', error);
                    });
            });
        });
    });
</script>

<script>
    // pengerjaan
    function searchPengerjaan() {
        // Ambil input pencarian dan nilai pencarian
        const searchInput = document.getElementById('searchInput');
        const searchTerm = searchInput.value.toLowerCase();

        // Ambil semua baris dari tabel
        const rows = document.querySelectorAll('#pengerjaan-list tr');

        rows.forEach(row => {
            const kode = row.getAttribute('data-kode').toLowerCase();
            const nama = row.getAttribute('data-nama').toLowerCase();

            // Periksa apakah baris cocok dengan istilah pencarian
            if (kode.includes(searchTerm) || nama.includes(searchTerm)) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    }
    // pengerjaan
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener untuk mengisi inputan dengan data yang dipilih
        const tableBody = document.getElementById('pengerjaan-list');

        tableBody.addEventListener('click', function(e) {
            const target = e.target.closest('tr');
            if (target) {
                const kode = target.getAttribute('data-kode');
                const nama = target.getAttribute('data-nama');

                // Set inputan dengan data yang dipilih
                document.getElementById('kodePengerjaan').value = kode;
                document.getElementById('pengerjaan').value = nama;

                // Tutup modal setelah memilih
                const modal = bootstrap.Modal.getInstance(document.getElementById('pengerjaanModal'));
                modal.hide();
            }
        });
    });
    // Sparepart
    // Fungsi pencarian untuk modal sparepart
    function searchSparepart() {
        // Ambil input pencarian dan nilai pencarian
        const searchInput = document.getElementById('search-input');
        const searchTerm = searchInput.value.toLowerCase();

        // Ambil semua baris dari tabel
        const rows = document.querySelectorAll('#sparepart-list tr');

        rows.forEach(row => {
            const kode = row.getAttribute('data-id').toLowerCase();
            const nama = row.getAttribute('data-nama').toLowerCase();
            const harga = row.getAttribute('data-harga').toLowerCase();

            // Periksa apakah baris cocok dengan istilah pencarian
            if (kode.includes(searchTerm) || nama.includes(searchTerm) || harga.includes(searchTerm)) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    }

    // Tambahkan event listener untuk pencarian saat input berubah
    document.getElementById('search-input').addEventListener('input', searchSparepart);

    // Fungsi untuk mengisi inputan dengan data yang dipilih
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('sparepart-list');

        tableBody.addEventListener('click', function(e) {
            const target = e.target.closest('tr');
            if (target) {
                const kode = target.getAttribute('data-id');
                const nama = target.getAttribute('data-nama');
                const harga = target.getAttribute('data-harga');

                // Set inputan dengan data yang dipilih
                document.getElementById('kodeSparepart').value = kode;
                document.getElementById('sparepartNama').value = nama;
                document.getElementById('hargaSparepart').value = harga;

                // Tutup modal setelah memilih
                const modal = bootstrap.Modal.getInstance(document.getElementById('kodepart'));
                modal.hide();
            }
        });
    });


    // asuransi
    document.addEventListener('DOMContentLoaded', function() {
        // Function to filter asuransi list based on search input
        document.getElementById('search-asuransi').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#asuransi-list tr');

            rows.forEach(row => {
                const kode = row.getAttribute('data-kode').toLowerCase();
                const nama = row.getAttribute('data-nama').toLowerCase();

                if (kode.includes(searchValue) || nama.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Function to handle row click and set value to input
        document.querySelectorAll('#asuransi-list .clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                const nama = this.getAttribute('data-nama');
                document.getElementById('asuransi').value = nama; // Set the name to the input field

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('asur'));
                modal.hide();
            });
        });
    });
    // Kendaraan Modal
    document.addEventListener('DOMContentLoaded', function() {
        const kendaraanList = document.getElementById('kendaraan-list');
        const searchKendaraan = document.getElementById('search-kendaraan');

        if (kendaraanList) {
            kendaraanList.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const noKendaraan = target.getAttribute('data-no-kendaraan');
                    const customerName = target.getAttribute('data-customer');
                    const noContact = target.getAttribute('data-no-contact');

                    document.getElementById('no-kendaraan').value = noKendaraan;
                    document.getElementById('customer-name').value = customerName;
                    document.getElementById('no-contact').value = noContact;

                    // Close the modal
                    $('#kendaraanModal').modal('hide');
                }
            });

            if (searchKendaraan) {
                searchKendaraan.addEventListener('input', function() {
                    const filter = searchKendaraan.value.toLowerCase();
                    const rows = kendaraanList.getElementsByTagName('tr');

                    Array.from(rows).forEach(row => {
                        const cells = row.getElementsByTagName('td');
                        const noKendaraan = cells[0] ? cells[0].textContent.toLowerCase() : '';
                        const customerName = cells[1] ? cells[1].textContent.toLowerCase() : '';
                        const noContact = cells[2] ? cells[2].textContent.toLowerCase() : '';

                        if (noKendaraan.includes(filter) || customerName.includes(filter) || noContact.includes(filter)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        }
    });


    // Jenis Mobil Modal
    document.addEventListener('DOMContentLoaded', function() {
        const jenisMobilList = document.getElementById('jenis-mobil-list');
        const searchJenisMobil = document.getElementById('searchJenisMobil');

        if (jenisMobilList && searchJenisMobil) {
            // Filter function
            searchJenisMobil.addEventListener('input', function() {
                const filter = searchJenisMobil.value.toLowerCase();
                const rows = jenisMobilList.getElementsByTagName('tr');
                Array.from(rows).forEach(function(row) {
                    const jenisMobil = row.getAttribute('data-jenis-mobil').toLowerCase();
                    if (jenisMobil.indexOf(filter) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Handle row click
            jenisMobilList.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const jenisMobil = target.getAttribute('data-jenis-mobil');

                    document.getElementById('jenis-mobil').value = jenisMobil;

                    // Close the modal
                    $('#jenisMobilModal').modal('hide');
                }
            });
        }
    });

    // Warna Modal
    document.addEventListener('DOMContentLoaded', function() {
        const warnaList = document.getElementById('warna-list');
        const searchWarna = document.getElementById('searchWarna');

        if (warnaList && searchWarna) {
            // Filter function
            searchWarna.addEventListener('input', function() {
                const filter = searchWarna.value.toLowerCase();
                const rows = warnaList.getElementsByTagName('tr');
                Array.from(rows).forEach(function(row) {
                    const warna = row.getAttribute('data-warna').toLowerCase();
                    if (warna.indexOf(filter) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Handle row click
            warnaList.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const warna = target.getAttribute('data-warna');

                    document.getElementById('warna').value = warna;

                    // Close the modal
                    $('#warnaModal').modal('hide');
                }
            });
        }
    });
</script>


<!-- js accordion -->
<script>
    // Fungsi untuk mereset dan menyembunyikan form
    function resetAndHideForm(formId, collapseId, buttonId) {
        document.getElementById(formId).reset(); // Reset form
        document.getElementById(collapseId).classList.remove('show'); // Sembunyikan form
        document.getElementById(buttonId).style.display = 'inline-block'; // Tampilkan tombol
    }

    // Event listener untuk tombol batal
    document.getElementById('cancelPengerjaanButton').addEventListener('click', function() {
        resetAndHideForm('pengerjaanForm', 'collapsePengerjaan', 'togglePengerjaanButton');
    });

    document.getElementById('cancelSparepartButton').addEventListener('click', function() {
        resetAndHideForm('sparepartForm', 'collapseSparepart', 'toggleSparepartButton');
    });

    // Event listener untuk tombol toggle
    document.getElementById('togglePengerjaanButton').addEventListener('click', function() {
        this.style.display = 'none'; // Sembunyikan tombol saat form dibuka
    });

    document.getElementById('toggleSparepartButton').addEventListener('click', function() {
        this.style.display = 'none'; // Sembunyikan tombol saat form dibuka
    });

    // Event listener untuk collapse
    document.getElementById('collapsePengerjaan').addEventListener('show.bs.collapse', function() {
        document.getElementById('togglePengerjaanButton').style.display = 'none';
    });

    document.getElementById('collapsePengerjaan').addEventListener('hide.bs.collapse', function() {
        document.getElementById('togglePengerjaanButton').style.display = 'inline-block';
    });

    document.getElementById('collapseSparepart').addEventListener('show.bs.collapse', function() {
        document.getElementById('toggleSparepartButton').style.display = 'none';
    });

    document.getElementById('collapseSparepart').addEventListener('hide.bs.collapse', function() {
        document.getElementById('toggleSparepartButton').style.display = 'inline-block';
    });
</script>


<!-- Hapus Pengerjaan -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener untuk tombol delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default anchor tag

                const url = this.getAttribute('data-url'); // Ambil URL dari data-url

                // Tampilkan SweetAlert2
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Tindakan ini tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user menekan "Ya, hapus!", redirect ke URL penghapusan
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>


<script>
    function updateNoPolisVisibility() {
        var asuransi = document.getElementById('asuransi').value.trim().toLowerCase();
        var noPolisSection = document.getElementById('no-polis-section');

        // Sembunyikan atau tampilkan No Polis berdasarkan nilai Asuransi
        if (asuransi === 'umum/pribadi') {
            noPolisSection.style.display = 'none';
        } else {
            noPolisSection.style.display = 'flex';
        }
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        updateNoPolisVisibility();
    });

    // Opsional: Jalankan saat input Asuransi berubah
    document.getElementById('asuransi').addEventListener('input', updateNoPolisVisibility);
</script>

<script>
    // Fungsi untuk memulai countdown
    function startCountdown(seconds, onUpdate, onComplete) {
        let remainingTime = seconds;

        // Update awal
        onUpdate(remainingTime);

        // Interval untuk update setiap detik
        const intervalId = setInterval(() => {
            remainingTime--;
            if (remainingTime > 0) {
                onUpdate(remainingTime);
            } else {
                clearInterval(intervalId);
                onComplete();
            }
        }, 1000);
    }

    // Ambil nilai tanggal estimasi
    const estimasiInput = document.getElementById('tanggal-estimasi').value;
    const estimasiDate = new Date(estimasiInput);
    const now = new Date();

    if (estimasiDate > now) {
        // Hitung selisih waktu dalam detik
        const timeDifferenceInSeconds = Math.floor((estimasiDate - now) / 1000);

        // Panggil countdown
        startCountdown(
            timeDifferenceInSeconds,
            (remainingTime) => {
                const days = Math.floor(remainingTime / 86400);
                const hours = Math.floor((remainingTime % 86400) / 3600);
                const minutes = Math.floor((remainingTime % 3600) / 60);
                const seconds = remainingTime % 60;

                const countdownText = `Tersisa: ${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;

                // Perbarui tampilan countdown di dalam div
                document.getElementById('countdown-timer').innerHTML = countdownText;
            },
            () => {
                // Countdown selesai
                document.getElementById('countdown-timer').innerHTML = 'Waktu habis!';
            }
        );
    } else {
        // Jika tanggal sudah lewat
        document.getElementById('countdown-timer').innerHTML = 'Tanggal estimasi telah lewat!';
    }
</script>

<!-- Script Countdown -->
<script>
    // Ambil elemen tombol berdasarkan ID
    document.getElementById('mobilKeluarBtn').addEventListener('click', function() {
        // Ambil nilai id_terima_po dari atribut data-id_terima_po
        const id_terima_po = this.getAttribute('data-id_terima_po');

        // Menampilkan SweetAlert2 dengan pilihan Iya dan Batal
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Tindakan ini tidak bisa dibatalkan. Mobil akan keluar dan data tidak dapat kembali setelah dikonfirmasi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya, Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true // Agar tombol Batal di kiri dan Iya di kanan
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika klik Iya, kirim request POST ke route dengan id_terima_po
                const url = '/buttonExit/' + encodeURIComponent(id_terima_po); // Ganti 'yourData' dengan id_terima_po

                fetch(url, {
                        method: 'POST', // Menggunakan POST
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest' // Biasanya digunakan untuk AJAX request
                        },
                        body: JSON.stringify({
                            // Kirim data tambahan jika diperlukan
                            mobilId: 123 // Ganti dengan data lain jika diperlukan
                        })
                    })
                    .then(response => response.json()) // Mengambil response JSON
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Mobil Keluar!',
                                data.message,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Terjadi Kesalahan', 'Gagal mengirim data ke server', 'error');
                    });
            } else if (result.isDismissed) {
                // Jika klik Batal
                Swal.fire(
                    'Aksi Dibatalkan!',
                    'Tidak ada perubahan yang dilakukan.',
                    'error'
                );
            }
        });
    });
</script>

<?= $this->endSection() ?>