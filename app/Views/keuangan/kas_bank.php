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
<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Jurnal Kas & Bank</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Jurnal Kas & Bank</h5>
                </header>
                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                        <!-- Tombol Add dan Export -->
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="btn btn-info btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#record">
                                New Record
                            </button>
                            <a href="#" class="btn btn-secondary btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-file-excel"></i> Export to Excel
                            </a>
                        </div>

                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/kas_bank') ?>" class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Input Cari -->
                            <div class="d-flex align-items-center">
                                <label for="search_keyword" class="form-label fw-bold text-primary me-2 mb-0">Cari:</label>
                                <input
                                    type="text"
                                    name="search_keyword"
                                    id="search_keyword"
                                    class="form-control form-control-sm"
                                    placeholder="No. Document/Deskripsi"
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
                <div class="card-content" style="margin:20px; font-size: 12px;">
                    <div class="table-responsive">
                        <table id="kasTable" class="table table-bordered table-striped table-hover mb-0 text-center">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">No. Dokumen</th>
                                    <th style="text-align: center;">Account</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: left;">Deskripsi</th>
                                    <th style="text-align: right;">Debit</th>
                                    <th style="text-align: right;">Credit</th>
                                    <th style="text-align: center;">User ID</th>
                                    <th style="text-align: center;">Tgl. Input</th>
                                    <th style="text-align: center;">Act</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($datakasbank as $row): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['date']; ?></td>
                                        <td><?= $row['doc_no']; ?></td>
                                        <td><?= $row['account']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td style="text-align: left;"><?= $row['description']; ?></td>
                                        <td style="text-align: right;"><?= number_format($row['debit'], 0, ',', '.'); ?></td>
                                        <td style="text-align: right;"><?= number_format($row['kredit'], 0, ',', '.'); ?></td>
                                        <td><?= $row['user_id']; ?></td>
                                        <td><?= $row['created_at']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal"
                                                data-id-report="<?= $row['id_report']; ?>"
                                                data-doc-no="<?= $row['doc_no']; ?>"
                                                data-account="<?= $row['account']; ?>"
                                                data-name="<?= $row['name']; ?>"
                                                data-description="<?= $row['description']; ?>"
                                                data-debit="<?= $row['debit']; ?>"
                                                data-credit="<?= $row['kredit']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $row['id_report']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>



                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="6" style="text-align: right;">Total</th>
                                    <th class="text-center" style="text-align: right;"><?= number_format(array_sum(array_column($datakasbank, 'debit')), 0, ',', '.'); ?></th>
                                    <th class="text-center" style="text-align: right;"><?= number_format(array_sum(array_column($datakasbank, 'kredit')), 0, ',', '.'); ?></th>
                                    <th colspan="3"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->

<!-- Modal New Record -->
<div class="modal fade" id="record" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="myModalLabel1">New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('keuangan/createKasBank') ?>" method="POST">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="date" id="tgl" class="form-control" name="tgl" onkeydown="return false" onclick="this.showPicker()" required>
                            <input type="hidden" class="form-control form-control-sm" name="doc_no" value="<?= $generate ?>" readonly>
                        </div>

                        <script>
                            // Mengatur input tanggal menjadi tanggal saat ini
                            document.addEventListener("DOMContentLoaded", function() {
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0'); // Januari = 0
                                var yyyy = today.getFullYear();
                                today = yyyy + '-' + mm + '-' + dd;
                                document.getElementById("tgl").value = today;
                            });
                        </script>

                    </div>

                    <button type="button" class="btn btn-success btn-sm" id="add-row-btn">
                        <i class="fas fa-plus"></i> Tambah Baris
                    </button>

                    <div class="table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>Account Debet</th>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-debet">
                                <tr>
                                    <td>
                                        <input class="form-control form-control-sm" name="akun_debet[]" list="akun_debet_list" placeholder="Pilih akun debet" required>
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm" name="keterangan[]" required></td>
                                    <td><input type="text" class="form-control form-control-sm nilai" name="nilai[]" oninput="hitungTotalDebit()" required></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="table-credit">
                                <tr>
                                    <td colspan="2">Account Credit</td>
                                    <td>
                                        <input type="hidden" id="total_debit" class="form-control form-control-sm mb-2" name="total_debit" readonly>
                                        <input class="form-control form-control-sm" name="akun_credit" list="akun_credit_list" placeholder="Pilih akun credit" required>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tambahkan datalist di luar modal -->
