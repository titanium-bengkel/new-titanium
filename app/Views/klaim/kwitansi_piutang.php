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
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Invoice Piutang</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Invoice Piutang</h5>
                </header>
                <div class="card-content">
                    <!-- Tabel -->
                    <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Asuransi</th>
                                    <th>Nilai Acc</th>
                                    <th>Bayar</th>
                                    <th>Saldo</th>
                                    <th>Jenis Bayar</th>
                                    <th>No. Order</th>
                                    <th>Tgl. Masuk</th>
                                    <th>Tgl. Selesai</th>
                                    <th>Customer Name</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($piutang)) : ?>
                                    <?php
                                    $i = 1;
                                    $foundPiutangUsaha = false;

                                    foreach ($piutang as $item) :
                                        // Tambahkan kondisi untuk memeriksa apakah nilai_total dan nilai_tagihan sama
                                        if ($item['jenis_bayar'] === 'PIUTANG USAHA' && $item['nilai_total'] != $item['nilai_tagihan']) :
                                            $foundPiutangUsaha = true;
                                    ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><a href="<?= base_url('kwitansi_piutangprev/' . $item['nomor']) ?>"><?= esc($item['nomor']) ?></a></td>
                                                <td><?= $item['tanggal']; ?></td>
                                                <td><?= $item['asuransi']; ?></td>
                                                <td><?= number_format($item['nilai_bayar'], 0, ',', '.'); ?></td>
                                                <td><?= number_format($item['nilai_total'], 0, ',', '.'); ?></td>
                                                <td><?= number_format($item['nilai_tagihan'], 0, ',', '.'); ?></td>
                                                <td><?= $item['jenis_bayar'] === 'PIUTANG USAHA' ? 'PIUTANG' : $item['jenis_bayar']; ?></td>
                                                <td><?= $item['no_order']; ?></td>
                                                <td><?= $item['tanggal_masuk']; ?></td>
                                                <td><?= $item['tanggal_selesai']; ?></td>
                                                <td><?= $item['customer_name']; ?></td>
                                            </tr>
                                        <?php
                                        endif;
                                    endforeach;

                                    // Tampilkan pesan jika tidak ada item dengan jenis_bayar 'PIUTANG USAHA'
                                    if (!$foundPiutangUsaha) :
                                        ?>
                                        <tr>
                                            <td colspan="12">No data available</td>
                                        </tr>
                                    <?php endif; ?>

                                <?php else : ?>
                                    <tr>
                                        <td colspan="12">No data available</td>
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


<?= $this->endSection() ?>