<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php

    if (session()->getFlashdata('success')) : ?>
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
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Pembayaran Hutang</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Pembayaran</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Pembayaran</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="id-bayar">ID Pembayaran</label>
                                </div>

                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="id-bayar" class="form-control" name="id-bayar" readonly>
                                </div>

                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="tgl">Tanggal</label>
                                </div>

                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="date" id="tgl" class="form-control" name="tgl">
                                </div>

                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="keterangan">Keterangan</label>
                                </div>

                                <div class="col-lg-8 col-8">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= isset($pembayaran['keterangan']) ? htmlspecialchars($pembayaran['keterangan']) : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="total-kredit">Total Kredit</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="total-kredit" class="form-control" name="total-kredit" readonly>
                                </div>
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="total-debet">Total Debet</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="total-debet" class="form-control" name="total-debet" readonly>
                                </div>
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="selisih">Selisih</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="selisih" class="form-control" name="selisih" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Add Faktur
                        </button>
                        <div class="accordion mt-2" id="fakturAccordion">
                            <div class="accordion-item">
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#fakturAccordion">
                                    <div class="accordion-body">
                                        <form action="<?= base_url('/keuangan/createFaktur') ?>" method="POST">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label for="noFaktur" class="form-label">No. Faktur</label>
                                                    <input type="text" class="form-control" id="noFaktur" name="noFaktur" readonly>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="supplier" class="form-label">Supplier</label>
                                                    <input type="text" class="form-control" id="supplier" name="supplier" required>
                                                </div>

                                                <div class="col-md-6 mb-2">
                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="discountNilai" class="form-label">Disc.</label>
                                                    <input type="number" class="form-control" id="discountNilai" name="discountNilai" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="subtotal" class="form-label">Subtotal</label>
                                                    <input type="number" class="form-control" id="subtotal" name="subtotal" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="ppnPersen" class="form-label">PPN %</label>
                                                    <input type="number" class="form-control" id="ppnPersen" name="ppnPersen" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="netto" class="form-label">Netto</label>
                                                    <input type="number" class="form-control" id="netto" name="netto" required>
                                                </div>

                                                <input type="text" id="kodeBayar" name="kodeBayar" hidden>
                                                <input type="text" id="kodeSupplier" name="kodeSupplier" hidden>
                                                <input type="text" id="jatuhTempo" name="jatuhTempo" hidden>
                                                <input type="text" id="ppnValue" name="ppnValue" hidden>
                                            </div>

                                            <button type="submit" class="btn btn-success btn-sm mt-2">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Faktur Table -->
                        <table class="table table-bordered text-center mt-2" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Kode Bayar</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Jumlah</th>
                                    <th>Discount Nilai</th>
                                    <th>Subtotal</th>
                                    <th>PPN %</th>
                                    <th>PPN Value</th>
                                    <th>Netto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="fakturTableBody">
                                <tr>
                                    <td colspan="12">No data available.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <button type="button" id="btnPembayaran" class="btn btn-primary btn-sm">
                            Pembayaran
                        </button>
                        <table class="table table-bordered text-center mt-2" style="font-size:12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Bayar</th>
                                    <th>Pembayaran</th>
                                    <th>No Bukti /BG /SO</th>
                                    <th>Kode Bank</th>
                                    <th>Debet</th>
                                    <th>Jatuh Tempo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Faktur -->
<div class="modal fade" id="fakturModal" tabindex="-1" aria-labelledby="fakturModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fakturModalLabel">Pilih No. Faktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Input Pencarian -->
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari No. Faktur, Supplier, atau Kode Bayar..." onkeyup="searchTable()">
                </div>
                <table id="fakturTable" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No. Faktur</th>
                            <th>Tanggal</th>
                            <th>Kode Bayar</th>
                            <th>Supplier</th>
                            <th>Jatuh Tempo</th>
                            <th>Jumlah</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th>PPN %</th>
                            <th hidden>PPN Value</th>
                            <th hidden>Kode Supplier</th>
                            <th>Netto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($faktur)): ?>
                            <?php foreach ($faktur as $item): ?>
                                <tr onclick="fillInputFields(this)">
                                    <td><?php echo $item['no_faktur']; ?></td>
                                    <td><?php echo $item['tanggal']; ?></td>
                                    <td><?php echo $item['pembayaran']; ?></td>
                                    <td><?php echo $item['supplier']; ?></td>
                                    <td><?php echo $item['jatuh_tempo']; ?></td>
                                    <td><?php echo number_format($item['total_jumlah'], 0, ',', '.'); ?></td>
                                    <td><?php echo number_format(0, 0, ',', '.'); ?></td>
                                    <td><?php echo number_format($item['total_jumlah'], 0, ',', '.'); ?></td>
                                    <td><?php echo number_format($item['ppn'], 0, ',', '.'); ?></td>
                                    <td hidden><?php echo number_format($item['nilai_ppn'], 0, ',', '.'); ?></td>
                                    <td hidden><?php echo $item['kode_supplier']; ?></td>
                                    <td><?php echo number_format($item['netto'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10">Tidak ada data tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Pencarian dan Input Otomatis Faktur -->
<script>
    // Fungsi pencarian pada tabel
    function searchTable() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('fakturTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) {
            var td = tr[i].getElementsByTagName('td');
            var found = false;

            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    var txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            tr[i].style.display = found ? "" : "none";
        }
    }

    function fillInputFields(row) {
        var cells = row.getElementsByTagName('td');

        // Memastikan setiap sel ada dan mengisi input dengan data dari tabel
        document.getElementById('noFaktur').value = cells[0]?.textContent?.trim() || '';
        document.getElementById('tanggal').value = cells[1]?.textContent?.trim() || '';
        document.getElementById('supplier').value = cells[3]?.textContent?.trim() || ''; // Supplier diambil dari kolom ke-4 (indeks 3)
        document.getElementById('kodeSupplier').value = cells[10]?.textContent?.replace(/\./g, '') || '0'; // Indeks kode supplier dari tabel
        document.getElementById('jumlah').value = cells[5]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('discountNilai').value = '0';
        document.getElementById('subtotal').value = cells[7]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('ppnPersen').value = cells[8]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('ppnValue').value = cells[9]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('netto').value = cells[11]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('kodeBayar').value = cells[2]?.textContent?.trim() || ''; // Kode Bayar di kolom ke-3 (indeks 2)
        document.getElementById('jatuhTempo').value = cells[4]?.textContent?.trim() || '';

        // Tutup modal setelah mengisi form
        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('fakturModal'));
        modal.hide();
    }
