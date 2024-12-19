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

<!-- Table List Invoice -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Kwitansi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Kwitansi</h5>
                </header>
                <div class="card-header d-flex align-items-center">
                    <a href="<?= base_url('add_invo') ?>" class="btn btn-primary btn-sm me-2">Add Kwitansi</a>
                    <a href="#" class="btn btn-secondary btn-sm me-2">Export Excel</a>
                </div>
                <div class="card-content">
                    <div class="table-responsive" style="margin: 20px; font-size: 13px">
                        <table class="table table-bordered mb-0 text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Asuransi</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Nilai OR</th>
                                    <th class="text-center">Qty OR</th>
                                    <th class="text-center">No. Order</th>
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">Pemb. Asuransi</th>
                                    <th class="text-center">Pemb. OR</th>
                                    <th class="text-center">User</th>
                                    <th class="text-center">Act</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($kwitansi)) : ?>
                                    <?php foreach ($kwitansi as $index => $item) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('add_invoprev/' . $item['nomor']) ?>"><?= esc($item['nomor']) ?></a></td>
                                            <td><?= $item['tanggal'] ?></td>
                                            <td><?= $item['asuransi'] ?></td>
                                            <td><?= number_format($item['nilai_bayar'], 0, ',', '.') ?></td>
                                            <td><?= number_format($item['nilai_or'], 0, ',', '.') ?></td>
                                            <td><?= $item['qty_or'] ?></td>
                                            <td><?= $item['no_order'] ?></td>
                                            <td><?= $item['customer_name'] ?></td>
                                            <td><?= $item['jenis_mobil'] ?></td>
                                            <td><?= $item['no_kendaraan'] ?></td>
                                            <td>
                                                <?php if ($item['pemb_asuransi'] === 'Sudah Bayar'): ?>
                                                    <span class="badge bg-success text-dark">Sudah Bayar</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($item['pemb_or'] === 'Sudah Bayar'): ?>
                                                    <span class="badge bg-success text-dark">Sudah Bayar</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">Belum Bayar</span>
                                                <?php endif; ?>
                                            </td>

                                            <td><?= $item['username'] ?></td>
                                            <td>
                                                <!-- Tombol hapus -->
                                                <button type="button" class="btn btn-sm delete-user-btn" data-nomor="<?= $item['nomor'] ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="13">Tidak ada data kwitansi</td>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
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
                        window.location.href = `/deleteKwitansi/${nomor}`;
                    }
                });
            });
        });
    });
</script>

<?= $this->endSection() ?>