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
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('repair_material_part') ?>" class="breadcrumb-link text-primary fw-bold">List RM Sparepart</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Material Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Material Sparepart</h5>
                </header>
                <div class="card-body">
                    <form action="<?= base_url('/sparepart/createRepairpart') ?>" method="post">
                        <h6>ID</h6>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_material">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_material" name="id_material" class="form-control form-control-sm" value="<?= $generateIdrepair ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_ro">No. Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_ro" class="form-control form-control-sm" name="no_ro">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm pilih-data" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_keluar">Gudang Keluar</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>
                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_rangka">No. Rangka</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_rangka" class="form-control form-control-sm" name="no_rangka">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Car Model</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Pelanggan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="asuransi" class="form-control form-control-sm" name="asuransi">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mt-2 my-table-class">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center">Kode Barang</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">HPP</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Pilih All <input type="checkbox" id="pilih-all" class="form-check-input"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data dari JS -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td><input type="text" class="form-control form-control-sm" id="total-qtyB" name="total_qty_B" readonly></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-control-sm" id="total-hpp" name="total_hpp" readonly></td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('repair_material_part'); ?>" class="btn btn-danger">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="repair" tabindex="-1" aria-labelledby="repairModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="repairModalLabel">Pilih Data Repair</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="repair-table" style="font-size: 14px;">
                        <thead class="table-secondary">
                            <tr>
                                <th>No. Order</th>
                                <th>No. Rangka</th>
                                <th>Car Model</th>
                                <th>Nopol</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($penerimaan)) : ?>
                                <?php foreach ($penerimaan as $data) : ?>
                                    <tr class="selectable-row"
                                        data-id_penerimaan="<?= htmlspecialchars($data['id_penerimaan']) ?>"
                                        data-no_repair_order="<?= htmlspecialchars($data['no_repair_order']) ?>"
                                        data-no_rangka="<?= htmlspecialchars($data['no_rangka']) ?>"
                                        data-jenis_mobil="<?= htmlspecialchars($data['jenis_mobil']) ?>"
                                        data-nopol="<?= htmlspecialchars($data['nopol']) ?>"
                                        data-gudang="<?= htmlspecialchars($data['gudang']) ?>"
                                        nama-pemilik="<?= htmlspecialchars($data['nama_pemilik']) ?>"
                                        data-asuransi="<?= htmlspecialchars($data['asuransi']) ?>"
                                        data-kode="<?= htmlspecialchars($data['id_kode_barang']) ?>"
                                        data-qty="<?= htmlspecialchars($data['qty']) ?>"
                                        data-satuan="<?= htmlspecialchars($data['satuan']) ?>"
                                        data-harga="<?= htmlspecialchars($data['harga']) ?>"
                                        data-jumlah="<?= htmlspecialchars($data['jumlah']) ?>"
                                        data-barang="<?= htmlspecialchars($data['nama_barang']) ?>">



                                        <td><?= htmlspecialchars($data['no_repair_order']) ?></td>
                                        <td><?= htmlspecialchars($data['no_rangka']) ?></td>
                                        <td><?= htmlspecialchars($data['jenis_mobil']) ?></td>
                                        <td><?= htmlspecialchars($data['nopol']) ?></td>
                                        <td><?= htmlspecialchars($data['asuransi']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Data penerimaan tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua baris yang bisa dipilih
        const rows = document.querySelectorAll('.selectable-row');

        // Loop setiap baris untuk menambahkan event listener
        rows.forEach(row => {
            row.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                const noRepairOrder = row.getAttribute('data-no_repair_order') || '';
                const noRangka = row.getAttribute('data-no_rangka') || '';
                const jenisMobil = row.getAttribute('data-jenis_mobil') || '';
                const nopol = row.getAttribute('data-nopol') || '';
                const asuransi = row.getAttribute('data-asuransi') || '';
                const gudang = row.getAttribute('data-gudang') || '';
                const pemilik = row.getAttribute('nama-pemilik') || '';
                const barang = row.getAttribute('data-barang') || '';
                const idKodeBarang = row.getAttribute('data-kode') || '';
                const qty = row.getAttribute('data-qty') || '';
                const satuan = row.getAttribute('data-satuan') || '';
                const harga = row.getAttribute('data-harga') || '';
                const jumlah = row.getAttribute('data-jumlah') || '';

                // Cek apakah data sudah ada di tabel
                const tbody = document.querySelector('.my-table-class tbody');
                const existingRow = Array.from(tbody.children).find(tr =>
                    tr.querySelector('input[name="kode_barang[]"]').value === idKodeBarang
                );

                if (existingRow) {
                    alert('Data sudah ada di tabel!');
                    return;
                }

                // Buat baris baru
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td class="text-center">
                    <input type="text" class="form-control form-control-sm" name="kode_barang[]" value="${idKodeBarang}" readonly>
                </td>
                <td class="text-center">
                    <input type="text" class="form-control form-control-sm" name="nama_barang[]" value="${barang}" readonly>
                </td>
                <td class="text-center">
                    <input type="number" class="form-control form-control-sm" name="qty[]" value="${qty}">
                </td>
                <td class="text-center">
                    <input type="text" class="form-control form-control-sm" name="satuan[]" value="${satuan}" readonly>
                </td>
                <td class="text-center">
                    <input type="number" class="form-control form-control-sm" name="hpp[]" value="${harga}">
                </td>
                <td class="text-center">
                    <input type="number" class="form-control form-control-sm" name="nilai[]" value="${jumlah}">
                </td>
                <td class="text-center">
                    <input type="checkbox" class="form-check-input" name="pilih[]">
                </td>
            `;

                // Tambahkan baris ke dalam tbody tabel
                tbody.appendChild(newRow);

                // Tutup modal (Bootstrap 5)
                const modalElement = document.getElementById('repair');
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) modal.hide();
                }
            });
        });

        // Fitur pilih semua checkbox (opsional)
        const pilihAllCheckbox = document.getElementById('pilih-all');
        if (pilihAllCheckbox) {
            pilihAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.form-check-input[name="pilih[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = pilihAllCheckbox.checked;
                });
            });
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil semua baris yang bisa dipilih
        const rows = document.querySelectorAll('.selectable-row');

        rows.forEach(row => {
            row.addEventListener('click', function() {
                // Ambil data dari atribut data-*
                const noRepairOrder = row.getAttribute('data-no_repair_order');
                const noRangka = row.getAttribute('data-no_rangka');
                const jenisMobil = row.getAttribute('data-jenis_mobil');
                const nopol = row.getAttribute('data-nopol');
                const asuransi = row.getAttribute('data-asuransi');
                const gudang = row.getAttribute('data-gudang');
                const pemilik = row.getAttribute('nama-pemilik');
                const barang = row.getAttribute('data-barang');

                // Masukkan data ke dalam form input
                document.getElementById('no_ro').value = noRepairOrder;
                document.getElementById('no_rangka').value = noRangka;
                document.getElementById('jenis_mobil').value = jenisMobil;
                document.getElementById('nopol').value = nopol;
                document.getElementById('asuransi').value = asuransi;
                document.getElementById('gudang_keluar').value = gudang;
                document.getElementById('nama_pemilik').value = pemilik;
                document.getElementById('nama_barang').value = barang;

                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('repair'));
                modal.hide();
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tanggal').value = todayString;
    });
</script>

<?= $this->endSection() ?>