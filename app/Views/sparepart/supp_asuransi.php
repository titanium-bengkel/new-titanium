<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Supply Asuransi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Supply Asuransi</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center w-100 justify-content-start">
                            <a href="<?= base_url('supp_asuransi_add') ?>" class="btn btn-primary btn-sm" style="width: 60px;">Add</a>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin:20px" ;>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">No. RO</th>
                                    <th style="text-align: center;">Tanggal RO</th>
                                    <th style="text-align: center;">Kode Supplier</th>
                                    <th style="text-align: center;">Nama Supplier</th>
                                    <th style="text-align: center;">Kode Gudang</th>
                                    <th style="text-align: center;">Asuransi</th>
                                    <th style="text-align: center;">Unit</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($supply)) : ?>
                                    <?php foreach ($supply as $index => $data) : ?>
                                        <tr>
                                            <td><?= esc($index + 1) ?></td> <!-- Nomor urut -->
                                            <td><a href="<?= base_url('supp_asuransi_prev/' . esc($data['id_penerimaan'])) ?>"><?= esc($data['id_penerimaan']) ?></a></td>
                                            <td><?= esc($data['tanggal']) ?></td>
                                            <td><?= esc($data['no_repair_order']) ?></td>
                                            <td><?= esc($data['jatuh_tempo']) ?></td>
                                            <td><?= esc($data['kode_supplier']) ?></td>
                                            <td><?= esc($data['supplier']) ?></td>
                                            <td><?= esc($data['gudang']) ?></td>
                                            <td><?= esc($data['asuransi']) ?></td>
                                            <td>
                                                <?= esc($data['jenis_mobil']) ?> <?= esc($data['warna']) ?> <?= esc($data['nopol']) ?> <?= esc($data['nama_pemilik']) ?>
                                            </td>
                                            <td><?= esc($data['keterangan']) ?></td>
                                            <td><?= esc($data['username']) ?></td>
                                            <td>
                                                <!-- Button hapus -->
                                                <button type="button" class="btn btn-danger btn-sm delete-user-btn"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13">Tidak ada data tersedia</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        const now = new Date();
        const currentMonth = now.getMonth() + 1; // Months are 0-based in JavaScript
        const currentYear = now.getFullYear();

        // Set the current month in the select
        const monthSelect = document.getElementById('selectMonth');
        monthSelect.value = currentMonth;

        // Set the current year and populate the year select
        const yearSelect = document.getElementById('selectYear');
        for (let year = 2020; year <= 2030; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.text = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }
    });
</script>
<?= $this->endSection() ?>