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
<script>
    if (!sessionStorage.getItem('alertShown')) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'info',
            title: 'Permintaan dari SA telah disetujui',
            html: `
                <p>Jika tidak terlihat di sini, segera hubungi SA untuk konfirmasi.</p>
                <p>Silakan klik detail sebelum membuat PO untuk memeriksa dan mengedit keterangan.</p>
                <p>Pastikan sparepart yang diminta tersedia dalam stok atau perlu diganti.</p>
            `,
            showConfirmButton: false,
            timer: 5000,
            width: '550px',
            padding: '20px',
        });

        // Tandai bahwa alert telah ditampilkan
        sessionStorage.setItem('alertShown', 'true');
    }
</script>

<section class="section">
    <div class="col-12">
        <div class="card">
            <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                <div class="breadcrumb-wrapper" style="font-size: 14px;">
                    <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                    <span class="breadcrumb-divider text-muted mx-3">/</span>
                    <span class="breadcrumb-current text-muted">Permintaan Sparepart</span>
                </div>
                <h5 class="page-title mb-0 fw-bold">Permintaan Sparepart NON-SUPPLY</h5>
            </header>
            <div class="card-content">
                <div class="table-responsive" style="font-size: 12px; margin:20px;">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr style="text-align: center;">
                                <th>#</th>
                                <th>No. Order</th>
                                <th>Tgl. Klaim</th>
                                <th>Tgl. Acc</th>
                                <th>Jenis Mobil</th>
                                <th>Nopol</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                                <th>SA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($poData)): ?>
                                <?php
                                $hasData = false;
                                $displayedIds = [];
                                $displayedCount = 0;

                                foreach ($poData as $data):
                                    $showData = true;

                                    // Jika data berasal dari M_Po, periksa kondisi asuransi dan status
                                    if (isset($data['status'])) {
                                        if ($data['asuransi'] === 'UMUM/PRIBADI' || $data['status'] === 'Acc Asuransi') {
                                            $showData = true;
                                        } else {
                                            $showData = false;
                                        }
                                    }

                                    // Pastikan ID tidak duplikat dan tampilkan data
                                    if ($showData && !in_array($data['id_terima_po'], $displayedIds)) {
                                        $hasData = true;
                                        $displayedIds[] = $data['id_terima_po'];
                                        $displayedCount++;
                                ?>
                                        <tr data-id="<?= esc($data['id_terima_po']) ?>">
                                            <td><?= $displayedCount ?></td>
                                            <td><?= esc($data['id_terima_po']) ?></td>
                                            <td><?= esc(date('Y-m-d', strtotime($data['tgl_klaim']))) ?></td>
                                            <td>
                                                <?php if (isset($data['asuransi']) && $data['asuransi'] === 'UMUM/PRIBADI'): ?>
                                                    -
                                                <?php elseif (isset($data['tgl_acc'])): ?>
                                                    <?= esc(date('Y-m-d', strtotime($data['tgl_acc']))) ?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($data['jenis_mobil'] ?? '-') ?></td>
                                            <td><?= esc($data['no_kendaraan'] ?? '-') ?></td>
                                            <td><?= esc($data['warna'] ?? '-') ?></td>
                                            <td><?= esc($data['tahun_kendaraan'] ?? '-') ?></td>
                                            <td><?= esc($data['asuransi'] ?? '-') ?></td>
                                            <td><?= esc($data['username'] ?? '-') ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#detail-po-<?= esc($data['id_terima_po']) ?>">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create-po-<?= esc($data['id_terima_po']) ?>">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php endforeach; ?>

                                <?php if (!$hasData): ?>
                                    <tr>
                                        <td colspan="11">Belum ada permintaan.</td>
                                    </tr>
                                <?php endif; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="11">Belum ada permintaan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <footer style="text-align: center; margin-top: 20px; font-size: 12px;">
                    <p>&copy; 2024 Titanium. All rights reserved.</p>
                </footer>
            </div>
        </div>
    </div>
</section>

<!-- Modal detail po -->
<?php foreach ($poData as $data): ?>
    <form action="<?= base_url('updateJenisPart/' . esc($data['id_terima_po'])) ?>" method="post">
        <input type="hidden" name="id_terima_po" value="<?= $data['id_terima_po'] ?>">
        <div class="modal fade" id="detail-po-<?= $data['id_terima_po'] ?>" tabindex="-1" aria-labelledby="detailPoLabel-<?= $data['id_terima_po'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="detailPoLabel-<?= $data['id_terima_po'] ?>" style="display: flex; justify-content: space-between; width: 100%; font-size: 14px;">
                            <span>Detail Permintaan Part:</span>
                            <span>Nopol: <?= esc($data['no_kendaraan']) ?> | Jenis Mobil: <?= esc($data['jenis_mobil']) ?></span>
                        </div>
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table text-center" style="border: 1px solid #dee2e6; border-collapse: collapse; width: 100%; color: #ffffff; font-size: 14px;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid #dee2e6;">Kode</th>
                                    <th style="border: 1px solid #dee2e6;">Nama</th>
                                    <th style="border: 1px solid #dee2e6;">Qty</th>
                                    <th style="border: 1px solid #dee2e6;">Harga</th>
                                    <th style="border: 1px solid #dee2e6;">Total Harga</th>
                                    <th style="border: 1px solid #dee2e6;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Ambil sparepart yang belum dikirim (is_sent = 0)
                                $spareparts = $detailPO[$data['id_terima_po']] ?? [];
                                $has_nonsupply = false;

                                // Filter sparepart yang belum dikirim
                                $sparepartsNotSent = array_filter($spareparts, function ($sparepart) {
                                    return !empty($sparepart['jenis_part']) && $sparepart['jenis_part'] === 'NON-SUPPLY' && $sparepart['is_sent'] == 0;
                                });

                                if (!empty($sparepartsNotSent)):
                                    foreach ($sparepartsNotSent as $sparepart):
                                        $has_nonsupply = true;
                                ?>
                                        <tr>
                                            <td style="border: 1px solid #dee2e6;">
                                                <input type="text" name="kode_sparepart[]" value="<?= esc($sparepart['kode_sparepart']) ?>" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;" readonly>
                                                <input type="hidden" name="id_sparepart_po[]" value="<?= esc($sparepart['id_sparepart_po']) ?>"> <!-- Hidden input untuk ID -->
                                            </td>
                                            <td style="border: 1px solid #dee2e6;">
                                                <input type="text" name="nama_sparepart[]" value="<?= esc($sparepart['nama_sparepart']) ?>" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;" readonly>
                                            </td>
                                            <td style="border: 1px solid #dee2e6;">
                                                <input type="number" name="qty[]" value="<?= intval($sparepart['qty']) ?>" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;" readonly>
                                            </td>
                                            <td style="border: 1px solid #dee2e6;">
                                                <input type="text" name="harga[]" value="<?= esc(number_format($sparepart['harga'], 0, ',', '.')) ?>" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;" readonly>
                                            </td>
                                            <td style="border: 1px solid #dee2e6;">
                                                <input type="text" name="total_harga[]" value="<?= esc(number_format($sparepart['total_harga'], 0, ',', '.')) ?>" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;" readonly>
                                            </td>

                                            <td style="border: 1px solid #dee2e6;">
                                                <select name="jenis_part[]" style="background-color: #2b2f38; color: #ffffff; border: none; width: 100%;">
                                                    <option value="NON-SUPPLY" <?= $sparepart['jenis_part'] == 'NON-SUPPLY' ? 'selected' : '' ?>>NON-SUPPLY</option>
                                                    <option value="AMBIL STOK" <?= $sparepart['jenis_part'] == 'AMBIL STOK' ? 'selected' : '' ?>>AMBIL STOK</option>
                                                    <option value="SUPPLY" <?= $sparepart['jenis_part'] == 'SUPPLY' ? 'selected' : '' ?>>SUPPLY</option>
                                                    <option value="TIDAK JADI GANTI" <?= $sparepart['jenis_part'] == 'TIDAK JADI GANTI' ? 'selected' : '' ?>>TIDAK JADI GANNTI</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;

                                    if (!$has_nonsupply):
                                    ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center; font-style: italic;">Tidak ada data sparepart (NON-SUPPLY).</td>
                                        </tr>
                                    <?php
                                    endif;
                                else: ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center; font-style: italic;">Tidak ada data sparepart.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>



<?php
foreach ($poData as $po):
?>
    <!-- Modal untuk Permintaan Sparepart -->
    <div class="modal fade" id="create-po-<?= $po['id_terima_po']; ?>" tabindex="-1" aria-labelledby="createPoLabel-<?= $po['id_terima_po']; ?>" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPoLabel-<?= $po['id_terima_po']; ?>">Buat Permintaan Sparepart untuk <?= esc($po['id_terima_po']); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="create-po-form-<?= $po['id_terima_po']; ?>" action="<?= base_url('create_part_po') ?>" method="POST">
                        <input type="hidden" name="id_terima_po" value="<?= $po['id_terima_po']; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Form Data -->
                                        <div class="row">
                                            <div class="col-lg-2 col-3 mb-3">
                                                <label for="id_pesan" class="col-form-label">Nomor (auto)</label>
                                            </div>
                                            <div class="col-lg-10 col-9 mb-3">
                                                <input type="text" id="id_pesan" class="form-control" name="id_pesan" value="<?= esc($id_pesan) ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-3 mb-3">
                                                <label for="tgl" class="col-form-label">Tanggal</label>
                                            </div>
                                            <div class="col-lg-10 col-9 mb-3">
                                                <input type="date" id="tgl" class="form-control" name="tgl" value="" onkeydown="return false" onclick="this.showPicker()" required>
                                            </div>

                                            <div class="col-lg-2 col-3">
                                                <label for="kode_supplier" class="col-form-label" hidden>Kode Supplier</label>
                                            </div>
                                            <div class="col-lg-10 col-9">
                                                <input type="hidden" id="kode_supplier" class="form-control" name="kode_supplier" readonly>
                                            </div>

                                            <div class="col-lg-2 col-3 mb-3">
                                                <label for="supplier" class="col-form-label">Supplier</label>
                                            </div>
                                            <div class="col-lg-9 col-7 mb-3">
                                                <input type="text" id="supplier" class="form-control" name="supplier" required>
                                            </div>

                                            <div class="col-lg-1 col-2 mb-3">
                                                <button type="button" class="btn btn-secondary btn-sm openSupplierModal">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>

                                            <!-- <div class="col-lg-2 col-3 mb-3">
                                                <label for="jatuh_tempo" class="col-form-label">Jatuh tempo</label>
                                            </div>
                                            <div class="col-lg-10 col-9 mb-3">
                                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onclick="this.showPicker()" required>
                                            </div> -->

                                            <div class="col-lg-2 col-3 mb-3">
                                                <label for="keterangan" class="col-form-label">Keterangan</label>
                                            </div>
                                            <div class="col-lg-10 col-9 mb-5">
                                                <textarea class="form-control" id="keterangan" rows="1" name="keterangan"></textarea>
                                            </div>
                                        </div>

                                        <!-- Informasi Tambahan -->
                                        <div class="row">
                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="no_ro" class="col-form-label">No. Repair Order</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-3">
                                                <input type="text" id="no_ro" class="form-control" name="no_ro" value="<?= $po['id_terima_po'] ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="nama_pemilik" class="col-form-label">Customer</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-3">
                                                <input type="text" id="nama_pemilik" class="form-control" name="nama_pemilik" value="<?= $po['customer_name'] ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="asuransi" class="col-form-label">Asuransi</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-3">
                                                <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= $po['asuransi'] ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="no_kendaraan" class="col-form-label">Nopol</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-3">
                                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= $po['no_kendaraan'] ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="jenis_mobil" class="col-form-label">Jenis Mobil</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-3">
                                                <input type="text" id="jenis_mobil" class="form-control" name="jenis_mobil" value="<?= $po['jenis_mobil'] ?>" readonly>
                                            </div>

                                            <div class="col-lg-2 col-12 mb-3">
                                                <label for="warna" class="col-form-label">Warna</label>
                                            </div>
                                            <div class="col-lg-10 col-12 mb-5">
                                                <input type="text" id="warna" class="form-control" name="warna" value="<?= $po['warna'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Qty</th>
                                                        <th>Satuan</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>No. Faktur</th>
                                                        <th>Tgl. Faktur</th>
                                                        <th>Pilih</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (isset($detailPO[$po['id_terima_po']])): ?>
                                                        <?php foreach ($detailPO[$po['id_terima_po']] as $sparepart): ?>
                                                            <tr>
                                                                <td><input type="text" class="form-control" name="kode_barang[]" value="<?= esc($sparepart['kode_sparepart']) ?>" readonly></td>
                                                                <td><input type="text" class="form-control" name="nama_barang[]" value="<?= esc($sparepart['nama_sparepart']) ?>" readonly></td>
                                                                <td><input type="number" class="form-control" name="qty[]" value="<?= esc($sparepart['qty']) ?>"></td>
                                                                <td><input type="text" class="form-control" name="satuan[]" value="PCS" readonly></td>
                                                                <td><input type="text" class="form-control" name="harga[]" value="<?= number_format($sparepart['harga'], 0, ',', '.') ?>" readonly></td>
                                                                <td><input type="text" class="form-control" name="jumlah[]" value="<?= number_format($sparepart['qty'] * $sparepart['harga'], 0, ',', '.') ?>" readonly></td>
                                                                <td><input type="text" class="form-control" name="no_faktur[]"></td>
                                                                <td><input type="text" class="form-control" name="tgl_faktur[]"></td>
                                                                <td><input type="checkbox" class="form-check-input" name="selected_ids[]" value="<?= esc($sparepart['id_sparepart_po']) ?>"></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="9">Tidak ada sparepart untuk PO ini.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Supplier -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Pilih Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="searchSupplier" class="form-control mb-3" placeholder="Cari Supplier">
                <div class="table-responsive">
                    <table class="table text-center mt-2" style="border-collapse: collapse; width: 100%; border: 1px solid #dee2e6;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #dee2e6;">Kode Supplier</th>
                                <th style="border: 1px solid #dee2e6;">Nama Supplier</th>
                            </tr>
                        </thead>
                        <tbody id="supplierTableBody">
                            <?php foreach ($suppliers as $supplier): ?>
                                <tr>
                                    <td style="border: 1px solid #dee2e6;"><?= esc($supplier['kode']) ?></td>
                                    <td style="border: 1px solid #dee2e6;"><?= esc($supplier['nama']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Event listener untuk checkbox "Pilih Semua"
    document.getElementById('select-all').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('.pilih-checkbox'); // Semua checkbox item
        for (var checkbox of checkboxes) {
            if (!checkbox.disabled) {
                checkbox.checked = this.checked; // Centang/Uncentang berdasarkan checkbox "Pilih Semua"
            }
        }
    });
