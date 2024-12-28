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
                <div class="card-content" style="margin:20px; font-size: 12px;">
                    <div class="buttons d-flex align-items-center mt-2 mb-2">
                        <button type="button" class="btn btn-info btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#record">
                            New Record
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm mr-2">
                            Export to Excel
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped table-hover mb-0 text-center">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Date</th>
                                    <th style="text-align: center;">No. Dokumen</th>
                                    <th style="text-align: center;">Account</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Deskripsi</th>
                                    <th style="text-align: center;">Debit</th>
                                    <th style="text-align: center;">Credit</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Tanggal Input</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($datakasbank as $row): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['doc_no']; ?></td>
                                        <td><?= $row['kode_account']; ?></td>
                                        <td><?= $row['nama_account']; ?></td>
                                        <td><?= $row['deskripsi']; ?></td>
                                        <td><?= number_format($row['debit'], 0, ',', '.'); ?></td>
                                        <td><?= number_format($row['kredit'], 0, ',', '.'); ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['tgl_input']; ?></td>
                                        <td>
                                            <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-tanggal="<?= $row['tanggal']; ?>"
                                                data-doc_no="<?= $row['doc_no']; ?>"
                                                data-kode_account="<?= $row['kode_account']; ?>"
                                                data-nama_account="<?= $row['nama_account']; ?>"
                                                data-deskripsi="<?= $row['deskripsi']; ?>"
                                                data-debit="<?= $row['debit']; ?>"
                                                data-kredit="<?= $row['kredit']; ?>"
                                                data-username="<?= $row['username']; ?>"
                                                data-tgl_input="<?= $row['tgl_input']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                            <thead style="text-align: center;">
                                <tr>
                                    <th colspan="6" style="text-align: right;">Total</th>
                                    <th class="text-center"><?= number_format(array_sum(array_column($datakasbank, 'debit')), 0, ',', '.'); ?></th>
                                    <th class="text-center"><?= number_format(array_sum(array_column($datakasbank, 'kredit')), 0, ',', '.'); ?></th>
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

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="process_edit.php" method="POST">
                    <!-- Input fields -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $row['tanggal']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="doc_no" class="form-label">Document Number</label>
                        <input type="text" class="form-control" id="doc_no" name="doc_no" value="<?= $row['doc_no']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kode_account" class="form-label">Kode Account</label>
                        <input type="text" class="form-control" id="kode_account" name="kode_account" value="<?= $row['kode_account']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_account" class="form-label">Nama Account</label>
                        <input type="text" class="form-control" id="nama_account" name="nama_account" value="<?= $row['nama_account']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $row['deskripsi']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="debit" class="form-label">Debit</label>
                        <input type="number" class="form-control" id="debit" name="debit" value="<?= $row['debit']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kredit" class="form-label">Kredit</label>
                        <input type="number" class="form-control" id="kredit" name="kredit" value="<?= $row['kredit']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $row['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_input" class="form-label">Tanggal Input</label>
                        <input type="date" class="form-control" id="tgl_input" name="tgl_input" value="<?= $row['tgl_input']; ?>" required>
                    </div>
                    <input type="hidden" name="id" id="editId" value="<?= $row['id_kasbank']; ?>"> <!-- Hidden input to store ID for updates -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal New Record -->
<div class="modal fade" id="record" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menyimpan data -->
                <form action="<?= base_url('keuangan/createKasBank') ?>" method="POST">
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
                    <div class="modal-footer">
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
</div>
<!-- Tambahkan datalist di luar modal -->
<datalist id="akun_debet_list"></datalist>
<datalist id="akun_credit_list"></datalist>

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


<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
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
            "pagingType": "full_numbers"
        });
    });
</script>


<?= $this->endSection() ?>