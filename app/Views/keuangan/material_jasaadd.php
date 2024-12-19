<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div style="margin-top: 15px; margin-bottom: 10px; font-size: 12px; padding: 10px 20px; border-radius: 8px; display: inline-block;">
        <div style="font-size: 14px; font-weight: bold;">
            <a href="<?= base_url('material_jasa') ?>" style="text-decoration: none; color: #007bff;">Repair Material jasa</a>
            <span style="color: #6c757d; margin: 0 8px;">/</span>
            <span style="color: #6c757d; font-weight: 500;">Repair Material Jasa</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="ms-3 mb-3 mt-4" style="border-bottom: 2px solid #6c757d; padding-bottom: 10px;">
                    <h5> Add Repair Material Jasa</h5>
                </header>
                <div class="card-body">
                    <!-- Tambahkan form action -->
                    <form action="<?= base_url('createRepairJasa') ?>" method="post">
                        <h6>ID</h6>
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

                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_ro">No. Repair Order</label>
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
                                <label class="col-form-label" for="tanggal_masuk">Tanggal Masuk</label>
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
                                <label class="col-form-label" for="jenis_mobil">Jenis mobil</label>
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
                                <label class="col-form-label" for="nama_pemilik">Pemilik</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('material_jasa'); ?>" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                    <!-- Akhir dari form action -->
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
                            <?php if (!empty($po)) : ?>
                                <?php foreach ($po as $data) : ?>
                                    <tr data-pemilik="<?= $data->customer_name ?>">
                                        <td><?= $data->id_terima_po ?></td>
                                        <td><?= date('d-m-Y', strtotime($data->tgl_klaim)) ?></td>
                                        <td><?= $data->jenis_mobil ?></td>
                                        <td><?= $data->no_kendaraan ?></td>
                                        <td><?= $data->warna ?></td>
                                        <td><?= $data->tahun_kendaraan ?></td>
                                        <td><?= $data->asuransi ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">Data PO tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
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


<!-- tabel skrip -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

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
            $('#nopol').val(nopol);
            $('#warna').val(warna);
            $('#tahun').val(tahun);
            $('#asuransi').val(asuransi);
            $('#nama_pemilik').val(customerName); // Isi nama pemilik ke input field

            // Tutup modal
            $('#repair').modal('hide');
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const repairMaterialDetail = document.getElementById("repair_material_detail");
        const totalQtyB = document.getElementById("total-qtyB");
        const totalQtyT = document.getElementById("total-qtyT");
        const totalQtyK = document.getElementById("total-qtyK");
        const totalHpp = document.getElementById("total-hpp");

        function calculateTotals() {
            let sumQtyB = 0;
            let sumQtyT = 0;
            let sumQtyK = 0;
            let sumHpp = 0;

            repairMaterialDetail.querySelectorAll("tr").forEach(function(row) {
                const qtyB = parseFloat(row.querySelector("input[name='qty_B[]']").value) || 0;
                const qtyT = parseFloat(row.querySelector("input[name='qty_T[]']").value) || 0;
                const qtyK = parseFloat(row.querySelector("input[name='qty_K[]']").value) || 0;
                const hpp = parseFloat(row.querySelector("input[name='hpp[]']").value) || 0;

                sumQtyB += qtyB;
                sumQtyT += qtyT;
                sumQtyK += qtyK;
                sumHpp += hpp;
            });

            totalQtyB.value = sumQtyB.toFixed(0);
            totalQtyT.value = sumQtyT.toFixed(0);
            totalQtyK.value = sumQtyK.toFixed(0);
            totalHpp.value = sumHpp.toFixed(0);
        }

        // Event listener untuk perubahan nilai QtyB, QtyT, QtyK, dan HPP
        repairMaterialDetail.addEventListener("input", function(event) {
            if (event.target.matches("input[name='qty_B[]'], input[name='qty_T[]'], input[name='qty_K[]'], input[name='hpp[]']")) {
                calculateTotals();
            }
        });

        // Event listener untuk tombol hapus baris
        repairMaterialDetail.addEventListener("click", function(event) {
            if (event.target.matches(".remove-row")) {
                event.target.closest("tr").remove();
                calculateTotals(); // Update totals after removing a row
            }
        });

        // Checkbox "Pilih All"
        document.getElementById("pilih-all").addEventListener("change", function() {
            const isChecked = this.checked;
            document.querySelectorAll(".pilih-checkbox").forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });
    });
</script>




<?= $this->endSection() ?>