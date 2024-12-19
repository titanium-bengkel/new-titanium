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
<section id="horizontal-input">
    <div class="row">
        <form method="post" action="<?= base_url('createKwitansi') ?>">
            <div class="col-md-12">
                <div class="card">
                    <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                        <div class="breadcrumb-wrapper" style="font-size: 14px;">
                            <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                            <span class="breadcrumb-divider text-muted mx-3">/</span>
                            <span class="breadcrumb-current text-muted">Add Kwitansi</span>
                        </div>
                        <h5 class="page-title mb-0 fw-bold">Add Kwitansi</h5>
                    </header>
                    <div class="card-body">
                        <h5 class="border-bottom pb-2 mb-4 fw-bold">Informasi Kwitansi</h5>
                        <div class="form-group row mb-3">
                            <label for="nomor" class="col-lg-2 col-form-label">Nomor Kwitansi</label>
                            <div class="col-lg-10">
                                <input type="text" id="nomor" class="form-control" name="nomor" value="<?= $nomor ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="tgl" class="col-lg-2 col-form-label">Tanggal</label>
                            <div class="col-lg-10">
                                <input type="date" id="tgl" class="form-control" name="tgl" value="" onclick="this.showPicker();">
                                <script>
                                    document.getElementById('tgl').value = new Date().toISOString().split('T')[0];
                                </script>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="jatuh_tempo" class="col-lg-2 col-form-label">Jatuh Tempo</label>
                            <div class="col-lg-10">
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" onclick="this.showPicker();" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="no_order" class="col-lg-2 col-form-label">No. Order</label>
                            <div class="col-lg-9">
                                <input type="text" id="no_order" class="form-control" name="no_order" readonly>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-ken">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <h5 class="border-bottom pb-2 mb-4 fw-bold">Detail Kendaraan</h5>
                        <div class="form-group row mb-3">
                            <label for="tgl-masuk" class="col-lg-2 col-form-label">Tgl. Masuk</label>
                            <div class="col-lg-10">
                                <input type="date" id="tgl-masuk" class="form-control" name="tgl-masuk" onclick="this.showPicker();">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="no_kendaraan" class="col-lg-2 col-form-label">No. Kendaraan</label>
                            <div class="col-lg-10">
                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="jenis-mobil" class="col-lg-2 col-form-label">Jenis Mobil</label>
                            <div class="col-lg-10">
                                <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="warna" class="col-lg-2 col-form-label">Warna</label>
                            <div class="col-lg-10">
                                <input type="text" id="warna" class="form-control" name="warna">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="no-rangka" class="col-lg-2 col-form-label">No. Rangka</label>
                            <div class="col-lg-10">
                                <input type="text" id="no-rangka" class="form-control" name="no-rangka">
                            </div>
                        </div>

                        <h5 class="border-bottom pb-2 mb-4 fw-bold">Informasi Pelanggan</h5>
                        <div class="form-group row mb-3">
                            <label for="customer-name" class="col-lg-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-lg-10">
                                <input type="text" id="customer-name" class="form-control" name="customer-name">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="no-contact" class="col-lg-2 col-form-label">No. Kontak</label>
                            <div class="col-lg-10">
                                <input type="text" id="no-contact" class="form-control" name="no-contact">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="tahun-mobil" class="col-lg-2 col-form-label">Tahun Mobil</label>
                            <div class="col-lg-10">
                                <input type="text" id="tahun-mobil" class="form-control" name="tahun-mobil">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="asuransi" class="col-lg-2 col-form-label">Asuransi</label>
                            <div class="col-lg-10">
                                <input type="text" id="asuransi" class="form-control" name="asuransi">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="no-polis" class="col-lg-2 col-form-label">No. Polis</label>
                            <div class="col-lg-10">
                                <input type="text" id="no-polis" class="form-control" name="no-polis">
                            </div>
                        </div>
                        <h5 class="border-bottom pb-2 mb-4 fw-bold">Detail Biaya</h5>
                        <div class="form-group row mb-3">
                            <label for="jasa" class="col-lg-2 col-form-label">Jasa</label>
                            <div class="col-lg-10">
                                <input type="text" id="jasa" class="form-control" name="jasa" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="sparepart" class="col-lg-2 col-form-label">Sparepart</label>
                            <div class="col-lg-10">
                                <input type="text" id="sparepart" class="form-control" name="sparepart" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="nilai-bayar" class="col-lg-2 col-form-label">Total Biaya</label>
                            <div class="col-lg-10">
                                <input type="text" id="nilai-bayar" class="form-control" name="nilai-bayar" readonly>
                            </div>
                        </div>
                        <script>
                            function formatCurrency(input) {
                                let value = input.value.replace(/[^0-9]/g, ""); // Hapus karakter non-angka
                                if (value) {
                                    let formatted = new Intl.NumberFormat('id-ID', {
                                        minimumFractionDigits: 0 // Format tanpa simbol mata uang
                                    }).format(value);
                                    input.value = formatted;
                                } else {
                                    input.value = "";
                                }
                            }

                            function calculateTotal() {
                                const jasa = document.getElementById("jasa")?.value.replace(/[^0-9]/g, "") || 0;
                                const sparepart = document.getElementById("sparepart")?.value.replace(/[^0-9]/g, "") || 0;

                                const total = (parseInt(jasa) || 0) + (parseInt(sparepart) || 0); // Hitung hanya Jasa + Sparepart
                                const formattedTotal = new Intl.NumberFormat('id-ID', {
                                    minimumFractionDigits: 0
                                }).format(total);

                                document.getElementById("nilai-bayar").value = formattedTotal; // Tampilkan total
                            }
                        </script>

                        <div class="form-group row mb-3">
                            <label for="nilai_or" class="col-lg-2 col-form-label">Nilai OR</label>
                            <div class="col-lg-10">
                                <input type="text" id="nilai-or" class="form-control" name="nilai_or" oninput="formatCurrency(this);">
                            </div>
                        </div>

                        <script>
                            function formatCurrencyWithoutRp(input) {
                                let value = input.value.replace(/[^0-9]/g, ""); // Hapus karakter non-angka
                                if (value) {
                                    let formatted = new Intl.NumberFormat('id-ID', {
                                        minimumFractionDigits: 0
                                    }).format(value);
                                    input.value = formatted;
                                } else {
                                    input.value = "";
                                }
                            }

                            function calculateOR() {
                                const nilaiOR = document.getElementById("nilai_or").value.replace(/[^0-9]/g, ""); // Ambil angka saja

                                // Tambahkan logika khusus untuk perhitungan Nilai OR jika diperlukan.
                                console.log("Nilai OR:", parseInt(nilaiOR) || 0);

                                // Jika diperlukan integrasi dengan total lainnya, tambahkan di sini
                                calculateTotal();
                            }

                            function calculateTotal() {
                                const jasa = document.getElementById("jasa")?.value.replace(/[^0-9]/g, "") || 0;
                                const sparepart = document.getElementById("sparepart")?.value.replace(/[^0-9]/g, "") || 0;
                                const nilaiOR = document.getElementById("nilai_or")?.value.replace(/[^0-9]/g, "") || 0;

                                const total = (parseInt(jasa) || 0) + (parseInt(sparepart) || 0) + (parseInt(nilaiOR) || 0);
                                const formattedTotal = new Intl.NumberFormat('id-ID', {
                                    minimumFractionDigits: 0
                                }).format(total);

                                document.getElementById("nilai-bayar").value = formattedTotal;
                            }
                        </script>
                        <div class="form-group row mb-3">
                            <label for="qty_or" class="col-lg-2 col-form-label">Qty OR</label>
                            <div class="col-lg-10">
                                <input type="number" id="qty-or" class="form-control" name="qty_or">
                            </div>
                        </div>
                        <h5 class="border-bottom pb-2 mb-4 fw-bold">Keterangan</h5>
                        <div class="form-group row mb-3">
                            <label for="keterangan" class="col-lg-2 col-form-label">Keterangan</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="button" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<!-- Horizontal Input end -->


