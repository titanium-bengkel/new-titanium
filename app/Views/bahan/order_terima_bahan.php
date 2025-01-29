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
                        <a href="<?= base_url('terima_bahan') ?>" class="breadcrumb-link text-primary fw-bold">List Penerimaan Bahan</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Penerimaan Bahan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Penerimaan Bahan</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('/bahan/create_terima') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="no_faktur">No. Faktur</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-1">
                                <input type="text" id="no_faktur" class="form-control form-control-sm" name="no_faktur" value="<?= $generatedIdTerima ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="tgl">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-1">
                                <input type="date" id="tgl" class="form-control form-control-sm" name="tgl" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="nomor">Nomor</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-1">
                                <input type="text" id="nomor" class="form-control form-control-sm" name="nomor">
                            </div>
                            <div class="col-lg-1 col-2 mb-1">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-kend">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label col-form-label-sm" for="kode_supplier" hidden>Kode Supplier</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input class="form-control form-control-sm" id="kode_supplier" rows="1" name="kode_supplier" hidden></input>
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="supplier">Supplier</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-1">
                                <input type="text" id="supplier" class="form-control form-control-sm" name="supplier">
                            </div>
                            <div class="col-lg-1 col-2 mb-1">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#supp">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="jatuh_tempo">Jatuh Tempo</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-1">
                                <input type="date" id="jatuh_tempo" class="form-control form-control-sm" name="jatuh_tempo" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-1">
                                <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="1"></textarea>
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="gudang">Gudang</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-1">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="gudang" name="gudang">
                                        <option>GUDANG BAHAN</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <h5>Data Supplier</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="kota">Kota</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-1">
                                <input type="text" id="kota" class="form-control form-control-sm" name="kota">
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-1">
                                <input type="text" id="alamat" class="form-control form-control-sm" name="alamat">
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="pembayaran">Metode Pembayaran</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-1">
                                <fieldset class="form-group">
                                    <select id="pembayaran" class="form-select form-select-sm" name="pembayaran">
                                        <option value="" disabled selected>--Pilih--</option>
                                        <?php foreach ($coa as $item): ?>
                                            <option value="<?= $item['nama_account']; ?>">
                                                <?php
                                                switch ($item['nama_account']) {
                                                    case 'REK BCA':
                                                        echo 'TRANSFER';
                                                        break;
                                                    case 'KAS KECIL':
                                                        echo 'CASH';
                                                        break;
                                                    default:
                                                        echo $item['nama_account'];
                                                }
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <option value="KREDIT">KREDIT</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="ppn">PPN</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-1">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="ppn" name="ppn">
                                        <option disable selected>--Pilih--</option>
                                        <option>PPN</option>
                                        <option>NON PPN</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-1">
                                <label class="col-form-label col-form-label-sm" for="term">Term (days)</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-1">
                                <input type="number" id="term" class="form-control form-control-sm" name="term" oninput="calculateJatuhTempo()" required>
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
                        <button type="button" class="btn btn-success btn-sm mb-1" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped -table-hover mb-0" id="detailTable" style="font-size: 14px;">
                                <thead class="thead-dark table-secondary">
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Disc</th>
                                        <th>Jumlah</th>
                                        <th>No PO</th>
                                        <th>PO id</th>
                                        <th>Pilih<input type="checkbox" id="pilih-all"></th>
                                        <th>Act</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body">
                                    <tr>
                                        <!-- Baris-baris data akan ditambahkan di sini -->
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th class="text-end" colspan="6">Total</th>
                                        <th>
                                            <input type="text" id="totalJumlah" class="form-control form-control-sm" readonly>
                                        </th>
                                        <th colspan="6"></th>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-end" colspan="6">Disc Total</th>
                                        <th>
                                            <input type="text" id="disc_total" name="disc_total" class="form-control form-control-sm">
                                        </th>
                                        <th colspan="6"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row align-items-center mt-4">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="<?= base_url('terima_bahan'); ?>" class="btn btn-danger btn-sm">Batal</a>
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
                    <table class="table table-bordered table-hover text-center" style="font-size: 14px;">
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
                                    <td colspan="2">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End -->


