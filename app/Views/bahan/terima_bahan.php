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
<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Penerimaan Bahan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Penerimaan Bahan</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <a href="<?= base_url('order_terima_bahan') ?>" class="btn btn-primary btn-sm me-2">Add Penerimaan</a>
                        <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin:20px" ;>
                        <table class="table table-bordered mb-0" id="po_bahan_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">No Faktur</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Jatuh Tempo</th>
                                    <th style="text-align: center;">No RO</th>
                                    <th style="text-align: center;">Kode Supplier</th>
                                    <th style="text-align: center;">Nama Supplier</th>
                                    <th style="text-align: center;">Gudang</th>
                                    <th style="text-align: center;">Jumlah</th>
                                    <th style="text-align: center;">PPN %</th>
                                    <th style="text-align: center;">PPN Nilai</th>
                                    <th style="text-align: center;">Netto</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Act</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($bahan)) : ?>
                                    <?php foreach ($bahan as $index => $data) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('order_terima_bahanprev/' . $data['id_penerimaan']); ?>">
                                                    <?= $data['id_penerimaan']; ?>
                                                </a>
                                            </td> <!-- Memperbaiki kesalahan penutupan tag -->
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['jatuh_tempo'] ?></td>
                                            <td><?= $data['nomor'] ?></td>
                                            <td><?= $data['kode_supplier'] ?></td>
                                            <td><?= $data['supplier'] ?></td>
                                            <td><?= $data['gudang'] ?></td>
                                            <td><?= number_format($data['total_jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= $data['ppn'] ?></td>
                                            <td><?= number_format($data['nilai_ppn'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($data['netto'], 0, ',', '.'); ?></td>
                                            <td><?= $data['total_qty'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td><?= $data['user_id'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('bahan/deleteterima/' . $data['id_penerimaan']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="16">Data tidak tersedia</td>
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
<!-- Table head options end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#po_bahan_table').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100],
            "ordering": true,
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "info": "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            "pagingType": "full_numbers"
        });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Ambil data dari tabel
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });

        // Konversi ke file Excel
        XLSX.writeFile(workbook, "Data_TerimaBahan.xlsx");
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