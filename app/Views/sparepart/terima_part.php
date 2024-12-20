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
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Penerimaan Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Penerimaan Sparepart NON-SUPPLY</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center w-100 justify-content-start">
                            <a href="<?= base_url('order_pos_terimapart') ?>" class="btn btn-primary btn-sm me-2">Add Penerimaan</a>
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
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
                                    <th>Total</th>
                                    <th>PPN</th>
                                    <th>PPN Nilai</th>
                                    <th>Netto</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($sparepart)) : ?>
                                    <?php foreach ($sparepart as $index => $data) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('order_pos_terimapartprev/' . $data['id_penerimaan']); ?>">
                                                    <?= $data['id_penerimaan']; ?>
                                                </a>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['no_preor'] ?></td>
                                            <td><?= $data['nopol'] ?></td>
                                            <td><?= $data['supplier'] ?></td>
                                            <td><?= $data['gudang'] ?></td>
                                            <td><?= number_format($data['total_jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($data['total_jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= $data['ppn'] ?></td>
                                            <td><?= number_format($data['nilai_ppn'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($data['netto'], 0, ',', '.'); ?></td>
                                            <td><?= $data['total_qty'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td>
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
                                    <th colspan="9">Total Perpage</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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