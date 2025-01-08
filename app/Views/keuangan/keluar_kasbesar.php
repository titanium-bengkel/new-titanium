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
                        <span class="breadcrumb-current text-muted">Pengeluaran Kas Besar</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pengeluaran Kas Besar</h5>
                </header>
                <div class="card-header py-3 px-4">
                    <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
                        <!-- Filter dan Tampilkan Semua -->
                        <form method="get" action="<?= base_url('filter/keluar_kasbesar') ?>" class="d-flex align-items-center gap-3 flex-wrap">
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
                            <div class="table-responsive" style="max-height: 800px; overflow-y: 20px;">
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
                            <h3>Rincian Pengeluaran Kas Besar</h3>

                            <?php if (!empty($data_kasbesar)): ?>
                                <?php
                                $groupedData = [];
                                foreach ($data_kasbesar as $item) {
                                    // Cek apakah item tanggal berada di bulan dan tahun saat ini
                                    $currentMonth = date('Y-m'); // Format tahun-bulan
                                    if (date('Y-m', strtotime($item['date'])) === $currentMonth) {
                                        $groupedData[$item['date']][] = $item;
                                    }
                                }
                                ?>

                                <?php if (!empty($groupedData)): ?>
                                    <?php foreach ($groupedData as $tanggal => $items): ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <table class="table table-bordered TABLE-HOVER table-striped text-center" style="font-size: 14px;">
                                                    <thead class="thead-dark table-secondary">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Tanggal</th>
                                                            <th>Account</th>
                                                            <th>Keterangan</th>
                                                            <th>Jumlah</th>
                                                            <th>User ID</th>
                                                            <th>Tgl. Input</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $totalJumlah = 0;
                                                        foreach ($items as $index => $item):
                                                            $totalJumlah += $item['debit'];
                                                        ?>
                                                            <tr>
                                                                <td><?= $index + 1 ?></td>
                                                                <td><?= esc($item['date']) ?></td>
                                                                <td><?= esc($item['account']) ?> - <?= esc($item['name']) ?></td>
                                                                <td><?= esc($item['description']) ?></td>
                                                                <td><?= number_format($item['debit'], 0, ',', '.') ?></td>
                                                                <td><?= esc($item['user_id']) ?></td>
                                                                <td><?= esc($item['created_at']) ?></td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <!-- Tombol Edit -->
                                                                        <button type="button" class="btn btn-sm edit-user-btn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editModal"
                                                                            data-id="<?= esc($item['id_report']) ?>"
                                                                            data-date="<?= esc($item['date']) ?>"
                                                                            data-account="<?= esc($item['account']) ?>"
                                                                            data-name="<?= esc($item['name']) ?>"
                                                                            data-description="<?= esc($item['description']) ?>"
                                                                            data-debit="<?= esc($item['debit']) ?>">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <!-- Tombol Hapus -->
                                                                        <button type="button" class="btn btn-sm delete-user-btn" data-id="<?= esc($item['id_report']) ?>">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4" class="text-right font-weight-bold">Total:</td>
                                                            <td><?= number_format($totalJumlah, 0, ',', '.') ?></td>
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
        </div>
</section>
<!-- Table head options end -->



<!-- Modal Bootstrap -->
<div class="modal fade" id="tanggalModal" tabindex="-1" aria-labelledby="tanggalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="tanggalModalLabel">Input Pengeluaran Kas Kecil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPengeluaran" action="<?= base_url('keuangan/createPKasbesar') ?>" method="POST">
                <div class="modal-body">
                    <!-- Form Input -->
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
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" id="saveData" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<datalist id="coaList">
    <!-- Datalist akan diisi oleh AJAX -->
</datalist>


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="editForm">
                <div class="modal-header bg-gradient-ltr">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Pengeluaran Kas Besar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_report" id="id_report">
                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="account" class="form-label">Account</label>
                        <input type="text" class="form-control" id="account" name="kode_account" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="nama_account" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="description" name="keterangan" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="debit" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="debit" name="nilai" required>
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

