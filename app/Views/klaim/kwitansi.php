<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- SweetAlert -->
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

<!-- List Kwitansi Section -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <!-- Header -->
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3 px-4 mt-2">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Kwitansi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Kwitansi</h5>
                </header>

                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                        <!-- Tombol Add dan Export -->
                        <div class="d-flex align-items-center gap-3">
                            <!-- <a href="<?= base_url('add_invo') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add Kwitansi
                            </a> -->
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/kwitansi') ?>" class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Input Cari -->
                            <div class="d-flex align-items-center">
                                <label for="search_keyword" class="form-label fw-bold text-primary me-2 mb-0">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="No. Invoice/Nopol"
                                    value="<?= $searchKeyword ?? '' ?>">
                            </div>

                            <!-- Input Tanggal Mulai -->
                            <div class="d-flex align-items-center">
                                <label for="start_date" class="form-label fw-bold text-primary me-2 mb-0">Mulai:</label>
                                <input
                                    type="date"
                                    name="start_date"
                                    id="start_date"
                                    class="form-control form-control-sm"
                                    value="<?= $startDate ?? date('Y-m-01') ?>">
                            </div>

                            <!-- Input Tanggal Akhir -->
                            <div class="d-flex align-items-center">
                                <label for="end_date" class="form-label fw-bold text-primary me-2 mb-0">Akhir:</label>
                                <input
                                    type="date"
                                    name="end_date"
                                    id="end_date"
                                    class="form-control form-control-sm"
                                    value="<?= $endDate ?? date('Y-m-d') ?>">
                            </div>

                            <!-- Tombol Filter -->
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm fw-bold">Filter</button>
                            </div>

                            <!-- Tombol Tampilkan Semua -->
                            <div>
                                <button type="submit" name="show_all" value="1" class="btn btn-secondary btn-sm fw-bold">Tampilkan Semua</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Table -->
                <div class="card-content">
                    <div class="table-responsive p-4">
                        <table id="kwitansiTable" class="table table-bordered table-hover table-striped text-center" style="font-size: 12px;">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Asuransi</th>
                                    <th>Nilai</th>
                                    <th>Nilai OR</th>
                                    <th>Qty OR</th>
                                    <th>No. Order</th>
                                    <th>Pelanggan</th>
                                    <th>Car Model</th>
                                    <th>Nopol</th>
                                    <th>Pemb. Asuransi</th>
                                    <th>Pemb. OR</th>
                                    <th>User ID</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                                <span class="badge bg-<?= $item['pemb_asuransi'] === 'Sudah Bayar' ? 'success' : 'warning' ?>">
                                                    <?= $item['pemb_asuransi'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?= $item['pemb_or'] === 'Sudah Bayar' ? 'success' : 'warning' ?>">
                                                    <?= $item['pemb_or'] ?>
                                                </span>
                                            </td>
                                            <td><?= $item['user_id'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm delete-user-btn" data-nomor="<?= $item['nomor'] ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="15">Tidak ada data kwitansi</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const table = document.getElementById('kwitansiTable');
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Kwitansi"
        });
        XLSX.writeFile(workbook, 'Kwitansi.xlsx');
    }
    updateTable();

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
                    window.location.href = `/deleteKwitansi/${nomor}`;
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>