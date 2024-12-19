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
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pembayaran</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pembayaran</h5>
                </header>
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-md-6">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="id-bayar">ID Pembayaran</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="text" id="id-bayar" class="form-control" name="id-bayar" value="<?= $id_pembayaran ?>" readonly>
                                </div>
                                <div class=" col-lg-4 col-4 mb-3">
                                    <label class="col-form-label" for="tgl">Tanggal</label>
                                </div>
                                <div class="col-lg-8 col-8 mb-3">
                                    <input type="date" id="tgl" class="form-control" name="tgl" readonly>
                                </div>
                                <script>
                                    // Set Tanggal otomatis ke hari ini jika tidak ada tanggal
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
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalinvo">
                            Add Invoice
                        </button>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8">No data available.</td>
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
                                    <th>No. Invoice</th>
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
<script>
    document.getElementById('btnPembayaran').addEventListener('click', function() {
        // Langsung tampilkan alert saat tombol diklik
        Swal.fire({
            icon: 'warning',
            title: 'Invoice belum diisi!',
            text: 'Silakan isi invoice terlebih dahulu.',
            confirmButtonText: 'OK'
        });
    });
</script>

<!-- Modal Input Invoice -->
<div class="modal fade" id="modalinvo" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Buat Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <form class="form form-horizontal" action="<?= base_url('createInvoice') ?>" method="POST">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row mb-3">
                                            <!-- ID Pembayaran (Hidden) -->
                                            <div class="col-md-4">
                                                <label for="id-pembayaran" hidden>ID Pembayaran</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="id-pembayaran" class="form-control" name="id_pembayaran" value="<?= $id_pembayaran ?>" readonly hidden>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- No. Invoice -->
                                            <div class="col-md-4">
                                                <label for="nomor-invoice">No. Invoice</label>
                                            </div>
                                            <div class="col-md-7 form-group">
                                                <input type="text" id="nomor-invoice" class="form-control" name="no_invoice" required>
                                            </div>
                                            <div class="col-lg-1 col-2 mb-3">
                                                <button type="button" class="btn btn-secondary btn-sm" id="openSecondaryModal">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Tanggal Invoice -->
                                            <div class="col-md-4">
                                                <label for="tgl-invo">Tgl. Invoice</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="date" id="tgl-invo" class="form-control" name="tgl_invoice" value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Asuransi -->
                                            <div class="col-md-4">
                                                <label for="asuransi">Asuransi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="asuransi" class="form-control" name="asuransi" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Jasa -->
                                            <div class="col-md-4">
                                                <label for="jasa">Jasa</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="jasa" class="form-control" name="jasa" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Sparepart -->
                                            <div class="col-md-4">
                                                <label for="sparepart">Sparepart</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="sparepart" class="form-control" name="sparepart" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Nilai OR -->
                                            <div class="col-md-4">
                                                <label for="nilai_or">Nilai OR</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nilai_or" class="form-control" name="nilai_or" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Total (Hidden) -->
                                            <div class="col-md-4">
                                                <label for="total">Total</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="total" class="form-control" name="total" readonly>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Keterangan -->
                                            <div class="col-md-4">
                                                <label for="ket">Keterangan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea rows="1" id="ket" class="form-control" name="keterangan"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <!-- Keterangan Invoice (Hidden) -->
                                            <div class="col-md-4">
                                                <label for="ket-inv" hidden>Keterangan Invoice</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input rows="1" id="ket-inv" class="form-control" name="keterangan_invoice" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
