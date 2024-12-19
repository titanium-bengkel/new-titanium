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
<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div style=" margin-top: 15px; margin-bottom: 10px; font-size: 12px; padding: 10px 20px; border-radius: 8px; display: inline-block;">
            <div style="font-size: 14px; font-weight: bold;">
                <a href="<?= base_url('/index') ?>" style="text-decoration: none; color: #007bff;">Dashboard</a>
                <span style="color: #6c757d; margin: 0 8px;">/</span>
                <span style="color: #6c757d; font-weight: 500;">Update Invoice Piutang</span>
            </div>
        </div>
        <form method="post" action="<?= base_url('updatePiutang/' . $nomor) ?>">
            <div class="col-md-12">
                <div class="card">
                    <header class="mb-3 mt-4" style="border-bottom: 2px solid #6c757d; padding-bottom: 10px;">
                        <h5 class="ms-3">Update Invoice Piutang</h5>
                    </header>
                    <div class="card-body">
                        <h5>ID</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nomor">Nomor</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nomor" class="form-control" name="nomor" value="<?= $piutang['nomor'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tgl">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="date" id="tgl" class="form-control" name="tgl" value="<?= $piutang['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_order">No. Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_order" class="form-control" name="no_order" value="<?= $piutang['no_order'] ?>" readonly>
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-ken">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_kendaraan">No. Kendaraan</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan" value="<?= $piutang['no_kendaraan'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis-mobil">Jenis Mobil</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil" value="<?= $piutang['jenis_mobil'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="warna" class="form-control" name="warna" value="<?= $piutang['warna'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="customer-name">Customer Name</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="customer-name" class="form-control" name="customer-name" value="<?= $piutang['customer_name'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-contact">No Contact</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-contact" class="form-control" name="no-contact" value="<?= $piutang['no_contact'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun-mobil">Tahun Mobil</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun-mobil" class="form-control" name="tahun-mobil" value="<?= $piutang['tahun_mobil'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= $piutang['asuransi'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="jasa">Jasa</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="jasa" class="form-control" name="jasa" value="<?= $piutang['jasa'] ?>" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="sparepart">Sparepart</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="sparepart" class="form-control" name="sparepart" value="<?= $piutang['sparepart'] ?>" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="row mb-3" style="display: none;">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-total">Nilai Total</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="nilai-total" class="form-control" name="nilai-total" value="<?= $piutang['nilai_total'] ?>" readonly style="display: none;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-bayar">Nilai Total</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="nilai-bayar" class="form-control" name="nilai-bayar">
                            </div>
                        </div>
                        <script>
                            function formatCurrency(input) {
                                let value = input.value;
                                let numericValue = value.replace(/\D/g, '');
                                let formattedValue = numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                input.value = formattedValue;
                            }

                            function calculateTotal() {
                                let jasaValue = document.getElementById('jasa').value.replace(/\./g, '');
                                let sparepartValue = document.getElementById('sparepart').value.replace(/\./g, '');

                                let total = (parseInt(jasaValue) || 0) + (parseInt(sparepartValue) || 0);

                                document.getElementById('nilai-bayar').value = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            }
                        </script>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="jenis-bayar">Jenis Bayar</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <select id="jenis-bayar" class="form-select" name="jenis-bayar">
                                    <option value="" disabled>--Pilih--</option>
                                    <option value="Cash" <?= $piutang['jenis_bayar'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
                                    <option value="Transfer BCA" <?= $piutang['jenis_bayar'] == 'Transfer BCA' ? 'selected' : '' ?>>Transfer BCA</option>
                                    <option value="Piutang" <?= $piutang['jenis_bayar'] == 'Piutang' ? 'selected' : '' ?>>Piutang</option>
                                    <option value="Titip" <?= $piutang['jenis_bayar'] == 'Titip' ? 'selected' : '' ?>>Titip</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl-masuk">Tanggal Masuk</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="date" id="tgl-masuk" class="form-control" name="tgl-masuk" value="<?= $piutang['tanggal_masuk'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl-selesai">Tanggal Selesai</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="date" id="tgl-estimasi" class="form-control" name="tgl-estimasi" value="<?= $piutang['tanggal_selesai'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= $piutang['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl_kirim_kwitansi">Tanggal Kirim Kwitansi</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="date" id="tgl_kirim_kwitansi" class="form-control" name="tgl_kirim_kwitansi" value="<?= $piutang['tanggal_kirim_kwitansi'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                        <div class="col-lg-10 col-4">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger">Batal</button>
                            <button type="button" class="btn btn-sm btn-success" style="margin-left: 20px;">Invoice to customer</button>
                            <button type="button" class="btn btn-sm btn-success">Invoice to asuransi</button>
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
                                <?php foreach ($dataRepair as $repair): ?>
                                    <tr
                                        data-tgl-klaim="<?= $repair['tgl_klaim'] ?>"
                                        data-tgl-acc="<?= $repair['tgl_acc'] ?>"
                                        data-tgl-keluar="<?= $repair['tgl_keluar'] ?>"
                                        data-status-bayar="<?= $repair['status_bayar'] ?>"
                                        data-progres-pengerjaan="<?= $repair['progres_pengerjaan'] ?>"
                                        data-no-polis="<?= $repair['no_polis'] ?>"
                                        data-no-rangka="<?= $repair['no_rangka'] ?>"
                                        data-no-contact="<?= $repair['no_contact'] ?>"
                                        data-customer-name="<?= $repair['customer_name'] ?>"
                                        data-alamat="<?= $repair['alamat'] ?>"
                                        data-kota="<?= $repair['kota'] ?>"
                                        data-keterangan="<?= $repair['keterangan'] ?>"
                                        data-biaya-pengerjaan="<?= $repair['biaya_pengerjaan'] ?>"
                                        data-biaya-sparepart="<?= $repair['biaya_sparepart'] ?>"
                                        data-total-biaya="<?= $repair['total_biaya'] ?>"
                                        data-bengkel="<?= $repair['bengkel'] ?>">
                                        <td><?= $repair['id_terima_po'] ?></td>
                                        <td><?= $repair['tgl_masuk'] ?></td>
                                        <td><?= $repair['no_kendaraan'] ?></td>
                                        <td><?= $repair['jenis_mobil'] ?></td>
                                        <td><?= $repair['warna'] ?></td>
                                        <td><?= $repair['tahun_kendaraan'] ?></td>
                                        <td><?= $repair['asuransi'] ?></td>
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
        // Sembunyikan semua baris saat modal dibuka
        $('#no-ken').on('shown.bs.modal', function() {
            $('#data-table-body tr').hide();
        });

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

            // Tutup modal menggunakan jQuery
            $('#no-ken').modal('hide');
        });
    });
</script>




<!-- js tgl -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl').value = todayString;
    });
</script>

<?= $this->endSection() ?>