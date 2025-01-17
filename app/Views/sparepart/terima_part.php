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
<?php if ($startDate && $endDate): ?>
    <p class="text-muted">Menampilkan data dari <strong><?= $startDate ?></strong> hingga <strong><?= $endDate ?></strong>.</p>
<?php endif; ?>


<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Penerimaan Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Penerimaan Sparepart NON-SUPPLY</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <div class="d-flex align-items-center w-100 justify-content-start">
                                <a href="<?= base_url('order_pos_terimapart') ?>" class="btn btn-primary btn-sm me-2">Add Penerimaan</a>
                                <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                            </div>
                            <form method="GET" action="">
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <label for="start-date" class="form-label mb-0 text-muted fw-bold">Periode:</label>
                                    <input type="date" id="start-date" name="start_date" class="form-control form-control-sm rounded-2 w-auto"
                                        value="<?= isset($startDate) ? $startDate : '' ?>" />
                                    <span class="mx-1 text-muted fw-bold">to</span>
                                    <input type="date" id="end-date" name="end_date" class="form-control form-control-sm rounded-2 w-auto"
                                        value="<?= isset($endDate) ? $endDate : '' ?>" />
                                    <button type="submit" class="btn btn-primary btn-sm rounded-2">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive" style="font-size: 12px; margin:20px; text-align: center;">
                        <table class="table table-bordered table-striped -table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>No. Faktur</th>
                                    <th>Tanggal</th>
                                    <th>No. PO</th>
                                    <th>Nopol</th>
                                    <th>Nama Supplier</th>
                                    <th>Kode Gudang</th>
                                    <th>Jumlah</th>
                                    <th>PPN</th>
                                    <th>PPN Nilai</th>
                                    <th>Netto</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sparepart)) : ?>
                                    <?php foreach ($sparepart as $index => $data) : ?>
                                        <tr>
                                            <td class="text-center"><?= $index + 1 ?></td>
                                            <td class="text-start"><a href="<?= base_url('order_pos_terimapartprev/' . str_replace('/', '_', $data['id_penerimaan'])); ?>">
                                                    <?= $data['id_penerimaan']; ?>
                                                </a>
                                            <td class="text-start"><?= $data['tanggal'] ?></td>
                                            <td class="text-start"><?= $data['no_preor'] ?></td>
                                            <td class="text-start"><?= $data['nopol'] ?></td>
                                            <td class="text-start"><?= $data['supplier'] ?></td>
                                            <td class="text-start"><?= $data['gudang'] ?></td>
                                            <td class="text-end"><?= number_format($data['total_jumlah'], 0, ',', '.'); ?></td>
                                            <td class="text-end"><?= $data['ppn'] ?></td>
                                            <td class="text-end"><?= number_format($data['nilai_ppn'], 0, ',', '.'); ?></td>
                                            <td class="text-end"><?= number_format($data['netto'], 0, ',', '.'); ?></td>
                                            <td class="text-end"><?= $data['total_qty'] ?></td>
                                            <td class="text-start"><?= $data['keterangan'] ?></td>
                                            <td class="text-start"><?= $data['username'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('sparepart/deleteterima/' . $data['id_penerimaan']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="18">Data tidak tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7" style="text-align: end;">Total Perpage</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="3"></th>
                                </tr>
                                <tr>
                                    <th colspan="7" style="text-align: end;">GrandTotal</th>
                                    <th class="text-end"><?= number_format($grandTotalJumlah, 0, ',', '.'); ?></th>
                                    <th></th>
                                    <th class="text-end"><?= number_format($grandTotalPpn, 0, ',', '.'); ?></th>
                                    <th class="text-end"><?= number_format($grandTotalNetto, 0, ',', '.'); ?></th>
                                    <th class="text-end"><?= number_format($grandTotalQty, 0, ',', '.'); ?></th>
                                    <th></th>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Ambil data dari tabel
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });

        // Konversi ke file Excel
        XLSX.writeFile(workbook, "Data_PenerimaanSparepart.xlsx");
    }
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#start-date", {
            dateFormat: "Y-m-d"
        });
        flatpickr("#end-date", {
            dateFormat: "Y-m-d"
        });
    });
</script> -->


<!-- <script>
    // Flatpickr initialization for date input fields
    flatpickr("#start-date", {
        dateFormat: "Y-m-d"
    });
    flatpickr("#end-date", {
        dateFormat: "Y-m-d"
    });

    document.getElementById('filter-btn').addEventListener('click', function() {
        const startDate = document.getElementById('start-date').value;
        const endDate = document.getElementById('end-date').value;

        if (startDate && endDate) {
            window.location.href = `?start_date=${startDate}&end_date=${endDate}`;
        } else {
            alert('Please select both start and end dates.');
        }
    });
</script> -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tombol delete
        const deleteButtons = document.querySelectorAll('.delete-user-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah link dari melakukan tindakan default (navigasi)

                const deleteUrl = this.getAttribute('data-url'); // Ambil URL dari atribut data-url

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl; // Redirect ke URL penghapusan jika dikonfirmasi
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>