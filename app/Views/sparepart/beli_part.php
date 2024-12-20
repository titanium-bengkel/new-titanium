<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/pesan_part') ?>" class="breadcrumb-link text-primary fw-bold">List Pemesanan</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pemesanan Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pemesanan Sparepart NON-SUPPLY</h5>
                </header>
                <div class="card-body">
                    <!-- Section ID -->
                    <form action="<?= base_url('create_partadd'); ?>" method="post">
                        <h5>Detail Pemesanan</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_pesan">Nomor</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_pesan" class="form-control" name="id_pesan" value="<?= $generatedId; ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control" name="tanggal" onkeydown="return false" onclick="this.showPicker()">
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
                            <!-- <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jatuh_tempo">Jatuh tempo</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onkeydown="return false" onclick="this.showPicker()" required>
                            </div> -->
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"></textarea>
                            </div>
                        </div>

                        <!-- Section Data -->
                        <h5>Detail Work Order</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="wo">WO</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="wo" class="form-control" name="wo">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Customer</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="asuransi" class="form-control" name="asuransi">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Jenis Mobil</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control" name="jenis_mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="warna" class="form-control" name="warna">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_kendaraan">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan">
                            </div>
                        </div>
                        <!-- Section Detail Barang -->
                        <button type="button" class="btn btn-success btn-sm mb-3" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                        <div class="table-responsive">
                            <table class="table table-bordered my-table-class text-center" style="font-size: 14px">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Pilih All <input type="checkbox" id="pilih-all"></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body">
                                    <tr>
                                        <td><input type="text" class="form-control" name="kode_barang[]" data-bs-toggle="modal" data-bs-target="#kodeBarangModal"></td>
                                        <td><input type="text" class="form-control" name="nama_barang[]"></td>
                                        <td><input type="text" class="form-control qty" name="qty[]" required></td>
                                        <td><input type="text" class="form-control" name="satuan[]"></td>
                                        <td><input type="text" class="form-control harga" name="harga[]"></td>
                                        <td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>
                                        <td>
                                            <input type="checkbox" class="form-check-input pilih-checkbox" name="pilih_checkbox[]" value="0" onchange="this.value=this.checked ? 1 : 0">
                                        </td>
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
                        <!-- Action Buttons -->
                        <div class="form-group row align-items-center">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('pesan_part'); ?>" class="btn btn-danger">Batal</a>
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
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="myModalLabel1">Cari Supplier</h5>
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
                    <table class="table table-bordered table-hover table-striped text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
                            </tr>
                        </thead>
                        <tbody id="supplier-list">
                            <?php if (!empty($supplier)) : ?>
                                <?php foreach ($supplier as $a) : ?>
                                    <tr class="clickable-row" data-kode="<?= $a['kode'] ?>" data-nama="<?= $a['nama'] ?>">
                                        <td><?= $a['kode'] ?></td>
                                        <td><?= $a['nama'] ?></td>
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
        </div>
        <div class="modal-footer bg-light mb-5">
            <!-- Null -->
        </div>
    </div>
</div>

<!-- Modal Order -->
<div class="modal fade text-left" id="repair" tabindex="-1" aria-labelledby="repairLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="repairLabel">Data Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-wo" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-wo" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped text-center" style="font-size: 12px;">
                        <thead class="table-secondary">
                            <tr>
                                <th>WO</th>
                                <th>Car Model</th>
                                <th>Nopol</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <?php if (!empty($po)) : ?>
                                <?php foreach ($po as $data) : ?>
                                    <tr data-pemilik="<?= esc($data['customer_name']) ?>">
                                        <td><?= esc($data['id_terima_po']) ?></td>
                                        <td><?= esc($data['jenis_mobil']) ?></td>
                                        <td><?= esc($data['no_kendaraan']) ?></td>
                                        <td><?= esc($data['warna']) ?></td>
                                        <td><?= esc($data['tahun_kendaraan']) ?></td>
                                        <td><?= esc($data['asuransi']) ?></td>
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
            </div>
            <div class="modal-footer bg-light mb-5">
                <!-- Null -->
            </div>
        </div>
    </div>
</div>
<!-- End -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen pencarian dan daftar baris pada tabel
        const searchInput = document.getElementById('search-wo');
        const tableBody = document.getElementById('order-list');
        const tableRows = tableBody.getElementsByTagName('tr');

        // Fungsi untuk menyaring baris berdasarkan input pencarian
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase(); // Ambil input pencarian dan ubah jadi huruf kecil
            Array.from(tableRows).forEach(row => {
                const rowText = row.textContent.toLowerCase(); // Ambil seluruh teks dalam baris
                // Tampilkan atau sembunyikan baris berdasarkan pencocokan
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    });
</script>




<!-- modal detail barang -->
<div class="modal fade" id="kodeBarangModal" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Data Sparepart</h5>
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
                            <?php if (!empty($sparepart)) : ?>
                                <?php foreach ($sparepart as $part) : ?>
                                    <tr data-satuan="<?= esc($part['satuan']) ?>">
                                        <td><?= esc($part['kode_part']) ?></td>
                                        <td><?= esc($part['nama_part']) ?></td>
                                        <td><?= esc($part['harga_beliawal']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">Data sparepart tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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
        $('#total-qty').val(formatNumber(totalQty));
        $('#total-jumlah').val(formatNumber(totalJumlah));
    }

    $(document).ready(function() {
        $('#add-row-btn').click(function() {
            // Menambahkan baris baru dengan input baru
            var row = '<tr>' +
                '<td><input type="text" class="form-control" name="kode_barang[]" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly></td>' +
                '<td><input type="text" class="form-control" name="nama_barang[]"></td>' +
                '<td><input type="text" class="form-control qty" name="qty[]" required></td>' +
                '<td><input type="text" class="form-control" name="satuan[]"></td>' +
                '<td><input type="text" class="form-control harga" name="harga[]"></td>' +
                '<td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>' +
                '<td><input type="checkbox" class="form-check-input pilih-checkbox" name="pilih_checkbox[]" value="0" onchange="this.value=this.checked ? 1 : 0"></td>' +
                '<td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button></td>' +
                '</tr>';

            // Menambahkan baris ke tbody
            $('#detail-barang-body').append(row);

            // Menambahkan event listener untuk tombol remove (hapus) yang baru
            updateRemoveButtonStatus(); // Memperbarui status tombol remove (jika ada logika lain)
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
            const satuanBarang = $(this).data('satuan');

            // Mengisi data ke baris yang sedang dipilih di tabel utama
            if (selectedRow) {
                selectedRow.find('input[name="kode_barang[]"]').val(kodeBarang);
                selectedRow.find('input[name="nama_barang[]"]').val(namaBarang);
                selectedRow.find('input[name="harga[]"]').val(hargaBarang);
                selectedRow.find('input[name="satuan[]"]').val(satuanBarang); // Mengisi input satuan
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
                document.getElementById('supplier').value = nama; // Set the name to the input field

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('supp'));
                modal.hide();
            });
        });
    });

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
            $('#wo').val(noOrder);
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
</script>

<?= $this->endSection() ?>