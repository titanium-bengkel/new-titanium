<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kas Masuk</span>
                    </div>

                    <div class="d-flex align-items-center">
                        <select id="kasFilter" class="form-select form-select-sm" style="margin-right: 15px;">
                            <option value="">Show All</option>
                            <option value="REK BCA">REK BCA</option>
                            <option value="KAS BESAR">KAS BESAR</option>
                        </select>
                    </div>
                </header>
                <div class="card-content">
                    <div class="table-responsive" style="margin:20px; font-size: 12px;">
                        <h5 class="page-title mb-0 fw-bold">Kas Masuk</h5>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Kas</th>
                                    <th style="text-align: center;">Nama Kas</th>
                                    <th style="text-align: center;">Debet</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User ID</th>
                                </tr>
                            </thead>
                            <tbody id="kasMasukTable">
                                <?php if (!empty($kasMasuk)): ?>
                                    <?php
                                    $transactionsByDate = [];
                                    $grandTotal = 0;
                                    foreach ($kasMasuk as $kas) {
                                        if ($kas['debit'] == 0) {
                                            continue;
                                        }
                                        $date = $kas['date'];
                                        if (!isset($transactionsByDate[$date])) {
                                            $transactionsByDate[$date] = ['transactions' => [], 'totalDebit' => 0];
                                        }
                                        $transactionsByDate[$date]['transactions'][] = $kas;
                                        $transactionsByDate[$date]['totalDebit'] += $kas['debit'];
                                        $grandTotal += $kas['debit'];
                                    }
                                    ?>

                                    <?php foreach ($transactionsByDate as $date => $data): ?>
                                        <?php foreach ($data['transactions'] as $index => $kas): ?>
                                            <tr data-nama-kas="<?= $kas['name']; ?>" data-debit="<?= $kas['debit']; ?>" data-is-total="false">
                                                <td style="text-align: center;"><?= $index + 1; ?></td>
                                                <td><?= $kas['doc_no']; ?></td>
                                                <td style="text-align: center;"><?= $kas['date'] ?></td>
                                                <td style="text-align: center;"><?= $kas['account']; ?></td>
                                                <td style="text-align: center;"><?= $kas['name']; ?></td>
                                                <td style="text-align: center;"><?= number_format($kas['debit'], 0, ',', '.'); ?></td>
                                                <td style="text-align: center;"><?= $kas['description']; ?></td>
                                                <td style="text-align: center;"><?= $kas['username']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr data-is-total="true" style="color: white;">
                                            <td colspan="5" style="text-align: right; font-weight: bold;">Total Debit pada <?= $date; ?></td>
                                            <td style="text-align: center; font-weight: bold;"><?= number_format($data['totalDebit'], 0, ',', '.'); ?></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" style="text-align: center;">Tidak ada data kas masuk.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight: bold;">
                                    <td colspan="5" style="text-align: right;">GRAND TOTAL</td>
                                    <td style="text-align: center;" id="grandTotalFooter"><?= number_format($grandTotal, 0, ',', '.'); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const filterDropdown = document.getElementById('filterDropdown');
                    const tableBody = document.getElementById('kasMasukTable');
                    const filteredTotalDebitElement = document.getElementById('filteredTotalDebit');
                    let grandTotal = <?= $grandTotal; ?>;

                    function calculateTotalDebit() {
                        let totalDebit = 0;
                        const filterValue = filterDropdown.value;

                        Array.from(tableBody.getElementsByTagName('tr')).forEach(row => {
                            const namaKas = row.getAttribute('data-nama-kas');
                            const debitValue = parseFloat(row.getAttribute('data-debit')) || 0;
                            const isTotalRow = row.getAttribute('data-is-total') === 'true';

                            if (filterValue === 'all' || isTotalRow || namaKas === filterValue) {
                                row.style.display = '';
                                if (!isTotalRow && (filterValue === 'all' || namaKas === filterValue)) {
                                    totalDebit += debitValue;
                                }
                            } else {
                                row.style.display = 'none';
                            }
                        });

                        filteredTotalDebitElement.textContent = new Intl.NumberFormat('id-ID', {
                            style: 'decimal'
                        }).format(filterValue === 'all' ? grandTotal : totalDebit);
                    }

                    filterDropdown.addEventListener('change', calculateTotalDebit);

                    // Inisialisasi tampilan pertama dengan "All"
                    calculateTotalDebit();
                });
            </script>
        </div>
    </div>
</section>


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
                var api = this.api();

                // Helper function to convert strings to integers
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\.,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Calculate total across all pages
                var total = api
                    .column(5, {
                        filter: 'applied'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Calculate total for the current page
                var pageTotal = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(5).footer()).html(
                    number_format(pageTotal, 0, ',', '.') + ' (Grand Total: ' + number_format(total, 0, ',', '.') + ')'
                );

                $('#grandTotalFooter').html(number_format(total, 0, ',', '.'));
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


<!-- Table head options end -->
<?= $this->endSection() ?>