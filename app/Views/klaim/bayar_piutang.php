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
<!-- Table Pembayaran Piutang -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Payment</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Payment</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <a href="<?= base_url('add_bayar') ?>" class="btn btn-sm btn-primary mr-2 me-2">Add Pembayaran</a>
                        <a href="#" class="btn btn-sm btn-secondary mr-2" style="margin-right:50px;">Export to Excel</a>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pembayaran-asuransi" role="tabpanel" aria-labelledby="pembayaran-asuransi-tab">
                            <div class="table-responsive text-center" style="margin: 20px; font-size: 12px;">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor</th>
                                            <th>Kwitansi</th>
                                            <th>Unit</th>
                                            <th>Asuransi</th>
                                            <th>Tanggal</th>
                                            <th>Jasa</th>
                                            <th>Sparepart</th>
                                            <th>Tagihan</th>
                                            <th>Pembayaran</th>
                                            <th>Sisa Tagihan</th>
                                            <th>Keterangan</th>
                                            <th>User ID</th>
                                            <th>Act</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($pemb)) : ?>
                                            <?php
                                            $rowNumber = 1; // Inisialisasi variabel penghitung untuk nomor baris
                                            foreach ($pemb as $item) : ?>
                                                <tr>
                                                    <td><?= $rowNumber++; // Increment nomor baris untuk setiap item yang cocok 
                                                        ?></td>
                                                    <td><a href="<?= base_url('add_bayarprev/' . $item['id_pembayaran']) ?>"><?= esc($item['id_pembayaran']) ?></a></td>
                                                    <td><?= $item['no_invoice'] ?? ''; ?></td>
                                                    <td><?= $item['keterangan_invoice'] ?? ''; ?></td>
                                                    <td><?= $item['asuransi'] ?? ''; ?></td>
                                                    <td><?= $item['tanggal'] ?? ''; ?></td>
                                                    <td><?= isset($item['jasa']) ? number_format($item['jasa'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['sparepart']) ? number_format($item['sparepart'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['total_kredit']) ? number_format($item['total_kredit'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['total_debet']) ? number_format($item['total_debet'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= isset($item['selisih']) ? number_format($item['selisih'], 0, ',', '.') : ''; ?></td>
                                                    <td><?= $item['keterangan'] ?? ''; ?></td>
                                                    <td></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm delete-user-btn">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="13">Tidak ada data yang tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Pembayaran Piutang end -->

<?= $this->endSection() ?>