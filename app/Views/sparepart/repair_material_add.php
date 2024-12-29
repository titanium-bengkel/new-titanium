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
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('repair_material_part') ?>" class="breadcrumb-link text-primary fw-bold">List RM Sparepart</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Material Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Material Sparepart</h5>
                </header>
                <div class="card-body">
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
                                <label class="col-form-label" for="no_ro">No. Work Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_ro" class="form-control form-control-sm" name="no_ro">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm pilih-data" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_keluar">Gudang Keluar</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                    </select>
                                </fieldset>
                            </div>
                            <!-- <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_masuk">Gudang Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="gudang_masuk" name="gudang_masuk" class="form-control form-control-sm">
                            </div> -->
                        </div>
                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_rangka">No. Rangka</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_rangka" class="form-control form-control-sm" name="no_rangka">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Car Model</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Customer</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="asuransi" class="form-control form-control-sm" name="asuransi">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mt-2 my-table-class">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">HPP</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Pilih All <input type="checkbox" id="pilih-all" class="form-check-input"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><input type="text" class="form-control form-control-sm" id="total-qtyB" name="total_qty_B" readonly></td>
                                        <td></td>
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
                </div>
            </div>
        </div>
    </div>
</section>


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
                                    <tr data-satuan="<?= $b['satuan'] ?>">
                                        <td><?= $b['kode_part'] ?></td>
                                        <td><?= $b['nama_part'] ?></td>
                                        <td><?= $b['harga_beliawal'] ?></td>
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

<div class="modal fade text-left" id="repair" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <table class="table table-bordered table-hover table-striped" id="repair" style="font-size: 14px;">
                        <thead class="table-secondary">
                            <tr>
                                <th>Work Order</th>
                                <th>No. Rangka</th>
                                <th>Car Model</th>
                                <th>Nopol</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penerimaan)) : ?>
                                <?php
                                // Array untuk melacak no_repair_order yang sudah ditampilkan
                                $shownRepairOrders = [];
                                ?>
                                <?php foreach ($penerimaan as $data) : ?>
                                    <?php if (!in_array($data['no_repair_order'], $shownRepairOrders)) : ?>
                                        <?php
                                        // Tandai no_repair_order ini agar tidak tampil lagi
                                        $shownRepairOrders[] = $data['no_repair_order'];
                                        ?>
                                        <tr data-idkode="<?= $data['id_kode_barang'] ?>"
                                            data-namabarang="<?= $data['nama_barang'] ?>"
                                            data-qty="<?= $data['qty'] ?>"
                                            data-gudang="<?= $data['gudang'] ?>"
                                            data-satuan="<?= $data['satuan'] ?>"
                                            data-hpp="<?= $data['netto'] ?>"
                                            data-repair="<?= $data['no_repair_order'] ?>"
                                            data-rangka="<?= $data['no_rangka'] ?>"
                                            data-terima="<?= $data['id_penerimaan'] ?>"
                                            data-asuransi="<?= $data['asuransi'] ?>"
                                            data-nopol="<?= $data['nopol'] ?>"
                                            data-jenis_mobil="<?= $data['jenis_mobil'] ?>"
                                            data-nama_pemilik="<?= $data['nama_pemilik'] ?>">
                                            <td><?= $data['no_repair_order'] ?></td>
                                            <td><?= $data['no_rangka'] ?></td>
                                            <td><?= $data['jenis_mobil'] ?></td>
                                            <td><?= $data['nopol'] ?></td>
                                            <td><?= $data['asuransi'] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">Data penerimaan tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangani klik pada baris di tabel modal
        const rows = document.querySelectorAll('#repair .table tbody tr');

        rows.forEach(row => {
            row.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                const idKode = row.getAttribute('data-idkode');
                const namaBarang = row.getAttribute('data-namabarang');
                const qty = row.getAttribute('data-qty');
                const gudang = row.getAttribute('data-gudang');
                const satuan = row.getAttribute('data-satuan');
                const hpp = row.getAttribute('data-hpp');
                const repairOrder = row.getAttribute('data-repair');
                const rangka = row.getAttribute('data-rangka');
                const asuransi = row.getAttribute('data-asuransi');
                const nopol = row.getAttribute('data-nopol');
                const jenisMobil = row.getAttribute('data-jenis_mobil');
                const namaPemilik = row.getAttribute('data-nama_pemilik');

                // Masukkan data ke dalam input form di luar modal
                document.getElementById('no_ro').value = repairOrder || '';
                document.getElementById('gudang_keluar').value = gudang || '';
                document.getElementById('no_rangka').value = rangka || '';
                document.getElementById('nopol').value = nopol || '';
                document.getElementById('jenis_mobil').value = jenisMobil || '';
                document.getElementById('nama_pemilik').value = namaPemilik || '';
                document.getElementById('asuransi').value = asuransi || '';

                // Menambahkan data ke tabel input (my-table-class)
                const tableBody = document.querySelector('.my-table-class tbody');
                const newRow = document.createElement('tr');

                newRow.innerHTML = `
                <td><input type="text" name="id_kode_barang[]" class="form-control form-control-sm" value="${idKode}" readonly></td>
                <td><input type="text" name="nama_barang[]" class="form-control form-control-sm" value="${namaBarang}"></td>
                <td><input type="number" name="qty_B[]" class="form-control form-control-sm" value="${qty}"></td>
                <td><input type="text" name="sat_B[]" class="form-control form-control-sm" value="${satuan}"></td>
                <td><input type="number" name="hpp[]" class="form-control form-control-sm" value="${hpp}"></td>
                <td><input type="number" name="nilai[]" class="form-control form-control-sm" value="0" readonly></td>
                <td class="text-center"><input type="checkbox" class="form-check-input pilih-checkbox"></td>
            `;

                tableBody.appendChild(newRow);

                // Tutup modal setelah memilih baris
                const modal = new bootstrap.Modal(document.getElementById('repair'));
                modal.hide();
            });
        });

        // Update total qty dan total hpp secara otomatis
        document.querySelector('.my-table-class').addEventListener('input', function() {
            let totalQty = 0;
            let totalHPP = 0;

            document.querySelectorAll('.my-table-class tbody tr').forEach(row => {
                const qtyInput = row.querySelector('[name="qty_B[]"]');
                const hppInput = row.querySelector('[name="hpp[]"]');

                if (qtyInput && hppInput) {
                    totalQty += parseFloat(qtyInput.value) || 0;
                    totalHPP += parseFloat(hppInput.value) || 0;
                }
            });

            document.getElementById('total-qtyB').value = totalQty;
            document.getElementById('total-hpp').value = totalHPP;
        });
    });
