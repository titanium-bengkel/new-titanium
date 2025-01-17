<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="col-12">
        <div class="card">
            <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                <div class="breadcrumb-wrapper" style="font-size: 14px;">
                    <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                    <span class="breadcrumb-divider text-muted mx-3">/</span>
                    <span class="breadcrumb-current text-muted">Pemesanan Sparepart</span>
                </div>
                <h5 class="page-title mb-0 fw-bold">Pemesanan Sparepart NON-SUPPLY</h5>
            </header>
            <div class="card-content">
                <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                    <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                        <div class="d-flex align-items-center w-100 justify-content-start">
                            <a href="<?= base_url('beli_part') ?>" class="btn btn-primary btn-sm me-2">Add Pemesanan</a>
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
                <!-- table head dark -->
                <div class="table-responsive" style=" font-size: 12px; margin:20px" ;>
                    <table class="table table-bordered table-striped table-hover mb-0">
                        <thead class="thead-dark table-secondary">
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">No. PO</th>
                                <th style="text-align: center;">No. Order</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">Supplier</th>
                                <th style="text-align: center;">Nopol</th>
                                <th style="text-align: center;">Asuransi</th>
                                <th style="text-align: center;">Unit</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;">No. Faktur</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">User ID</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($sparepart)) : ?>
                                <?php foreach ($sparepart as $key => $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1; ?></td>
                                        <td class="text-center">
                                            <?php if ($item['all_sent']): ?>
                                                <span class="badge bg-success" style="font-size: 14px; padding: 5px 10px;">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </span>
                                            <?php endif; ?>
                                        </td>


                                        <td class="text-left">
                                            <a href="<?= base_url('beli_partprev/' . $item['id_pesan']); ?>">
                                                <?= $item['id_pesan']; ?>
                                            </a>
                                        </td>
                                        <td class="text-left"><?= $item['wo']; ?></td>
                                        <td class="text-left"><?= $item['tanggal']; ?></td>
                                        <td class="text-left"><?= $item['supplier']; ?></td>
                                        <td class="text-left"><?= $item['nopol']; ?></td>
                                        <td class="text-left"><?= $item['asuransi']; ?></td>
                                        <td class="text-left"><?= $item['jenis_mobil']; ?> <?= $item['warna']; ?> <?= $item['nopol']; ?> <?= $item['customer']; ?></td>
                                        <td class="text-end"><?= number_format($item['total_jumlah'], 0, ',', '.'); ?></td>
                                        <td class="text-left"><?= $item['no_faktur']; ?></td>
                                        <td class="text-left"><?= $item['keterangan']; ?></td>
                                        <td class="text-left"><?= $item['user_id']; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('sparepart/delete/' . $item['id_pesan']); ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="14">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <tfoot>
                            <tr style="text-align: center;">
                                <th colspan="9" style="text-align: end;">Total Perpage</th>
                                <th></th>
                                <th colspan="5"></th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="9" style="text-align: end;">Total All</th>
                                <th style="text-align: end;"><?= number_format($grandTotalJumlah, 0, ',', '.'); ?></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Ambil data dari tabel
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });

        // Konversi ke file Excel
        XLSX.writeFile(workbook, "Data_PoSparepart.xlsx");
    }
</script>

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