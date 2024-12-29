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
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Material Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Material Sparepart</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <form action="/preorder/filter" method="get" class="d-flex align-items-center flex-wrap w-100">
                                <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0" placeholder="Cari data" style="width: 100%; max-width: 130px;">
                                <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2 mb-2 mb-md-0" placeholder="Select date.." style="width: 100%; max-width: 130px;">
                                <select name="month" class="form-control form-control-sm me-2 mb-2 mb-md-0" id="selectMonth" style="width: 100%; max-width: 100px;">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <select name="year" class="form-control form-control-sm mb-2 mb-md-0" id="selectYear" style="width: 100%; max-width: 100px;">
                                    <!-- Tahun akan diisi otomatis -->
                                </select>
                            </form>
                        </div>
                        <div class="d-flex align-items-center mt-4 w-100 justify-content-start">
                            <a href="<?= base_url('repair_material_add') ?>" class="btn btn-primary btn-sm me-2" style="width: 60px;">Add</a>
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</a>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="font-size: 12px; margin:20px" ;>
                        <table class="table table-bordered table-striped -table-hover mb-0">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">Kode Gudang</th>
                                    <th style="text-align: center;">No. Order</th>
                                    <!-- <th style="text-align: center;">Tanggal Order</th> -->
                                    <th style="text-align: center;">Jenis Mobil</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Nama Pemilik</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                                <?php if (!empty($repair)): ?>
                                    <?php foreach ($repair as $index => $data): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('repair_material_prev/' . $data['id_material']); ?>">
                                                    <?= $data['id_material'] ?>
                                                </a>
                                            </td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['gudang_keluar'] ?></td>
                                            <td><?= $data['no_repair'] ?></td>
                                            <!-- <td><?= $data['tanggal_masuk'] ?></td> -->
                                            <td><?= $data['jenis_mobil'] ?></td>
                                            <td><?= $data['nopol'] ?></td>
                                            <td><?= $data['nama_pemilik'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td>
                                                <!-- <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('/sparepart/deleterepairpart/' . $data['id_material']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button> -->
                                                <button type="button" class="btn btn-danger btn-sm delete-user-btn" style="padding: 1px 3px; font-size: 10px;" data-url="<?= base_url('/sparepart/deleterepairpart/' . $data['id_material']); ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="14">Data tidak ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-primary">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
        XLSX.writeFile(workbook, "Data_RepairMaterialSparepart.xlsx");
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
<?= $this->endSection() ?>