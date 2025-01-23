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
                        <a href="<?= base_url('/pembayaran_hutang') ?>" class="breadcrumb-link text-primary fw-bold">Pembayaran Hutang</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Prev Pembayaran</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Prev Pembayaran Hutang</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-start">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="id-bayar">ID Pembayaran</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="text" id="id-bayar" class="form-control" name="id-bayar" value="<?= $pembayaran['id_pembayaran'] ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="supplier">Supplier</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="text" id="supplier" class="form-control" name="supplier"
                                        value="<?= $pembayaran['kode_supplier'] . ' - ' . $pembayaran['supplier'] ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="tgl">Tanggal</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="date" id="tgl" class="form-control" name="tgl" value="<?= $pembayaran['tanggal'] ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="keterangan">Keterangan</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="1" readonly><?= $pembayaran['keterangan'] ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="total-kredit">Total Kredit</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="text" id="total-kredit" class="form-control" name="total-kredit" value="<?= number_format($pembayaran['kredit'], 0, ',', '.'); ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="total-debet">Total Debet</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="text" id="total-debet" class="form-control" name="total-debet" value="<?= number_format($pembayaran['debit'], 0, ',', '.'); ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="selisih">Selisih</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <input type="text" id="selisih" class="form-control" name="selisih" value="<?= number_format($pembayaran['saldo'], 0, ',', '.'); ?>" readonly>
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
                                                    <input type="text" class="form-control" id="noFaktur" name="noFaktur" value="<?= htmlspecialchars($pembayaran['no_faktur'] ?? '') ?>" readonly>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($pembayaran['tanggal'] ?? '') ?>" required>
                                                </div>

                                                <div class="col-md-6 mb-2">
                                                    <label for="jumlah" class="form-label">Jumlah</label>
                                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= htmlspecialchars($pembayaran['jumlah'] ?? '') ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="discountNilai" class="form-label">Disc.</label>
                                                    <input type="number" class="form-control" id="discountNilai" name="discountNilai" value="<?= htmlspecialchars($pembayaran['discount_nilai'] ?? '') ?>" required>
                                                </div>

                                                <!-- Subtotal, PPN %, dan Netto sejajar 3 kolom -->
                                                <div class="col-md-4 mb-2">
                                                    <label for="subtotal" class="form-label">Subtotal</label>
                                                    <input type="number" class="form-control" id="subtotal" name="subtotal" value="<?= htmlspecialchars($pembayaran['subtotal'] ?? '') ?>" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="ppnPersen" class="form-label">PPN %</label>
                                                    <input type="number" class="form-control" id="ppnPersen" name="ppnPersen" value="<?= htmlspecialchars($pembayaran['ppn_persen'] ?? '') ?>" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="netto" class="form-label">Netto</label>
                                                    <input type="number" class="form-control" id="netto" name="netto" value="<?= htmlspecialchars($pembayaran['netto'] ?? '') ?>" required>
                                                </div>

                                                <input type="hidden" id="ppnValue" name="ppnValue" value="<?= htmlspecialchars($pembayaran['ppn_value'] ?? '') ?>">
                                                <input type="hidden" id="kodeBayar" name="kodeBayar" value="<?= htmlspecialchars($pembayaran['kode_bayar'] ?? '') ?>">
                                                <input type="hidden" id="tglPembayaran" name="tglPembayaran" value="<?= htmlspecialchars($pembayaran['jatuh_tempo'] ?? '') ?>">
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
                                    <th>No Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Kode Bayar</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Jumlah</th>
                                    <th>Disc.</th>
                                    <th>Subtotal</th>
                                    <th>PPN Persen</th>
                                    <th>PPN Value</th>
                                    <th>Netto</th>
                                </tr>
                            </thead>
                            <tbody id="fakturTableBody">
                                <?php if (!empty($pembayaran)): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pembayaran['no_faktur']); ?></td>
                                        <td><?= htmlspecialchars($pembayaran['tanggal']); ?></td>
                                        <td><?= htmlspecialchars($pembayaran['kode_bayar']); ?></td>
                                        <td><?= htmlspecialchars($pembayaran['jatuh_tempo']); ?></td>
                                        <td><?= number_format($pembayaran['jumlah'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pembayaran['discount_nilai'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pembayaran['subtotal'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pembayaran['ppn_persen'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pembayaran['ppn_value'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pembayaran['netto'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10">Tidak ada data yang tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Accordion Button -->
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#paymentAccordion" aria-expanded="false" aria-controls="paymentAccordion">
                        Pembayaran
                    </button>

                    <!-- Accordion Content -->
                    <div class="collapse mt-2" id="paymentAccordion">
                        <div class="card card-body">
                            <form action="<?= base_url('/keuangan/addPembayaran') ?>" method="POST">
                                <input type="hidden" class="form-control" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
                                <input type="hidden" class="form-control" name="no_faktur" value="<?= $pembayaran['no_faktur'] ?>">
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-2">
                                        <label for="kodeBayar" class="form-label">Kode Bayar</label>
                                        <select class="form-select" id="kodeBayar" name="kode_bayar" required>
                                            <option value="" disabled selected>--Pilih--</option>
                                            <option value="TRANSFER BCA">TRANSFER BCA</option>
                                            <option value="KAS BESAR">KAS BESAR</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="noBukti" class="form-label">No Bukti / BG / SO</label>
                                        <input type="text" class="form-control" id="noBukti" name="no_bukti" placeholder="No Bukti / BG / SO" required>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="nominal" class="form-label">Nominal</label>
                                        <input type="text" class="form-control" id="nominal" name="nominal" required>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <label for="tglPembayaran" class="form-label">Tgl. Pembayaran</label>
                                        <input type="date" class="form-control" id="tglPembayaran" name="tgl_pembayaran" value="<?= date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm mt-2">Simpan</button>
                            </form>
                        </div>
                    </div>

                    <!-- Table for Data -->
                    <div class="table-responsive">
                        <table class="table table-bordered text-center mt-3" style="font-size:14px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Bayar</th>
                                    <th>Pembayaran</th>
                                    <th>No Bukti / BG / SO</th>
                                    <th>Kode Bank</th>
                                    <th>Debet</th>
                                    <th>Tgl. Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($bayar)): ?>
                                    <?php foreach ($bayar as $index => $item): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= htmlspecialchars($item['kode_bayar']); ?></td>
                                            <td></td>
                                            <td><?= htmlspecialchars($item['no_bukti']); ?></td>
                                            <td></td>
                                            <td><?= number_format($item['nominal'], 0, ',', '.'); ?></td>
                                            <td><?= htmlspecialchars($item['tgl_pembayaran']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">Tidak ada data yang tersedia.</td>
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
                            <th>Netto</th>
                        </tr>
                    </thead>
                    <tbody>

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

    // Fungsi untuk mengisi input ketika baris diklik
    function fillInputFields(row) {
        var cells = row.getElementsByTagName('td');

        // Memastikan setiap sel ada dan mengisi input dengan data dari tabel
        document.getElementById('noFaktur').value = cells[0]?.textContent?.trim() || '';
        document.getElementById('tanggal').value = cells[1]?.textContent?.trim() || ''; // Format Y-M-D langsung diambil
        document.getElementById('kodeBayar').value = cells[2]?.textContent?.trim() || '';
        document.getElementById('tglPembayaran').value = cells[4]?.textContent?.trim() || ''; // Format Y-M-D langsung diambil
        document.getElementById('jumlah').value = cells[5]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('discountNilai').value = '0';
        document.getElementById('subtotal').value = cells[7]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('ppnPersen').value = cells[8]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('ppnValue').value = cells[9]?.textContent?.replace(/\./g, '') || '0';
        document.getElementById('netto').value = cells[10]?.textContent?.replace(/\./g, '') || '0';

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
        const tglPembayaran = document.getElementById('tglPembayaran').value;
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
            <td>${tglPembayaran}</td>
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