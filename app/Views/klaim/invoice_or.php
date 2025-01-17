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
<!-- List Invoice Piutang -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Kwitansi OR</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Kwitansi OR</h5>
                </header>
                <div class="card-content">
                    <div class="card-header">
                        <div class="buttons">
                            <a href="<?= base_url('add_invo_or') ?>" class="btn btn-primary btn-sm me-2">Add Kwitansi OR</a>
                            <a href="#" class="btn btn-secondary btn-sm">Export to Excel</a>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive text-center" style="margin: 20px; font-size: 12px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Tgl. Kirim</th>
                                    <th class="text-center">Asuransi</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Nilai OR</th>
                                    <th class="text-center">Qty OR</th>
                                    <th class="text-center">Nilai Akhir OR</th>
                                    <th class="text-center">Jenis Bayar</th>
                                    <th class="text-center">No. Order</th>
                                    <th class="text-center">Tgl. Masuk</th>
                                    <th class="text-center">Tgl. Selesai</th>
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kwitansi_or)): ?>
                                    <?php $i = 1;
                                    foreach ($kwitansi_or as $row): ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><a href="<?= base_url('add_invoprev_or/' . $row['nomor']) ?>"><?= esc($row['nomor']) ?></a></td>
                                            <td><?= $row['tanggal']; ?></td>
                                            <td><?= $row['tanggal_kirim_kwitansi']; ?></td>
                                            <td><?= $row['asuransi']; ?></td>
                                            <td><?= number_format($row['nilai_total'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['nilai_or'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['qty_or'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($row['total_or'], 0, ',', '.'); ?></td>
                                            <td><?= $row['jenis_bayar']; ?></td>
                                            <td><?= $row['no_order']; ?></td>
                                            <td><?= $row['tanggal_masuk']; ?></td>
                                            <td><?= $row['tanggal_selesai']; ?></td>
                                            <td><?= $row['customer_name']; ?></td>
                                            <td><?= $row['jenis_mobil']; ?></td>
                                            <td><?= $row['no_kendaraan']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm delete-user-btn" data-nomor="<?= $row['nomor'] ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="18" class="text-center">No data available</td>
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
<!-- Table Pembayaran Piutang end -->

<!-- Add necessary JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('.table').DataTable({
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

    // Menambahkan event listener untuk tombol hapus dengan SweetAlert2
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-user-btn").forEach(button => {
            button.addEventListener("click", function() {
                const nomor = this.getAttribute("data-nomor");
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Kwitansi ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke route deleteKwitansi dengan nomor kwitansi
                        window.location.href = `/deleteKwitansiOR/${nomor}`;
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>