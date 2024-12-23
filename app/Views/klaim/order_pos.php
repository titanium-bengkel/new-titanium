<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/klaim/preorder') ?>" class="breadcrumb-link text-primary fw-bold">Pre Order</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Pre Order</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Pre Order</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('preorder/create') ?>" method="post">
                        <input type="hidden" name="id_po" value="<?= $idPo ?>">
                        <?= csrf_field() ?>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label">Cabang</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3 d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input type="radio" id="bengkel-titanium" name="bengkel" value="Titanium" class="form-check-input" checked>
                                    <label class="form-check-label" for="bengkel-titanium">Titanium</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="radio" id="bengkel-tandem" name="bengkel" value="Tandem" class="form-check-input">
                                    <label class="form-check-label" for="bengkel-tandem">Tandem</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="radio" id="bengkel-k3karoseri" name="bengkel" value="K3 Karoseri" class="form-check-input">
                                    <label class="form-check-label" for="bengkel-k3karoseri">K3 Karoseri</label>
                                </div>
                                <div class="form-check me-3">
                                    <input type="radio" id="bengkel-vortex" name="bengkel" value="Vortex" class="form-check-input">
                                    <label class="form-check-label" for="bengkel-vortex">Vortex</label>
                                </div>
                                <!-- Inputan Tanggal dan Jam -->
                                <div class="d-flex ms-auto">
                                    <input type="date" id="tanggal" class="form-control me-2" name="tanggal_klaim" style="max-width: 180px;">
                                    <input type="time" id="jam" name="jam_klaim" class="form-control" style="max-width: 120px;">
                                </div>
                            </div>
                            <hr>

                            <h5 class="text-center mb-3">Data Kendaraan</h5>

                            <!-- Pre-Order ID -->
                            <div class=" col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="pre-order-id">No. Order</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="pre-order-id" class="form-control" name="pre-order-id" value="<?= $preOrderId ?>" readonly>
                            </div>

                            <!-- No. Kendaraan -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-kendaraan">Nopol</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no-kendaraan" class="form-control" name="no-kendaraan">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#kendaraanModal">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <!-- No Rangka -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-rangka">No. Rangka</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-rangka" class="form-control" name="no_rangka">
                            </div>

                            <!-- Jenis Mobil -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis-mobil">Car Model</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#jenisMobilModal">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <!-- Warna -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="warna" class="form-control" name="warna">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#warnaModal">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                            <!-- Tahun Kendaraan -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun-kendaraan">Tahun</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun-kendaraan" class="form-control" name="tahun-kendaraan">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="panel">Panel</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="panel" class="form-control" name="panel">
                            </div>
                        </div>
                        <hr>
                        <h5 class="text-center mb-3">Data Customer</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="customer-name">Customer Name</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="customer-name" class="form-control" name="customer-name" required>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-contact">No. Contact</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-contact" class="form-control" name="no-contact">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="alamat" class="form-control" name="alamat" required>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="kota">Kota</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="kota" class="form-control" name="kota" required>
                            </div>
                        </div>
                        <hr>
                        <h5 class="text-center mb-3">Data Asuransi</h5>
                        <?php
                        $asuransi = isset($_POST['asuransi']) ? trim($_POST['asuransi']) : '';
                        $hideNoPolis = (strtolower($asuransi) === 'Umum/Pribadi');
                        ?>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-2">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-2">
                                <input type="text" id="asuransi" class="form-control" name="asuransi" readonly>
                            </div>
                            <div class="col-lg-1 col-2 mb-2">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#asur">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row align-items-center" id="form-group-no-polis">
                            <div class="col-lg-2 col-3 mb-2">
                                <label class="col-form-label" for="no-polis">No. Polis</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-2">
                                <input type="text" id="no-polis" class="form-control" name="no-polis">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-2">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-2">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Status Order</label>
                            </div>
                            <div class="col-lg-2 col-4 mb-2">
                                <fieldset class="form-group">
                                    <select class="form-select" id="basicSelect">
                                        <option>Pre-Order</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <h5>Checklist Proses Klaim</h5>
                        <div class="col-lg-12 col-9 mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="proses-klaim" name="progres" value="Proses Klaim" <?= (isset($po['progres']) && $po['progres'] == 'Proses Klaim') ? 'checked' : '' ?> checked>
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
                        <!-- <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('klaim/preorder') ?>" type="button" class="btn btn-danger">Batal</a>
                        </div> -->

                        <div class="mt-3">
                            <form id="myForm" action="/submit" method="post">
                                <button type="button" id="btnSimpan" class="btn btn-primary" onclick="flyButton()">Simpan</button>
                                <a href="<?= base_url('klaim/preorder') ?>" type="button" class="btn btn-danger">Batal</a>
                            </form>
                        </div>

                        <style>
                            /* Gaya dasar tombol */
                            #btnSimpan {
                                position: relative;
                                /* Untuk memulai animasi */
                                transition: transform 0.2s ease-in-out;
                                z-index: 9999;
                                /* Agar tombol terlihat di atas elemen lainnya */
                            }

                            /* Gaya untuk animasi saat terbang */
                            .flying {
                                animation: fly-around-page 10s ease-in-out;
                                pointer-events: none;
                                /* Mencegah interaksi selama animasi */
                            }

                            /* Keyframes untuk animasi terbang keliling halaman */
                            @keyframes fly-around-page {
                                0% {
                                    transform: translate(0, 0);
                                }

                                10% {
                                    transform: translate(100vw, -10vh) rotate(45deg);
                                }

                                30% {
                                    transform: translate(70vw, 60vh) rotate(90deg);
                                }

                                50% {
                                    transform: translate(-80vw, -40vh) rotate(180deg);
                                }

                                70% {
                                    transform: translate(-20vw, 80vh) rotate(270deg);
                                }

                                90% {
                                    transform: translate(0vw, -100vh) rotate(360deg);
                                }

                                100% {
                                    transform: translate(0, 0);
                                    /* Kembali ke posisi awal */
                                }
                            }
                        </style>

                        <script>
                            let hasFlown = false; // Variabel untuk memastikan animasi hanya terjadi sekali

                            function flyButton() {
                                const button = document.getElementById('btnSimpan');
                                const form = document.getElementById('myForm');

                                if (hasFlown) {
                                    // Jika animasi sudah selesai sebelumnya, ubah tombol jadi submit
                                    button.setAttribute("type", "submit");
                                    form.submit(); // Kirim form
                                    return;
                                }

                                // Nonaktifkan tombol selama animasi
                                button.disabled = true;

                                // Tambahkan kelas "flying" untuk animasi
                                button.classList.add('flying');

                                // Set variabel "hasFlown" menjadi true agar tidak terbang lagi
                                hasFlown = true;

                                // Hapus kelas setelah animasi selesai agar tombol bisa digunakan untuk submit
                                setTimeout(() => {
                                    button.classList.remove('flying');
                                    button.disabled = false; // Aktifkan tombol kembali
                                    button.setAttribute("type", "submit"); // Ubah tombol menjadi submit
                                }, 10000); // Durasi sesuai waktu animasi (10 detik)
                            }
                        </script>


                    </form>
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
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4 mt-1">
                        <label for="search-input">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-input" class="form-control form-control-sm" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Qty Stock</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
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
                        <input type="file" id="file-input" name="gambar[]" class="d-none" multiple accept=".jpg, .jpeg, .png, .svg">
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

        Array.from(files).forEach(file => {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            const fileMimeType = file.type;

            console.log(`File Name: ${file.name}`);
            console.log(`File Extension: ${fileExtension}`);
            console.log(`File MIME Type: ${fileMimeType}`);

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
                    <input type="file" name="gambar[]" accept=".jpg, .jpeg, .png, .svg" disabled>
                    <p>${file.name}</p>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                </td>
            </tr>`;
                tableBody.insertAdjacentHTML('beforeend', newRow);
            } else {
                alert('Format file tidak diizinkan: ' + file.name);
            }
        });

        // Fungsi untuk menghapus baris
        document.querySelectorAll('.remove-row').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });
    }
</script>


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
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>Nopol</th>
                            <th>Customer</th>
                            <th>No. Contact</th>
                        </tr>
                    </thead>
                    <tbody id="kendaraan-list">
                        <?php if (!empty($kendaraan)) : ?>
                            <?php foreach ($kendaraan as $k) : ?>
                                <tr data-no-kendaraan="<?= $k['no_kendaraan'] ?>" data-customer="<?= $k['customer_name'] ?>" data-no-contact="<?= $k['no_contact'] ?>" style="display: none;">
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
                <table class="table table-bordered table-hover text-center align-middle">
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
                                <tr data-jenis-mobil="<?= $j['jenis_mobil'] ?>" style="display: none;">
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
                <table class="table table-bordered table-hover text-center align-middle">
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
                                <tr data-warna="<?= $w['warna'] ?>" style="display: none;">
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
                        <?php if (isset($asuransiData) && !empty($asuransiData)) : ?>
                            <?php foreach ($asuransiData as $a) : ?>
                                <tr class="clickable-row" data-kode="<?= htmlspecialchars($a->kode, ENT_QUOTES, 'UTF-8') ?>" data-nama="<?= htmlspecialchars($a->nama_asuransi, ENT_QUOTES, 'UTF-8') ?>">
                                    <td><?= htmlspecialchars($a->kode, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($a->nama_asuransi, ENT_QUOTES, 'UTF-8') ?></td>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Get the search input and the table body
        const searchInput = document.getElementById('search-asuransi');
        const tableRows = document.querySelectorAll('#asuransi-list .clickable-row');

        // Add event listener to the search input
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();

            // Loop through all table rows
            tableRows.forEach(row => {
                // Get the content of the kode and nama columns
                const kode = row.getAttribute('data-kode').toLowerCase();
                const nama = row.getAttribute('data-nama').toLowerCase();

                // Check if the filter matches either kode or nama
                if (kode.includes(filter) || nama.includes(filter)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Search functionality for Pengerjaan
    function searchPengerjaan() {
        const searchInput = document.getElementById('searchInput');
        const searchTerm = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('#pengerjaan-list tr');

        rows.forEach(row => {
            const kode = row.getAttribute('data-kode').toLowerCase();
            const nama = row.getAttribute('data-nama').toLowerCase();
            row.style.display = (kode.includes(searchTerm) || nama.includes(searchTerm)) ? '' : 'none';
        });
    }

    // Show toast function
    function showToast(type, message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }

    // Function to check Asuransi and toggle No Polis visibility
    function checkAsuransi() {
        const asuransiNama = document.getElementById('asuransi').value.trim().toLowerCase();
        const noPolisGroups = document.querySelectorAll('.no-polis-group');
        noPolisGroups.forEach(group => {
            group.style.display = (asuransiNama === 'umum/pribadi') ? 'none' : 'flex';
        });
    }

    // Function to open date picker
    function openDatepicker(element) {
        element.showPicker();
    }

    // Event listeners on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Pengerjaan table row click
        const tableBody = document.getElementById('pengerjaan-list');
        if (tableBody) {
            tableBody.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const kode = target.getAttribute('data-kode');
                    const nama = target.getAttribute('data-nama');
                    document.getElementById('kodePengerjaan').value = kode;
                    document.getElementById('pengerjaan').value = nama;
                    const modal = bootstrap.Modal.getInstance(document.getElementById('pengerjaanModal'));
                    modal.hide();
                }
            });
        }

        // Kendaraan table row click
        const kendaraanList = document.getElementById('kendaraan-list');
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
                    $('#kendaraanModal').modal('hide');
                }
            });
        }

        // Jenis Mobil search and select
        const jenisMobilList = document.getElementById('jenis-mobil-list');
        const searchJenisMobil = document.getElementById('searchJenisMobil');
        if (jenisMobilList && searchJenisMobil) {
            searchJenisMobil.addEventListener('input', function() {
                const filter = searchJenisMobil.value.toLowerCase();
                const rows = jenisMobilList.getElementsByTagName('tr');
                Array.from(rows).forEach(row => {
                    const jenisMobil = row.getAttribute('data-jenis-mobil').toLowerCase();
                    row.style.display = jenisMobil.includes(filter) ? '' : 'none';
                });
            });
            jenisMobilList.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const jenisMobil = target.getAttribute('data-jenis-mobil');
                    document.getElementById('jenis-mobil').value = jenisMobil;
                    $('#jenisMobilModal').modal('hide');
                }
            });
        }

        // Warna search and select
        const warnaList = document.getElementById('warna-list');
        const searchWarna = document.getElementById('searchWarna');
        if (warnaList && searchWarna) {
            searchWarna.addEventListener('input', function() {
                const filter = searchWarna.value.toLowerCase();
                const rows = warnaList.getElementsByTagName('tr');
                Array.from(rows).forEach(row => {
                    const warna = row.getAttribute('data-warna').toLowerCase();
                    row.style.display = warna.includes(filter) ? '' : 'none';
                });
            });
            warnaList.addEventListener('click', function(e) {
                const target = e.target.closest('tr');
                if (target) {
                    const warna = target.getAttribute('data-warna');
                    document.getElementById('warna').value = warna;
                    $('#warnaModal').modal('hide');
                }
            });
        }


        // Asuransi row click handling
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                const kode = this.getAttribute('data-kode');
                const nama = this.getAttribute('data-nama');
                document.getElementById('asuransi').value = nama;
                const noPolisGroup = document.getElementById('form-group-no-polis');
                if (nama.toLowerCase() === 'umum/pribadi') {
                    noPolisGroup.classList.add('d-none');
                } else {
                    noPolisGroup.classList.remove('d-none');
                }
                const modal = bootstrap.Modal.getInstance(document.getElementById('asur'));
                modal.hide();
            });
        });

        // Check Asuransi on page load
        checkAsuransi();

        // Asuransi input change
        document.getElementById('asuransi').addEventListener('input', checkAsuransi);

        // Pengerjaan form submit validation
        document.getElementById('pengerjaanForm').addEventListener('submit', function(event) {
            const kodePengerjaan = document.getElementById('kodePengerjaan').value;
            const pengerjaan = document.getElementById('pengerjaan').value;
            const harga = document.getElementById('harga').value;
            if (!kodePengerjaan || !pengerjaan || !harga) {
                event.preventDefault();
                showToast('error', 'Harap isi semua data yang diperlukan.');
            }
        });

        // Sparepart form submit validation
        document.getElementById('sparepartForm').addEventListener('submit', function(event) {
            event.preventDefault();
            showToast('error', 'Harap isi semua data yang diperlukan.');
        });

        // Upload button validation
        document.getElementById('uploadButton').addEventListener('click', function() {
            const keterangan = document.getElementById('keterangan').value;
            const deskripsi = document.getElementById('deskripsi').value;
            const gambarFile = document.getElementById('gambar').files.length;
            if (!keterangan || !deskripsi || gambarFile === 0) {
                showToast('Harap isi semua data yang diperlukan.');
            } else {
                const modal = new bootstrap.Modal(document.getElementById('gambar'));
                modal.show();
            }
        });

        // Initialize toast function for flash messages
        <?php if (session()->getFlashdata('error')) : ?>
            showToast('error', '<?= session()->getFlashdata('error') ?>');
        <?php elseif (session()->getFlashdata('success')) : ?>
            showToast('success', '<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>
    });
    // Event listener ketika modal kendaraan dibuka
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-kendaraan');
        const kendaraanList = document.getElementById('kendaraan-list');
        const rows = kendaraanList.getElementsByTagName('tr');

        // Sembunyikan semua data saat modal dibuka
        $('#kendaraanModal').on('shown.bs.modal', function() {
            Array.from(rows).forEach(function(row) {
                row.style.display = 'none'; // Sembunyikan setiap baris
            });
        });

        // Fungsi untuk filter data berdasarkan input pencarian
        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();

            // Tampilkan baris yang sesuai dengan pencarian
            Array.from(rows).forEach(function(row) {
                const noKendaraan = row.getAttribute('data-no-kendaraan').toLowerCase();
                const customer = row.getAttribute('data-customer').toLowerCase();
                const noContact = row.getAttribute('data-no-contact').toLowerCase();

                // Periksa apakah input sesuai dengan No. Kendaraan, Customer, atau No. Contact
                if (noKendaraan.includes(filter) || customer.includes(filter) || noContact.includes(filter)) {
                    row.style.display = ''; // Tampilkan baris yang cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
                }
            });
        });
    });
    // Event listener ketika modal jenis mobil dibuka
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputJenisMobil = document.getElementById('searchJenisMobil');
        const jenisMobilList = document.getElementById('jenis-mobil-list');
        const rowsJenisMobil = jenisMobilList.getElementsByTagName('tr');

        // Sembunyikan semua data saat modal dibuka
        $('#jenisMobilModal').on('shown.bs.modal', function() {
            Array.from(rowsJenisMobil).forEach(function(row) {
                row.style.display = 'none'; // Sembunyikan setiap baris
            });
        });

        // Fungsi untuk filter data berdasarkan input pencarian
        searchInputJenisMobil.addEventListener('input', function() {
            const filter = searchInputJenisMobil.value.toLowerCase();

            // Tampilkan baris yang sesuai dengan pencarian
            Array.from(rowsJenisMobil).forEach(function(row) {
                const jenisMobil = row.getAttribute('data-jenis-mobil').toLowerCase();

                // Periksa apakah input sesuai dengan Jenis Mobil
                if (jenisMobil.includes(filter)) {
                    row.style.display = ''; // Tampilkan baris yang cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
                }
            });
        });
    });
    // Event listener ketika modal warna dibuka
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputWarna = document.getElementById('searchWarna');
        const warnaList = document.getElementById('warna-list');
        const rowsWarna = warnaList.getElementsByTagName('tr');

        // Sembunyikan semua data saat modal dibuka
        $('#warnaModal').on('shown.bs.modal', function() {
            Array.from(rowsWarna).forEach(function(row) {
                row.style.display = 'none'; // Sembunyikan setiap baris
            });
        });

        // Fungsi untuk filter data berdasarkan input pencarian
        searchInputWarna.addEventListener('input', function() {
            const filter = searchInputWarna.value.toLowerCase();

            // Tampilkan baris yang sesuai dengan pencarian
            Array.from(rowsWarna).forEach(function(row) {
                const warna = row.getAttribute('data-warna').toLowerCase();

                // Periksa apakah input sesuai dengan warna
                if (warna.includes(filter)) {
                    row.style.display = ''; // Tampilkan baris yang cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
                }
            });
        });
    });
    // Event listener ketika modal asuransi dibuka
    $('#asur').on('shown.bs.modal', function() {
        const rows = document.querySelectorAll('#asuransi-list tr');
        Array.from(rows).forEach(row => {
            row.style.display = 'none'; // Sembunyikan setiap baris saat modal dibuka
        });
    });

    // Fungsi untuk filter data berdasarkan input pencarian
    document.getElementById('search-asuransi').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#asuransi-list tr');

        // Tampilkan baris yang sesuai dengan pencarian
        Array.from(rows).forEach(function(row) {
            const kode = row.getAttribute('data-kode').toLowerCase();
            const nama = row.getAttribute('data-nama').toLowerCase();

            // Periksa apakah input sesuai dengan Kode atau Nama Asuransi
            if (kode.includes(filter) || nama.includes(filter)) {
                row.style.display = ''; // Tampilkan baris yang cocok
            } else {
                row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
            }
        });
    });

    // Event listener untuk baris yang dapat diklik
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function() {
            const kode = this.getAttribute('data-kode');
            const nama = this.getAttribute('data-nama');
            document.getElementById('asuransi').value = nama; // Ganti dengan ID input yang sesuai
            const modal = bootstrap.Modal.getInstance(document.getElementById('asur'));
            modal.hide();
        });
    });
</script>


<!-- jam dan Tanggal -->

<script>
    // Fungsi untuk mengatur tanggal dan waktu otomatis
    window.onload = function() {
        // Menentukan tanggal hari ini dalam format yyyy-mm-dd
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        var yyyy = today.getFullYear();
        var dateString = yyyy + '-' + mm + '-' + dd;

        // Menetapkan nilai tanggal pada inputan
        document.getElementById("tanggal").value = dateString;

        // Menentukan waktu saat ini dalam format hh:mm
        var hh = String(today.getHours()).padStart(2, '0');
        var min = String(today.getMinutes()).padStart(2, '0');
        var timeString = hh + ':' + min;

        // Menetapkan nilai waktu pada inputan
        document.getElementById("jam").value = timeString;
    }
</script>

<?= $this->endSection() ?>