<!-- Modal Data Repair -->
<div class="modal fade" id="no-ken" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Data Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Pencarian -->
                <div class="mb-2">
                    <div class="input-group">
                        <input type="text" id="search-input" class="form-control" name="search" placeholder="Cari berdasarkan No. Order, Nopol, dll...">
                        <button class="btn btn-outline-primary" type="button" id="search-button">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </div>

                <!-- Tabel Data -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No. Order</th>
                                <th>Tanggal Masuk</th>
                                <th>No. Kendaraan</th>
                                <th>Jenis Mobil</th>
                                <th>Warna</th>
                                <th>Tahun Kendaraan</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body">
                            <?php if (!empty($dataRepair)): ?>
                                <?php foreach ($dataRepair as $kwi): ?>
                                    <tr
                                        data-tgl-klaim="<?= $kwi['tgl_klaim'] ?>"
                                        data-tgl-acc="<?= $kwi['tgl_acc'] ?>"
                                        data-tgl-keluar="<?= $kwi['tgl_keluar'] ?>"
                                        data-status-bayar="<?= $kwi['status_bayar'] ?>"
                                        data-progres-pengerjaan="<?= $kwi['progres_pengerjaan'] ?>"
                                        data-no-polis="<?= $kwi['no_polis'] ?>"
                                        data-no-rangka="<?= $kwi['no_rangka'] ?>"
                                        data-no-contact="<?= $kwi['no_contact'] ?>"
                                        data-customer-name="<?= $kwi['customer_name'] ?>"
                                        data-alamat="<?= $kwi['alamat'] ?>"
                                        data-kota="<?= $kwi['kota'] ?>"
                                        data-keterangan="<?= $kwi['keterangan'] ?>"
                                        data-biaya-pengerjaan="<?= $kwi['biaya_pengerjaan'] ?>"
                                        data-biaya-sparepart="<?= $kwi['biaya_sparepart'] ?>"
                                        data-total-biaya="<?= $kwi['total_biaya'] ?>"
                                        data-nilai-or="<?= $kwi['nilai_or'] ?>"
                                        data-qty-or="<?= $kwi['qty_or'] ?>"
                                        data-bengkel="<?= $kwi['bengkel'] ?>">
                                        <td><?= $kwi['id_terima_po'] ?></td>
                                        <td><?= $kwi['tgl_masuk'] ?></td>
                                        <td><?= $kwi['no_kendaraan'] ?></td>
                                        <td><?= $kwi['jenis_mobil'] ?></td>
                                        <td><?= $kwi['warna'] ?></td>
                                        <td><?= $kwi['tahun_kendaraan'] ?></td>
                                        <td><?= $kwi['asuransi'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Data Order tidak ada.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol pencarian
        $('#search-button').on('click', function() {
            let searchInput = $('#search-input').val().toLowerCase();
            if (searchInput === '') {
                alert('Mohon masukkan kata kunci pencarian!');
            } else {
                // Filter tabel berdasarkan input pencarian
                $('#data-table-body tr').each(function() {
                    let rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchInput)) {
                        $(this).show(); // Tampilkan baris jika cocok
                    } else {
                        $(this).hide(); // Sembunyikan baris jika tidak cocok
                    }
                });
            }
        });

        // Event listener untuk input pencarian langsung (real-time search)
        $('#search-input').on('input', function() {
            let searchInput = $(this).val().toLowerCase();
            $('#data-table-body tr').each(function() {
                let rowText = $(this).text().toLowerCase();
                if (rowText.includes(searchInput)) {
                    $(this).show(); // Tampilkan baris jika cocok
                } else {
                    $(this).hide(); // Sembunyikan baris jika tidak cocok
                }
            });
        });

        // Dapatkan semua baris di dalam tabel modal
        $('#data-table-body tr').on('click', function() {
            // Ambil data dari sel-sel tabel yang terlihat
            const idTerimaPO = $(this).find('td').eq(0).text();
            const tglMasuk = $(this).find('td').eq(1).text();
            const noKendaraan = $(this).find('td').eq(2).text();
            const jenisMobil = $(this).find('td').eq(3).text();
            const warna = $(this).find('td').eq(4).text();
            const tahunKendaraan = $(this).find('td').eq(5).text();
            const asuransi = $(this).find('td').eq(6).text();

            // Ambil data dari atribut data-* untuk data yang disembunyikan
            const tglKlaim = $(this).data('tgl-klaim');
            const tglAcc = $(this).data('tgl-acc');
            const tglKeluar = $(this).data('tgl-keluar');
            const statusBayar = $(this).data('status-bayar');
            const progresPengerjaan = $(this).data('progres-pengerjaan');
            const noPolis = $(this).data('no-polis');
            const noRangka = $(this).data('no-rangka');
            const noContact = $(this).data('no-contact');
            const customerName = $(this).data('customer-name');
            const alamat = $(this).data('alamat');
            const kota = $(this).data('kota');
            const keterangan = $(this).data('keterangan');
            const biayaPengerjaan = $(this).data('biaya-pengerjaan');
            const biayaSparepart = $(this).data('biaya-sparepart');
            const totalBiaya = $(this).data('total-biaya');
            const nilaiOR = $(this).data('nilai-or');
            const qtyOR = $(this).data('qty-or');
            const bengkel = $(this).data('bengkel');

            // Set nilai pada input form
            $('#no_order').val(idTerimaPO);
            $('#no_kendaraan').val(noKendaraan);
            $('#jenis-mobil').val(jenisMobil);
            $('#warna').val(warna);
            $('#customer-name').val(customerName);
            $('#no-contact').val(noContact);
            $('#tahun-mobil').val(tahunKendaraan);
            $('#asuransi').val(asuransi);
            $('#tgl-masuk').val(tglMasuk);
            $('#tgl-selesai').val(tglKeluar);
            $('#keterangan').val(keterangan);
            $('#jasa').val(biayaPengerjaan);
            $('#sparepart').val(biayaSparepart);
            $('#nilai-total').val(totalBiaya);
            $('#nilai-bayar').val(totalBiaya);
            $('#no-polis').val(noPolis);
            $('#no-rangka').val(noRangka);
            $('#nilai-or').val(nilaiOR);
            $('#qty-or').val(qtyOR);

            // Tutup modal menggunakan jQuery
            $('#no-ken').modal('hide');
        });
    });
</script>


<?= $this->endSection() ?>