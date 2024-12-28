<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Laporan Hutang Supplier</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Laporan Hutang Supplier</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">No. Faktur</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Term</th>
                                    <th style="text-align: center;">Jatuh Tempo</th>
                                    <th style="text-align: center;">Nilai</th>
                                    <th style="text-align: center;">Pembayaran</th>
                                    <th style="text-align: center;">Saldo</th>
                                </tr>
                            </thead>

                            <?php
                            $current_supplier = null;
                            $subtotal_hutang = 0;
                            $subtotal_pembayaran = 0;
                            $subtotal_saldo = 0;

                            foreach ($supplier as $sup):
                                // Jika supplier baru, tampilkan header untuk supplier
                                if ($current_supplier !== $sup['kode_supplier']):
                                    // Jika sudah ada supplier sebelumnya, tampilkan subtotal sebelumnya
                                    if ($current_supplier !== null):
                            ?>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th><?= number_format($subtotal_hutang, 0, ',', '.'); ?></th>
                                            <th><?= number_format($subtotal_pembayaran, 0, ',', '.'); ?></th>
                                            <th><?= number_format($subtotal_saldo, 0, ',', '.'); ?></th>
                                        </tr>
                                    <?php
                                    endif;

                                    // Update current_supplier dan reset subtotal
                                    $current_supplier = $sup['kode_supplier'];
                                    $subtotal_hutang = 0;
                                    $subtotal_pembayaran = 0;
                                    $subtotal_saldo = 0;
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td colspan="7"><b><?= $sup['kode_supplier'] . ' - ' . $sup['supplier']; ?></b></td>
                                        </tr>
                                    </tbody>
                                <?php
                                endif;

                                // Hitung nilai total dan saldo
                                $nilai_total = $sup['total_jumlah'];
                                $pembayaran = $sup['total_jumlah'];
                                $saldo = $pembayaran - $nilai_total;

                                // Tambahkan ke subtotal
                                $subtotal_hutang += $nilai_total;
                                $subtotal_pembayaran += $pembayaran;
                                $subtotal_saldo += $saldo;
                                ?>

                                <tbody>
                                    <tr>
                                        <td><?= $sup['no_faktur']; ?></td>
                                        <td class="text-center"><?= date('Y-m-d', strtotime($sup['tanggal'])); ?></td>
                                        <td class="text-center"><?= $sup['term']; ?></td>
                                        <td class="text-center"><?= date('Y-m-d', strtotime($sup['jatuh_tempo'])); ?></td>
                                        <td class="text-center"><?= number_format($nilai_total, 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= number_format($pembayaran, 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= number_format($saldo, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="4"></th>
                                <th><?= number_format($subtotal_hutang, 0, ',', '.'); ?></th>
                                <th><?= number_format($subtotal_pembayaran, 0, ',', '.'); ?></th>
                                <th><?= number_format($subtotal_saldo, 0, ',', '.'); ?></th>
                            </tr>
                            <thead style="font-size: 14px;">
                                <tr>
                                    <th colspan="4"></th>
                                    <th style="text-align: center;">Total Hutang: <?= number_format(array_sum(array_column($supplier, 'nilai_total')), 0, ',', '.'); ?></th>
                                    <th style="text-align: center;">Total Pembayaran: <?= number_format(array_sum(array_column($supplier, 'pembayaran')), 0, ',', '.'); ?></th>
                                    <th style="text-align: center;">Total Saldo: <?= number_format(array_sum(array_column($supplier, 'pembayaran')) - array_sum(array_column($supplier, 'nilai_total')), 0, ',', '.'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->
<?= $this->endSection() ?>