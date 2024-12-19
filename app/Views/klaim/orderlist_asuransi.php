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
<!-- Table acc Asuransi -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">List Acc Asuransi</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">List Acc Asuransi</h5>
                </header>
                <div class="card-content">
                    <div class="table-responsive" style="font-size: 12px; margin: 20px;">
                        <button class="btn btn-secondary btn-sm mb-2 text-right" onclick="exportToExcel()">Export to Excel</button>
                        <table id="accAsuransiTable" class="table table-bordered text-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">No Asuransi</th>
                                    <th class="text-center">Tgl. Acc</th>
                                    <th class="text-center">Asuransi</th>
                                    <th class="text-center">No. Order</th>
                                    <th class="text-center">Jasa</th>
                                    <th class="text-center">Sparepart</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Tgl. Masuk</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Nopol</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Tgl. Input</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($accData)): ?>
                                    <?php foreach ($accData as $index => $acc): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('order_pos_asprev/' . $acc['id_terima_po']) ?>"><?= $acc['id_acc_asuransi'] ?></a></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_acc'])) ?></td>
                                            <td><?= $acc['asuransi'] ?></td>
                                            <td><?= $acc['id_terima_po'] ?></td>
                                            <td><?= number_format($acc['biaya_jasa'], 0, ',', '.') ?></td>
                                            <td><?= number_format($acc['biaya_sparepart'], 0, ',', '.') ?></td>
                                            <td><?= number_format($acc['biaya_total'], 0, ',', '.') ?></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_masuk'])) ?></td>
                                            <td><?= $acc['jenis_mobil'] ?></td>
                                            <td><?= $acc['no_kendaraan'] ?></td>
                                            <td><?= $acc['customer_name'] ?></td>
                                            <td><?= isset($acc['username']) ? esc($acc['username']) : 'N/A'; ?></td>
                                            <td><?= date('Y-m-d', strtotime($acc['tgl_acc'])) ?></td>
                                            <td>
                                                <div class="d-flex justify-content-between" style="height: 30px;">
                                                    <button type="button" class="btn me-1" data-bs-toggle="modal" data-bs-target="#uploadfile" style="height: 100%; width: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn me-1" onclick="lihatPdf()" style="height: 100%; width: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </button>
                                                    <button type="button" class="btn" style="height: 100%; width: 35px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="15" class="text-center">No data available.</td>
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

<!-- modal foto-->
<div class="modal fade text-left" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-success btn-sm" id="add-row-btn"><i class="fas fa-plus"></i> Tambah Baris</button>
                <div class="table-responsive">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No.Acc</th>
                                <th>Keterangan</th>
                                <th>File PDF</th>
                            </tr>
                        </thead>
                        <tbody class="table-debet">
                            <tr>
                                <td></td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="file" class="basic-filepond" data-parsley-required="true"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const table = document.getElementById('accAsuransiTable');
        const wb = XLSX.utils.table_to_book(table, {
            sheet: "List Acc Asuransi"
        });

        // Format nama file
        const date = new Date();
        const formattedDate = date.toISOString().replace(/[-:.]/g, "").slice(0, 14);
        const zipFileName = `List_Acc_Asuransi_${formattedDate}.xlsx`;

        // Unduh file Excel
        XLSX.writeFile(wb, zipFileName);
    }
</script>
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
<script>
    $(document).ready(function() {
        $('#accAsuransiTable').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100],
            "ordering": true,
            "searching": true, // Aktifkan fitur search
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