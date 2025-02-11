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
                <style>
                    .filter-form {
                        margin-top: 0;
                        /* Mengurangi jarak margin atas */
                    }
                </style>

                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap"> <!-- Ubah align-items-center menjadi align-items-start -->
                        <!-- Table Section -->
                        <div class="col-md-3">
                            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                                <table class="table table-bordered table-hover table-striped text-center">
                                    <thead class="thead-dark table-secondary">
                                        <tr>
                                            <th>Total Debit</th>
                                            <th>Total Kredit</th>
                                            <th>Saldo Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: right;"><?= number_format($totalDebit, 0, ',', '.') ?></td>
                                            <td style="text-align: right;"><?= number_format($totalKredit, 0, ',', '.') ?></td>
                                            <td style="text-align: right;">
                                                <?= number_format($totalDebit - $totalKredit, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <form method="get" action="<?= base_url('filter/kaskecil') ?>" class="filter-form d-flex align-items-center gap-3 flex-wrap justify-content-end">
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

                <div class="card-content">
                    <div class="row" style="margin: 20px;" style="font-size: 14px;">

                        <div class="col-md-3">
                            <h5>Jumlah Pengeluaran</h5>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button id="prevMonth" class="btn btn-secondary">Sebelumnya</button>
                                <span id="currentMonth" class="h5"></span> <!-- Menampilkan bulan dan tahun -->
                                <button id="nextMonth" class="btn btn-secondary">Selanjutnya</button>
                            </div>

                            <!-- Tabel Kas Kecil -->
                            <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                                <table class="table table-bordered table-hover table-striped text-center">
                                    <thead class="thead-dark table-secondary">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <!-- Data tabel akan ditambahkan di sini -->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3>Rincian Kas Kecil</h3>
                                <div>
                                    <h6>Saldo Awal:</h6>
                                    <!-- Format angka dengan number_format untuk menampilkan ribuan -->
                                    <h5><?= number_format($saldoAwal, 0, ',', '.') ?></h5>
                                </div>
                            </div>



                            <?php if ($sisaDebit < 500000): ?>
                                <div class="alert alert-warning" role="alert">
                                    <strong>Perhatian!</strong> Sisa debit kas kecil kurang dari Rp 500.000. Segera isi ulang kas kecil.
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($kaskecil)): ?>
                                <?php
                                // Mengelompokkan data berdasarkan tanggal
                                $groupedData = [];
                                foreach ($kaskecil as $item) {
                                    $groupedData[$item['tanggal']][] = $item;
                                }
                                ?>

                                <?php foreach ($groupedData as $tanggal => $items): ?>
                                    <?php
                                    // Menghitung total debit dan kredit per kelompok data yang ditampilkan
                                    $totalDebitview = 0;
                                    $totalKreditview = 0;
                                    foreach ($items as $item) {
                                        $totalDebitview += $item['debit'];
                                        $totalKreditview += $item['kredit'];
                                    }
                                    ?>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover table-striped text-center" style="font-size: 14px;">
                                                <thead class="thead-dark table-secondary">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Account</th>
                                                        <th>Name</th>
                                                        <th>Keterangan</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>User</th>
                                                        <th>Tgl. Input</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($items as $index => $item): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= esc($item['tanggal']) ?></td>
                                                            <td style="text-align: left;"><?= esc($item['kode_account']) ?></td>
                                                            <td style="text-align: left;"><?= esc($item['nama_account']) ?></td>
                                                            <td style="text-align: left;"><?= esc($item['keterangan']) ?></td>
                                                            <td style="text-align: right;"><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                                            <td style="text-align: right;"><?= number_format($item['kredit'], 0, ',', '.') ?></td>
                                                            <td><?= esc($item['user_id']) ?></td>
                                                            <td><?= esc($item['tgl_input']) ?></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal"
                                                                        data-id-kc="<?= $item['id_kc']; ?>"
                                                                        data-kode-account="<?= $item['kode_account']; ?>"
                                                                        data-nama-account="<?= $item['nama_account']; ?>"
                                                                        data-keterangan="<?= $item['keterangan']; ?>"
                                                                        data-debit="<?= $item['debit']; ?>"
                                                                        data-kredit="<?= $item['kredit']; ?>"
                                                                        data-user-id="<?= $item['user_id']; ?>">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm delete-user-btn" data-id="<?= esc($item['id_kc']) ?>">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" class="text-right font-weight-bold">Total:</td>
                                                        <td style="text-align: right;"><?= number_format($totalDebitview, 0, ',', '.') ?></td>
                                                        <td style="text-align: right;"><?= number_format($totalKreditview, 0, ',', '.') ?></td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-info text-center" role="alert">
                                    Belum ada data kas kecil yang tersedia.
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Table head options end -->



<!-- Modal Add -->
<div class="modal fade" id="tanggalModal" tabindex="-1" aria-labelledby="tanggalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="tanggalModalLabel">Input Kas Kecil</h5>
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
                        <button type="button" class="btn btn-sm add-row btn-light-info"><i class="fas fa-plus"></i></button>
                        <button type="button" class="btn btn-sm remove-row btn-light-danger"><i class="fas fa-minus"></i></button>
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
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="saveData" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<datalist id="coaList">
    <!-- Datalist akan diisi oleh AJAX -->
