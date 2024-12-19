<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div style="margin-top: 15px; margin-bottom: 10px; font-size: 12px; padding: 10px 20px; border-radius: 8px; display: inline-block;">
        <div style="font-size: 14px; font-weight: bold;">
            <a href="<?= base_url('material_jasa') ?>" style="text-decoration: none; color: #007bff;">Repair Material Jasa</a>
            <span style="color: #6c757d; margin: 0 8px;">/</span>
            <span style="color: #6c757d; font-weight: 500;">Repair Material Jasa</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="ms-3 mb-3 mt-4" style="border-bottom: 2px solid #6c757d; padding-bottom: 10px;">
                    <h5> Repair Material Jasa</h5>
                </header>
                <div class="card-body">
                    <!-- Tambahkan form action -->
                    <form action="<?= base_url('update_rmjasa') ?>" method="post">
                        <h6>ID</h6>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_jasa">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_jasa" name="id_jasa" class="form-control form-control-sm" value="<?= $jasa['id_jasa'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" onkeydown="return false" onclick="this.showPicker()" value="<?= $jasa['tanggal'] ?>">
                            </div>
                        </div>

                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_ro">No. Repair Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_ro" class="form-control form-control-sm" name="no_ro" value="<?= $jasa['no_ro'] ?>">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal_masuk">Tanggal Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal_masuk" class="form-control form-control-sm" name="tanggal_masuk" onkeydown="return false" onclick="this.showPicker()" value="<?= $jasa['tanggal_masuk'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol" value="<?= $jasa['nopol'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Jenis mobil</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil" value="<?= $jasa['jenis_mobil'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="warna" class="form-control form-control-sm" name="warna" value="<?= $jasa['warna'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun">Tahun</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun" class="form-control form-control-sm" name="tahun" value="<?= $jasa['tahun'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Pemilik</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik" value="<?= $jasa['nama_pemilik'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan" value="<?= $jasa['keterangan'] ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3 mb-2">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary btn-sm">update</button>
                                <a href="<?= base_url('material_jasa'); ?>" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <hr>
                    <button type="button" class="btn btn-success btn-sm mt-3" id="toggleAccordionBtn">
                        <i class="fas fa-plus"></i> Add Jasa
                    </button>
                    <div class="accordion mt-2">
                        <div id="accordionForm" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <form action="<?= base_url('updateOrCreateJasa'); ?>" method="post">
                                    <input type="text" class="form-control form-control-sm" id="id_jasa" name="id_jasa" value="<?= $jasa['id_jasa'] ?>" readonly hidden>
                                    <!-- Baris untuk Kode Jasa -->
                                    <div class="form-group row align-items-center mb-2">
                                        <div class="col-lg-2 col-3">
                                            <label for="kode_jasa" class="col-form-label">Kode Jasa</label>
                                        </div>
                                        <div class="col-lg-8 col-7">
                                            <input type="text" class="form-control form-control-sm" id="kode_jasa" name="kode_jasa" value="" readonly>
                                        </div>
                                        <div class="col-lg-2 col-2">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#jasa">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mb-2">
                                        <div class="col-lg-2 col-3">
                                            <label for="nama_jasa" class="col-form-label">Nama Jasa</label>
                                        </div>
                                        <div class="col-lg-10 col-9">
                                            <input type="text" class="form-control form-control-sm" id="nama_jasa" name="nama_jasa">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mb-2">
                                        <div class="col-lg-2 col-3">
                                            <label for="harga" class="col-form-label">Harga</label>
                                        </div>
                                        <div class="col-lg-10 col-9">
                                            <input type="text" class="form-control form-control-sm" id="harga" name="harga">
                                        </div>
                                    </div>
                                    <div class="form-group row align-items-center mb-2">
                                        <div class="col-lg-2 col-3">
                                            <label for="jenis_bayar" class="col-form-label">Jenis Bayar</label>
                                        </div>
                                        <div class="col-lg-10 col-9">
                                            <input type="text" class="form-control form-control-sm" id="jenis_bayar" name="jenis_bayar">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-3">Simpan</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered my-table-class">
                            <thead>

                                <tr>
                                    <th>Kode Jasa</th>
                                    <th>Jasa</th>
                                    <th>Harga</th>
                                    <th>Jenis Bayar</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="detail-opra">
                                <?php if (!empty($detailjasa)): ?>
                                    <?php foreach ($detailjasa as $index => $data): ?>
                                        <tr>
                                            <td><?= $data['kode_jasa'] ?></td>
                                            <td><?= $data['nama_jasa'] ?></td>
                                            <td><?= $data['harga'] ?></td>
                                            <td><?= $data['jenis_bayar'] ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">Data tidak ditemukan</td>
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



<!-- Modal Repair Order -->
<div class="modal fade text-left" id="repair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-input">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-input" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.Order</th>
                                <th>tanggal</th>
                                <th>Type mobil</th>
                                <th>Nopol</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">Data PO tidak tersedia.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal detail barang -->
<div class="modal fade" id="jasa" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                    <table class="table table-bordered table-hover" id="table-jasa">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Jasa</th>
                                <th>Alokasi Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($masterjasa)): ?>
                                <?php foreach ($masterjasa as $index => $data): ?>
                                    <tr class="select-row" data-kode="<?= $data['kode'] ?>" data-nama="<?= $data['nama_jasa'] ?>" data-bayar="<?= $data['kode_biaya'] ?>">
                                        <td><?= $data['kode'] ?></td>
                                        <td><?= $data['nama_jasa'] ?></td>
                                        <td><?= $data['kode_biaya'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Card 2: Tabel Invoice





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


<!-- tabel skrip -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('toggleAccordionBtn').addEventListener('click', function() {
        var accordionForm = document.getElementById('accordionForm');
        if (accordionForm.classList.contains('show')) {
            accordionForm.classList.remove('show');
        } else {
            accordionForm.classList.add('show');
        }
    });

    // Menambahkan event listener ke semua baris tabel dalam modal
    $(document).ready(function() {
        // Fungsi untuk menangani klik pada baris tabel
        $('#repair tbody tr').on('click', function() {
            // Ambil data dari atribut data-pemilik
            var customerName = $(this).data('pemilik');

            // Ambil data dari kolom dalam baris yang diklik
            var noOrder = $(this).find('td:eq(0)').text();
            var tgl_masuk = $(this).find('td:eq(1)').text(); // Format dd-mm-yyyy
            var jenisMobil = $(this).find('td:eq(2)').text();
            var nopol = $(this).find('td:eq(3)').text();
            var warna = $(this).find('td:eq(4)').text();
            var tahun = $(this).find('td:eq(5)').text();
            var asuransi = $(this).find('td:eq(6)').text();

            // Konversi format tanggal dari dd-mm-yyyy menjadi yyyy-mm-dd
            var parts = tgl_masuk.split('-');
            var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0]; // yyyy-mm-dd

            // Isi data ke dalam input field
            $('#no_ro').val(noOrder);
            $('#tanggal_masuk').val(formattedDate); // Isi tanggal masuk dengan format yyyy-mm-dd
            $('#jenis_mobil').val(jenisMobil);
            $('#no_kendaraan').val(nopol);
            $('#warna').val(warna);
            $('#tahun').val(tahun);
            $('#asuransi').val(asuransi);
            $('#nama_pemilik').val(customerName); // Isi nama pemilik ke input field

            // Tutup modal
            $('#repair').modal('hide');
        });
    });


    // Menambahkan event listener pada setiap baris tabel
    document.querySelectorAll('#table-jasa .select-row').forEach(row => {
        row.addEventListener('click', function() {
            // Mengambil data dari atribut data pada baris yang diklik
            const kodeJasa = this.getAttribute('data-kode');
            const namaJasa = this.getAttribute('data-nama');
            const jenisBayar = this.getAttribute('data-bayar');

            // Mengisi nilai ke input form
            document.getElementById('kode_jasa').value = kodeJasa;
            document.getElementById('nama_jasa').value = namaJasa;
            document.getElementById('jenis_bayar').value = jenisBayar;

            // Menutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('jasa'));
            modal.hide();
        });
    });
</script>




<?= $this->endSection() ?>