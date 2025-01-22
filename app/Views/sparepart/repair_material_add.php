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
                                    <select class="form-select form-select-sm" id="gudang" name="gudang_keluar">
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
                                <tbody id="repair-data-body">
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

<!-- Modal Order -->
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
                            <?php
                            // Membuat array untuk menyimpan no_repair_order yang sudah ditampilkan
                            $uniqueNoRepairOrders = [];
                            ?>
                            <?php if (!empty($penerimaan)) : ?>
                                <?php foreach ($penerimaan as $data) : ?>
                                    <?php
                                    // Mengecek apakah no_repair_order sudah ada dalam array $uniqueNoRepairOrders
                                    if (!in_array($data['no_repair_order'], $uniqueNoRepairOrders)) :
                                        // Menambahkan no_repair_order ke array untuk menghindari duplikasi
                                        $uniqueNoRepairOrders[] = $data['no_repair_order'];
                                    ?>
                                        <tr class="repair-row" data-id-penerimaan="<?= $data['id_penerimaan'] ?>" data-no-repair-order="<?= $data['no_repair_order'] ?>"
                                            data-no-rangka="<?= $data['no_rangka'] ?>" data-jenis-mobil="<?= $data['jenis_mobil'] ?>" data-nopol="<?= $data['nopol'] ?>"
                                            data-asuransi="<?= $data['asuransi'] ?>" data-pemilik="<?= $data['nama_pemilik'] ?>" data-gudang="<?= $data['gudang'] ?>">
                                            <td><?= htmlspecialchars($data['no_repair_order']) ?></td>
                                            <td><?= htmlspecialchars($data['no_rangka']) ?></td>
                                            <td><?= htmlspecialchars($data['jenis_mobil']) ?></td>
                                            <td><?= htmlspecialchars($data['nopol']) ?></td>
                                            <td><?= htmlspecialchars($data['asuransi']) ?></td>
                                        </tr>
                                    <?php endif; ?>
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
    document.addEventListener("DOMContentLoaded", function() {
        // Menambahkan event listener pada setiap baris di modal
        const repairRows = document.querySelectorAll(".repair-row");

        repairRows.forEach(row => {
            row.addEventListener("click", function() {
                // Mengambil data dari atribut data-* di baris yang dipilih
                const noRepairOrder = this.getAttribute("data-no-repair-order");
                const noRangka = this.getAttribute("data-no-rangka");
                const jenisMobil = this.getAttribute("data-jenis-mobil");
                const nopol = this.getAttribute("data-nopol");
                const asuransi = this.getAttribute("data-asuransi");
                const idPenerimaan = this.getAttribute("data-id-penerimaan");
                const pemilik = this.getAttribute('data-pemilik');
                const gudang = this.getAttribute('data-gudang');

                // Mengisi form dengan data yang dipilih
                document.getElementById("no_ro").value = noRepairOrder;
                document.getElementById("no_rangka").value = noRangka;
                document.getElementById("jenis_mobil").value = jenisMobil;
                document.getElementById("nopol").value = nopol;
                document.getElementById("asuransi").value = asuransi;
                document.getElementById("nama_pemilik").value = pemilik;
                document.getElementById("gudang").value = gudang;

                // Menutup modal setelah memilih
                const modal = bootstrap.Modal.getInstance(document.getElementById('repair'));
                modal.hide();

                // Fetch spareparts data based on the selected id_penerimaan
                fetchSpareparts(idPenerimaan);
            });
        });
    });

    // Fetch spareparts data based on id_penerimaan
    function fetchSpareparts(idPenerimaan) {
        fetch(`/get_spareparts-terima?id_penerimaan=${idPenerimaan}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    const tableBody = document.querySelector('#repair-data-body');

                    // Jangan menghapus baris yang sudah ada di tabel
                    // Akan menambahkan baris baru tanpa menghapus yang lama
                    data.forEach(sparepart => {
                        const row = `
                        <tr>
                            <td><input type="text" class="form-control" name="kode_barang[]" value="${sparepart.id_kode_barang}" readonly></td>
                            <td><input type="text" class="form-control" name="nama_barang[]" value="${sparepart.nama_barang}"></td>
                            <td><input type="text" class="form-control qty" name="qty[]" value="${sparepart.qty}"></td>
                            <td><input type="text" class="form-control" name="satuan[]" value="${sparepart.satuan}"></td>
                            <td><input type="text" class="form-control harga" name="harga[]" value="${sparepart.harga}"></td>
                            <td><input type="text" class="form-control jumlah" name="jumlah[]" readonly></td>
                            <td><input type="checkbox" class="form-check-input pilih-checkbox" name="is_sent_checkbox[]" value="1" ${sparepart.is_sent === 1 ? 'checked' : ''}></td>
                        </tr>
                    `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });

                    // Fungsi untuk mengupdate jumlah atau validasi lainnya jika diperlukan
                    updateRemoveButtonStatus();
                    updateJumlah();
                } else {
                    console.error('Data sparepart kosong atau tidak valid');
                }
            })
            .catch(error => {
                console.error('Error fetching spareparts:', error);
            });
    }

    // Fungsi untuk mengupdate jumlah atau validasi lainnya jika diperlukan
    function updateJumlah() {
        const qtyFields = document.querySelectorAll('.qty');
        const hargaFields = document.querySelectorAll('.harga');
        const jumlahFields = document.querySelectorAll('.jumlah');

        qtyFields.forEach((qtyField, index) => {
            const qty = parseFloat(qtyField.value) || 0;
            const harga = parseFloat(hargaFields[index].value) || 0;
            const jumlah = qty * harga;
            jumlahFields[index].value = jumlah.toFixed(2);
        });
    }

    function updateRemoveButtonStatus() {
        const checkboxes = document.querySelectorAll('.pilih-checkbox');
        const removeButton = document.querySelector('#remove-selected-btn');

        const selectedCheckboxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
        removeButton.disabled = selectedCheckboxes.length === 0;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tanggal').value = todayString;
    });

    // Checkbox "Pilih All"
    document.getElementById("pilih-all").addEventListener("change", function() {
        const isChecked = this.checked;
        document.querySelectorAll(".pilih-checkbox").forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });
</script>




<?= $this->endSection() ?>