<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php

    use App\Models\M_Pembayaran;

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
        <div class="container mt-4">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/bayar_piutang') ?>" class="breadcrumb-link text-primary fw-bold">List Pembayaran</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pembayaran Piutang</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pembayaran Piutang</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="id-bayar">ID Pembayaran</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="id-bayar" class="form-control" name="id-bayar"
                                        value="<?= isset($bayar['id_pembayaran']) ? htmlspecialchars($bayar['id_pembayaran']) : ''; ?>" readonly>
                                </div>
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="tgl">Tanggal</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="date" id="tgl" class="form-control" name="tgl"
                                        value="<?= isset($bayar['tanggal']) ? htmlspecialchars($bayar['tanggal']) : ''; ?>" readonly>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var today = new Date().toISOString().split('T')[0];
                                        if (!document.getElementById('tgl').value) {
                                            document.getElementById('tgl').value = today;
                                        }
                                    });
                                </script>
                                <div class="col-lg-4 col-4">
                                    <label class="col-form-label" for="keterangan">Keterangan</label>
                                </div>
                                <div class="col-lg-8 col-8">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= isset($bayar['keterangan']) ? htmlspecialchars($bayar['keterangan']) : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="total-kredit">Total Kredit</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="total-kredit" class="form-control" name="total-kredit"
                                        value="<?= isset($bayar['total_kredit']) ? number_format($bayar['total_kredit'], 0, ',', '.') : ''; ?>" readonly>
                                </div>
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="total-debet">Total Debet</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="total-debet" class="form-control" name="total-debet"
                                        value="<?= isset($bayar['total_debet']) ? number_format($bayar['total_debet'], 0, ',', '.') : ''; ?>" readonly>
                                </div>
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="selisih">Selisih</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="selisih" class="form-control" name="selisih"
                                        value="<?= isset($bayar['selisih']) ? number_format($bayar['selisih'], 0, ',', '.') : ''; ?>" readonly>
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
                        <!-- Tombol untuk membuka modal -->
                        <button type="button" class="btn btn-primary btn-sm" id="openModalBtn">
                            Add Invoice
                        </button>

                        <!-- Script untuk menampilkan SweetAlert2 -->
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.getElementById('openModalBtn').addEventListener('click', function() {
                                // Menampilkan SweetAlert2 dengan pesan "Invoice sudah dibuat"
                                Swal.fire({
                                    icon: 'success', // Ikon berupa tanda centang hijau
                                    title: 'Invoice sudah dibuat', // Judul pesan
                                    text: 'Invoice telah berhasil dibuat dan disimpan.', // Teks tambahan
                                    confirmButtonText: 'OK' // Tombol untuk menutup SweetAlert
                                });
                            });
                        </script>

                        <table class="table table-bordered text-center mt-2" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No. Invoice</th>
                                    <th>Tgl. Invoice</th>
                                    <th>Keterangan Invoice</th>
                                    <th>Asuransi</th>
                                    <th>Jasa</th>
                                    <th>Sparepart</th>
                                    <th>OR</th>
                                    <th>Total</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($invoices)): ?>
                                    <?php foreach ($invoices as $index => $invoice): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= htmlspecialchars($invoice['no_invoice']); ?></td>
                                            <td><?= htmlspecialchars($invoice['tgl_invoice']); ?></td>
                                            <td><?= htmlspecialchars($invoice['keterangan_invoice']); ?></td>
                                            <td><?= htmlspecialchars($invoice['asuransi']); ?></td>
                                            <td><?= number_format($invoice['jasa'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($invoice['sparepart'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($invoice['nilai_or'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($invoice['total'], 0, ',', '.'); ?></td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="<?= base_url('path/to/edit/' . $invoice['id_invoice']); ?>" class="text-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <a href="<?= base_url('path/to/delete/' . $invoice['id_invoice']); ?>" class="text-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">Tidak ada data invoice yang tersedia.</td>
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
                    <div class="table-responsive">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#entryPembayaranModal">
                            Pembayaran
                        </button>
                        <table class="table table-bordered text-center mt-2" style="font-size:14px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Bayar</th>
                                    <th>Pembayaran</th>
                                    <th>No Bukti /BG /SO</th>
                                    <th>Kode Bank</th>
                                    <th>Debet</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($paymentInvoices)): ?>
                                    <?php foreach ($paymentInvoices as $index => $invoice): ?>
                                        <tr>
                                            <td><?= $index + 1; ?></td>
                                            <td><?= esc($invoice['kode_bayar']); ?></td>
                                            <td><?= esc($invoice['metode_pembayaran']); ?></td>
                                            <td><?= esc($invoice['no_bukti']); ?></td>
                                            <td><?= esc($invoice['kode_bank']); ?></td>
                                            <td><?= esc(number_format($invoice['debet'], 0, ',', '.')); ?></td>
                                            <td><?= esc($invoice['jatuh_tempo']); ?></td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="<?= base_url('path/to/edit/' . $invoice['id_pembayaran']); ?>" class="text-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <a href="<?= base_url('path/to/delete/' . $invoice['id_pembayaran']); ?>" class="text-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7">Belum ada pembayaran.</td>
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
<!-- Horizontal Input end -->

<!-- Modal Pembayaran -->
<div class="modal fade" id="entryPembayaranModal" tabindex="-1" aria-labelledby="entryPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="entryPembayaranModalLabel">Entry Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('addPembayaran'); ?>" method="post">
                    <input type="hidden" name="id_pembayaran" value="<?= esc($id_pembayaran); ?>">
                    <div class="row g-3 mb-4">
                        <!-- Kode Bayar -->
                        <div class="col-md-4">
                            <label for="kode_bayar" class="form-label">Kode Pembayaran</label>
                            <select id="kode_bayar" class="form-select" name="kode_bayar" required>
                                <option value="" disabled selected>--Pilih--</option>
                                <?php foreach ($coa as $item): ?>
                                    <option value="<?= $item['nama_account']; ?>">
                                        <?php
                                        switch ($item['nama_account']) {
                                            case 'REK BCA':
                                                echo 'TRANSFER BCA';
                                                break;
                                            case 'KAS BESAR':
                                                echo 'CASH';
                                                break;
                                            case 'TIDAK DITAGIHKAN':
                                                echo 'TIDAK DITAGIHKAN';
                                                break;
                                            case 'BEBAN DIBAYAR DIMUKA':
                                                echo 'TITIP';
                                                break;
                                            default:
                                                echo $item['nama_account'];
                                        }
                                        ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-md-4">
                            <label for="metodePembayaran" class="form-label">Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select" id="metodePembayaran" required>
                                <option value="" disabled selected>--Pilih Pembayaran--</option>
                                <option value="Pembayaran Asuransi">Pembayaran Asuransi</option>
                                <option value="Pembayaran OR">Pembayaran OR</option>
                            </select>
                        </div>


                        <!-- No Bukti -->
                        <div class="col-md-4">
                            <label for="noBukti" class="form-label">No Bukti/No BG</label>
                            <input type="text" name="no_bukti" class="form-control" id="noBukti" placeholder="No Bukti/No BG" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <!-- Bank -->
                        <div class="col-md-4">
                            <label for="bank" class="form-label">Bank</label>
                            <input type="text" name="bank" class="form-control" id="bank" placeholder="Bank" required>
                        </div>

                        <!-- Debet -->
                        <div class="col-md-4">
                            <label for="debet" class="form-label">Debet</label>
                            <input type="text" name="debet" class="form-control" id="debet" placeholder="Debet" required oninput="formatDebet(this)">
                        </div>

                        <script>
                            // Fungsi untuk memformat angka dengan pemisah ribuan
                            function formatDebet(input) {
                                // Menghapus karakter non-numeric kecuali koma dan titik
                                let value = input.value.replace(/[^0-9]/g, "");

                                // Memformat angka dengan pemisah ribuan
                                if (value) {
                                    value = new Intl.NumberFormat('id-ID').format(value);
                                }

                                // Set nilai yang sudah diformat kembali ke input
                                input.value = value;
                            }
                        </script>


                        <!-- Tanggal -->
                        <div class="col-md-4">
                            <label for="tgl-tmp" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tgl-tmp" class="form-control" onkeydown="return false" required>
                        </div>

                        <script>
                            // Mengatur input tanggal ke tanggal hari ini
                            document.addEventListener('DOMContentLoaded', function() {
                                const today = new Date().toISOString().split('T')[0]; // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
                                document.getElementById('tgl-tmp').value = today; // Set input tanggal ke tanggal hari ini
                            });
                        </script>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-success me-2">Add</button>
                        <button type="button" class="btn btn-sm btn-warning" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal Input Invoice -->
<div class="modal fade text-left" id="modalinvo" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Entry invoice yang telah terima pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <form class="form form-horizontal" action="<?= base_url('addInvoice') ?>" method="POST">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="id-pembayaran" hidden>ID Pembayaran</label>
                                            </div>
                                            <div class="col-md-7 form-group">
                                                <input type="text" id="id-pembayaran" class="form-control" name="id_pembayaran" value="<?= isset($id_pembayaran) ? htmlspecialchars($id_pembayaran) : ''; ?>" hidden>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nomor-invoice">No. Invoice </label>
                                            </div>
                                            <div class="col-md-7 form-group">
                                                <input type="text" id="nomor-invoice" class="form-control" name="no_invoice">
                                            </div>
                                            <div class="col-lg-1 col-2 mb-3">
                                                <button type="button" class="btn btn-secondary btn-sm" id="openSecondaryModal">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tgl-invo">Tgl. Invoice</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="date" id="tgl-invo" class="form-control" name="tgl_invoice" value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="asuransi">Asuransi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="asuransi" class="form-control" name="asuransi">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="jasa">Jasa</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="jasa" class="form-control" name="jasa" oninput="formatCurrency(this); calculateTotal();">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="sparepart">Sparepart</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="sparepart" class="form-control" name="sparepart" oninput="formatCurrency(this); calculateTotal();">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="total" hidden>Total</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="total" class="form-control" name="total" readonly>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="ket">Keterangan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="ket" class="form-control" name="keterangan">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="ket-inv" hidden>Keterangan Invoice</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input rows="1" id="ket-inv" class="form-control" name="keterangan_invoice" hidden>
                                            </div>
                                        </div>

                                        <script>
                                            function formatCurrency(input) {
                                                // Hapus semua karakter kecuali angka
                                                let value = input.value.replace(/[^\d]/g, '');
                                                // Ubah menjadi integer
                                                let numericValue = parseFloat(value) || 0;
                                                // Format dengan pemisah ribuan
                                                input.value = numericValue.toLocaleString('id-ID', {
                                                    minimumFractionDigits: 0,
                                                    maximumFractionDigits: 0
                                                });
                                            }


                                            function calculateTotal() {
                                                const jasa = parseFloat(document.getElementById('jasa').value.replace(/[^\d]/g, '').replace(/,/g, '')) || 0;
                                                const sparepart = parseFloat(document.getElementById('sparepart').value.replace(/[^\d]/g, '').replace(/,/g, '')) || 0;
                                                const total = jasa + sparepart;

                                                document.getElementById('total').value = total.toLocaleString('id-ID', {
                                                    minimumFractionDigits: 0,
                                                    maximumFractionDigits: 0
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary ms-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Invoice sebagai modal sekunder -->
<div class="modal fade text-left" id="secondarymodal" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Pilih Invoice</h5>
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
                    <table class="table table-bordered text-center mb-0" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>No. Faktur</th>
                                <th>Tgl. Faktur</th>
                                <th>No. Order</th>
                                <th>Saldo Jasa</th>
                                <th>Saldo Sparepart</th>
                                <th>Total Saldo</th>
                                <th>Ket.</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataMerger)): ?>
                                <?php foreach ($dataMerger as $inv): ?>
                                    <tr class="selectable-row" data-invoice='{
                                        "nomor": "<?= isset($inv['nomor']) ? htmlspecialchars($inv['nomor']) : ''; ?>",
                                        "asuransi": "<?= isset($inv['asuransi']) ? htmlspecialchars($inv['asuransi']) : ''; ?>",
                                        "jasa": "<?= isset($inv['jasa']) ? intval($inv['jasa']) : ''; ?>",
                                        "sparepart": "<?= isset($inv['sparepart']) ? intval($inv['sparepart']) : ''; ?>",
                                        "nilai_total": "<?= isset($inv['nilai_total']) ? intval($inv['nilai_total']) : ''; ?>",
                                        "keterangan": "<?= isset($inv['customer_name']) ? htmlspecialchars($inv['customer_name'] . ' - ' . $inv['jenis_mobil'] . ' ' . $inv['no_kendaraan']) : ''; ?>"
                                    }'>
                                        <td><?= isset($inv['nomor']) ? htmlspecialchars($inv['nomor']) : ''; ?></td>
                                        <td><?= isset($inv['tanggal']) ? htmlspecialchars($inv['tanggal']) : ''; ?></td>
                                        <td><?= isset($inv['no_order']) ? htmlspecialchars($inv['no_order']) : ''; ?></td>
                                        <td><?= isset($inv['jasa']) ? number_format($inv['jasa'], 0, ',', '.') : '0'; ?></td> <!-- Format dengan ribuan -->
                                        <td><?= isset($inv['sparepart']) ? number_format($inv['sparepart'], 0, ',', '.') : '0'; ?></td> <!-- Format dengan ribuan -->
                                        <td><?= isset($inv['nilai_total']) ? number_format($inv['nilai_total'], 0, ',', '.') : '0'; ?></td> <!-- Format dengan ribuan -->
                                        <td><?= isset($inv['customer_name']) ? htmlspecialchars($inv['customer_name'] . ' - ' . $inv['jenis_mobil'] . ' ' . $inv['no_kendaraan']) : ''; ?></td>
                                        <td><?= isset($inv['asuransi']) ? htmlspecialchars($inv['asuransi']) : ''; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8">No data available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary ms-1">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var rows = document.querySelectorAll('.selectable-row');
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                var data = JSON.parse(this.getAttribute('data-invoice'));

                // Set value ke input field yang sesuai
                document.getElementById('nomor-invoice').value = data.nomor;
                document.getElementById('asuransi').value = data.asuransi;
                document.getElementById('jasa').value = data.jasa;
                document.getElementById('sparepart').value = data.sparepart;
                document.getElementById('total').value = data.nilai_total;
                document.getElementById('ket-inv').value = data.keterangan;

                // Tutup modal sekunder (jika ada)
                var modalSec = bootstrap.Modal.getInstance(document.getElementById('secondarymodal'));
                if (modalSec) {
                    modalSec.hide();
                }
            });
        });

        // Event handler untuk membuka modal sekunder
        document.getElementById('openSecondaryModal').addEventListener('click', function() {
            var modalSec = new bootstrap.Modal(document.getElementById('secondarymodal'));
            modalSec.show();
        });
    });
</script>

<script>
    // Open the secondary modal without hiding the primary modal
    $('#openSecondaryModal').on('click', function() {
        // Create an instance of the secondary modal
        var secondaryModal = new bootstrap.Modal(document.getElementById('secondarymodal'));
        secondaryModal.show(); // Show the secondary modal
    });

    // Optional: Handle when the secondary modal is hidden
    $('#secondarymodal').on('hidden.bs.modal', function() {
        // You can do something here if needed when the secondary modal is closed
    });

    // Automatically set today's date in the invoice date input
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl-invo').value = todayString; // Update the correct ID for your date input
    });
</script>


<?= $this->endSection() ?>