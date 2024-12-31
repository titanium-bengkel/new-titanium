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
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/dashboard') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Kas Kecil</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Kas Kecil</h5>
                </header>
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <h6 class="mt-3" style="margin-left: 15px;">Sort by</h6>
                        <input type="text" id="dateRange" class="form-control flatpickr-range mt-2" placeholder="Select date range" style="margin-left:20px; width: 250px;">
                    </div>
                </div>
                <div class="row" style="margin: 20px;" style="font-size: 14px;">
                    <div class="col-md-3">
                        <h5>Jumlah Pengeluaran</h5>
                        <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <!-- Tanggal dan jumlah akan ditambahkan di sini oleh JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3>Rincian Kas Kecil</h3>

                        <?php if (!empty($kaskecil)): ?>
                            <?php
                            // Mengurutkan data berdasarkan tanggal
                            usort($kaskecil, function ($a, $b) {
                                return strtotime($a['tanggal']) - strtotime($b['tanggal']);
                            });

                            // Mengelompokkan data berdasarkan tanggal
                            $groupedData = [];
                            foreach ($kaskecil as $item) {
                                // Cek apakah item tanggal berada di bulan dan tahun saat ini
                                $currentMonth = date('Y-m'); // Format tahun-bulan
                                if (date('Y-m', strtotime($item['tanggal'])) === $currentMonth) {
                                    $groupedData[$item['tanggal']][] = $item;
                                }
                            }
                            ?>

                            <?php if (!empty($groupedData)): ?>
                                <?php foreach ($groupedData as $tanggal => $items): ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <table class="table table-bordered text-center" style="font-size: 14px;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Account</th>
                                                        <th>Name</th>
                                                        <th>Keterangan</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>User ID</th>
                                                        <th>Tgl. Input</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $totalDebit = 0;
                                                    $totalKredit = 0;
                                                    foreach ($items as $index => $item):
                                                        $totalDebit += $item['debit'];
                                                        $totalKredit += $item['kredit'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= esc($item['tanggal']) ?></td>
                                                            <td><?= esc($item['kode_account']) ?></td>
                                                            <td><?= esc($item['nama_account']) ?></td>
                                                            <td><?= esc($item['keterangan']) ?></td>
                                                            <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                                            <td><?= number_format($item['kredit'], 0, ',', '.') ?></td>
                                                            <td><?= esc($item['user_id']) ?></td>
                                                            <td><?= esc($item['tgl_input']) ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-sm edit-user-btn" data-id="<?= esc($item['id_kc']) ?>"><i class="fas fa-edit"></i></button>
                                                                    <button type="button" class="btn btn-sm delete-user-btn" data-id="<?= esc($item['id_kc']) ?>"><i class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" class="text-right font-weight-bold">Total:</td>
                                                        <td><?= number_format($totalDebit, 0, ',', '.') ?></td>
                                                        <td><?= number_format($totalKredit, 0, ',', '.') ?></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-warning" role="alert">
                                    Tidak ada data tersedia untuk bulan ini.
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-info text-center" role="alert">
                                Belum ada Pengeluaran Bulan ini.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Table head options end -->



<!-- Modal Bootstrap -->
<div class="modal fade" id="tanggalModal" tabindex="-1" aria-labelledby="tanggalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tanggalModalLabel">Input Kas Kecil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input -->
                <form id="formPengeluaran" action="<?= base_url('keuangan/createKasKecil') ?>" method="POST">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="docNo" class="form-label">Doc No.</label>
                        <input type="text" class="form-control" id="docNo" name="doc_no" readonly>
                    </div>

                    <!-- Tombol Tambah dan Hapus Baris -->
                    <div class="mb-1">
                        <button type="button" class="btn btn-sm add-row">+</button>
                        <button type="button" class="btn btn-sm remove-row">-</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Kode Account</th>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tableRows">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="kode_account[]" placeholder="Masukkan kode account" list="coaList">
                                        <datalist id="coaList"></datalist>
                                    </td>
                                    <td><input type="text" class="form-control" name="keterangan[]" placeholder="Masukkan keterangan"></td>
                                    <td><input type="text" class="form-control" name="nilai[]" placeholder="Masukkan nilai"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="saveData" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<datalist id="coaList">
    <!-- Datalist akan diisi oleh AJAX -->
</datalist>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Fetch data COA saat halaman dimuat
        $.ajax({
            url: '<?= base_url('keuangan/getCoa') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Mengisi datalist dengan data yang diterima
                var coaList = $('#coaList');
                coaList.empty(); // Kosongkan datalist sebelum diisi
                $.each(data, function(index, item) {
                    coaList.append('<option value="' + item.kode + ' - ' + item.nama_account + '"></option>');
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching COA data:', textStatus, errorThrown);
            }
        });

        // Fungsi untuk menambah baris baru
        $(document).on('click', '.add-row', function() {
            var newRow = `<tr>
                <td>
                    <input type="text" class="form-control" name="kode_account[]" placeholder="Masukkan kode account" list="coaList">
                </td>
                <td><input type="text" class="form-control" name="keterangan[]" placeholder="Masukkan keterangan"></td>
                <td><input type="number" class="form-control" name="nilai[]" placeholder="Masukkan nilai"></td>
            </tr>`;
            $('#tableRows').append(newRow);
        });

        // Fungsi untuk menghapus baris
        $(document).on('click', '.remove-row', function() {
            if ($('#tableRows tr').length > 1) { // Cegah menghapus baris terakhir
                $('#tableRows tr:last').remove();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Sembunyikan semua detail pada awal
        $('.details').hide();

        // Toggle untuk menampilkan atau menyembunyikan detail
        $('.toggle-btn').click(function() {
            $(this).closest('.card').find('.details').slideToggle();
        });
    });
</script>
<script>
    // Saat tanggal diklik, tampilkan modal
    $(document).on('click', '.open-modal', function() {
        var selectedDate = $(this).data('date');
        $('#tanggalModalLabel').text("Input Kas Kecil "); // Tampilkan tanggal di judul modal
        $('#formPengeluaran').attr('data-date', selectedDate); // Simpan tanggal dalam form

        // Update input tanggal dengan nilai yang dipilih
        $('#tanggal').val(selectedDate);
    });

    // Aksi tombol simpan di modal
    $('#saveData').click(function() {
        var date = $('#formPengeluaran').attr('data-date');
        var jumlah = $('#jumlah').val();
        var keterangan = $('#keterangan').val();

        // Lakukan sesuatu dengan data ini (misalnya kirim ke backend atau update UI)
        console.log("Tanggal: " + date + ", Jumlah: " + jumlah + ", Keterangan: " + keterangan);

        // Tutup modal
        $('#tanggalModal').modal('hide');
    });
</script>

<script>
    // Fungsi untuk generate semua tanggal dalam bulan berjalan
    function generateDatesForCurrentMonth() {
        var dates = [];
        var now = new Date();
        var currentYear = now.getFullYear();
        var currentMonth = now.getMonth();

        // Dapatkan jumlah hari dalam bulan saat ini
        var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        for (var day = 1; day <= daysInMonth; day++) {
            var formattedDay = day.toString().padStart(2, '0');
            var formattedMonth = (currentMonth + 1).toString().padStart(2, '0');
            var formattedDate = `${currentYear}-${formattedMonth}-${formattedDay}`;
            dates.push({
                date: formattedDate,
                amount: 0
            });
        }
        return dates;
    }

    // Fungsi untuk mendapatkan format docNo berdasarkan tanggal yang dipilih
    function formatDocNo(selectedDate) {
        var dateParts = selectedDate.split('-'); // Memisahkan string tanggal ke dalam format [tahun, bulan, hari]
        var year = dateParts[0].slice(-2); // Ambil 2 digit tahun
        var month = String(dateParts[1]).padStart(2, '0'); // Ambil bulan dalam format 2 digit
        var day = String(dateParts[2]).padStart(2, '0'); // Ambil tanggal dalam format 2 digit

        // Format docNo sesuai permintaan
        var docNo = "01.01." + month + ".CJ" + year + month + day;

        // Update nilai input docNo
        document.getElementById('docNo').value = docNo;
    }

    // Fungsi untuk mempopulasi tabel
    function populateTable(data) {
        var tableBody = $('#tableBody');
        tableBody.empty(); // Kosongkan tabel sebelum diisi ulang

        data.forEach(function(item) {
            tableBody.append(
                `<tr class="text-center">
                    <td><a href="#" class="open-modal" data-date="${item.date}" data-bs-toggle="modal" data-bs-target="#tanggalModal">${item.date}</a></td>
                    <td>${item.amount.toLocaleString()}</td>
                </tr>`
            );
        });
    }

    $(document).ready(function() {
        var dates = generateDatesForCurrentMonth(); // Generate tanggal untuk bulan berjalan
        populateTable(dates); // Populate tabel dengan tanggal-tanggal yang sudah di-generate

        // Saat tanggal diklik, tampilkan modal
        $(document).on('click', '.open-modal', function() {
            var selectedDate = $(this).data('date');
            $('#tanggalModalLabel').text("Input Kas Kecil"); // Tampilkan tanggal di judul modal
            $('#formPengeluaran').attr('data-date', selectedDate); // Simpan tanggal dalam form

            // Update input tanggal dengan nilai yang dipilih
            $('#tanggal').val(selectedDate);

            // Generate docNo berdasarkan tanggal yang dipilih
            formatDocNo(selectedDate);
        });

        // Aksi tombol simpan di modal
        $('#saveData').click(function() {
            var date = $('#formPengeluaran').attr('data-date');
            var jumlah = $('#jumlah').val();
            var keterangan = $('#keterangan').val();

            // Lakukan sesuatu dengan data ini (misalnya kirim ke backend atau update UI)
            console.log("Tanggal: " + date + ", Jumlah: " + jumlah + ", Keterangan: " + keterangan);

            // Tutup modal
            $('#tanggalModal').modal('hide');
        });

        // Filter data berdasarkan tanggal yang dipilih
        $(document).on('change', '#startDate, #endDate', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Filter data berdasarkan rentang tanggal
            var filteredData = dates.filter(function(item) {
                return (!startDate || item.date >= startDate) && (!endDate || item.date <= endDate);
            });

            // Tampilkan data yang sudah difilter di tabel
            populateTable(filteredData);
        });

        // JavaScript to handle click and show modal
        const tableClickable = document.querySelectorAll('.table-clickable');
        tableClickable.forEach(function(cell) {
            cell.addEventListener('click', function() {
                const targetModal = this.getAttribute('data-target');

                const modal = new bootstrap.Modal(document.querySelector(targetModal));
                modal.show();
            });
        });
    });
</script>


<!-- End Modal -->
<?= $this->endSection() ?>