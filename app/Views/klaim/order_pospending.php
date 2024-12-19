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
                        <a href="<?= base_url('/orderlist_pending') ?>" class="breadcrumb-link text-primary fw-bold">Pending Invoice</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Data Pending Invoice</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Data Pending Invoice</h5>
                </header>
                <div class="card-body">
                    <h5>Kendaraan</h5>
                    <div class="form-group row align-items-center">
                        <input type="hidden" id="id-terima-po" name="id_terima_po" value="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="pre-order-id">Pre-Order ID</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" class="form-control" value="<?= isset($ro['id_terima_po']) ? esc($ro['id_terima_po']) : '' ?>" readonly>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-kendaraan">No. Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= isset($ro['no_kendaraan']) ? esc($ro['no_kendaraan']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jenis-mobil">Jenis Mobil</label>
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
                            <label class="col-form-label" for="no-rangka">No Rangka</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-rangka" class="form-control" name="no-rangka" value="<?= isset($ro['no_rangka']) ? esc($ro['no_rangka']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tahun-kendaraan">Tahun Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="tahun-kendaraan" class="form-control" name="tahun-kendaraan" value="<?= isset($ro['tahun_kendaraan']) ? esc($ro['tahun_kendaraan']) : '' ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5>Customer</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="customer-name">Customer Name</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="customer-name" class="form-control" name="customer-name" value="<?= isset($ro['customer_name']) ? esc($ro['customer_name']) : '' ?>">
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-contact">No Contact</label>
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
                    <h5>Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= isset($ro['asuransi']) ? esc($ro['asuransi']) : '' ?>" oninput="checkAsuransi()" readonly>
                        </div>
                        <div id="no-polis-section">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-polis">No Polis</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-polis" class="form-control" name="no-polis" value="<?= isset($ro['no_polis']) ? esc($ro['no_polis']) : '' ?>" readonly>
                            </div>
                        </div>

                        <script>
                            function checkAsuransi() {
                                var asuransi = document.getElementById("asuransi").value.toLowerCase();
                                var noPolisSection = document.getElementById("no-polis-section");

                                if (asuransi === "umum/pribadi") {
                                    noPolisSection.style.display = "none";
                                } else {
                                    noPolisSection.style.display = "flex";
                                }
                            }

                            window.onload = checkAsuransi;
                        </script>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal-masuk">Tanggal Masuk</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal-masuk" class="form-control" name="tanggal-masuk"
                                value="<?= isset($ro['tgl_klaim']) ? esc($ro['tgl_klaim']) : '' ?>"
                                onkeydown="return false"
                                onclick="this.showPicker()">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal-estimasi">Tanggal Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal-estimasi" class="form-control" name="tanggal-estimasi"
                                value="<?= isset($ro['tgl_keluar']) ? esc($ro['tgl_keluar']) : '' ?>"
                                onkeydown="return false"
                                onclick="this.showPicker()" required>
                        </div>

                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="harga-estimasi">Harga Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="harga-estimasi" class="form-control" name="harga-estimasi"
                                value="<?= isset($ro['total_biaya']) ? esc(number_format($ro['total_biaya'], 0, ',', '.')) : '' ?>" readonly>
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
                    <h5>Checklist Proses Klaim</h5>
                    <div class="form-group" id="repairOrderForm">
                        <!-- Ketok -->
                        <?php if (!in_array($ro['progres_pengerjaan'], ['Beres Pengerjaan', 'Menunggu Sparepart Tambahan', 'Menunggu Comment User', 'Data Completed'])): ?>
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
                        <?php endif; ?>

                        <?php if (!in_array($ro['progres_pengerjaan'], ['Data Completed'])): ?>
                            <!-- Beres Pengerjaan -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="beres-pengerjaan" name="progres_pengerjaan" value="Beres Pengerjaan"
                                    <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Beres Pengerjaan') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="beres-pengerjaan">Beres Pengerjaan</label>
                            </div>
                            <!-- Menunggu Sparepart Tambahan -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="menunggu-sparepart" name="progres_pengerjaan" value="Menunggu Sparepart Tambahan"
                                    <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Menunggu Sparepart Tambahan') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="menunggu-sparepart">Menunggu Sparepart Tambahan</label>
                            </div>

                            <!-- Menunggu Comment User -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="comment-user" name="progres_pengerjaan" value="Menunggu Comment User"
                                    <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Menunggu Comment User') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="comment-user">Menunggu Comment User</label>
                            </div>
                        <?php endif; ?>

                        <!-- Data Completed -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="data-completed" name="progres_pengerjaan" value="Data Completed"
                                <?= (isset($ro['progres_pengerjaan']) && $ro['progres_pengerjaan'] == 'Data Completed') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="data-completed">Data Completed</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" class="btn btn-sm btn-danger">Batal</button>
                        <button type="button" class="btn btn-sm btn-success" style="margin-left: 20px;">Cetak Estimasi</button>
                        <button type="button" class="btn btn-sm btn-success">Cetak SPK B</button>

                        <?php if (isset($ro['progres_pengerjaan'])): ?>
                            <?php if ($ro['progres_pengerjaan'] === 'Data Completed'): ?>
                                <button type="button" class="btn btn-sm btn-warning" style="margin-left: 20px;"
                                    onclick="handleKwitansiClick(<?= isset($ro['is_sent']) ? $ro['is_sent'] : 0; ?>)">Kwitansi</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
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
                            <input type="hidden" name="is_sent" value="1">
                            <button type="submit" class="btn btn-primary">Sudah</button>
                        </form>
                    </div>
                </div>
            </div>
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
                            <input type="hidden" name="id_terima_po" value="<?= esc($ro['id_terima_po']) ?>">
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="kodePengerjaan" class="col-form-label">Kode Pengerjaan</label>
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
                                    <label for="pengerjaan" class="col-form-label">Pengerjaan</label>
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
                                    <input type="text" class="form-control form-control-sm" id="harga" name="harga">
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
                                    <th>Pengerjaan</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalHarga = 0;
                                if (!empty($pengerjaan)) :
                                    foreach ($pengerjaan as $index => $p) :
                                        $totalHarga += $p['harga'];
                                ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= esc($p['kode_pengerjaan']) ?></td>
                                            <td><?= esc($p['nama_pengerjaan']) ?></td>
                                            <td><?= number_format((float)$p['harga'], 0, ',', '.') ?></td>
                                            <td class="d-flex">
                                                <a href="#" class="btn btn-sm me-2 btn-edit" data-kode-pengerjaan="<?= esc($p['kode_pengerjaan']) ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= base_url('deletePengerjaanPo/' . esc($p['kode_pengerjaan'])) ?>" class="btn btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3"><strong>Total Harga</strong></td>
                                        <td><strong><?= number_format($totalHarga, 0, ',', '.') ?></strong></td>
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
                    <!-- Button Accordion untuk Sparepart -->
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseSparepart" id="toggleSparepartButton">
                        Add
                    </button>
                    <!-- Sparepart Form -->
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
                                    <input type="text" class="form-control form-control-sm" id="hargaSparepart" name="hargaSparepart" readonly>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    <label for="kodePengerjaan" class="col-form-label">Pengerjaan</label>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" id="kodePengerjaan" name="kodePengerjaan">
                                        <?php if (!empty($pengerjaan)) : ?>
                                            <?php foreach ($pengerjaan as $p) : ?>
                                                <option value="<?= esc($p['kode_pengerjaan']) ?>">
                                                    <?= esc($p['nama_pengerjaan']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">Tidak ada data</option>
                                        <?php endif; ?>
                                    </select>
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
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Kode Pengerjaan</th>
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
                                <?php if (!empty($spareparts)) : ?>
                                    <?php $index = 1; ?>
                                    <?php $totalQty = 0; ?>
                                    <?php $totalHarga = 0; ?>
                                    <?php foreach ($spareparts as $sparepart) : ?>
                                        <?php
                                        $qty = $sparepart['qty'];
                                        $harga = $sparepart['harga'];
                                        // Hitung total harga per item
                                        $totalHargaPerItem = $harga * $qty;
                                        ?>
                                        <tr>
                                            <td><?= $index++ ?></td>
                                            <td><?= esc($sparepart['nama_sparepart']) ?></td>
                                            <td><?= esc($sparepart['jenis_part']) ?></td>
                                            <td><?= esc($qty) ?></td>
                                            <td><?= number_format($totalHargaPerItem, 0, ',', '.') ?></td>
                                            <td><?= esc($sparepart['kode_pengerjaan']) ?></td>
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
                                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                        <td><strong><?= $totalQty ?></strong></td>
                                        <td><strong><?= number_format($totalHarga, 0, ',', '.') ?></strong></td>
                                        <td colspan="8"></td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data sparepart</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

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
                        <?php if (!empty($pengerjaan)) : ?>
                            <?php foreach ($pengerjaan as $p) : ?>
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
                            <?php if (!empty($spareparts)) : ?>
                                <?php foreach ($spareparts as $sparepart) : ?>
                                    <tr data-id="<?= isset($sparepart['kode']) ? esc($sparepart['kode']) : 'N/A' ?>"
                                        data-nama="<?= isset($sparepart['nama']) ? esc($sparepart['nama']) : 'N/A' ?>"
                                        data-harga="<?= isset($sparepart['harga']) ? esc($sparepart['harga']) : 0 ?>">
                                        <td><?= isset($sparepart['kode']) ? esc($sparepart['kode']) : 'N/A' ?></td>
                                        <td><?= isset($sparepart['nama']) ? esc($sparepart['nama']) : 'N/A' ?></td>
                                        <td><?= isset($sparepart['harga']) ? number_format(esc($sparepart['harga']), 0, ',', '.') : '0' ?></td>
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
                const fileInput = document.getElementById('file-input');
                const dataTransfer = new DataTransfer();
                Array.from(fileInput.files).forEach(f => dataTransfer.items.add(f));
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
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

<?= $this->endSection() ?>