<!-- Script untuk Modal dan SweetAlert 2 -->
<script>
    // Modal Edit
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik
        const id = button.getAttribute('data-id');
        const date = button.getAttribute('data-date');
        const account = button.getAttribute('data-account');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');
        const debit = button.getAttribute('data-debit');

        // Isi form di modal
        document.getElementById('id_report').value = id;
        document.getElementById('date').value = date;
        document.getElementById('account').value = account;
        document.getElementById('name').value = name;
        document.getElementById('description').value = description;
        document.getElementById('debit').value = debit;

        // Set action form
        const editForm = document.getElementById('editForm');
        editForm.action = `<?= base_url('keuangan/updatePKasbesar') ?>/${id}`;
    });

    // SweetAlert 2 untuk Konfirmasi Hapus
    document.querySelectorAll('.delete-user-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Arahkan ke endpoint hapus
                    window.location.href = `<?= base_url('keuangan/deletePKasbesar') ?>/${id}`;
                }
            });
        });
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
    // Fungsi untuk mendapatkan data dari server
    function fetchData() {
        $.ajax({
            url: '<?= base_url('getDataKeluarkasbesar') ?>', // Ganti dengan URL yang sesuai
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Data fetched:', data); // Log data yang diterima
                populateTable(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    }

    $(document).ready(function() {
        // Panggil data saat halaman dimuat
        fetchData();

        // Set interval untuk memperbarui data setiap 5 detik
        setInterval(fetchData, 5000); // Mengambil data setiap 5 detik

        // Saat tanggal diklik, tampilkan modal
        $(document).on('click', '.open-modal', function() {
            var selectedDate = $(this).data('date');
            $('#tanggalModalLabel').text("Input Pengeluaran KAS BESAR "); // Tampilkan tanggal di judul modal
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
                tanggal: formattedDate,
                debit: 0 // Default 0 untuk pengeluaran
            });
        }
        return dates;
    }

    // Fungsi untuk mendapatkan format docNo berdasarkan tanggal yang dipilih
    function formatDocNo(selectedDate) {
        var dateParts = selectedDate.split('-'); // Pisahkan string tanggal ke dalam format [tahun, bulan, hari]
        var year = dateParts[0].slice(-2); // Ambil 2 digit terakhir dari tahun
        var month = String(dateParts[1]).padStart(2, '0'); // Ambil bulan dalam format 2 digit
        var day = String(dateParts[2]).padStart(2, '0'); // Ambil tanggal dalam format 2 digit

        // Format docNo sesuai format yang diinginkan
        var docNo = "01.01." + month + ".KB" + year + month + day;

        // Update input docNo
        document.getElementById('docNo').value = docNo;
    }

    // Fungsi untuk menggabungkan data dari server dengan semua tanggal dalam bulan berjalan
    function mergeDataWithDates(dataFromServer, dates) {
        var transactions = {}; // Objek untuk menyimpan nilai total per tanggal

        // Hitung total nilai per tanggal
        dataFromServer.forEach(function(item) {
            if (!transactions[item.date]) {
                transactions[item.date] = 0; // Inisialisasi jika belum ada
            }
            transactions[item.date] += parseFloat(item.debit); // Pastikan nilainya diubah menjadi angka
        });

        // Gabungkan data transaksi dengan semua tanggal
        return dates.map(function(dateItem) {
            return {
                tanggal: dateItem.tanggal,
                debit: transactions[dateItem.tanggal] || 0 // Jika tidak ada transaksi, set nilai 0
            };
        });
    }

    // Fungsi untuk mempopulasi tabel
    function populateTable(data) {
        var tableBody = $('#tableBody');
        var totalJumlah = 0; // Variabel untuk menyimpan total

        tableBody.empty(); // Kosongkan tabel sebelum diisi data

        // Looping data untuk mengisi tabel dan menghitung total jumlah
        data.forEach(function(item) {
            totalJumlah += item.debit; // Tambahkan jumlah ke total

            // Format nilai dengan format uang Rp
            var formattedDebit = 'Rp. ' + item.debit.toLocaleString('id-ID');

            // Tambahkan data ke tabel
            tableBody.append(
                `<tr class="text-center">
                    <td><a href="#" class="open-modal" data-date="${item.tanggal}" data-bs-toggle="modal" data-bs-target="#tanggalModal">${item.tanggal}</a></td>
                    <td>${formattedDebit}</td>
                </tr>`
            );
        });

        // Update total jumlah di bagian footer
        $('#totalJumlah').text('Rp. ' + totalJumlah.toLocaleString('id-ID'));
    }

    // Fungsi untuk mengambil data dari server
    function fetchKasBesarData() {
        $.ajax({
            url: '<?= base_url("keuangan/getKasBesarData") ?>', // URL controller
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Generate tanggal untuk bulan berjalan
                var dates = generateDatesForCurrentMonth();
                // Gabungkan data dari server dengan semua tanggal dalam bulan berjalan
                var mergedData = mergeDataWithDates(response.dataKasBesar, dates);
                // Populate table dengan data yang sudah digabungkan
                populateTable(mergedData);
            },
            error: function() {
                alert('Gagal memuat data');
            }
        });
    }

    $(document).ready(function() {
        fetchKasBesarData();

        // Saat tanggal diklik, tampilkan modal untuk input pengeluaran
        $(document).on('click', '.open-modal', function() {
            var selectedDate = $(this).data('date');
            $('#tanggalModalLabel').text("Input Pengeluaran KAS BESAR " + selectedDate); // Tampilkan tanggal di judul modal
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
                return (!startDate || item.tanggal >= startDate) && (!endDate || item.tanggal <= endDate);
            });

            // Tampilkan data yang sudah difilter di tabel
            populateTable(filteredData);
        });
    });
</script>





<!-- End Modal -->
<?= $this->endSection() ?>