</script>





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

    document.querySelectorAll('#repair tbody tr').forEach(row => {
        row.addEventListener('click', () => {
            // Ambil data dari atribut dataset pada baris
            const dataPemilik = row.dataset.pemilik || '';
            const dataGudang = row.dataset.gudang || '';
            const dataNopol = row.dataset.nopol || '';
            const dataJenis = row.dataset.jenis || '';
            const dataRepair = row.dataset.repair || '';
            const dataRangka = row.dataset.rangka || '';
            const dataAsuransi = row.dataset.asuransi || '';
            const idPenerimaan = row.dataset.terima || ''; // Ambil ID Penerimaan dari dataset

            // Isi form input dengan data yang sesuai
            document.querySelector('#no_ro').value = dataRepair; // No Work Order
            document.querySelector('#nama_pemilik').value = dataPemilik; // Customer
            document.querySelector('#gudang_masuk').value = dataGudang; // Gudang Masuk
            document.querySelector('#gudang_keluar').value = dataGudang; // Gudang Keluar
            document.querySelector('#nopol').value = dataNopol; // Nopol
            document.querySelector('#jenis_mobil').value = dataJenis; // Car Model
            document.querySelector('#no_rangka').value = dataRangka; // No. Rangka
            document.querySelector('#asuransi').value = dataAsuransi; // Asuransi

            // Panggil fungsi fetchSpareparts untuk mendapatkan sparepart terkait berdasarkan no_repair_order
            if (dataRepair) {
                fetchSpareparts(dataRepair);
            } else {
                console.error('No Repair Order tidak ditemukan');
            }

            // Tutup modal setelah klik baris
            $('#repair').modal('hide');
        });
    });

    // Function to fetch spare parts based on no_repair_order
    function fetchSpareparts(noRepairOrder) {
        fetch(`/get_spareparts_terima?no_repair_order=${noRepairOrder}`) // Menggunakan no_repair_order
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#repair_material_detail');
                tableBody.innerHTML = ''; // Clear previous rows

                if (data && Array.isArray(data)) {
                    data.forEach(sparepart => {
                        const row = `
                        <tr>
                            <td><input type="text" name="id_kode_barang[]" class="form-control form-control-sm" value="${sparepart.id_kode_barang}" readonly></td>
                            <td><input type="text" name="nama_barang[]" class="form-control form-control-sm" value="${sparepart.nama_barang}"></td>
                            <td><input type="number" name="qty[]" class="form-control form-control-sm" value="${sparepart.qty}"></td>
                            <td><input type="text" name="satuan[]" class="form-control form-control-sm" value="${sparepart.satuan}" readonly></td>
                            <td><input type="text" name="harga[]" class="form-control form-control-sm" value="${sparepart.harga}"></td>
                            <td><input type="text" name="nilai[]" class="form-control form-control-sm" value="${sparepart.qty * sparepart.harga}" readonly></td>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                    updateRemoveButtonStatus();
                    updateJumlah();
                } else {
                    console.error('Data spareparts tidak ditemukan atau kosong.');
                }
            })
            .catch(error => console.error('Error fetching spareparts:', error));
    }


    // Fungsi untuk menghapus baris
    document.querySelector('#repair_material_detail').addEventListener('click', (e) => {
        if (e.target && e.target.matches('.remove-row')) {
            e.target.closest('tr').remove();
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