<div class="modal fade" id="secondarymodal" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Pilih Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Pencarian Invoice -->
                <div class="mb-3">
                    <label for="search-input" class="form-label">Cari Invoice</label>
                    <input type="text" id="search-input" class="form-control" name="search" placeholder="Cari berdasarkan nomor faktur atau nama pelanggan...">
                </div>
                <!-- Tabel Invoice -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0" style="font-size: 14px;">
                        <thead class="table-dark">
                            <tr>
                                <th>No. Faktur</th>
                                <th>Tgl. Faktur</th>
                                <th>No. Order</th>
                                <th>Saldo Jasa</th>
                                <th>Saldo Sparepart</th>
                                <th>Saldo OR</th>
                                <th>Total Saldo</th>
                                <th>Ket.</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($invoices)): ?>
                                <?php foreach ($invoices as $inv): ?>
                                    <tr class="selectable-row" data-invoice='{
                "nomor": "<?= isset($inv['nomor']) ? htmlspecialchars($inv['nomor']) : ''; ?>",
                "asuransi": "<?= isset($inv['asuransi']) ? htmlspecialchars($inv['asuransi']) : ''; ?>",
                "jasa": "<?= isset($inv['jasa']) ? intval($inv['jasa']) : ''; ?>",
                "sparepart": "<?= isset($inv['sparepart']) ? intval($inv['sparepart']) : ''; ?>",
                "nilai_bayar": "<?= isset($inv['nilai_bayar']) ? intval($inv['nilai_bayar']) : ''; ?>",
                "nilai_or": "<?= isset($inv['nilai_or']) ? intval($inv['nilai_or']) : ''; ?>",
                "qty_or": "<?= isset($inv['qty_or']) ? intval($inv['qty_or']) : ''; ?>",
                "keterangan": "<?= isset($inv['customer_name']) ? htmlspecialchars($inv['customer_name'] . ' - ' . $inv['jenis_mobil'] . ' ' . $inv['no_kendaraan']) : ''; ?>"
            }'>
                                        <td><?= isset($inv['nomor']) ? htmlspecialchars($inv['nomor']) : 'N/A'; ?></td>
                                        <td><?= isset($inv['tanggal']) ? htmlspecialchars($inv['tanggal']) : 'N/A'; ?></td>
                                        <td><?= isset($inv['no_order']) ? htmlspecialchars($inv['no_order']) : 'N/A'; ?></td>
                                        <td><?= isset($inv['jasa']) ? number_format($inv['jasa'], 0, ',', '.') : '0'; ?></td>
                                        <td><?= isset($inv['sparepart']) ? number_format($inv['sparepart'], 0, ',', '.') : '0'; ?></td>

                                        <?php
                                        // Menghitung nilai OR * qty OR
                                        $nilai_or = isset($inv['nilai_or']) ? intval($inv['nilai_or']) : 0;
                                        $qty_or = isset($inv['qty_or']) ? intval($inv['qty_or']) : 0;
                                        $nilai_or_total = $nilai_or * $qty_or;

                                        // Menghitung total = jasa + sparepart + nilai_or_total
                                        $jasa = isset($inv['jasa']) ? intval($inv['jasa']) : 0;
                                        $sparepart = isset($inv['sparepart']) ? intval($inv['sparepart']) : 0;
                                        $total = $jasa + $sparepart + $nilai_or_total;
                                        ?>

                                        <!-- Menampilkan total -->
                                        <td><?= number_format($nilai_or_total, 0, ',', '.'); ?></td>
                                        <td><?= number_format($total, 0, ',', '.'); ?></td>
                                        <td><?= isset($inv['customer_name']) ? htmlspecialchars($inv['customer_name'] . ' - ' . $inv['jenis_mobil'] . ' ' . $inv['no_kendaraan']) : 'N/A'; ?></td>
                                        <td><?= isset($inv['asuransi']) ? htmlspecialchars($inv['asuransi']) : 'N/A'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
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
                document.getElementById('ket-inv').value = data.keterangan;

                // Menghitung nilai OR * qty OR
                var nilai_or = parseFloat(data.nilai_or) || 0; // Mengambil nilai OR, jika tidak ada maka default 0
                var qty_or = parseInt(data.qty_or) || 0; // Mengambil qty OR, jika tidak ada maka default 0
                var nilai_or_total = nilai_or * qty_or; // Mengalikan nilai OR dengan qty OR

                // Set hasil perkalian nilai_or * qty_or ke input nilai_or
                document.getElementById('nilai_or').value = nilai_or_total;

                // Menghitung total = sparepart + jasa + nilai_or_total
                var jasa = parseFloat(data.jasa) || 0; // Mengambil nilai jasa, jika tidak ada maka default 0
                var sparepart = parseFloat(data.sparepart) || 0; // Mengambil nilai sparepart, jika tidak ada maka default 0
                var total = jasa + sparepart + nilai_or_total; // Penjumlahan jasa + sparepart + nilai_or_total

                // Set total ke input total
                document.getElementById('total').value = total;

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