</datalist>



<!-- Modal Edit  -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="editModalLabel">Edit Kas Kecil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_kc" id="id_kc">

                    <div class="mb-3">
                        <label for="kode_account" class="form-label">Kode Account</label>
                        <input type="text" class="form-control" id="kode_account" name="kode_account" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_account" class="form-label">Nama Account</label>
                        <input type="text" class="form-control" id="nama_account" name="nama_account" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="debit" class="form-label">Debit</label>
                        <input type="number" class="form-control" id="debit" name="debit" required>
                    </div>

                    <div class="mb-3">
                        <label for="kredit" class="form-label">Kredit</label>
                        <input type="number" class="form-control" id="kredit" name="kredit" required>
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
        const idKc = button.getAttribute('data-id-kc');
        const tanggal = button.getAttribute('data-tanggal');
        const kodeAccount = button.getAttribute('data-kode-account');
        const namaAccount = button.getAttribute('data-nama-account');
        const keterangan = button.getAttribute('data-keterangan');
        const debit = button.getAttribute('data-debit');
        const kredit = button.getAttribute('data-kredit');
        const userId = button.getAttribute('data-user-id');

        // Isi form di modal
        document.getElementById('id_kc').value = idKc;
        document.getElementById('tanggal').value = tanggal;
        document.getElementById('kode_account').value = kodeAccount;
        document.getElementById('nama_account').value = namaAccount;
        document.getElementById('keterangan').value = keterangan;
        document.getElementById('debit').value = debit;
        document.getElementById('kredit').value = kredit;
        document.getElementById('user_id').value = userId;

        // Tambahkan ID KC untuk pengiriman ke server
        const form = editModal.querySelector('form');
        form.action = `<?= base_url('keuangan/updateKasKecil/'); ?>${idKc}`;
    });
</script>




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
    // Mendapatkan tanggal awal bulan
    let currentDate = new Date();

    // Fungsi untuk menampilkan bulan dan tahun
    function updateMonthDisplay() {
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const monthName = monthNames[currentDate.getMonth()];
        const year = currentDate.getFullYear();
        $('#currentMonth').text(`${monthName} ${year}`);
    }

    // Fungsi untuk mengubah tanggal ke bulan sebelumnya
    function prevMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateMonthDisplay();
        fetchKasKecilData();
    }

    // Fungsi untuk mengubah tanggal ke bulan selanjutnya
    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateMonthDisplay();
        fetchKasKecilData();
    }

    // Fungsi untuk generate semua tanggal dalam bulan berjalan
    function generateDatesForCurrentMonth() {
        var dates = [];
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth();

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

    // Fungsi untuk menggabungkan data dari server dengan tanggal yang sudah di-generate
    function mergeDataWithDates(dataFromServer, dates) {
        var transactions = {}; // Objek untuk menyimpan nilai total per tanggal

        // Hitung total nilai per tanggal
        dataFromServer.forEach(function(item) {
            if (!transactions[item.tanggal]) {
                transactions[item.tanggal] = 0; // Inisialisasi jika belum ada
            }
            transactions[item.tanggal] += parseFloat(item.kredit); // Pastikan nilainya diubah menjadi angka
        });

        // Gabungkan data transaksi dengan tanggal yang sudah di-generate
        return dates.map(function(dateItem) {
            return {
                date: dateItem.date,
                amount: transactions[dateItem.date] || 0 // Jika tidak ada transaksi, set nilai 0
            };
        });
    }

    // Fungsi untuk mempopulasi tabel dengan data
    function populateTable(data) {
        var tableBody = $('#tableBody');
        tableBody.empty(); // Kosongkan tabel sebelum diisi ulang

        // Looping data untuk mengisi tabel
        data.forEach(function(item) {
            tableBody.append(
                `<tr class="text-center">
                <td><a href="#" class="open-modal" data-date="${item.date}" data-bs-toggle="modal" data-bs-target="#tanggalModal">${item.date}</a></td>
                <td>${item.amount.toLocaleString()}</td>
            </tr>`
            );
        });
    }

    // Fungsi untuk mengambil data dari server
    function fetchKasKecilData() {
        $.ajax({
            url: '<?= base_url("keuangan/getKasKecilData") ?>', // URL controller
            type: 'GET',
            dataType: 'json',
            data: {
                month: currentDate.getMonth() + 1,
                year: currentDate.getFullYear()
            },
            success: function(response) {
                // Generate tanggal untuk bulan berjalan
                var dates = generateDatesForCurrentMonth();
                // Gabungkan data dari server dengan semua tanggal dalam bulan berjalan
                var mergedData = mergeDataWithDates(response.dataKasKecil, dates);
                // Populate table dengan data yang sudah digabungkan
                populateTable(mergedData);
            },
            error: function() {
                alert('Gagal memuat data');
            }
        });
    }

    $(document).ready(function() {
        updateMonthDisplay();
        fetchKasKecilData(); // Ambil data kas kecil dari server

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

        // Event listener untuk tombol sebelumnya dan selanjutnya
        $('#prevMonth').click(prevMonth);
        $('#nextMonth').click(nextMonth);
    });
</script>




<!-- End Modal -->
<?= $this->endSection() ?>