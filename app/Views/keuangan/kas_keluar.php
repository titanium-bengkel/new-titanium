<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kas Keluar</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <select id="kasFilter" class="form-select form-select-sm" style="margin-right: 15px;">
                            <option value="">Show All</option>
                            <option value="REK BCA">REK BCA</option>
                            <option value="KAS BESAR">KAS BESAR</option>
                            <option value="KAS KECIL">KAS KECIL</option>
                        </select>
                    </div>
                </header>

                <div class="card-content">
                    <!-- table head dark -->
                    <div class="table-responsive" style="margin:20px; font-size: 12px;" ;>
                        <h5 class="page-title mb-0 fw-bold mb-2">Kas Keluar</h5>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Kas</th>
                                    <th style="text-align: center;">Nama Kas</th>
                                    <th style="text-align: center;">Kredit</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php if (!empty($kasKeluar)): ?>
                                    <?php
                                    $totalDebit = 0;
                                    $displayIndex = 1; // Counter for displayed rows
                                    foreach ($kasKeluar as $index => $kas):
                                        if ($kas['kredit'] == 0 || !in_array($kas['name'], ['KAS BESAR', 'KAS KECIL', 'REK BCA'])) {
                                            continue; // Skip rows based on conditions
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $displayIndex++; ?></td> <!-- Increment and display the counter -->
                                            <td><?= $kas['doc_no']; ?></td>
                                            <td><?= $kas['date']; ?></td>
                                            <td><?= $kas['account']; ?></td>
                                            <td><?= $kas['name']; ?></td>
                                            <td><?= number_format($kas['kredit'], 0, ',', '.'); ?></td>
                                            <td style="text-align: left;"><?= $kas['description']; ?></td>
                                            <td><?= $kas['username']; ?></td>
                                        </tr>
                                    <?php
                                        $totalDebit += $kas['kredit'];
                                    endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">Tidak ada data kas masuk.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="text-center">
                                <tr>
                                    <th colspan="5" style="text-align: right;">Total per Halaman</th>
                                    <th id="totalPerPage"></th>
                                    <th colspan="2"></th>
                                </tr>
                                <tr>
                                    <th colspan="5" style="text-align: right;">Grand Total</th>
                                    <th id="grandTotal"><?= number_format($totalDebit, 0, ',', '.'); ?></th>
                                    <th colspan="2"></th>
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


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('.table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 20,
            "lengthMenu": [
                [20, 50, 100, -1],
                [20, 50, 100, "All"]
            ],
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\.,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                var total = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var pageTotal = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(5).footer()).html(
                    number_format(pageTotal, 0, ',', '.') + ' (Grand Total: ' + number_format(total, 0, ',', '.') + ')'
                );

                $('#totalPerPage').html(number_format(pageTotal, 0, ',', '.'));
                $('#grandTotal').html(number_format(total, 0, ',', '.'));
            }
        });

        $('#kasFilter').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue) {
                table.column(4).search('^' + selectedValue + '$', true, false).draw();
            } else {
                table.column(4).search('').draw();
            }
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = number.toFixed(decimals);
            var nstr = number.toString();
            var x = nstr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? dec_point + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');
            }
            return x1 + x2;
        }
    });
</script>







<?= $this->endSection() ?>