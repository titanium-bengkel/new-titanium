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
                        <span class="breadcrumb-current text-muted">Repair Order List</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Order List</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <table class="table table-bordered table-striped table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">No. Order</th>
                                    <th style="text-align: center;">Tgl. Masuk</th>
                                    <th style="text-align: center;">Tgl. Acc</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Jenis Mobil</th>
                                    <th style="text-align: center;">Nama Pelanggan</th>
                                    <th style="text-align: center;">Harga Acc</th>
                                    <th style="text-align: center;">Jasa</th>
                                    <th style="text-align: center;">Sparepart</th>
                                    <th style="text-align: center;">Bahan</th>
                                    <th style="text-align: center;">Pemakaian</th>
                                    <th style="text-align: center;">Profit</th>
                                    <th style="text-align: center;">No. Faktur</th>
                                    <!-- <th style="text-align: center;">Tgl. Faktur</th> -->
                                    <!-- <th style="text-align: center;">Keterangan</th> -->
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                <?php foreach ($rodata as $row): ?>
                                    <?php
                                    // Hitung pemakaian
                                    $pemakaian = ($row['jasa_total'] ?? 0) + ($row['sparepart_total'] ?? 0) + ($row['bahan_total'] ?? 0);

                                    // Cek jenis asuransi
                                    if (isset($row['asuransi']) && $row['asuransi'] === "UMUM/PRIBADI") {
                                        $tanggal = $row['tgl_klaim'] ?? '-';
                                        $harga = $row['total_biaya'] ?? 0; // Ubah 'harga' menjadi 'total_biaya'
                                    } else {
                                        $tanggal = $row['tgl_acc'] ?? '-';
                                        $harga = $row['harga_acc'] ?? 0;
                                    }
                                    // Hitung profit
                                    $profit = $harga - $pemakaian;
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><a href="<?= base_url('ro_listprev/' . $row['id_terima_po']); ?>"><?= $row['id_terima_po']; ?></a></td>
                                        <td><?= $row['tgl_masuk']; ?></td>
                                        <td><?= $tanggal; ?></td>
                                        <td><?= $row['progres_pengerjaan']; ?></td>
                                        <td><?= $row['no_kendaraan']; ?></td>
                                        <td><?= $row['jenis_mobil']; ?></td>
                                        <td><?= $row['customer_name']; ?></td>
                                        <td><?= number_format($harga, 0, ',', '.'); ?></td> <!-- Harga acc atau harga estimasi -->
                                        <td><?= number_format($row['jasa_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['sparepart_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['bahan_total'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($pemakaian, 0, ',', '.'); ?></td>
                                        <td><?= number_format($profit, 0, ',', '.'); ?></td>
                                        <td><?= $row['no_faktur']; ?></td>
                                        <!-- <td><?= $row['tgl_faktur']; ?></td> -->
                                        <!-- <td style="text-align: left;"><?= $row['keterangan']; ?></td> -->
                                    </tr>
                                <?php endforeach; ?>
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
        $('.table').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100],
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