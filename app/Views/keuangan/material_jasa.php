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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Jasa</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Jasa</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <a href="<?= base_url('material_jasaadd') ?>" class="btn btn-primary mr-2">Add Repair Jasa</a>
                    </div>
                    <div class="table-responsive" style="margin:20px; font-size: 14px;">
                        <table class="table table-bordered table-hover table-striped mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">No. Order</th>
                                    <th style="text-align: center;">Tgl. Order</th>
                                    <th style="text-align: center;">Jenis Mobil</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Tahun</th>
                                    <th style="text-align: center;">Warna</th>
                                    <th style="text-align: center;">Nama Pelanggan</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Subtotal</th>
                                    <th style="text-align: center;">User ID</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($jasa)): ?>
                                    <?php foreach ($jasa as $index => $data): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('material_jasaprev/' . $data['id_jasa']); ?>">
                                                    <?= $data['id_jasa'] ?>
                                                </a></td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['no_ro'] ?></td>
                                            <td><?= $data['tanggal_masuk'] ?></td>
                                            <td><?= $data['jenis_mobil'] ?></td>
                                            <td><?= $data['nopol'] ?></td>
                                            <td><?= $data['tahun'] ?></td>
                                            <td><?= $data['warna'] ?></td>
                                            <td><?= $data['nama_pemilik'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <!-- Display subtotal without decimal -->
                                            <td class="subtotal"><?= number_format($data['total'], 0, '.', '.') ?></td>
                                            <td><?= $data['user_id'] ?></td>
                                            <td>
                                                <!-- Tombol Hapus -->
                                                <button class="btn btn-sm delete-btn" data-id="<?= $data['id_jasa'] ?>"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="14">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                            <!-- Footer with Total Subtotal -->
                            <thead>
                                <tr>
                                    <th colspan="11" style="text-align: end;">Total</th>
                                    <th style="text-align: center;" id="total-subtotal"></th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript to calculate the total of subtotals -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let subtotals = document.querySelectorAll('.subtotal');
        let total = 0;

        // Loop through all subtotals and add them
        subtotals.forEach(function(subtotal) {
            total += parseInt(subtotal.textContent.replace(/\./g, ''), 10); // Remove dots and convert to integer
        });

        // Display the total in the footer
        document.getElementById('total-subtotal').textContent = total.toLocaleString('id-ID'); // Format the total with commas
    });
</script>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Event listener untuk tombol hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const idJasa = this.getAttribute('data-id'); // Mendapatkan id_jasa dari tombol

            // Menampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke controller untuk menghapus data
                    window.location.href = '<?= base_url("deleteRepairJasa/") ?>' + idJasa;
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>