<datalist id="akun_debet_list"></datalist>
<datalist id="akun_credit_list"></datalist>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="editModalLabel">Edit Kas Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="doc_no" class="form-label">No. Dokumen</label>
                        <input type="text" class="form-control" id="doc_no" name="doc_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" id="account" name="account" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="debit" class="form-label">Debit</label>
                        <input type="number" class="form-control" id="debit" name="debit" required>
                    </div>
                    <div class="mb-3">
                        <label for="credit" class="form-label">Credit</label>
                        <input type="number" class="form-control" id="credit" name="credit" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik

        // Ambil data dari atribut tombol
        const idReport = button.getAttribute('data-id-report');
        const docNo = button.getAttribute('data-doc-no');
        const account = button.getAttribute('data-account');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const debit = button.getAttribute('data-debit');
        const credit = button.getAttribute('data-credit');

        // Isi form di modal
        document.getElementById('doc_no').value = docNo;
        document.getElementById('account').value = account;
        document.getElementById('name').value = name;
        document.getElementById('description').value = description;
        document.getElementById('debit').value = debit;
        document.getElementById('credit').value = credit;

        // Tambahkan ID report untuk pengiriman ke server
        const form = editModal.querySelector('form');
        form.action = `<?= base_url('keuangan/updateKasBank/'); ?>${idReport}`;
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id'); // Ambil id dari data-id tombol

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL untuk menghapus data
                        window.location.href = `<?= base_url('keuangan/deleteKasBank/'); ?>${id}`;
                    }
                });
            });
        });
    });
</script>

<!-- Script untuk modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        var coaData = [];

        // Load COA data untuk mengisi akun debet dan credit
        function loadCoaData() {
            $.ajax({
                url: 'keuangan/getCoa',
                method: 'GET',
                success: function(data) {
                    coaData = data;

                    // Mengisi datalist untuk akun debet
                    $.each(coaData, function(key, value) {
                        $('#akun_debet_list').append(
                            `<option value="${value.kode} - ${value.nama_account}">`
                        );
                    });

                    // Mengisi datalist untuk akun kredit
                    $.each(coaData, function(key, value) {
                        $('#akun_credit_list').append(
                            `<option value="${value.kode} - ${value.nama_account}">`
                        );
                    });

                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }

        // Fungsi untuk menambahkan baris debet baru
        $('#add-row-btn').on('click', function() {
            var row = '<tr>' +
                '<td>' +
                '<input class="form-control form-control-sm" name="akun_debet[]" list="akun_debet_list" placeholder="Pilih akun debet">' +
                '</td>' +
                '<td><input type="text" class="form-control form-control-sm" name="keterangan[]"></td>' +
                '<td><input type="text" class="form-control form-control-sm nilai" name="nilai[]"></td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>' +
                '</td>' +
                '</tr>';
            $('.table-debet').append(row);
        });

        // Event delegation untuk menghitung total debit saat input di dalam table-debet diubah
        $('.table-debet').on('input', '.nilai', function() {
            hitungTotalDebit();
        });

        function hitungTotalDebit() {
            var total = 0;
            $('input.nilai').each(function() {
                var nilai = parseFloat($(this).val());
                if (!isNaN(nilai)) {
                    total += nilai;
                }
            });
            $('#total_debit').val(total); // Set total debit di input
        }

        // Kirim data ke controller via AJAX
        $('#saveKasBank').on('click', function() {
            // Ambil data dari form modal
            var formData = {
                tgl: $('#tgl').val(),
                doc_no: $('input[name="doc_no"]').val(),
                akun_debet: $('input[name="akun_debet[]"]').map(function() {
                    return $(this).val();
                }).get(),
                keterangan: $('input[name="keterangan[]"]').map(function() {
                    return $(this).val();
                }).get(),
                nilai: $('input[name="nilai[]"]').map(function() {
                    return $(this).val();
                }).get(),
                akun_credit: $('input[name="akun_credit"]').val(),
                total_debit: $('#total_debit').val(), // Ambil nilai total debit dari input
            };

            // Validasi data sebelum dikirim
            if (!formData.tgl || formData.akun_debet.length === 0 || !formData.akun_credit) {
                alert('Pastikan semua data telah terisi!');
                return;
            }

            // Kirim data ke controller
            $.ajax({
                url: 'keuangan/createKasBank', // Pastikan URL sesuai dengan route
                method: 'POST',
                data: formData,
                success: function(response) {
                    alert('Data berhasil disimpan!');
                    window.location.href = 'kasbank'; // Redirect setelah sukses
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: ", xhr.responseText);
                    alert('Terjadi kesalahan, data tidak tersimpan! ' + xhr.responseText);
                }
            });
        });

        // Load COA data saat halaman siap
        loadCoaData();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const table = document.getElementById('kasTable');
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Kas Bank"
        });
        XLSX.writeFile(workbook, 'Kas&Bank.xlsx');
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