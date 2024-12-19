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
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/pembelian') ?>" class="breadcrumb-link text-primary fw-bold">Pembelian Sparepart dan Material</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Pembelian</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Pembelian</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('/keuangan/createPembelian') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_faktur">No. Faktur</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_faktur" class="form-control" name="no_faktur">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tgl">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tgl" class="form-control" name="tgl" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="kode_supplier" hidden>Kode Supplier</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input class="form-control" id="kode_supplier" rows="1" name="kode_supplier" hidden></input>
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
                                <label class="col-form-label" for="jatuh_tempo">Jatuh Tempo</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onkeydown="return false">
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
                                        <option>GUDANG BAHAN</option>
                                        <option>GUDANG SUPPLY</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nomor">Nomor</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="nomor" class="form-control" name="nomor">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-kend">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="kota">Kota</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="kota" class="form-control" name="kota">
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
                            <div class="col-lg-10 col-7 mb-1">
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
                            <div class="col-lg-10 col-7 mb-1">
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
                                <input type="number" id="term" class="form-control" name="term" oninput="calculateJatuhTempo()">
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
                        <div class="table-responsive">
                            <table class="table table-bordered mt-2 my-table-class text-center" id="detailTable" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Disc</th>
                                        <th>Jumlah</th>
                                        <th>No PO</th>
                                        <th>PO id</th>
                                        <th>Pilih All <input type="checkbox" id="pilih-all"></th>
                                        <th>Act</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body">
                                    <tr>
                                        <!-- Baris-baris data akan ditambahkan di sini -->
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <th>
                                            <input type="text" id="totalQty" class="form-control" readonly>
                                        </th>
                                        <th colspan="3"></th>
                                        <th>
                                            <input type="text" id="totalJumlah" class="form-control" readonly>
                                        </th>
                                        <th colspan="4"></th>
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
                            <?php if (!empty($supplier) && is_array($supplier)): ?>
                                <?php foreach ($supplier as $data): ?>
                                    <tr class="clickable-row"
                                        data-kode="<?= $data['kode'] ?>"
                                        data-nama="<?= $data['nama'] ?>"
                                        data-kota="<?= $data['kota'] ?>"
                                        data-alamat="<?= $data['alamat'] ?>">
                                        <td><?= $data['kode'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                                <th>Gudang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($getData)) : ?>
                                <?php foreach ($getData as $data) : ?>
                                    <tr class="clickable-row"
                                        data-id="<?= $data['id']; ?>"
                                        data-kode="<?= $data['kode_supplier']; ?>"
                                        data-supplier="<?= $data['supplier']; ?>"
                                        data-nomor="<?= $data['nomor_terima'] ?>"
                                        data-kota="<?= $data['kota']; ?> "
                                        data-alamat="<?= $data['alamat']; ?>"
                                        data-jatuh_tempo="<?= $data['jatuh_tempo']; ?>"
                                        data-keterangan="<?= $data['keterangan']; ?>"
                                        data-gudang="<?= $data['gudang']; ?>"
                                        data-kota="<?= $data['kota']; ?>"
                                        data-alamat="<?= $data['alamat']; ?>"
                                        data-pembayaran="<?= $data['pembayaran']; ?>"
                                        data-ppn="<?= $data['ppn']; ?>"
                                        data-term="<?= $data['term']; ?>">
                                        <td><?= $data['nomor_terima'] ?></td>
                                        <td><?= $data['tanggal']; ?></td>
                                        <td><?= $data['kode_supplier']; ?></td>
                                        <td><?= $data['supplier']; ?></td>
                                        <td>
                                            <?php
                                            if ($data['gudang'] === 'GUDANG BAHAN') {
                                                echo 'BAHAN';
                                            } elseif ($data['gudang'] === 'GUDANG STOK SPAREPART') {
                                                echo 'SPAREPART';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>

                                        <td><?= number_format(isset($data['total_jumlah']) ? $data['total_jumlah'] : 0, 0, ',', '.'); ?></td>

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
                                    <tr data-satuan="<?= $b->sat_t ?>">
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
        <td><input type="text" name="qty[]" class="form-control"></td>
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

    // Fungsi formatNumber untuk format angka dengan format Indonesia
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        }).format(number);
    }

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
        // Handle click on table rows
        $('.clickable-row').on('click', function() {
            const rowData = {
                id: $(this).data('id'),
                ppn: $(this).data('ppn'),
                kode: $(this).data('kode'),
                supplier: $(this).data('supplier'),
                nomor: $(this).data('nomor'),
                kota: $(this).data('kota'),
                alamat: $(this).data('alamat'),
                pembayaran: $(this).data('pembayaran'),
                jatuh_tempo: $(this).data('jatuh_tempo'),
                gudang: $(this).data('gudang'),
                term: $(this).data('term'),
                keterangan: $(this).data('keterangan'),
            };

            // Isi form dengan data dari baris yang diklik
            $('#no_faktur').val(rowData.id); // Set No. Faktur
            $('#kode_supplier').val(rowData.kode);
            $('#supplier').val(rowData.supplier);
            $('#nomor').val(rowData.nomor);
            $('#kota').val(rowData.kota);
            $('#alamat').val(rowData.alamat);
            $('#pembayaran').val(rowData.pembayaran); // Set metode pembayaran
            $('#jatuh_tempo').val(rowData.jatuh_tempo); // Set tanggal jatuh tempo
            $('#gudang').val(rowData.gudang); // Set gudang
            $('#term').val(rowData.term); // Set term
            $('#keterangan').val(rowData.keterangan); // Set keterangan

            // Atur dropdown PPN berdasarkan nilai ppn (11 untuk PPN, 0 untuk NON PPN)
            if (rowData.ppn == 11) {
                $('#ppn').val('PPN'); // Pilih opsi PPN
            } else if (rowData.ppn == 0) {
                $('#ppn').val('NON PPN'); // Pilih opsi NON PPN
            }

            // Hide the modal after selecting a row
            $('#no-kend').modal('hide');

            // Fetch additional details for the selected item
            getDetailBarang(rowData.nomor);
        });

        function getDetailBarang(no_po) {
            $.ajax({
                url: 'getDetail/' + no_po,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data dari server:", data);

                    // Kosongkan tbody sebelum mengisi dengan data baru
                    $('#detail-barang-body').empty();

                    // Iterasi untuk setiap item dalam data
                    $.each(data, function(index, item) {
                        const qty = item.qty ? parseFloat(item.qty) : 0;
                        const harga = item.harga ? parseFloat(item.harga) : 0;
                        const disc = item.disc ? parseFloat(item.disc) : 0;

                        // Perhitungan jumlah (qty * harga - disc)
                        const jumlah = (qty * harga) - disc;

                        // Tambahkan row baru ke tabel
                        $('#detail-barang-body').append(`
                    <tr>
                        <td><input type="text" class="form-control" name="id_kode_barang[]" value="${item.kode_barang || ''}" readonly></td>
                        <td><input type="text" class="form-control" name="nama_barang[]" value="${item.nama_barang || ''}" readonly></td>
                        <td><input type="number" class="form-control qty" name="qty[]" value="${item.qty || 0}" oninput="updateJumlah(this)"></td>
                        <td><input type="text" class="form-control" name="satuan[]" value="${item.satuan || ''}" readonly></td>
                        <td><input type="number" class="form-control harga" name="harga[]" value="${item.harga || 0}" oninput="updateJumlah(this)"></td>
                        <td><input type="number" class="form-control disc" name="disc[]" value="${item.disc || 0}" oninput="updateJumlah(this)"></td>
                        <td><input type="text" class="form-control jumlah" name="jumlah[]" value="${formatNumber(jumlah)}" readonly></td>
                        <td><input type="text" class="form-control" name="no_po[]" value="${item.no_po || ''}"></td>
                        <td><input type="text" class="form-control" name="po_id[]" value="${item.po_id || ''}"></td>
                        <td><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" ${item.ceklis ? 'checked' : ''}></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button></td>
                    </tr>
                `);
                    });

                    // Tambahkan event listener untuk tombol hapus
                    $('.remove-row').on('click', function() {
                        $(this).closest('tr').remove();
                        hitungTotal(); // Update total setelah menghapus baris
                    });

                    // Panggil hitungTotal untuk menghitung total awal setelah data ditambahkan
                    hitungTotal();
                },
                error: function(xhr, status, error) {
                    console.error("Error saat mengambil data:", xhr.responseText); // Lihat pesan error dari server
                }
            });
        }

        // Fungsi untuk menghitung total qty dan total jumlah
        function hitungTotal() {
            let totalQty = 0;
            let totalJumlah = 0;

            // Loop untuk setiap baris dalam tabel
            $('#detail-barang-body tr').each(function() {
                const qty = parseFloat($(this).find('.qty').val()) || 0;
                const jumlah = parseFloat($(this).find('.jumlah').val().replace(/,/g, '')) || 0;

                totalQty += qty;
                totalJumlah += jumlah;
            });

            // Update elemen totalQty dan totalJumlah di HTML
            $('#totalQty').text(formatNumber(totalQty));
            $('#totalJumlah').text(formatNumber(totalJumlah));
        }

        // Fungsi untuk mengupdate jumlah di setiap baris ketika qty/harga/disc berubah
        function updateJumlah(input) {
            const row = $(input).closest('tr'); // Ambil row dari input yang berubah
            const qty = parseFloat(row.find('.qty').val()) || 0;
            const harga = parseFloat(row.find('.harga').val()) || 0;
            const disc = parseFloat(row.find('.disc').val()) || 0;

            // Hitung jumlah berdasarkan qty, harga, dan diskon
            const jumlah = (qty * harga) - disc;

            // Update field jumlah di baris ini
            row.find('.jumlah').val(formatNumber(jumlah));

            // Update total setelah perhitungan di baris ini
            hitungTotal();
        }

        // Fungsi untuk memformat angka dengan koma untuk ribuan dan dua angka desimal
        function formatNumber(num) {
            return num.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }


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
            row.find('.jumlah').val(formatNumber(jumlah.toFixed(2)));
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

<?= $this->endSection() ?>