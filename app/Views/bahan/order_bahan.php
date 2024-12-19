<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">List Pemesanan Bahan (PO)</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pemesanan Bahan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pemesanan Bahan</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('bahan/create_bahan'); ?>" method="post">
                        <h5>Data Pesan</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_po_bahan">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_po_bahan" class="form-control" name="id_po_bahan" value="<?= $generatedId; ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control" name="tanggal" onkeydown="return false" onclick="this.showPicker()">
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
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea class="form-control" id="keterangan" rows="1" name="keterangan"></textarea>
                            </div>
                        </div>

                        <!-- tabel detail barang  -->
                        <button type="button" class="btn btn-success btn-sm" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered my-table-class text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>QtyB</th>
                                        <th>SatB</th>
                                        <th>QtyT</th>
                                        <th>SatT</th>
                                        <th>QtyK</th>
                                        <th>SatK</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>No Faktur</th>
                                        <th>Tgl. Faktur</th>
                                        <th>Pilih All <input type="checkbox" id="pilih-all"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body">
                                    <tr>
                                        <td><input type="text" class="form-control" name="kode_barang[]" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>
                                        <td><input type="text" class="form-control" name="nama_barang[]"></td>
                                        <td><input type="text" class="form-control" name="qty_b[]"></td>
                                        <td><input type="text" class="form-control" name="sat_b[]"></td>
                                        <td><input type="text" class="form-control " name="qty_t[]"></td>
                                        <td><input type="text" class="form-control" name="sat_t[]"></td>
                                        <td><input type="text" class="form-control " name="qty_k[]"></td>
                                        <td><input type="text" class="form-control" name="sat_k[]"></td>
                                        <td><input type="text" class="form-control harga" name="harga[]"></td>
                                        <td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" value="1"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total Qty</td>
                                        <td><input type="text" class="form-control" id="total-qty" name="total-qty[]" readonly></td>
                                        <td colspan="2">Total Jumlah</td>
                                        <td><input type="text" class="form-control" id="total-jumlah" name="total-jumlah[]" readonly></td>
                                        <td colspan="6"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="<?= base_url('po_bahan'); ?>" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Horizontal Input end -->


<!-- Modal supplier -->
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
                                    <tr class="clickable-row" data-kode="<?= $a->kode ?>" data-nama="<?= $a->nama ?>">
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
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm">Submit</button>
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
                                    <tr data-satt="<?= $b['sat_t'] ?>" data-satb="<?= $b['sat_b'] ?>" data-satk="<?= $b['sat_k'] ?>">
                                        <td><?= $b['kode_bahan'] ?></td>
                                        <td><?= $b['nama_bahan'] ?></td>
                                        <td><?= number_format($b['harga_beli'], 0, ',', '.'); ?></td>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Tanggal -->
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



