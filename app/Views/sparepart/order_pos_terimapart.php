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
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">List Penerimaan Sparepart</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Penerimaan Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Penerimaan Sparepart NON-SUPPLY</h5>
                </header>
                <div class="card-body">
                    <h5>ID</h5>
                    <form action="<?= base_url('/sparepart/create_part') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_penerimaan">No. Faktur</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_penerimaan" class="form-control" name="id_penerimaan" value="<?= $generatedIdTerima ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control" name="tanggal" onkeydown="return false" onclick="this.showPicker()" required>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="kode_supplier" hidden>Kode Supplier</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="hidden" id="kode_supplier" class="form-control" name="kode_supplier">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="supplier">Supplier</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="supplier" class="form-control" name="supplier">
                            </div>

                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#supp">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jatuh_tempo">Jatuh tempo</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"></textarea>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang">Gudang</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="gudang" name="gudang">
                                        <option disabled selected>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART</option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>

                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <input type="text" id="no_repair_order" class="form-control" name="no_repair_order" hidden>
                            <input type="text" id="asuransi" class="form-control" name="asuransi" hidden>
                            <input type="text" id="jenis_mobil" class="form-control" name="jenis_mobil" hidden>
                            <input type="text" id="warna" class="form-control" name="warna" hidden>
                            <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik" hidden>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_preor">No. PO/Nopol</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_preor" class="form-control" name="no_preor" readonly>
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no_po">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="kota">Kota</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="kota" class="form-control" name="kota">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control" name="nopol">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="alamat" class="form-control" name="alamat">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="pembayaran">Metode Pembayaran</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="pembayaran" name="pembayaran">
                                        <option disabled selected>--Pilih--</option>
                                        <option>TRANSFER</option>
                                        <option>KREDIT</option>
                                        <option>CASH</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="ppn">PPN</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="ppn" name="ppn">
                                        <option disabled selected>--Pilih--</option>
                                        <option>PPN</option>
                                        <option>NON PPN</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="term">Term (days)</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="number" id="term" class="form-control" name="term" oninput="calculateJatuhTempo()" required>
                            </div>
                            <script>
                                function calculateJatuhTempo() {
                                    const term = parseInt(document.getElementById('term').value) || 0;
                                    const today = new Date(); // Get today's date

                                    if (term > 0) {
                                        today.setDate(today.getDate() + term);
                                        const newDate = today.toISOString().split('T')[0];
                                        document.getElementById('jatuh_tempo').value = newDate;
                                    } else {
                                        document.getElementById('jatuh_tempo').value = '';
                                    }
                                }
                            </script>
                        </div>

                        <button type="button" class="btn btn-success btn-sm" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <div class="table-responsive table-bordered">
                            <table id="detail-barang" class="table my-table-class text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Disc</th>
                                        <th>Jumlah</th>
                                        <th>No. PO</th>
                                        <th>Select All<input type="checkbox" id="select-all-checkbox"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body">
                                    <!-- Baris-baris data akan ditambahkan di sini -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total:</strong></td>
                                        <td><input type="text" id="total-qty" class="form-control" readonly></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="text" id="total-jumlah" class="form-control" readonly></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="form-group row align-items-center mt-4">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="<?= base_url('terima_part'); ?>" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->

<!-- modal supplier -->
<div class="modal fade" id="supp" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Cari Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-supplier" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-supplier" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
                            </tr>
                        </thead>
                        <tbody id="supplier-list">
                            <?php if (!empty($supplier)) : ?>
                                <?php foreach ($supplier as $a) : ?>
                                    <tr class="clickable-row" data-kode="<?= $a->kode ?>" data-nama="<?= $a->nama ?>" data-kota="<?= $a->kota ?>" data-alamat="<?= $a->alamat ?>">
                                        <td><?= $a->kode ?></td>
                                        <td><?= $a->nama ?></td>
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
                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Repair Order -->
<div class="modal fade" id="no_po" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Purchase Order (PO)</h5>
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
                    <table class="table table-bordered table-hover text-center" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Kode Supplier</th>
                                <th>Nama</th>
                                <th>Nopol</th>
                                <th>Jumlah PO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($part_po)) : ?>
                                <?php foreach ($part_po as $a) : ?>
                                    <tr data-noRepair="<?= $a->no_repair_order ?>" data-asuransi="<?= $a->asuransi ?>" data-mobil="<?= $a->jenis_mobil ?>" data-warna="<?= $a->warna ?>" data-kode="<?= $a->kode_supplier ?> data-supplier=" <?= $a->supplier ?>">
                                        <td><?= esc($a->id_pesan) ?></td>
                                        <td><?= esc($a->tanggal) ?></td>
                                        <td><?= esc($a->kode_supplier) ?></td>
                                        <td><?= esc($a->supplier) ?></td>
                                        <td><?= esc($a->no_kendaraan) ?></td>
                                        <td><?= esc($a->total_jumlah) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">Data PO tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                            <?php if (!empty($barang)) : ?>
                                <?php foreach ($barang as $b) : ?>
                                    <tr data-satuan="<?= $b->sat_B ?>">
                                        <td><?= $b->kode ?></td>
                                        <td><?= $b->nama ?></td>
                                        <td><?= $b->hargabeli_B ?></td>
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


