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
        <form method="post" action="<?= base_url('createKwitansiOR') ?>">
            <div class="col-md-12">
                <div class="card">
                    <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                        <div class="breadcrumb-wrapper" style="font-size: 14px;">
                            <a href="<?= base_url('/invoice_or') ?>" class="breadcrumb-link text-primary fw-bold">Kwitansi OR</a>
                            <span class="breadcrumb-divider text-muted mx-3">/</span>
                            <span class="breadcrumb-current text-muted">Add Kwitansi OR</span>
                        </div>
                        <h5 class="page-title mb-0 fw-bold">Add Kwitansi OR</h5>
                    </header>
                    <div class="card-body">
                        <h5>ID</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nomor">Nomor</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nomor" class="form-control" name="nomor" value="<?= $nomor ?>" readonly>
                            </div>

                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tgl-acc">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="date" id="tgl" class="form-control" name="tgl" onkeydown="return false" onclick="this.showPicker()" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Data </h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_order">No. Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_order" class="form-control" name="no_order" readonly>
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
                                <input type="text" id="no_kendaraan" class="form-control" name="no_kendaraan">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis-mobil">Jenis Mobil</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="warna" class="form-control" name="warna">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="customer-name">Customer Name</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="customer-name" class="form-control" name="customer-name">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-contact">No Contact</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-contact" class="form-control" name="no-contact">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun-mobil">Tahun Mobil</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun-mobil" class="form-control" name="tahun-mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="asuransi" class="form-control" name="asuransi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="jasa" hidden>Jasa</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="hidden" id="jasa" class="form-control" name="jasa" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="sparepart" hidden>Sparepart</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="hidden" id="sparepart" class="form-control" name="sparepart" oninput="formatCurrency(this); calculateTotal()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-total">Nilai Total</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="total-biaya" class="form-control" name="nilai-total" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-bayar" hidden>Nilai Bayar</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="hidden" id="total-biaya" class="form-control" name="nilai-bayar">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-or">Nilai OR</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="nilai-or" class="form-control" name="nilai-or" oninput="updateTotal()">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="qty-or">Qty OR</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="qty-or" class="form-control" name="qty-or">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="jenis-bayar">Jenis Bayar</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <select id="jenis-bayar" class="form-select" name="jenis-bayar">
                                    <option value="" disabled selected>--Pilih--</option>
                                    <?php foreach ($coa as $item): ?>
                                        <option value="<?= $item['nama_account']; ?>">
                                            <?php
                                            switch ($item['nama_account']) {
                                                case 'REK BCA':
                                                    echo 'TRANSFER BCA';
                                                    break;
                                                case 'KAS BESAR':
                                                    echo 'CASH';
                                                    break;
                                                case 'PIUTANG USAHA':
                                                    echo 'PIUTANG';
                                                    break;
                                                case 'BEBAN DIBAYAR DIMUKA':
                                                    echo 'TITIP';
                                                    break;
                                                default:
                                                    echo $item['nama_account'];
                                            }
                                            ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl-masuk">Tgl. Masuk</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="date" id="tgl-masuk" class="form-control" name="tgl-masuk" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl-selesai">Tgl. Selesai</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="date" id="tgl-estimasi" class="form-control" name="tgl-estimasi" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="tgl_kirim_kwitansi">Tgl. Kirim Kwitansi</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="date" id="tgl_kirim_kwitansi" class="form-control" name="tgl_kirim_kwitansi" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <textarea class="form-control" id="keterangan" rows="1"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-10 col-4">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger">Batal</button>
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
                <h5 class="modal-title" id="myModalLabel1">Data Repair Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                    <table class="table table-bordered mb-0 text-center" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No. Order</th>
                                <th>Tgl. Masuk</th>
                                <th>No. Kendaraan</th>
                                <th>Jenis Mobil</th>
                                <th>Warna</th>
                                <th>Tahun Kendaraan</th>
                                <th>Asuransi</th>
                                <th>Nilai OR</th>
                                <th>Qty OR</th>
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
                                        data-total-biaya="<?= $kwi['harga_acc'] ?>"
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
                                        <td><?= $kwi['nilai_or'] ?></td>
                                        <td><?= $kwi['qty_or'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">Data Order tidak ada.</td>
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


<script>
    $(document).ready(function() {
        // Event listener untuk tombol pencarian
        $('#search-button').on('click', function() {
            let searchInput = $('#search-input').val().toLowerCase();
            if (searchInput === '') {
                alert('Mohon masukkan kata kunci pencarian!');
            } else {
                // Filter tabel berdasarkan input pencarian
                let found = false; // Tambahkan flag untuk mengecek apakah ada baris yang ditemukan
                $('#data-table-body tr').each(function() {
                    let rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchInput)) {
                        $(this).show(); // Tampilkan baris jika cocok
                        found = true; // Tandai bahwa ada hasil
                    } else {
                        $(this).hide(); // Sembunyikan baris jika tidak cocok
                    }
                });
                if (!found) {
                    alert('Data tidak ditemukan!');
                }
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

        $(document).on('click', '#data-table-body tr', function() {
            // Mengambil data dari elemen tabel
            const idTerimaPO = $(this).find('td').eq(0).text();
            const tglMasuk = $(this).find('td').eq(1).text();
            const noKendaraan = $(this).find('td').eq(2).text();
            const jenisMobil = $(this).find('td').eq(3).text();
            const warna = $(this).find('td').eq(4).text();
            const tahunKendaraan = $(this).find('td').eq(5).text();
            const asuransi = $(this).find('td').eq(6).text();

            // Mengambil data dari atribut data-*
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

            // Mengisi data ke dalam input form
            $('#no_order').val(idTerimaPO);
            $('#tgl-masuk').val(tglMasuk);
            $('#no_kendaraan').val(noKendaraan);
            $('#jenis-mobil').val(jenisMobil);
            $('#warna').val(warna);
            $('#tahun-mobil').val(tahunKendaraan);
            $('#asuransi').val(asuransi);
            $('#customer-name').val(customerName);
            $('#no-contact').val(noContact);
            $('#keterangan').val(keterangan);
            $('#nilai-or').val(nilaiOR);
            $('#qty-or').val(qtyOR);
            $('#total-biaya').val(totalBiaya);

            $('#alamat').val(alamat);
            $('#kota').val(kota);

            // Menutup modal
            $('#no-ken').modal('hide');
        });
    });
</script>


<?= $this->endSection() ?>