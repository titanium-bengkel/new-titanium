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
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Laporan Pembelian</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Laporan Pembelian Sparepart dan Material</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center w-100 justify-content-start">
                            <a href="<?= base_url('pembelian_add') ?>" class="btn btn-primary btn-sm" style="width: 60px;">Add</a>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">No. Faktur</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Bayar</th>
                                    <th style="text-align: center;">Jatuh Tempo</th>
                                    <th style="text-align: center;">No. RO</th>
                                    <th style="text-align: center;">Kode Supplier</th>
                                    <th style="text-align: center;">Supplier</th>
                                    <th style="text-align: center;">Kode Gudang</th>
                                    <th style="text-align: center;">Jumlah</th>
                                    <th style="text-align: center;">Total</th>
                                    <th style="text-align: center;">PPN</th>
                                    <th style="text-align: center;">PPN Nilai</th>
                                    <th style="text-align: center;">Netto</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($keuangan)) : ?>
                                    <?php foreach ($keuangan as $index => $data) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('pembelian_prev/' . $data['no_faktur']); ?>">
                                                    <?= $data['no_faktur']; ?>
                                                </a>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['pembayaran'] ?></td>
                                            <td><?= $data['jatuh_tempo'] ?></td>
                                            <td><?= $data['no_preor'] ?></td>
                                            <td><?= $data['kode_supplier'] ?></td>
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
                                                <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('/keuangan/hapuspembelian/' . $data['no_faktur']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="18">Data tidak tersedia.</td>
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
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({

            "paging": true,
            "pageLength": 20,
            "lengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            "ordering": false,
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

<?= $this->endSection() ?>