<!-- tabel skrip -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    function updateJumlah() {
        let totalQty = 0;
        let totalJumlah = 0;
        $('#detail-barang-body tr').each(function() {
            const qty = parseFloat($(this).find('.qty').val()) || 0;
            const harga = parseFloat($(this).find('.harga').val()) || 0;
            const jumlah = qty * harga;
            $(this).find('.jumlah').val(formatNumber(jumlah));
            totalQty += qty;
            totalJumlah += jumlah;
        });
        $('#total-qty').val(formatNumber(totalQty)); // Update total qty
        $('#total-jumlah').val(formatNumber(totalJumlah)); // Update total jumlah
    }

    $(document).ready(function() {
        let selectedRow; // Variabel untuk menyimpan baris yang dipilih

        // Menambahkan baris baru ke dalam tabel
        $('#add-row-btn').click(function() {
            const row = `
            <tr>
                <td><input type="text" class="form-control" name="id_kode_barang[]" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>
                <td><input type="text" class="form-control" name="nama_barang[]"></td>
                <td><input type="text" class="form-control qty" name="qty[]"></td>
                <td><input type="text" class="form-control" name="satuan[]"></td>
                <td><input type="text" class="form-control harga" name="harga[]"></td>
                <td><input type="text" class="form-control" name="disc[]"></td>
                <td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>
                <td><input type="text" class="form-control" name="no_po[]"></td>
                <td><input type="checkbox" class="form-check-input pilih-checkbox"></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button></td>
            </tr>
        `;
            $('#detail-barang-body').append(row);
            updateRemoveButtonStatus();
        });

        // Fungsi untuk mengatur status tombol hapus
        function updateRemoveButtonStatus() {
            $('.remove-row').off('click').on('click', function() {
                $(this).closest('tr').remove();
            });
        }

        // Event listener untuk checkbox "Select All"
        $('#select-all-checkbox').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('.pilih-checkbox').prop('checked', isChecked); // Set semua checkbox baris ke status checkbox Select All
        });

        // Event listener untuk checkbox individu, jika semua checkbox tercentang maka centang juga Select All
        $('#detail-barang-body').on('change', '.pilih-checkbox', function() {
            const allChecked = $('.pilih-checkbox').length === $('.pilih-checkbox:checked').length;
            $('#select-all-checkbox').prop('checked', allChecked);
        });

        // Menyimpan referensi baris yang sedang dipilih
        $('#detail-barang-body').on('click', 'input[name="id_kode_barang[]"]', function() {
            selectedRow = $(this).closest('tr'); // Simpan referensi baris yang diklik
        });

        // Mengisi data ke baris yang dipilih ketika item di modal dipilih
        $('#kodeBarangModal tbody').on('click', 'tr', function() {
            const kodeBarang = $(this).find('td:eq(0)').text();
            const namaBarang = $(this).find('td:eq(1)').text();
            const hargaBarang = $(this).find('td:eq(2)').text();
            const satuanBarang = $(this).data('satuan');
            const noPo = $(this).find('td:eq(4)').text();

            if (selectedRow) {
                selectedRow.find('input[name="id_kode_barang[]"]').val(kodeBarang);
                selectedRow.find('input[name="nama_barang[]"]').val(namaBarang);
                selectedRow.find('input[name="harga[]"]').val(hargaBarang);
                selectedRow.find('input[name="satuan[]"]').val(satuanBarang);
                selectedRow.find('input[name="no_po[]"]').val(noPo);
            }

            $('#kodeBarangModal').modal('hide');
        });

        // Menghapus baris
        $('#detail-barang-body').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateRemoveButtonStatus();
            updateJumlah();
        });

        // Fungsi untuk mengaktifkan / menonaktifkan tombol remove berdasarkan jumlah baris
        function updateRemoveButtonStatus() {
            const rowCount = $('#detail-barang-body tr').length;
            $('.remove-row').prop('disabled', rowCount <= 1);
        }

        updateRemoveButtonStatus();

        // Checkbox untuk memilih semua barang
        $('#pilih-all').click(function() {
            $('.pilih-checkbox').prop('checked', $(this).is(':checked'));
        });

        // Event untuk checkbox individual
        $('.my-table-class').on('click', '.pilih-checkbox', function() {
            $('#pilih-all').prop('checked', $('.pilih-checkbox').length === $('.pilih-checkbox:checked').length);
        });

        // Update jumlah saat input qty atau harga berubah
        $('.my-table-class tbody').on('input', '.qty, .harga', function() {
            updateJumlah();
        });

        // Event untuk mengisi detail supplier
        document.querySelectorAll('#supplier-list .clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                document.getElementById('supplier').value = this.getAttribute('data-nama');
                document.getElementById('kota').value = this.getAttribute('data-kota');
                document.getElementById('alamat').value = this.getAttribute('data-alamat');

                const modal = bootstrap.Modal.getInstance(document.getElementById('supp'));
                modal.hide();
            });
        });

        // Event untuk mengisi detail PO
        document.querySelectorAll('#no_po tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                // Ambil data dari atribut baris yang diklik
                const idPesan = this.cells[0].innerText;
                const tanggal = this.cells[1].innerText;
                const kodeSupplier = this.cells[2].innerText;
                const supplier = this.cells[3].innerText;
                const nopol = this.cells[4].innerText;
                const totalJumlah = this.cells[5].innerText;

                const noRepair = this.getAttribute('data-noRepair');
                const asuransi = this.getAttribute('data-asuransi');
                const mobil = this.getAttribute('data-mobil');
                const warna = this.getAttribute('data-warna');
                const alamat = this.getAttribute('data-alamat'); // Sesuaikan jika alamat diambil dari data yang berbeda

                // Isi input field dengan data yang diambil
                document.getElementById('no_preor').value = idPesan;
                document.getElementById('kode_supplier').value = kodeSupplier;
                document.getElementById('supplier').value = supplier;
                document.getElementById('nopol').value = nopol;
                document.getElementById('no_repair_order').value = noRepair;
                document.getElementById('asuransi').value = asuransi;
                document.getElementById('jenis_mobil').value = mobil;
                document.getElementById('warna').value = warna;
                document.getElementById('alamat').value = alamat;

                // Tutup modal setelah data terisi
                const modal = bootstrap.Modal.getInstance(document.getElementById('no_po'));
                modal.hide();

                // Panggil fungsi fetchSpareparts untuk mendapatkan spare part terkait
                fetchSpareparts(idPesan);
            });
        });

        // Function to fetch spare parts
        function fetchSpareparts(idPesan) {
            fetch(`/get_spareparts?id_pesan=${idPesan}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#detail-barang-body');
                    tableBody.innerHTML = '';

                    data.forEach(sparepart => {
                        const row = `
                          <tr>
                            <td>
                                <input type="text" class="form-control" name="kode_barang[]" value="${sparepart.id_kode_barang}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="nama_barang[]" value="${sparepart.nama_barang}">
                            </td>
                            <td>
                                <input type="text" class="form-control qty" name="qty[]" value="${sparepart.qty}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="satuan[]" value="${sparepart.satuan}">
                            </td>
                            <td>
                                <input type="text" class="form-control harga" name="harga[]" value="${sparepart.harga}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="disc[]">
                            </td>
                            <td>
                                <input type="text" class="form-control jumlah" name="jumlah[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="no_po[]" value="${sparepart.id_pesan}">
                            </td>
                            <td>
                                <input type="checkbox" class="form-check-input pilih-checkbox" 
                                    name="is_sent_checkbox[]" value="1" 
                                    ${sparepart.is_sent === 1 ? 'checked' : ''}>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </td>
                        </tr>

                        `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                    updateRemoveButtonStatus();
                    updateJumlah();
                })
                .catch(error => console.error('Error fetching spareparts:', error));
        }

        // Function to filter the table based on search input
        document.getElementById('search-input').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#no_po tbody tr');

            rows.forEach(row => {
                const idPesan = row.cells[0].innerText.toLowerCase();
                const nopol = row.cells[4].innerText.toLowerCase();

                if (idPesan.includes(searchValue) || nopol.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk mengisi data otomatis saat baris diklik
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                // Mengambil data dari baris yang diklik
                const kodeSupplier = this.getAttribute('data-kode');
                const namaSupplier = this.getAttribute('data-nama');
                const kota = this.getAttribute('data-kota');
                const alamat = this.getAttribute('data-alamat');

                // Mengisi data ke input form
                document.getElementById('kode_supplier').value = kodeSupplier;
                document.getElementById('supplier').value = namaSupplier;

                // Jika ada input kota dan alamat di form, tambahkan juga kode berikut:
                // document.getElementById('kota').value = kota;
                // document.getElementById('alamat').value = alamat;

                // Menutup modal setelah data diisi
                $('#supp').modal('hide');
            });
        });

        // Fungsi pencarian real-time berdasarkan input
        document.getElementById('search-supplier').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            document.querySelectorAll('#supplier-list .clickable-row').forEach(row => {
                const nama = row.getAttribute('data-nama').toLowerCase();
                row.style.display = nama.includes(searchValue) ? '' : 'none';
            });
        });
    });
</script>


<?= $this->endSection() ?>