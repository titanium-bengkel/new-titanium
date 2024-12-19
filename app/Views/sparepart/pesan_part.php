<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Table Pre-order -->
<section class="section">
    <div class="col-12">
        <div class="card">
            <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                <div class="breadcrumb-wrapper" style="font-size: 14px;">
                    <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                    <span class="breadcrumb-divider text-muted mx-3">/</span>
                    <span class="breadcrumb-current text-muted">Pemesanan Sparepart</span>
                </div>
                <h5 class="page-title mb-0 fw-bold">Pemesanan Sparepart NON-SUPPLY</h5>
            </header>
            <div class="card-content">
                <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                    <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                        <div class="d-flex align-items-center w-100 justify-content-start">
                            <a href="<?= base_url('beli_part') ?>" class="btn btn-primary btn-sm me-2" style="width: 60px;">Add</a>
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                        </div>
                    </div>
                </div>
                <!-- table head dark -->
                <div class="table-responsive" style=" font-size: 12px; margin:20px" ;>
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;">OK</th>
                                <th style="text-align: center;">No. PO</th>
                                <th style="text-align: center;">No. Repair Order</th>
                                <th style="text-align: center;">Tanggal</th>
                                <th style="text-align: center;">Nama Supplier</th>
                                <th style="text-align: center;">Nopol</th>
                                <th style="text-align: center;">Asuransi</th>
                                <th style="text-align: center;">Unit</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;">No. Faktur</th>
                                <th style="text-align: center;">Keterangan</th>
                                <th style="text-align: center;">User</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php if (!empty($sparepart)) : ?>
                                <?php foreach ($sparepart as $key => $item) : ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td>
                                            <?php if ($item['all_sent']): ?>
                                                <span class="badge bg-success">Oke</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="<?= base_url('beli_partprev/' . $item['id_pesan']); ?>">
                                                <?= $item['id_pesan']; ?>
                                            </a>
                                        </td>
                                        <td><?= $item['no_repair_order']; ?></td>
                                        <td><?= $item['tanggal']; ?></td>
                                        <td><?= $item['supplier']; ?></td>
                                        <td><?= $item['no_kendaraan']; ?></td>
                                        <td><?= $item['asuransi']; ?></td>
                                        <td><?= $item['jenis_mobil']; ?> <?= $item['warna']; ?> <?= $item['no_kendaraan']; ?> <?= $item['nama_pemilik']; ?></td>
                                        <td><?= number_format($item['total_jumlah'], 0, ',', '.'); ?></td>
                                        <td><?= $item['no_faktur']; ?></td>
                                        <td><?= $item['keterangan']; ?></td>
                                        <td><?= $item['username']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('sparepart/delete/' . $item['id_pesan']); ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="14">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                        <tfoot>
                            <tr style="text-align: center;">
                                <th colspan="9" style="text-align: end;">Total Perpage</th>
                                <th></th>
                                <th colspan="5"></th>
                            </tr>
                            <tr style="text-align: center;">
                                <th colspan="9" style="text-align: end;">Total All</th>
                                <th style="text-align: center;"></th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Ambil data dari tabel
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sheet1"
        });

        // Konversi ke file Excel
        XLSX.writeFile(workbook, "Data_PoSparepart.xlsx");
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

    // Cek apakah ada pesan sukses atau error di session
    <?php if (session()->has('berhasil')): ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?= session('berhasil') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php elseif (session()->has('error')): ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '<?= session('error') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>