</script>

<script>
    function submitMainForm() {
        // Get form data
        const formData = new FormData(document.getElementById('form-create-po'));

        // Send form data via AJAX
        fetch('/create_part', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(() => {
                        // Redirect to 'beli_part' page with the created ID
                        window.location.href = `/beli_part/${data.created_id}`;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
    }

    // Event listener for form submission
    document.getElementById('form-create-po').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        submitMainForm();
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi modal supplier
        const supplierModal = new bootstrap.Modal(document.getElementById('supplierModal'), {
            backdrop: 'static',
            keyboard: false
        });

        let selectedPoFormId = null;

        // Event listener untuk membuka modal saat tombol diklik
        document.querySelectorAll('.openSupplierModal').forEach(button => {
            button.addEventListener('click', function() {
                // Tangkap ID form yang akan diisi data supplier
                selectedPoFormId = this.closest('form').id;
                supplierModal.show();
            });
        });

        // Pemilihan supplier dari tabel di modal
        document.getElementById('supplierTableBody').addEventListener('click', function(event) {
            const row = event.target.closest('tr');
            if (row && selectedPoFormId) {
                const kode = row.querySelector('td:nth-child(1)').textContent.trim();
                const nama = row.querySelector('td:nth-child(2)').textContent.trim();

                // Set nilai ke input utama pada form terkait
                document.querySelector(`#${selectedPoFormId} #kode_supplier`).value = kode;
                document.querySelector(`#${selectedPoFormId} #supplier`).value = nama;

                // Close the modal
                supplierModal.hide();
            }
        });

        // Fungsi pencarian dalam modal
        document.getElementById('searchSupplier').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#supplierTableBody tr').forEach(row => {
                const kode = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                row.style.display = kode.includes(query) || nama.includes(query) ? '' : 'none';
            });
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

        document.getElementById('tgl').value = todayString;
    });
</script>


<?= $this->endSection() ?>