<!-- Modal untuk memilih PO Bahan -->
<div class="modal fade text-left" id="no-kend" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Cari Data Supplier</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" id="search-po" class="form-control" placeholder="Cari berdasarkan Kode, Supplier, atau Tanggal...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="poTable" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Kode</th>
                                <th>Supplier</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($po_bahan)) : ?>
                                <?php foreach ($po_bahan as $po) : ?>
                                    <tr class="clickable-row"
                                        data-id="<?= $po['id_po_bahan']; ?>"
                                        data-kode="<?= $po['kode_supplier']; ?>"
                                        data-supplier="<?= $po['supplier']; ?>"
                                        data-nomor="<?= $po['id_po_bahan']; ?>"
                                        data-kota="<?= $po['kota']; ?>"
                                        data-alamat="<?= $po['alamat']; ?>">
                                        <td><?= $po['id_po_bahan']; ?></td>
                                        <td><?= $po['tanggal']; ?></td>
                                        <td><?= $po['kode_supplier']; ?></td>
                                        <td><?= $po['supplier']; ?></td>
                                        <td><?= number_format($po['total_jumlah'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">No data available.</td>
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
                    <table class="table table-bordered table-hover text-center" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bahan)) : ?>
                                <?php foreach ($bahan as $b) : ?>
                                    <tr data-satuan="<?= $b->satuan ?>">
                                        <td><?= $b->kode_bahan ?></td>
                                        <td><?= $b->nama_bahan ?></td>
                                        <td><?= number_format($b->harga_beli, 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Menghapus salah satu pemanggilan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById('add-row-btn').addEventListener('click', function() {
        const tbody = document.getElementById('detail-barang-body');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
        <td><input type="text" name="id_kode_barang[]" class="form-control"></td>
        <td><input type="text" name="nama_barang[]" class="form-control"></td>
        <td><input type="text" name="kategori[]" class="form-control"  readonly></td>
        <td><input type="number" name="qty[]" class="form-control"></td>
        <td><input type="text" name="satuan[]" class="form-control"></td>
        <td><input type="text" name="harga[]" class="form-control"></td>
        <td><input type="text" name="disc[]" class="form-control"></td>
        <td><input type="text" name="jumlah[]" class="form-control" readonly></td>
        <td><input type="text" name="id_po_bahan[]" class="form-control"></td>
        <td><input type="text" name="po_id[]" class="form-control"></td>
        <td><input type="checkbox" name="ceklis[]"></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.parentElement.remove();"><i class="fas fa-trash"></i></button></td>
    `;

        tbody.appendChild(newRow);
    });


    // Inisialisasi tanggal hari ini
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0');
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const year = today.getFullYear();
        document.getElementById('tgl').value = `${year}-${month}-${day}`;
    });

    // Fungsi pencarian untuk tabel PO
    document.getElementById('search-po').addEventListener('keyup', function() {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll('#poTable tbody tr');

        rows.forEach(function(row) {
            const nomor = row.cells[0].textContent.toLowerCase();
            const tanggal = row.cells[1].textContent.toLowerCase();
            const kode = row.cells[2].textContent.toLowerCase();
            const supplier = row.cells[3].textContent.toLowerCase();
            // Sembunyikan atau tampilkan baris berdasarkan pencarian
            row.style.display = (nomor.includes(input) || tanggal.includes(input) || kode.includes(input) || supplier.includes(input)) ? '' : 'none';
        });
    });

    $(document).ready(function() {
        // Menangani klik pada baris tabel PO
        $('.clickable-row').on('click', function() {
            const rowData = {
                id: $(this).data('id'),
                kode: $(this).data('kode'),
                supplier: $(this).data('supplier'),
                nomor: $(this).data('nomor'),
                kota: $(this).data('kota'),
                alamat: $(this).data('alamat')
            };

            // Mengisi form dengan data dari baris yang diklik
            $('#kode_supplier').val(rowData.kode);
            $('#supplier').val(rowData.supplier);
            $('#nomor').val(rowData.nomor);
            $('#kota').val(rowData.kota);
            $('#alamat').val(rowData.alamat);
            $('#no-kend').modal('hide');

            // Ambil detail barang
            getDetailBarang(rowData.id);
        });

        // Ambil detail barang berdasarkan id_po_bahan
        function getDetailBarang(id_po_bahan) {
            $.ajax({
                url: 'getDetailBarang/' + id_po_bahan,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#detail-barang-body').empty(); // Kosongkan tabel sebelum menambahkan data
                    $.each(data, function(index, item) {
                        const jumlah = item.qty * item.harga;
                        const isChecked = item.ceklis == 1 ? 'checked' : '';
                        const isDisabled = item.ceklis == 1 ? 'disabled' : '';

                        $('#detail-barang-body').append(`
                    <tr>
                        <td><input type="text" class="form-control" name="id_kode_barang[]" value="${item.id_kode_barang}" readonly></td>
                        <td><input type="text" class="form-control" name="nama_barang[]" value="${item.nama_barang}" readonly></td>
                        <td><input type="text" class="form-control" name="kategori[]" value="${item.kategori}" readonly></td>
                        <td><input type="text" class="form-control qty" name="qty[]" value="${item.qty}" oninput="updateJumlah(this)"></td>
                        <td><input type="text" class="form-control" name="satuan[]" value="${item.satuan}" readonly></td>
                        <td><input type="text" class="form-control harga" name="harga[]" value="${item.harga}" oninput="updateJumlah(this)"></td>
                        <td><input type="text" class="form-control disc" name="disc[]" value="${item.disc || 0}" oninput="updateJumlah(this)"></td>
                        <td><input type="text" class="form-control jumlah" name="jumlah[]" value="${formatNumber(jumlah)}" readonly></td>
                        <td><input type="text" class="form-control" name="id_po_bahan[]" value="${item.id_po_bahan || ''}"></td>
                        <td><input type="text" class="form-control" name="po_id[]" value="${item.po_id || ''}"></td>
                        <td><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" value="${item.ceklis}" ${isChecked}></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row" onclick="this.parentElement.parentElement.remove(); hitungTotal();"><i class="fas fa-minus"></i></button></td>
                    </tr>
                `);
                    });
                    hitungTotal(); // Hitung total setelah data ditambahkan
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function formatNumber(num, withDecimal = true) {
            return num.toLocaleString('id-ID', {
                minimumFractionDigits: withDecimal ? 2 : 0,
                maximumFractionDigits: withDecimal ? 2 : 0
            });
        }

        function hitungTotal() {
            let totalJumlah = 0;

            // Hitung total jumlah dari semua baris di tabel
            $('#detail-barang-body tr').each(function() {
                const jumlah = parseFloat($(this).find('.jumlah').val().replace(/,/g, '')) || 0;
                totalJumlah += jumlah;
            });

            // Ambil nilai diskon dari input disc_total
            const discTotal = parseFloat($('#disc_total').val().replace(/,/g, '')) || 0;

            // Kurangi diskon dari totalJumlah
            totalJumlah -= discTotal;

            // Update input totalJumlah dengan format desimal
            $('#totalJumlah').val(formatNumber(totalJumlah));
        }

        // Panggil fungsi hitungTotal saat ada perubahan pada elemen yang relevan
        $('#detail-barang-body').on('input', '.jumlah', function() {
            hitungTotal();
        });

        $('#disc_total').on('input', function() {
            hitungTotal();
        });






        // Menangani pengiriman form
        $('#yourFormId').on('submit', function(e) {
            e.preventDefault();
            const dataDetail = [];
            $('#detail-barang-body tr').each(function() {
                const rowData = {
                    id_kode_barang: $(this).find('input[name="id_kode_barang[]"]').val(),
                    nama_barang: $(this).find('input[name="nama_barang[]"]').val(),
                    qty: parseFloat($(this).find('input[name="qty[]"]').val()) || 0,
                    satuan: $(this).find('input[name="satuan[]"]').val(),
                    harga: parseFloat($(this).find('input[name="harga[]"]').val()) || 0,
                    disc: parseFloat($(this).find('input[name="disc[]"]').val()) || 0,
                    no_po: $(this).find('input[name="id_po_bahan[]"]').val(),
                    po_id: $(this).find('input[name="po_id[]"]').val(),
                    ceklis: $(this).find('input[name="ceklis[]"]').is(':checked') ? 1 : 0
                };

                if (rowData.ceklis === 1) {
                    dataDetail.push(rowData);
                }
            });

            $.ajax({
                url: '/bahan/create_terima',
                method: 'POST',
                data: {
                    detail: dataDetail
                },
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil disimpan');
                    } else {
                        alert('Gagal menyimpan data: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });
        });

        // Mengupdate jumlah ketika input qty, harga, atau diskon berubah
        $(document).on('input', '.qty, .harga, .disc', function() {
            const row = $(this).closest('tr');
            const qty = parseFloat(row.find('.qty').val()) || 0;
            const harga = parseFloat(row.find('.harga').val()) || 0;
            const disc = parseFloat(row.find('.disc').val()) || 0;
            const jumlah = (qty * harga) - disc;
            // Format jumlah menggunakan formatNumber dan update input .jumlah
            row.find('.jumlah').val(formatNumber(jumlah));

            // Hitung total secara keseluruhan
            hitungTotal();
        });

        // Pencarian untuk daftar supplier
        document.getElementById('search-supplier').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#supplier-list tr');
            rows.forEach(row => {
                const kode = row.getAttribute('data-kode') ? row.getAttribute('data-kode').toLowerCase() : '';
                const name = row.getAttribute('data-supplier') ? row.getAttribute('data-supplier').toLowerCase() : '';
                // Sembunyikan atau tampilkan baris berdasarkan pencarian
                row.style.display = kode.includes(searchValue) || name.includes(searchValue) ? '' : 'none';
            });
        });
        $(document).ready(function() {
            // Event listener untuk klik pada baris tabel supplier
            $('#supplier-list').on('click', '.clickable-row', function() {
                var kodeSupplier = $(this).data('kode');
                var namaSupplier = $(this).data('nama');
                var kotaSupplier = $(this).data('kota');
                var alamatSupplier = $(this).data('alamat');

                // Jika Anda ingin memasukkan data ke input field tertentu di halaman utama, lakukan seperti ini:
                $('#kode-supplier-input').val(kodeSupplier); // Ganti dengan ID input field yang benar
                $('#nama-supplier-input').val(namaSupplier); // Ganti dengan ID input field yang benar

                // Tutup modal setelah data di klik
                $('#supp').modal('hide');
            });
        });
    });
</script>

<!-- search barang -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk input pencarian
        document.getElementById('search-po').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // Ambil nilai input dan ubah ke huruf kecil
            const rows = document.querySelectorAll('#no-kend tbody tr'); // Seleksi semua baris di dalam modal

            rows.forEach(row => {
                const poBahan = row.cells[0].innerText.toLowerCase(); // Kolom Kode
                const kodeSupp = row.cells[2].innerText.toLowerCase(); // Kolom Nama
                const namaSupp = row.cells[3].innerText.toLowerCase();

                // Tampilkan baris jika nilai input cocok dengan Kode atau Nama
                if (poBahan.includes(searchValue) || kodeSupp.includes(searchValue) || namaSupp.includes(searchValue)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });
</script>

<!-- search supplier -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan event listener untuk input pencarian
        document.getElementById('search-supplier').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // Ambil nilai input dan ubah ke huruf kecil
            const rows = document.querySelectorAll('#supp tbody tr'); // Seleksi semua baris di dalam modal

            rows.forEach(row => {
                const kodeSupp = row.cells[0].innerText.toLowerCase(); // Kolom Kode
                const namaSupp = row.cells[1].innerText.toLowerCase(); // Kolom Nama

                // Tampilkan baris jika nilai input cocok dengan Kode atau Nama
                if (kodeSupp.includes(searchValue) || namaSupp.includes(searchValue)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    });
</script>




<?= $this->endSection() ?>