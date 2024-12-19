<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pembayaran Hutang</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pembayaran Hutang</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <div class="buttons d-flex align-items-center">
                            <a href="<?= base_url('bayar_hutang_add') ?>" class="btn btn-primary btn-sm mr-2" style="width: 100px; margin-right:10px;">Add</a>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin:20px" ;>
                        <table id="reportTable" class="table table-bordered mb-0 text-center" style="font-size: 14px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Nama Supplier</th>
                                    <th style="text-align: center;">Tagihan</th>
                                    <th style="text-align: center;">Pembayaran</th>
                                    <th style="text-align: center;">Sisa Tagihan</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php foreach ($hutang as $index => $row): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><a href="<?= base_url('bayar_hutang_prev/' . $row['id_pembayaran']) ?>"><?= $row['id_pembayaran'] ?></a></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td><?= $row['supplier'] ?? 'Unknown' ?></td>
                                        <td><?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                        <td><?= number_format($row['debit'], 0, ',', '.') ?></td>
                                        <td><?= number_format($row['saldo'], 0, ',', '.') ?></td>
                                        <td><?= $row['keterangan'] ?? '' ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm edit-user-btn"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-sm delete-user-btn"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="3" style="text-align:left;">Total</th>
                                    <th id="totalTagihan"></th>
                                    <th id="totalPembayaran"></th>
                                    <th id="totalSisa"></th>
                                    <th colspan="4"></th>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#reportTable').DataTable({
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
            "pagingType": "full_numbers",
            "drawCallback": function(settings) {
                calculatePageTotals();
            }
        });

        function calculatePageTotals() {
            let table = $('#reportTable').DataTable();
            let totalTagihan = 0;
            let totalPembayaran = 0;
            let totalSisa = 0;

            // Loop through the displayed rows
            table.rows({
                search: 'applied'
            }).every(function(rowIdx, tableLoop, rowLoop) {
                let data = this.data();
                // Assuming the following columns:
                // Tagihan: column 4, Pembayaran: column 5, Sisa Tagihan: column 6
                totalTagihan += parseFloat(data[4].replace(/\./g, '').replace(/,/g, '.')) || 0; // Convert to number
                totalPembayaran += parseFloat(data[5].replace(/\./g, '').replace(/,/g, '.')) || 0; // Convert to number
                totalSisa += parseFloat(data[6].replace(/\./g, '').replace(/,/g, '.')) || 0; // Convert to number
            });

            // Update the footer with totals
            $('#reportTable tfoot tr th').eq(4).text(totalTagihan.toLocaleString('id-ID')); // Format as currency (ID)
            $('#reportTable tfoot tr th').eq(5).text(totalPembayaran.toLocaleString('id-ID')); // Format as currency (ID)
            $('#reportTable tfoot tr th').eq(6).text(totalSisa.toLocaleString('id-ID')); // Format as currency (ID)
        }
    });
</script>



<?= $this->endSection() ?>