</script>










<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Script Buka Modal Faktur -->
<script>
    $(document).ready(function() {
        // Membuka modal ketika input No. Faktur diklik
        $('#noFaktur').on('click', function() {
            $('#fakturModal').modal('show'); // Menampilkan modal
        });

        // Event untuk tombol Simpan
        $('#simpanFaktur').on('click', function() {
            // Ambil nilai dari form dan lakukan proses penyimpanan di sini
            var noFaktur = $('#noFakturModal').val();
            console.log("No. Faktur disimpan: " + noFaktur);

            // Tutup modal setelah menyimpan
            $('#fakturModal').modal('hide');
        });
    });
</script>
<!-- Horizontal Input end -->
<script>
    // Wait until the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        // Add click event listener to the button
        document.getElementById("btnPembayaran").addEventListener("click", function() {
            // Show SweetAlert2
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: 'Harap Tambahkan Faktur Terlebih Dahulu!!!',
                confirmButtonText: 'OK'
            });
        });
    });
</script>

<!-- Script Add Faktur -->
<script>
    document.getElementById('btnAddFaktur').onclick = function() {
        // Menampilkan form input faktur
        document.getElementById('fakturForm').style.display = 'block';
    };

    document.getElementById('addToTable').onclick = function() {
        // Mendapatkan nilai dari input
        const noFaktur = document.getElementById('noFaktur').value;
        const tanggal = document.getElementById('tanggal').value;
        const kodeBayar = document.getElementById('kodeBayar').value;
        const jatuhTempo = document.getElementById('jatuhTempo').value;
        const jumlah = document.getElementById('jumlah').value;
        const discount = document.getElementById('discount').value;
        const subtotal = document.getElementById('subtotal').value;
        const ppnPersen = document.getElementById('ppnPersen').value;
        const ppnValue = document.getElementById('ppnValue').value;
        const netto = document.getElementById('netto').value;

        // Menambahkan baris baru ke tabel
        const tableBody = document.getElementById('fakturTableBody');
        const newRow = tableBody.insertRow(tableBody.rows.length - 1); // Insert before "No data available."
        newRow.innerHTML = `
            <td>${tableBody.rows.length - 1}</td>
            <td>${noFaktur}</td>
            <td>${tanggal}</td>
            <td>${kodeBayar}</td>
            <td>${jatuhTempo}</td>
            <td>${jumlah}</td>
            <td>${discount}</td>
            <td>${subtotal}</td>
            <td>${ppnPersen}</td>
            <td>${ppnValue}</td>
            <td>${netto}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
            </td>
        `;

        // Menyembunyikan form setelah menambahkan data
        document.getElementById('fakturForm').style.display = 'none';

        // Menghapus "No data available." jika ada data
        if (tableBody.rows.length > 1) {
            tableBody.deleteRow(0); // Menghapus baris "No data available."
        }

        // Mengosongkan input setelah ditambahkan
        document.getElementById('formFaktur').reset();
    };

    document.getElementById('cancelInput').onclick = function() {
        // Menyembunyikan form jika cancel
        document.getElementById('fakturForm').style.display = 'none';
    };

    function deleteRow(button) {
        // Menghapus baris dari tabel
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // Menambah kembali baris "No data available." jika tidak ada data
        const tableBody = document.getElementById('fakturTableBody');
        if (tableBody.rows.length === 1) {
            const noDataRow = tableBody.insertRow(0);
            noDataRow.innerHTML = '<td colspan="12">No data available.</td>';
        }
    }
</script>


<?= $this->endSection() ?>