<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>Repair Material </h3>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tambahkan form action -->
                    <form action="<?= base_url('/sparepart/createRepairpart') ?>" method="post">
                        <h6>ID</h6>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_material">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_material" name="id_material" class="form-control form-control-sm" value="<?= $generateIdrepair ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_keluar">Gudang Keluar</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG REPAIR</option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_masuk">Gudang Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="gudang_masuk" name="gudang_masuk" class="form-control form-control-sm">
                            </div>
                        </div>
                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <input type="text" id="asuransi" class="form-control form-control-sm" name="asuransi" hidden>
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
                        <button type="button" class="btn btn-success btn-sm mb-3" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-2 my-table-class">
                                <thead>
                                    <tr>
                                        <th>Kode barang</th>
                                        <th>Nama barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>HPP</th>
                                        <th>Nilai</th>
                                        <th>Pilih All <input type="checkbox" id="pilih-all" class="form-check-input"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="repair_material_detail">
                                    <tr>
                                        <td><input type="text" name="id_kode_barang[]" class="form-control form-control-sm" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>
                                        <td><input type="text" name="nama_barang[]" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="qty_B[]" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="sat_B[]" class="form-control form-control-sm"></td>
                                        <td><input type="text" name="hpp[]" class="form-control form-control-sm"></td>
                                        <td></td>
                                        <td><input type="checkbox" class="form-check-input pilih-checkbox"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><input type="text" class="form-control form-control-sm" id="total-qtyB" name="total_qty_B" readonly></td>
                                        <td></td>
                                        <!-- <td><input type="text" class="form-control form-control-sm" id="total-qtyT" name="total_qty_T" readonly></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-control-sm" id="total-qtyK" name="total_qty_K" readonly></td>
                                        <td></td> -->
                                        <td><input type="text" class="form-control form-control-sm" id="total-hpp" name="total_hpp" readonly></td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('repair_material_part'); ?>" class="btn btn-danger">Batal</a>
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
                            <?php if (!empty($barang)) : ?>
                                <?php foreach ($barang as $b) : ?>
                                    <tr data-satuan="<?= $b->satuan ?>">
                                        <td><?= $b->kode_part ?></td>
                                        <td><?= $b->nama_part ?></td>
                                        <td><?= $b->harga_beliawal ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">Data supplier tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
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
                                <th>No. Penerimaan</th>
                                <th>Tanggal</th>
                                <th>Type Mobil</th>
                                <th>Nopol</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penerimaan)) : ?>
                                <?php foreach ($penerimaan as $data) : ?>
                                    <tr
                                        data-pemilik="<?= $data['nama_pemilik'] ?>"
                                        data-gudang="<?= $data['gudang'] ?>"
                                        data-nopol="<?= $data['nopol'] ?>"
                                        data-jenis="<?= $data['jenis_mobil'] ?>"
                                        data-idKode="<?= $data['id_kode_barang'] ?>"
                                        data-namaBarang="<?= $data['nama_barang'] ?>"
                                        data-qty="<?= $data['qty'] ?>"
                                        data-satuan="<?= $data['satuan'] ?>"
                                        data-hpp="<?= $data['harga'] ?>"
                                        data-repair="<?= $data['no_repair_order'] ?>"
                                        data-Terima="<?= $data['id_penerimaan'] ?>"
                                        data-tgl_masuk="<?= $data['tgl_masuk'] ?>"
                                        data-warna="<?= $data['warna'] ?>"
                                        data-tahun_kendaraan="<?= $data['tahun_kendaraan'] ?>"
                                        data-asuransi="<?= $data['asuransi'] ?>">

                                        <td><?= $data['no_repair_order'] ?></td>
                                        <td><?= date('d-m-Y', strtotime($data['tgl_masuk'])) ?></td>
                                        <td><?= $data['jenis_mobil'] ?></td>
                                        <td><?= $data['nopol'] ?></td>
                                        <td><?= $data['warna'] ?></td>
                                        <td><?= $data['tahun_kendaraan'] ?? '-' ?></td> <!-- Data ini tidak ada di penerimaan -->
                                        <td><?= $data['asuransi'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">Data penerimaan tidak tersedia.</td>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tanggal').value = todayString;
    });
</script>