<!-- Tabel Script -->
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
            var jenisMobil = $(this).find('td:eq(1)').text();
            var nopol = $(this).find('td:eq(2)').text();
            var warna = $(this).find('td:eq(3)').text();
            var tahun = $(this).find('td:eq(4)').text();
            var asuransi = $(this).find('td:eq(5)').text();

            // Isi data ke dalam input field
            $('#no_ro').val(noOrder);
            $('#jenis_mobil').val(jenisMobil);
            $('#no_kendaraan').val(nopol);
            $('#warna').val(warna);
            $('#tahun').val(tahun);
            $('#asuransi').val(asuransi);
            $('#nama_pemilik').val(customerName);

            // Tutup modal
            $('#repair').modal('hide');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Function to filter supplier list based on search input
        document.getElementById('search-supplier').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#supplier-list tr');

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
        document.querySelectorAll('#supplier-list .clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                const nama = this.getAttribute('data-nama');
                const kode_supplier = this.getAttribute('data-kode');
                document.getElementById('supplier').value = nama;
                document.getElementById('kode_supplier').value = kode_supplier;

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('supp'));
                modal.hide();
            });
        });
    });

    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    function updateJumlah() {
        let totalQty = 0;
        let totalJumlah = 0;

        $('#detail-barang-body tr').each(function() {
            // Get the raw unformatted values from the inputs by removing formatting
            const qty = parseFloat($(this).find('.qty').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
            const harga = parseFloat($(this).find('.harga').val().replace(/\./g, '').replace(/,/g, '.')) || 0;

            // Perform the multiplication
            const jumlah = qty * harga;

            // Set the formatted value in the jumlah field
            $(this).find('.jumlah').val(formatNumber(jumlah));

            // Add to totals
            totalQty += qty;
            totalJumlah += jumlah;
        });

        // Set the formatted totals
        $('#total-qty').val(formatNumber(totalQty));
        $('#total-jumlah').val(formatNumber(totalJumlah));
    }

    // Formatting function to handle numbers with Indonesian style (thousands separator and no decimals)
    function formatNumber(number) {
        return number.toLocaleString('id-ID', {
            minimumFractionDigits: 0
        });
    }


    $(document).ready(function() {
        // Menambahkan baris
        $('#add-row-btn').click(function() {
            var row = '<tr>' +
                '<td><input type="text" class="form-control" name="kode_barang[]" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>' +
                '<td><input type="text" class="form-control" name="nama_barang[]"></td>' +
                '<td><input type="text" class="form-control qty" name="qty_b[]"></td>' +
                '<td><input type="text" class="form-control" name="sat_b[]"></td>' +
                '<td><input type="text" class="form-control qty" name="qty_t[]"></td>' +
                '<td><input type="text" class="form-control" name="sat_t[]"></td>' +
                '<td><input type="text" class="form-control qty" name="qty_k[]"></td>' +
                '<td><input type="text" class="form-control" name="sat_k[]"></td>' +
                '<td><input type="text" class="form-control harga" name="harga[]"></td>' +
                '<td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" value="1"></td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>' +
                '</td>' +
                '</tr>';
            $('#detail-barang-body').append(row);
            updateRemoveButtonStatus();
        });

        // Menyimpan referensi baris yang sedang dipilih
        $('#detail-barang-body').on('click', 'input[name="kode_barang[]"]', function() {
            selectedRow = $(this).closest('tr'); // Simpan referensi baris yang diklik
        });

        // Mengisi data ke baris yang dipilih ketika item di modal dipilih
        $('#kodeBarangModal tbody').on('click', 'tr', function() {
            // Mendapatkan data dari baris yang dipilih di modal
            const kodeBarang = $(this).find('td:eq(0)').text();
            const namaBarang = $(this).find('td:eq(1)').text();
            const hargaBarang = $(this).find('td:eq(2)').text();
            const sat_b = $(this).data('satb'); // Mendapatkan data satuan sat_b dari atribut data-satb
            const sat_t = $(this).data('satt'); // Mendapatkan data satuan sat_t dari atribut data-satt
            const sat_k = $(this).data('satk'); // Mendapatkan data satuan sat_k dari atribut data-satk

            // Mengisi data ke baris yang sedang dipilih di tabel utama
            if (selectedRow) {
                selectedRow.find('input[name="kode_barang[]"]').val(kodeBarang);
                selectedRow.find('input[name="nama_barang[]"]').val(namaBarang);
                selectedRow.find('input[name="harga[]"]').val(hargaBarang);
                selectedRow.find('input[name="sat_b[]"]').val(sat_b); // Mengisi input satuan sat_b
                selectedRow.find('input[name="sat_t[]"]').val(sat_t); // Mengisi input satuan sat_t
                selectedRow.find('input[name="sat_k[]"]').val(sat_k); // Mengisi input satuan sat_k
            }

            // Menutup modal
            $('#kodeBarangModal').modal('hide');
        });

        // Menghapus baris
        $('.my-table-class tbody').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateRemoveButtonStatus();
            updateJumlah();
        });

        // Fungsi untuk mengatur status tombol kurangi
        function updateRemoveButtonStatus() {
            var rowCount = $('.my-table-class tbody tr').length;
            if (rowCount === 1) {
                $('.my-table-class .remove-row').prop('disabled', true); // Menonaktifkan tombol jika hanya ada satu baris
            } else {
                $('.my-table-class .remove-row').prop('disabled', false); // Mengaktifkan tombol jika lebih dari satu baris
            }
        }

        // Memastikan status tombol saat halaman dimuat
        updateRemoveButtonStatus();

        // Fungsi untuk checkbox "Pilih All"
        $('#pilih-all').click(function() {
            var isChecked = $(this).is(':checked');
            $('.my-table-class .pilih-checkbox').prop('checked', isChecked);
        });

        // Pastikan checkbox "Pilih All" terupdate ketika checkbox lain di-klik
        $('.my-table-class').on('click', '.pilih-checkbox', function() {
            var allChecked = $('.my-table-class .pilih-checkbox').length === $('.my-table-class .pilih-checkbox:checked').length;
            $('#pilih-all').prop('checked', allChecked);
        });

        // Update jumlah ketika input qty atau harga berubah
        $('.my-table-class tbody').on('input', '.qty, .harga', function() {
            updateJumlah();
        });

        // Inisialisasi awal
        updateJumlah();
    });
</script>


<?= $this->endSection() ?>