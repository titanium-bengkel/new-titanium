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
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/material_jasa') ?>" class="breadcrumb-link text-primary fw-bold">List Repair Jasa</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Repair Jasa</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Repair Jasa</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('createRepairJasa') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_jasa">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_jasa" name="id_jasa" class="form-control form-control-sm" value="<?= $generateId ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>

                        <h5>Data Order</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_ro">No. Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_ro" class="form-control form-control-sm" name="no_ro">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal_masuk">Tgl. Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal_masuk" class="form-control form-control-sm" name="tanggal_masuk" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_rangka">No. Rangka</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_rangka" class="form-control form-control-sm" name="no_rangka">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Car Model</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="warna" class="form-control form-control-sm" name="warna">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun">Tahun</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun" class="form-control form-control-sm" name="tahun">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Nama Pelanggan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea type="text" id="keterangan" class="form-control form-control-sm" rows="1" name="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('material_jasa'); ?>" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->


<div class="modal fade text-left" id="repair" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="myModalLabel2">Data Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-input">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-input" class="form-control" placeholder="Cari berdasarkan No. Order, Nopol, atau Model Mobil">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="repair-table">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>No.Order</th>
                                <th>Tgl. Masuk</th>
                                <th>Car Model</th>
                                <th>Nopol</th>
                                <th>No. Rangka</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($ro)) : ?>
                                <?php foreach ($ro as $data) : ?>
                                    <?php
                                    $dataArray = (array)$data;
                                    ?>
                                    <tr data-pemilik="<?= $dataArray['customer_name'] ?>">
                                        <td><?= $dataArray['id_terima_po'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($dataArray['tgl_masuk'])) ?></td>
                                        <td><?= $dataArray['jenis_mobil'] ?></td>
                                        <td><?= $dataArray['no_kendaraan'] ?></td>
                                        <td><?= $dataArray['no_rangka'] ?></td>
                                        <td><?= $dataArray['warna'] ?></td>
                                        <td><?= $dataArray['tahun_kendaraan'] ?></td>
                                        <td><?= $dataArray['asuransi'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light"></div>
        </div>
    </div>
</div>


<!-- modal detail barang -->
<div class="modal fade" id="kodeBarangModal" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Cari Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-barang" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-barang" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td colspan="2">Data supplier tidak tersedia.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tanggal').value = todayString;
        // document.getElementById('tanggal_masuk').value = todayString;
    });
</script>

<!-- Search Data Order -->
<script>
    document.getElementById("search-input").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#repair-table tbody tr");

        rows.forEach(function(row) {
            let cells = row.querySelectorAll("td");
            let text = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
            if (text.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
</script>


<!-- tabel skrip -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#repair tbody tr').on('click', function() {
            var customerName = $(this).data('pemilik');
            var noOrder = $(this).find('td:eq(0)').text();
            var tgl_masuk = $(this).find('td:eq(1)').text();
            var jenisMobil = $(this).find('td:eq(2)').text();
            var nopol = $(this).find('td:eq(3)').text();
            var noRangka = $(this).find('td:eq(4)').text();
            var warna = $(this).find('td:eq(5)').text();
            var tahun = $(this).find('td:eq(6)').text();
            var asuransi = $(this).find('td:eq(7)').text();
            var parts = tgl_masuk.split('-');
            var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];
            $('#no_ro').val(noOrder);
            $('#tanggal_masuk').val(formattedDate);
            $('#jenis_mobil').val(jenisMobil);
            $('#nopol').val(nopol);
            $('#no_rangka').val(noRangka);
            $('#warna').val(warna);
            $('#tahun').val(tahun);
            $('#asuransi').val(asuransi);
            $('#nama_pemilik').val(customerName);
            $('#repair').modal('hide');
        });
    });
</script>





<?= $this->endSection() ?>