<!-- tabel skrip -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var selectedRow; // Variabel untuk menyimpan baris yang dipilih

        // Menambahkan baris baru ke dalam tabel
        $('#add-row-btn').click(function() {
            var row = '<tr>' +
                '<td><input type="text" name="id_kode_barang[]" class="form-control form-control-sm" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>' +
                '<td><input type="text" name="nama_barang[]" class="form-control form-control-sm"></td>' +
                '<td><input type="text" name="qty_B[]" class="form-control form-control-sm"></td>' +
                '<td><input type="text" name="sat_B[]" class="form-control form-control-sm"></td>' +
                '<td><input type="text" name="hpp[]" class="form-control form-control-sm"></td>' +
                '<td></td>' +
                '<td><input type="checkbox" class="form-check-input pilih-checkbox"></td>' +
                '<td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button></td>' +
                '</tr>';
            $('#repair_material_detail').append(row);
        });

        // Menghapus baris dari tabel
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });

        // Menyimpan referensi ke baris yang dipilih untuk dimasukkan data dari modal
        $(document).on('click', 'input[data-bs-toggle="modal"]', function() {
            selectedRow = $(this).closest('tr');
        });

        // Mengisi data dari modal ke baris tabel yang dipilih
        $('#kodeBarangModal').on('click', 'tbody tr', function() {
            var kode = $(this).find('td:eq(0)').text();
            var nama = $(this).find('td:eq(1)').text();
            var harga = $(this).find('td:eq(2)').text(); // Perbaiki akses harga
            var satuan = $(this).data('satuan');


            // Mengisi data ke dalam input di baris yang dipilih
            selectedRow.find('input[name="id_kode_barang[]"]').val(kode);
            selectedRow.find('input[name="nama_barang[]"]').val(nama);
            selectedRow.find('input[name="hpp[]"]').val(harga);
            selectedRow.find('input[name="sat_B[]"]').val(satuan);

            $('#kodeBarangModal').modal('hide');
        });

        // Pilih semua checkbox
        $('#pilih-all').click(function() {
            $('.pilih-checkbox').prop('checked', this.checked);
        });
    });

    // Menambahkan event listener ke semua baris tabel dalam modal
    // $(document).ready(function() {
    //     // Fungsi untuk menangani klik pada baris tabel
    //     $('#repair tbody tr').on('click', function() {
    //         // Ambil data dari atribut data-pemilik
    //         var nama_pemilik = $(this).data('pemilik');
    //         var gudang = $(this).data('gudang');

    //         // Ambil data dari kolom dalam baris yang diklik
    //         var noOrder = $(this).find('td:eq(0)').text();
    //         var tgl_masuk = $(this).find('td:eq(1)').text(); // Format dd-mm-yyyy
    //         var jenisMobil = $(this).find('td:eq(2)').text();
    //         var nopol = $(this).find('td:eq(3)').text();
    //         var warna = $(this).find('td:eq(4)').text();
    //         var tahun = $(this).find('td:eq(5)').text();
    //         var asuransi = $(this).find('td:eq(6)').text();

    //         // Konversi format tanggal dari dd-mm-yyyy menjadi yyyy-mm-dd
    //         var parts = tgl_masuk.split('-');
    //         var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0]; // yyyy-mm-dd

    //         // Isi data ke dalam input field
    //         $('#no_ro').val(noOrder);
    //         $('#tanggal_masuk').val(formattedDate); // Isi tanggal masuk dengan format yyyy-mm-dd
    //         $('#jenis_mobil').val(jenisMobil);
    //         $('#nopol').val(nopol);
    //         $('#warna').val(warna);
    //         $('#tahun').val(tahun);
    //         $('#asuransi').val(asuransi);
    //         $('#nama_pemilik').val(nama_pemilik); // Isi nama pemilik ke input field
    //         $('#gudang_keluar').val(gudang);
    //         $('#gudang_masuk').val(gudang);

    //         // Tutup modal
    //         $('#repair').modal('hide');
    //     });
    // });

    document.querySelectorAll('#repair tbody tr').forEach(row => {
        row.addEventListener('click', () => {
            // Ambil modal dan data dari dataset baris
            const modal = document.querySelector('#repair');
            const dataPemilik = row.dataset.pemilik;
            const dataRepair = row.dataset.repair;
            const dataGudang = row.dataset.gudang;
            const dataNopol = row.dataset.nopol;
            const dataJenis = row.dataset.jenis;
            const dataIdKode = row.dataset.idkode;
            const dataNamaBarang = row.dataset.namabarang;
            const dataQty = row.dataset.qty;
            const dataSatuan = row.dataset.satuan;
            const dataHpp = row.dataset.hpp;
            const dataTglmasuk = row.dataset.tgl_masuk;
            const dataWarna = row.dataset.warna;
            const dataTahun = row.dataset.tahun_kendaraan;
            const dataAsuransi = row.dataset.asuransi;

            // Masukkan data ke form (jika diperlukan)
            document.querySelector('#no_ro').value = dataRepair;
            document.querySelector('#nama_pemilik').value = dataPemilik;
            document.querySelector('#gudang_masuk').value = dataGudang;
            document.querySelector('#gudang_keluar').value = dataGudang;
            document.querySelector('#nopol').value = dataNopol;
            document.querySelector('#tanggal_masuk').value = dataTglmasuk;
            document.querySelector('#warna').value = dataWarna;
            document.querySelector('#tahun').value = dataTahun;
            document.querySelector('#asuransi').value = dataAsuransi;
            document.querySelector('#jenis_mobil').value = dataJenis;

            // Tambahkan data ke tabel detail
            const tableBody = document.querySelector('#repair_material_detail');
            let rowUpdated = false;

            // Periksa apakah id_kode_barang sudah ada di tabel detail
            tableBody.querySelectorAll('tr').forEach(existingRow => {
                const existingIdKode = existingRow.querySelector('input[name="id_kode_barang[]"]').value;

                if (existingIdKode === dataIdKode) {
                    // Jika ditemukan, perbarui baris yang ada
                    existingRow.querySelector('input[name="nama_barang[]"]').value = dataNamaBarang;
                    existingRow.querySelector('input[name="qty[]"]').value = parseInt(existingRow.querySelector('input[name="qty[]"]').value) + parseInt(dataQty);
                    existingRow.querySelector('input[name="satuan[]"]').value = dataSatuan;
                    existingRow.querySelector('input[name="harga[]"]').value = dataHpp;
                    existingRow.querySelector('input[name="nilai[]"]').value = parseInt(existingRow.querySelector('input[name="qty[]"]').value) * dataHpp;
                    rowUpdated = true;
                }
            });

            // Jika tidak ada baris yang diperbarui, tambahkan baris baru
            if (!rowUpdated) {
                const newRow = `
            <tr>
                <td><input type="text" name="id_kode_barang[]" class="form-control form-control-sm" value="${dataIdKode}" readonly></td>
                <td><input type="text" name="nama_barang[]" class="form-control form-control-sm" value="${dataNamaBarang}" readonly></td>
                <td><input type="number" name="qty[]" class="form-control form-control-sm" value="${dataQty}"></td>
                <td><input type="text" name="satuan[]" class="form-control form-control-sm" value="${dataSatuan}" readonly></td>
                <td><input type="text" name="harga[]" class="form-control form-control-sm" value="${dataHpp}" readonly></td>
                <td><input type="text" name="nilai[]" class="form-control form-control-sm" value="${dataQty * dataHpp}" readonly></td>
                <td><input type="checkbox" class="form-check-input"></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-trash"></i></button></td>
            </tr>
            `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
            }

            // Tutup modal setelah klik baris
            $('#repair').modal('hide');
        });
    });

    // Event listener untuk menghapus baris di tabel detail
    document.querySelector('#repair_material_detail').addEventListener('click', e => {
        if (e.target.classList.contains('delete-row')) {
            const row = e.target.closest('tr');
            row.remove();
        }
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

    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk input pencarian
        document.getElementById('search-input').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // Ambil nilai input dan ubah ke huruf kecil
            const rows = document.querySelectorAll('#repair tbody tr'); // Seleksi semua baris di dalam modal

            rows.forEach(row => {
                const noOrder = row.cells[0].innerText.toLowerCase(); // Kolom No.Order
                const nopol = row.cells[3].innerText.toLowerCase(); // Kolom Nopol

                // Tampilkan baris jika nilai input cocok dengan No.Order atau Nopol
                if (noOrder.includes(searchValue) || nopol.includes(searchValue)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk input pencarian
        document.getElementById('search-barang').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // Ambil nilai input dan ubah ke huruf kecil
            const rows = document.querySelectorAll('#kodeBarangModal tbody tr'); // Seleksi semua baris di dalam modal

            rows.forEach(row => {
                const kodePart = row.cells[0].innerText.toLowerCase(); // Kolom Kode
                const namaPart = row.cells[1].innerText.toLowerCase(); // Kolom Nama

                // Tampilkan baris jika nilai input cocok dengan Kode atau Nama
                if (kodePart.includes(searchValue) || namaPart.includes(searchValue)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>