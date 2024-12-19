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
                        <span class="breadcrumb-current text-muted">Pemesanan Bahan (PO)</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pemesanan Bahan (PO)</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <a href="<?= base_url('order_bahan') ?>" class="btn btn-primary btn-sm me-2">Add Pemesanan</a>
                        <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                    </div>

                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin: 20px;">
                        <table class="table table-bordered mb-0" id="po_bahan_table">
                            <thead class="thead-dark" style="text-align: center;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Nomor</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Kode Supplier</th>
                                    <th class="text-center">Nama Supplier</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">No. Faktur</th>
                                    <th class="text-center">Ket</th>
                                    <th class="text-center">User</th>
                                    <th class="text-center">Act</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($bahan)) : ?>
                                    <?php foreach ($bahan as $key => $item) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td>
                                                <?php if ($item['status'] === 'Oke'): ?>
                                                    <span class="badge bg-success">Oke</span>
                                                <?php else: ?>
                                                    <!-- Tampilkan <td> kosong jika status bukan 'Oke' -->
                                                    <span></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('order_bahanprev/' . $item['id_po_bahan']); ?>">
                                                    <?= $item['id_po_bahan']; ?>
                                                </a>
                                            </td>
                                            <td><?= $item['tanggal']; ?></td>
                                            <td><?= $item['kode_supplier']; ?></td>
                                            <td><?= $item['supplier']; ?></td>
                                            <td><?= number_format($item['total_jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= $item['no_faktur']; ?></td>
                                            <td><?= $item['keterangan']; ?></td>
                                            <td><?= $item['user_id']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('bahan/delete/' . $item['id_po_bahan']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr style="text-align: center;">
                                    <th colspan="6" style="text-align: end;">Total Perpage</th>
                                    <th></th>
                                    <th colspan="4"></th>
                                </tr>
                                <tr style="text-align: center;">
                                    <th colspan="6" style="text-align: end;">Total All</th>
                                    <th></th>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tombol delete
        const deleteButtons = document.querySelectorAll('.delete-user-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah link dari melakukan tindakan default (navigasi)

                const deleteUrl = this.getAttribute('data-url'); // Ambil URL dari atribut data-url

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl; // Redirect ke URL penghapusan jika dikonfirmasi
                    }
                });
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Ambil data dari tabel
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });

        // Konversi ke file Excel
        XLSX.writeFile(workbook, "Data_PoBahan.xlsx");
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#po_bahan_table').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100],
            "ordering": true,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
            },
            "pagingType": "full_numbers"
        });
    });
</script>




<?= $this->endSection() ?>