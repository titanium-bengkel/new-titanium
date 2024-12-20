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
        <form action="<?= base_url('updatePo/' . $po['id_terima_po']) ?>" method="post">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/klaim/preorder') ?>" class="breadcrumb-link text-primary fw-bold">Pre Order</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Update Pre Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Update Pre Order</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-1 ">
                            <label class="col-form-label">Cabang</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-1 d-flex align-items-center">
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-titanium" name="bengkel" value="Titanium" class="form-check-input"
                                    <?= (isset($po['bengkel']) && esc($po['bengkel']) === 'Titanium') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="bengkel-titanium">Titanium</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-tandem" name="bengkel" value="Tandem" class="form-check-input"
                                    <?= (isset($po['bengkel']) && esc($po['bengkel']) === 'Tandem') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="bengkel-tandem">Tandem</label>
                            </div>
                            <div class="form-check me-3">
                                <input type="radio" id="bengkel-k3karoseri" name="bengkel" value="K3 Karoseri" class="form-check-input"
                                    <?= (isset($po['bengkel']) && esc($po['bengkel']) === 'K3 Karoseri') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="bengkel-k3karoseri">K3 Karoseri</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="vortex" name="bengkel" value="Vortex" class="form-check-input"
                                    <?= (isset($po['bengkel']) && esc($po['bengkel']) === 'Vortex') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="vortex">Vortex</label>
                            </div>
                            <div class="d-flex ms-auto">
                                <input type="date" id="tanggal" class="form-control me-2" name="tanggal_klaim" style="max-width: 180px;" value="<?= isset($po['tgl_klaim']) ? esc($po['tgl_klaim']) : '' ?>">
                                <input type="time" id="jam" name="jam_klaim" class="form-control" style="max-width: 120px;" value="<?= isset($po['jam_klaim']) ? esc($po['jam_klaim']) : '' ?>">
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h5 class="text-center mb-3">Data Kendaraan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="id-terima-po">No. Order</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" class="form-control" value="<?= isset($po['id_terima_po']) ? esc($po['id_terima_po']) : '' ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-rangka">No. Rangka</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-rangka" class="form-control" name="no_rangka" value="<?= isset($po['no_rangka']) ? esc($po['no_rangka']) : '' ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-kendaraan">Nopol</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= isset($po['no_kendaraan']) ? esc($po['no_kendaraan']) : '' ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#kendaraanModal">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jenis-mobil">Jenis Mobil</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="jenis-mobil" class="form-control" name="jenis_mobil" value="<?= isset($po['jenis_mobil']) ? esc($po['jenis_mobil']) : '' ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#jenisMobilModal">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="warna" class="form-control" name="warna" value="<?= isset($po['warna']) ? esc($po['warna']) : '' ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#warnaModal">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tahun-kendaraan">Tahun</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="tahun-kendaraan" class="form-control" name="tahun_kendaraan" value="<?= isset($po['tahun_kendaraan']) ? esc($po['tahun_kendaraan']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="panel">Panel</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="panel" class="form-control" name="panel" value="<?= isset($po['panel']) ? esc($po['panel']) : '' ?>">
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-center mb-3">Data Pelanggan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="customer-name">Nama Pelanggan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="customer-name" class="form-control" name="customer_name" value="<?= isset($po['customer_name']) ? esc($po['customer_name']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-contact">Kontak</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-contact" class="form-control" name="no_contact" value="<?= isset($po['no_contact']) ? esc($po['no_contact']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="alamat">Alamat</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="alamat" class="form-control" name="alamat" value="<?= isset($po['alamat']) ? esc($po['alamat']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="kota">Kota</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="kota" class="form-control" name="kota" value="<?= isset($po['kota']) ? esc($po['kota']) : '' ?>">
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-center mb-3">Data Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-9 col-9 mb-3">
                            <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= isset($po['asuransi']) ? esc($po['asuransi']) : '' ?>" readonly>
                            <input type="hidden" id="approval-status" value="<?= $isApproved ? 'approved' : 'not_approved' ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#asur">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="col-lg-2 col-3 mb-3" id="no-polis-label">
                            <label class="col-form-label" for="no-polis">No. Polis</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3" id="no-polis-container">
                            <input type="text" id="no-polis" class="form-control" name="no_polis" value="<?= isset($po['no_polis']) ? esc($po['no_polis']) : '' ?>">
                        </div>


                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= isset($po['keterangan']) ? esc($po['keterangan']) : '' ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text-center mb-3">Nilai Estimasi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="nilai-jasa">Nilai Jasa</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="nilai-jasa" class="form-control" name="nilai_jasa" readonly>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Ambil elemen total harga dan input nilai jasa
                                const totalHargaElement = document.getElementById('total-harga');
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
                            <label class="col-form-label" for="harga-estimasi">Nilai Sparepart</label>
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
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="harga-estimasi">Nilai Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="harga-estimasi" class="form-control" name="harga_estimasi" value="<?= isset($hargaEstimasi) ? esc(number_format($hargaEstimasi, 0, ',', '.')) : '' ?>" readonly>
                        </div>
                        <script>
                            function formatRupiah(angka) {
                                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }

                            function cleanRupiah(angka) {
                                return parseInt(angka.replace(/\./g, '')) || 0;
                            }

                            function updateHargaEstimasi() {
                                let hargaPengerjaan = document.getElementById('harga').value;
                                let hargaSparepart = document.getElementById('hargaSparepart').value;

                                console.log("Harga Pengerjaan (before clean):", hargaPengerjaan);
                                console.log("Harga Sparepart (before clean):", hargaSparepart);

                                let totalPengerjaan = cleanRupiah(hargaPengerjaan);
                                let totalSparepart = cleanRupiah(hargaSparepart);

                                console.log("Harga Pengerjaan (after clean):", totalPengerjaan);
                                console.log("Harga Sparepart (after clean):", totalSparepart);

                                let totalEstimasi = totalPengerjaan + totalSparepart;

                                console.log("Total Estimasi:", totalEstimasi);

                                document.getElementById('harga-estimasi').value = formatRupiah(totalEstimasi);
                            }

                            document.getElementById('harga').addEventListener('input', updateHargaEstimasi);
                            document.getElementById('hargaSparepart').addEventListener('input', updateHargaEstimasi);

                            updateHargaEstimasi();
                        </script>
                    </div>
                    <hr>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="status-order">Status Order</label>
                        </div>
                        <div class="col-lg-2 col-4 mb-2">
                            <?php
                            $poModel = new \App\Models\M_Po();
                            $po = $poModel->where('id_terima_po', $id_terima_po)->first();
                            $isApproved = !empty($po) && isset($po['status']) && $po['status'] === 'Acc Asuransi';
                            ?>
                            <select class="form-select" id="status-order" name="status_order">
                                <?php if (isset($po['asuransi']) && strtolower($po['asuransi']) == 'umum/pribadi') : ?>
                                    <option value="Pre-Order" <?= (isset($po['status_order']) && $po['status_order'] == 'Pre-Order') ? 'selected' : '' ?>>Pre-Order</option>
                                    <option value="Repair Order" <?= (isset($po['status_order']) && $po['status_order'] == 'Repair Order') ? 'selected' : '' ?>>Repair Order</option>
                                <?php else : ?>
                                    <?php if ($isApproved) : ?>
                                        <option value="Acc Asuransi" <?= (isset($po['status_order']) && $po['status_order'] == 'Acc Asuransi') ? 'selected' : '' ?>>Acc Asuransi</option>
                                        <option value="Repair Order" <?= (isset($po['status_order']) && $po['status_order'] == 'Repair Order') ? 'selected' : '' ?>>Repair Order</option>
                                    <?php else : ?>
                                        <option value="Pre-Order" <?= (isset($po['status_order']) && $po['status_order'] == 'Pre-Order') ? 'selected' : '' ?>>Pre-Order</option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <h5>Checklist Progres</h5>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="proses-klaim" name="progres" value="Proses Klaim" <?= (isset($po['progres']) && $po['progres'] == 'Proses Klaim') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="proses-klaim">Proses Klaim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="menunggu-sparepart" name="progres" value="Menunggu Sparepart" <?= (isset($po['progres']) && $po['progres'] == 'Menunggu Sparepart') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="menunggu-sparepart">Menunggu Sparepart</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="menunggu-supply" name="progres" value="Menunggu Supply" <?= (isset($po['progres']) && $po['progres'] == 'Menunggu Supply') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="menunggu-supply">Menunggu Supply</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="siap-masuk" name="progres" value="Siap Masuk" <?= (isset($po['progres']) && $po['progres'] == 'Siap Masuk') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="siap-masuk">Siap Masuk</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="batal-klaim-asuransi" name="progres" value="Batal Klaim Asuransi" <?= (isset($po['progres']) && $po['progres'] == 'Batal Klaim Asuransi') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="batal-klaim-asuransi">Batal Klaim Asuransi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="batal-mobil-masuk" name="progres" value="Batal Mobil Masuk" <?= (isset($po['progres']) && $po['progres'] == 'Batal Mobil Masuk') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="batal-mobil-masuk">Batal Mobil Masuk</label>
                        </div>
                    </div>

                    <!-- JavaScript to change progress based on selected status order -->
                    <script>
                        document.getElementById('status-order').addEventListener('change', function() {
                            if (this.value === 'Repair Order') {
                                // Check the "Siap Masuk" radio button when "Repair Order" is selected
                                document.getElementById('siap-masuk').checked = true;
                            }
                        });
                    </script>

                    <div class="mt-3">
                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-sm btn-primary me-2">Update</button>
                            <!-- <button type="button" class="btn btn-sm btn-secondary" style="margin-left: 20px;">Cetak Estimasi</button> -->
                            <a href="<?= base_url('cetakEstimasi/' . $po['id_terima_po']) ?>" target="_blank" class="btn btn-secondary btn-sm">Cetak Estimasi</a>


                            <div id="approval-buttons">
                                <?php if ($isApproved) : ?>
                                    <a href="<?= base_url('order_pos_asprev/' . $po['id_terima_po']); ?>" class="btn btn-sm btn-success" style="margin-left: 10px;">
                                        Sudah Approve
                                    </a>
                                <?php else : ?>
                                    <button type="button" class="btn btn-sm btn-success" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#asur-acc">
                                        Approve Asuransi
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="alert alert-info mt-3 alert-dismissible fade show" role="alert" id="infoAlert">
                            PASTIKAN SELALU UPDATE AGAR HARGA ESTIMASI TERINPUT.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>

                    <script>
                        // Flashing colors for the alert
                        const alertElement = document.getElementById('infoAlert');
                        const colors = ['#17a2b8', '#f0ad4e', '#d9534f', '#5bc0de', '#5cb85c']; // Array of colors
                        let index = 0;

                        const flashColors = setInterval(() => {
                            if (alertElement) {
                                alertElement.style.backgroundColor = colors[index % colors.length];
                                index++;
                            }
                        }, 500); // Change color every 500 milliseconds

                        // Automatically close the alert after 10 seconds
                        setTimeout(() => {
                            clearInterval(flashColors); // Stop flashing before closing
                            if (alertElement) {
                                var bootstrapAlert = new bootstrap.Alert(alertElement);
                                bootstrapAlert.close();
                            }
                        }, 10000);
                    </script>
                </div>
            </div>
        </form>

        <!-- Form Input Pengerjaan -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <!-- Button Accordion -->
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapsePengerjaan" id="togglePengerjaanButton">
                        Add
                    </button>
                    <!-- Form Pengerjaan -->
                    <div id="collapsePengerjaan" class="collapse mt-2">
                        <form id="pengerjaanForm" method="post" action="<?= base_url('createPengerjaanPo') ?>">
                            <input type="hidden" name="id_terima_po" value="<?= esc($po['id_terima_po']) ?>"> <!-- Add this line -->
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="kodePengerjaan" class="col-form-label">Kode Jasa</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm" id="kodePengerjaan" name="kodePengerjaan" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#pengerjaanModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="pengerjaan" class="col-form-label">Jasa</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="pengerjaan" name="pengerjaan">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="harga" class="col-form-label">Harga</label>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="harga" name="harga" onkeyup="formatRupiah(this)">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div>
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
                                    <th>Jasa</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalHarga = 0;
                                if (!empty($pengerjaanList)) :
                                    foreach ($pengerjaanList as $index => $p) :
                                        $totalHarga += $p['harga'];
                                ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($p['kode_pengerjaan']) ?></td>
                                            <td><?= esc($p['nama_pengerjaan']) ?></td>
                                            <td><?= number_format((float)$p['harga'], 0, ',', '.') ?></td>
                                            <td class="d-flex">
                                                <a href="#" class="btn btn-sm me-2 btn-edit" data-kode-pengerjaan="<?= esc($p['id_pengerjaan_po']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-sm btn-delete"
                                                    data-url="<?= base_url('deletePengerjaanPo/' . esc($p['id_pengerjaan_po'])) ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3"><strong>Total Harga</strong></td>
                                        <td><strong id="total-harga"><?= number_format($totalHarga, 0, ',', '.') ?></strong></td>
                                        <td></td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">Tidak ada data pengerjaan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sparepart -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseSparepart" id="toggleSparepartButton">
                        Add
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
                                            <!-- <option value="BORONG">BORONG</option> -->
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
                            <div class="row mb-2">
                                <div>
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm" id="cancelSparepartButton">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Tabel Sparepart -->
                    <div class="table-responsive text-center" style="font-size: 14px;">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Q_PO</th>
                                    <th>Tgl. Po</th>
                                    <th>Q_Beli</th>
                                    <th>Tgl. Beli</th>
                                    <th>Q_Trpsng</th>
                                    <th>Tgl. Trpsng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($daftarSparepart)) : ?>
                                    <?php $index = 1; ?>
                                    <?php $totalQty = 0; ?>
                                    <?php $totalHarga = 0; ?>
                                    <?php foreach ($daftarSparepart as $sparepart) : ?>
                                        <?php
                                        $qty = $sparepart['qty'];
                                        $harga = $sparepart['harga'];
                                        // Hitung total harga per item
                                        $totalHargaPerItem = $harga * $qty;
                                        ?>
                                        <tr>
                                            <td><?= $index++ ?></td>
                                            <td><?= $sparepart['kode_sparepart'] ?></td>
                                            <td><?= esc($sparepart['nama_sparepart']) ?></td>
                                            <td><?= esc($sparepart['jenis_part']) ?></td>
                                            <td><?= esc($qty) ?></td>
                                            <td><?= number_format($totalHargaPerItem, 0, ',', '.') ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="d-flex">
                                                <a href="#" class="btn btn-sm me-2 btn-edit-sparepart" data-id-sparepart="<?= esc($sparepart['id_sparepart_po']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('deleteSparepartPo/' . esc($sparepart['id_sparepart_po'])) ?>" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $totalQty += $qty;
                                        $totalHarga += $totalHargaPerItem;
                                        ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                        <td><strong><?= $totalQty ?></strong></td>
                                        <td id="total-harga-sparepart"><strong><?= number_format($totalHarga, 0, ',', '.') ?></strong></td>
                                        <td colspan="9"></td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="13" class="text-center">Tidak ada data sparepart</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
                    <a href="<?= base_url('downloadAllGambar/' . $id_terima_po) ?>" class="btn btn-info btn-sm float-end">
                        Download ZIP<i class="fa-solid fa-file-zipper"></i>
                    </a>


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
                        <?php if (!empty($pengerjaan)) : ?>
                            <?php foreach ($pengerjaan as $p) : ?>
                                <tr data-kode="<?= $p->kode_pengerjaan ?>" data-nama="<?= $p->nama_pengerjaan ?>">
                                    <td><?= $p->kode_pengerjaan ?></td>
                                    <td><?= $p->nama_pengerjaan ?></td>
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
                            <?php if (!empty($spareparts)) : ?>
                                <?php foreach ($spareparts as $sparepart) : ?>
                                    <tr data-id="<?= esc($sparepart['kode_part']) ?>" data-nama="<?= esc($sparepart['nama_part']) ?>" data-harga="<?= esc($sparepart['harga']) ?>">
                                        <td><?= esc($sparepart['kode_part']) ?></td>
                                        <td><?= esc($sparepart['nama_part']) ?></td>
                                        <td><?= number_format(esc($sparepart['harga']), 0, ',', '.') ?></td>
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



<!-- Modal Kendaraan -->
<div class="modal fade" id="kendaraanModal" tabindex="-1" aria-labelledby="kendaraanLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kendaraanLabel">Pilih Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="search-kendaraan" class="form-control mb-3" placeholder="Cari Kendaraan...">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No. Kendaraan</th>
                            <th>Customer</th>
                            <th>No. Contact</th>
                        </tr>
                    </thead>
                    <tbody id="kendaraan-list">
                        <?php if (!empty($kendaraan)) : ?>
                            <?php foreach ($kendaraan as $k) : ?>
                                <tr data-no-kendaraan="<?= $k['no_kendaraan'] ?>" data-customer="<?= $k['customer_name'] ?>" data-no-contact="<?= $k['no_contact'] ?>">
                                    <td><?= $k['no_kendaraan'] ?></td>
                                    <td><?= $k['customer_name'] ?></td>
                                    <td><?= $k['no_contact'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">Data kendaraan tidak tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal Jenis Mobil -->
<div class="modal fade" id="jenisMobilModal" tabindex="-1" role="dialog" aria-labelledby="jenisMobilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jenisMobilModalLabel">Pilih Jenis Mobil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchJenisMobil" class="form-control mb-3" placeholder="Cari Jenis Mobil...">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Mobil</th>
                        </tr>
                    </thead>
                    <tbody id="jenis-mobil-list">
                        <?php if (isset($jenis_mobil) && !empty($jenis_mobil)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($jenis_mobil as $j) : ?>
                                <tr data-jenis-mobil="<?= $j['jenis_mobil'] ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= $j['jenis_mobil'] ?></td>
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


<!-- Modal Warna -->
<div class="modal fade" id="warnaModal" tabindex="-1" role="dialog" aria-labelledby="warnaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warnaModalLabel">Pilih Warna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchWarna" class="form-control mb-3" placeholder="Cari Warna...">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Warna</th>
                        </tr>
                    </thead>
                    <tbody id="warna-list">
                        <?php if (isset($warna) && !empty($warna)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($warna as $w) : ?>
                                <tr data-warna="<?= $w['warna'] ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= $w['warna'] ?></td>
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

<!-- Modal untuk memilih Asuransi -->
<div class="modal fade" id="asur" tabindex="-1" aria-labelledby="asurLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asurLabel">Pilih Asuransi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="search-asuransi" class="form-control mb-3" placeholder="Cari Asuransi...">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Asuransi</th>
                        </tr>
                    </thead>
                    <tbody id="asuransi-list">
                        <?php if (isset($asuransi) && !empty($asuransi)) : ?>
                            <?php foreach ($asuransi as $a) : ?>
                                <tr class="clickable-row" data-kode="<?= $a->kode ?>" data-nama="<?= $a->nama_asuransi ?>">
                                    <td><?= $a->kode ?></td>
                                    <td><?= $a->nama_asuransi ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Data asuransi tidak tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- Modal Acc Asuransi -->
<div class="modal fade" id="asur-acc" tabindex="-1" aria-labelledby="asuransiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: .5rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <form action="<?= base_url('createAccAsuransi') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_terima_po" value="<?= esc($po['id_terima_po']) ?>">

                <div class="modal-header bg-gradient-ltr" style="color: #fff; border-bottom: 1px solid #dee2e6;">
                    <h5 class="modal-title text-white" id="asuransiModalLabel">Detail Asuransi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 70vh; overflow-y: auto; padding: 1.5rem;">
                    <!-- ID Section -->
                    <div class="mb-4">
                        <h5 class="mb-3">ID</h5>
                        <div class="row mb-3">
                            <label for="no_acc" class="col-sm-3 col-form-label" style="font-weight: 500;">No. Order</label>
                            <div class="col-sm-9">
                                <input type="text" id="no_acc" class="form-control" name="no_acc" value="<?= isset($po['id_terima_po']) ? esc($po['id_terima_po']) : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl_acc" class="col-sm-3 col-form-label" style="font-weight: 500;">Tanggal Acc</label>
                            <div class="col-sm-9">
                                <input type="date" id="tgl_acc" class="form-control" name="tgl_acc" onclick="this.showPicker()" required>
                            </div>
                        </div>

                        <script>
                            // Mengatur nilai default input tanggal ke hari ini
                            document.addEventListener('DOMContentLoaded', function() {
                                const today = new Date();
                                const formattedDate = today.toISOString().split('T')[0]; // Mengambil format YYYY-MM-DD
                                document.getElementById('tgl_acc').value = formattedDate; // Set input tanggal
                            });
                        </script>
                    </div>

                    <!-- Data Section -->
                    <div class="mb-4">
                        <h5 class="mb-3">Data Kendaraan</h5>
                        <div class="row mb-3">
                            <label for="no_kendaraan" class="col-sm-3 col-form-label" style="font-weight: 500;">No. Kendaraan</label>
                            <div class="col-sm-9">
                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= isset($po['no_kendaraan']) ? esc($po['no_kendaraan']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis_mobil" class="col-sm-3 col-form-label" style="font-weight: 500;">Jenis Mobil</label>
                            <div class="col-sm-9">
                                <input type="text" id="jenis_mobil" class="form-control" name="jenis_mobil" value="<?= isset($po['jenis_mobil']) ? esc($po['jenis_mobil']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="warna" class="col-sm-3 col-form-label" style="font-weight: 500;">Warna</label>
                            <div class="col-sm-9">
                                <input type="text" id="warna" class="form-control" name="warna" value="<?= isset($po['warna']) ? esc($po['warna']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="customer_name" class="col-sm-3 col-form-label" style="font-weight: 500;">Nama Customer</label>
                            <div class="col-sm-9">
                                <input type="text" id="customer_name" class="form-control" name="customer_name" value="<?= isset($po['customer_name']) ? esc($po['customer_name']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_contact" class="col-sm-3 col-form-label" style="font-weight: 500;">No. Kontak</label>
                            <div class="col-sm-9">
                                <input type="text" id="no_contact" class="form-control" name="no_contact" value="<?= isset($po['no_contact']) ? esc($po['no_contact']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tahun_mobil" class="col-sm-3 col-form-label" style="font-weight: 500;">Tahun Kendaraan</label>
                            <div class="col-sm-9">
                                <input type="text" id="tahun_mobil" class="form-control" name="tahun_mobil" value="<?= isset($po['tahun_kendaraan']) ? esc($po['tahun_kendaraan']) : '' ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Asuransi Section -->
                    <div class="mb-4">
                        <h5 class="mb-3">Detail Asuransi</h5>
                        <div class="row mb-3">
                            <label for="asuransi" class="col-sm-3 col-form-label" style="font-weight: 500;">Asuransi</label>
                            <div class="col-sm-9">
                                <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= isset($po['asuransi']) ? esc($po['asuransi']) : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl_masuk" class="col-sm-3 col-form-label" style="font-weight: 500;">Tanggal Masuk</label>
                            <div class="col-sm-9">
                                <input type="date" id="tgl_masuk" class="form-control" name="tgl_masuk" onclick="this.showPicker()" value="<?= isset($po['tgl_klaim']) ? esc($po['tgl_klaim']) : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tgl_estimasi" class="col-sm-3 col-form-label" style="font-weight: 500;">Tanggal Estimasi</label>
                            <div class="col-sm-9">
                                <input type="date" id="tgl_estimasi" class="form-control" name="tgl_estimasi" onclick="this.showPicker()" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jasa" class="col-sm-3 col-form-label" style="font-weight: 500;">Biaya Jasa</label>
                            <div class="col-sm-9">
                                <input type="text" id="jasa" class="form-control" name="jasa" oninput="formatNumber(this); calculateTotal()" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="sparepart" class="col-sm-3 col-form-label" style="font-weight: 500;">Biaya Sparepart</label>
                            <div class="col-sm-9">
                                <input type="text" id="sparepart" class="form-control" name="sparepart" oninput="formatNumber(this); calculateTotal()" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nilai_total" class="col-sm-3 col-form-label" style="font-weight: 500;">Nilai Total</label>
                            <div class="col-sm-9">
                                <input type="text" id="nilai_total" class="form-control" name="nilai_total" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nilai_or" class="col-sm-3 col-form-label" style="font-weight: 500;">Nilai OR</label>
                            <div class="col-sm-9">
                                <input type="text" id="nilai_or" class="form-control" name="nilai_or">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="qty_or" class="col-sm-3 col-form-label" style="font-weight: 500;">Qty OR</label>
                            <div class="col-sm-9">
                                <input type="number" id="qty_or" class="form-control" name="qty_or" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="keterangan" class="col-sm-3 col-form-label" style="font-weight: 500;">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan" placeholder="Tambahkan keterangan"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="file_lampiran" class="col-sm-3 col-form-label" style="font-weight: 500;">File Lampiran</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" id="file_lampiran" type="file" name="file_lampiran" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-top: 1px solid #dee2e6;">
                    <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
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

<!-- Acc Asuransi Pengerjaan -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('biayaJasaTableBody');
        const addRowButton = document.getElementById('addRowButton');
        const totalHargaInput = document.getElementById('totalHargaJasa');

        addRowButton.addEventListener('click', function() {
            const rowCount = tableBody.children.length + 1;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${rowCount}</td>
                <td><input type="text" class="form-control" name="nama_jasa[]" required></td>
                <td><input type="number" class="form-control" name="harga_jasa[]" value="0" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
            `;
            tableBody.appendChild(newRow);
            updateRowNumbers();
            updateTotalHarga();
        });

        tableBody.addEventListener('click', function(event) {
            if (event.target && (event.target.classList.contains('remove-row') || event.target.closest('.remove-row'))) {
                event.target.closest('tr').remove();
                updateRowNumbers();
                updateTotalHarga();
            }
        });

        tableBody.addEventListener('input', function(event) {
            if (event.target && event.target.name === 'harga_jasa[]') {
                updateTotalHarga();
            }
        });

        function updateRowNumbers() {
            Array.from(tableBody.children).forEach((row, index) => {
                row.children[0].textContent = index + 1;
            });
        }

        function updateTotalHarga() {
            let totalHarga = 0;
            const hargaInputs = tableBody.querySelectorAll('input[name="harga_jasa[]"]');
            hargaInputs.forEach(input => {
                const value = parseFloat(input.value) || 0;
                totalHarga += value;
            });
            totalHargaInput.value = totalHarga.toLocaleString('id-ID');
        }
    });
</script>

<!-- Acc Asuransi Sparepart-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('biayaSparepartTableBody');
        const addRowButton = document.getElementById('addSparepartRowButton');
        const totalQtyInput = document.getElementById('totalQtySparepart');
        const totalHargaInput = document.getElementById('totalHargaSparepart');

        addRowButton.addEventListener('click', function() {
            const rowCount = tableBody.children.length + 1;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${rowCount}</td>
                <td><input type="text" class="form-control" name="nama_sparepart[]" required></td>
                <td><input type="number" class="form-control qty-input" name="qty_sparepart[]" value="0" required></td>
                <td><input type="number" class="form-control harga-input" name="harga_sparepart[]" value="0" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
            `;
            tableBody.appendChild(newRow);
            updateRowNumbers();
            updateTotals();
        });

        tableBody.addEventListener('click', function(event) {
            if (event.target && (event.target.classList.contains('remove-row') || event.target.closest('.remove-row'))) {
                event.target.closest('tr').remove();
                updateRowNumbers();
                updateTotals();
            }
        });

        tableBody.addEventListener('input', function(event) {
            if (event.target && (event.target.classList.contains('qty-input') || event.target.classList.contains('harga-input'))) {
                updateTotals();
            }
        });

        function updateRowNumbers() {
            Array.from(tableBody.children).forEach((row, index) => {
                row.children[0].textContent = index + 1;
            });
        }

        function updateTotals() {
            let totalQty = 0;
            let totalHarga = 0;
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach(row => {
                const qtyInput = row.querySelector('.qty-input');
                const hargaInput = row.querySelector('.harga-input');
                const qty = parseFloat(qtyInput.value) || 0;
                const harga = parseFloat(hargaInput.value) || 0;
                totalQty += qty;
                totalHarga += qty * harga;
                // Update the harga total per item
                row.querySelector('input[name="harga_sparepart[]"]').value = qty * harga;
            });
            totalQtyInput.value = totalQty;
            totalHargaInput.value = totalHarga.toLocaleString('id-ID');
        }
    });
</script>


<script>
    function formatRupiah(input) {
        // Ambil nilai input dan hapus semua karakter non-digit kecuali koma (jika ada)
        let angka = input.value.replace(/[^,\d]/g, "");

        // Format angka dengan tanda titik ribuan
        input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk membersihkan format ribuan sebelum submit
    document.getElementById('pengerjaanForm').addEventListener('submit', function() {
        let hargaInput = document.getElementById('hargaSparepart');
        // Hapus titik ribuan sebelum form dikirim ke server
        hargaInput.value = hargaInput.value.replace(/\./g, '');
    });
</script>
<!-- Script untuk Mengelola Visibilitas No Polis -->
<script>
    function updateNoPolisVisibility() {
        var asuransi = document.getElementById('asuransi').value.trim().toLowerCase();
        var noPolisLabel = document.getElementById('no-polis-label');
        var noPolisContainer = document.getElementById('no-polis-container');

        if (asuransi === 'umum/pribadi') {
            noPolisLabel.style.display = 'none';
            noPolisContainer.style.display = 'none';
        } else {
            noPolisLabel.style.display = 'block';
            noPolisContainer.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateNoPolisVisibility();
    });

    // Optional: Add an event listener for changes in the "Asuransi" input
    document.getElementById('asuransi').addEventListener('input', updateNoPolisVisibility);
</script>

<!-- script modal gambar -->
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

<!-- upload foto -->
<script>
    document.getElementById('add-row-btn').addEventListener('click', function() {
        var newRow = `<tr>
            <td>
                <select class="form-select" name="keterangan[]" id="basicSelect">
                    <option>Sebelum</option>
                    <option>Epoxy</option>
                    <option>Finish</option>
                </select>
            </td>
            <td><input type="text" name="deskripsi[]" class="form-control"></td>
            <td><input type="file" name="gambar[]" class="image-resize-filepond" accept=".jpg, .jpeg, .png, .svg"></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
            </td>
        </tr>`;
        document.querySelector('.table-debet').insertAdjacentHTML('beforeend', newRow);
    });

    document.querySelector('.table-debet').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>

<script>
    function formatRupiah(input) {
        // Ambil nilai input dan hapus semua karakter non-digit kecuali koma (jika ada)
        let angka = input.value.replace(/[^,\d]/g, "");

        // Format angka dengan tanda titik ribuan
        input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk membersihkan format ribuan sebelum submit
    document.getElementById('pengerjaanForm').addEventListener('submit', function() {
        let hargaInput = document.getElementById('harga');
        // Hapus titik ribuan sebelum form dikirim ke server
        hargaInput.value = hargaInput.value.replace(/\./g, '');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengatur event listener untuk tombol edit sparepart
        document.querySelectorAll('.btn-edit-sparepart').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const idSparepart = this.getAttribute('data-id-sparepart');

                // Debugging: log ID sparepart
                console.log('ID Sparepart:', idSparepart);

                // Mengambil data dari server
                fetch(`<?= base_url('getSparepartData/') ?>${idSparepart}`)
                    .then(response => {
                        // Debugging: log status respons
                        console.log('Response Status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        // Debugging: log data yang diterima
                        console.log('Data Received:', data);

                        // Isi form dengan data yang diperoleh
                        document.getElementById('kodeSparepart').value = data.kode_sparepart || '';
                        document.getElementById('sparepartNama').value = data.nama_sparepart || '';
                        document.getElementById('sparepartQty').value = data.qty || '';
                        document.getElementById('hargaSparepart').value = data.harga || '';
                        document.getElementById('kodePengerjaan').value = data.kode_pengerjaan || '';
                        document.getElementById('jenisPart').value = data.jenis_part || '';

                        // Set form action untuk edit
                        document.getElementById('sparepartForm').action = `<?= base_url('updateSparepartPo') ?>/${data.id_sparepart_po}`;

                        // Buka accordion jika tidak terlihat
                        const accordion = document.getElementById('collapseSparepart');
                        if (accordion.classList.contains('collapse')) {
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

<!-- Approval Asuransi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var asuransiInput = document.getElementById('asuransi');
        var statusOrderSelect = document.getElementById('status-order');
        var approvalButtons = document.getElementById('approval-buttons');
        var approvalStatus = document.getElementById('approval-status').value;

        function updateFormElements() {
            var asuransiValue = asuransiInput.value.trim().toLowerCase();

            // Hapus semua opsi yang ada di dropdown status order
            statusOrderSelect.innerHTML = '';

            if (asuransiValue === 'umum/pribadi') {
                // Tambahkan opsi Pre-Order dan Repair Order jika asuransi adalah Umum/Pribadi
                statusOrderSelect.add(new Option("Pre-Order", "Pre-Order"));
                statusOrderSelect.add(new Option("Repair Order", "Repair Order"));

                // Sembunyikan tombol approval
                approvalButtons.style.display = 'none';
            } else {
                // Tambahkan opsi Pre-Order jika asuransi bukan Umum/Pribadi dan belum disetujui
                if (approvalStatus !== 'approved') {
                    statusOrderSelect.add(new Option("Pre-Order", "Pre-Order"));
                } else {
                    // Tambahkan opsi Acc Asuransi dan Repair Order jika asuransi bukan Umum/Pribadi dan sudah disetujui
                    statusOrderSelect.add(new Option("Acc Asuransi", "Acc Asuransi"));
                    statusOrderSelect.add(new Option("Repair Order", "Repair Order"));
                }

                // Tampilkan tombol approval
                approvalButtons.style.display = 'block';
            }
        }

        // Jalankan update pertama kali saat halaman dimuat
        updateFormElements();

        // Tambahkan event listener untuk update ketika nilai Asuransi berubah
        asuransiInput.addEventListener('input', updateFormElements);
    });
</script>

<!-- Pengerjaan -->
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


<script>
    function formatNumber(element) {
        // Mengambil nilai dari elemen input dan menghapus karakter non-numeric kecuali titik
        let value = element.value.replace(/[^0-9]/g, '');

        // Memformat angka dengan pemisah ribuan menggunakan titik
        if (value) {
            value = parseInt(value, 10).toLocaleString('id-ID').replace(/,/g, '.');
        }

        // Menetapkan nilai format ke elemen input
        element.value = value;
    }

    function calculateTotal() {
        // Ambil nilai dari input dan hapus pemisah ribuan
        const jasa = getNumericValue(document.getElementById('jasa').value);
        const sparepart = getNumericValue(document.getElementById('sparepart').value);

        // Hitung nilai total
        const total = jasa + sparepart;

        // Set nilai total ke input nilai_total dengan format ribuan menggunakan titik
        document.getElementById('nilai_total').value = total.toLocaleString('id-ID').replace(/,/g, '.');
    }

    function getNumericValue(value) {
        return parseFloat(value.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
    }
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



<?= $this->endSection() ?>