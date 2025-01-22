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
                <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/material_jasa') ?>" class="breadcrumb-link text-primary fw-bold">List Repair Jasa</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Repair Jasa</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Repair Jasa</h5>
                </header>
                <div class="card-body">
                    <!-- Tambahkan form action -->
                    <form action="<?= base_url('update_rmjasa') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_jasa">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_jasa" name="id_jasa" class="form-control form-control-sm" value="<?= $jasa['id_jasa'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" onkeydown="return false" onclick="this.showPicker()" value="<?= $jasa['tanggal'] ?>">
                            </div>
                        </div>

                        <h5>Data Order</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_ro">No.Order</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="no_ro" class="form-control form-control-sm" name="no_ro" value="<?= $jasa['no_ro'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal_masuk">Tgl. Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal_masuk" class="form-control form-control-sm" name="tanggal_masuk" onkeydown="return false" onclick="this.showPicker()" value="<?= $jasa['tanggal_masuk'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol" value="<?= $jasa['nopol'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_rangka">No. Rangka</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no_rangka" class="form-control form-control-sm" name="no_rangka" value="<?= $jasa['no_rangka'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Car Model</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil" value="<?= $jasa['jenis_mobil'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="warna" class="form-control form-control-sm" name="warna" value="<?= $jasa['warna'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun">Tahun</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun" class="form-control form-control-sm" name="tahun" value="<?= $jasa['tahun'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Nama Pelanggan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik" value="<?= $jasa['nama_pemilik'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan" value="<?= $jasa['keterangan'] ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3 mb-2">
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?= base_url('material_jasa'); ?>" class="btn btn-danger">Batal</a>
                                </div>
                                <div>
                                    <a href="<?= base_url('material_jasaadd'); ?>" class="btn btn-success">Input Baru</a>
                                </div>
                            </div>
                        </div>

                    </form>
                    <hr>

                    <button type="button" class="btn btn-success btn-sm mt-3" id="toggleAccordionBtn" data-bs-toggle="collapse" data-bs-target="#accordionForm" aria-expanded="false" aria-controls="accordionForm">
                        <i class="fas fa-plus"></i> Add Jasa
                    </button>

                    <div class="accordion mt-2 mb-3">
                        <div id="accordionForm" class="accordion-collapse collapse">
                            <div class="accordion-body border rounded shadow-sm p-3 bg-gradient-success">
                                <form action="<?= base_url('updateOrCreateJasa'); ?>" method="post">
                                    <input type="hidden" class="form-control form-control-sm" id="id_jasa" name="id_jasa" value="<?= $jasa['id_jasa'] ?>">
                                    <input type="hidden" id="no_ro" class="form-control form-control-sm" name="no_order" value="<?= $jasa['no_ro'] ?>">

                                    <!-- Kode Jasa -->
                                    <div class="form-group row align-items-center mb-3">
                                        <label for="kode_jasa" class="col-lg-2 col-form-label">Kode Jasa</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control form-control-sm" id="kode_jasa" name="kode_jasa" value="" readonly>
                                        </div>
                                        <div class="col-lg-2 text-end">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#jasa">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Nama Jasa -->
                                    <div class="form-group row align-items-center mb-3">
                                        <label for="nama_jasa" class="col-lg-2 col-form-label">Nama Jasa</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control form-control-sm" id="nama_jasa" name="nama_jasa">
                                        </div>
                                    </div>

                                    <!-- Harga -->
                                    <div class="form-group row align-items-center mb-3">
                                        <label for="harga" class="col-lg-2 col-form-label">Harga</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control form-control-sm" id="harga" name="harga">
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center mb-3">
                                        <label for="keterangan" class="col-lg-2 col-form-label">Keterangan</label>
                                        <div class="col-lg-10">
                                            <textarea type="text" class="form-control form-control-sm" id="keterangan" name="keterangan" rows="1"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center mb-3">
                                        <label for="jenis_bayar" class="col-lg-2 col-form-label" hidden>Jenis Bayar</label>
                                        <div class="col-lg-10">
                                            <input type="hidden" class="form-control form-control-sm" id="jenis_bayar" name="jenis_bayar">
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover my-table-class">
                            <thead class="table-secondary text-center">
                                <tr>
                                    <th>Kode Jasa</th>
                                    <th>Jasa</th>
                                    <th>Harga</th>
                                    <th>Jenis Bayar</th>
                                    <th>Keterangan</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="detail-opra" class="text-center">
                                <?php if (!empty($detailjasa)): ?>
                                    <?php foreach ($detailjasa as $index => $data): ?>
                                        <tr>
                                            <td><?= $data['kode_jasa'] ?></td>
                                            <td><?= $data['nama_jasa'] ?></td>
                                            <td><?= $data['harga'] ?></td>
                                            <td><?= $data['jenis_bayar'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <th></th>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="text-center">
                                        <td colspan="6">No data available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Horizontal Input end -->


<!-- Modal Detail Barang -->
<div class="modal fade" id="jasa" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-ltr">
                <h5 class="modal-title text-white" id="myModalLabel1">List Jasa RM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-barang" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-barang" class="form-control" name="search" onkeyup="filterTable()">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center" id="table-jasa">
                        <thead class="table-secondary">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Jasa</th>
                                <th>Alokasi Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($masterjasa)): ?>
                                <?php foreach ($masterjasa as $index => $data): ?>
                                    <tr class="select-row" data-kode="<?= $data['kode'] ?>" data-nama="<?= $data['nama_jasa'] ?>" data-bayar="<?= $data['kode_biaya'] ?>" data-ket-biaya="<?= $data['ket_biaya'] ?>">
                                        <td><?= $data['kode'] ?></td>
                                        <td><?= $data['nama_jasa'] ?></td>
                                        <td><?= $data['kode_biaya'] ?> - <?= $data['ket_biaya'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No data available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer bg-light"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterTable() {
        const input = document.getElementById('search-barang');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('table-jasa');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Mulai dari indeks 1 karena indeks 0 adalah header
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    const textValue = cells[j].textContent || cells[j].innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                        break;
                    }
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('toggleAccordionBtn').addEventListener('click', function() {
        const accordionForm = document.getElementById('accordionForm');
        accordionForm.classList.toggle('show');
    });

    $(document).ready(function() {
        $('#repair tbody').on('click', 'tr', function() {
            const customerName = $(this).data('pemilik');
            const noOrder = $(this).find('td:eq(0)').text();
            const tglMasuk = $(this).find('td:eq(1)').text();
            const jenisMobil = $(this).find('td:eq(2)').text();
            const nopol = $(this).find('td:eq(3)').text();
            const warna = $(this).find('td:eq(4)').text();
            const tahun = $(this).find('td:eq(5)').text();
            const asuransi = $(this).find('td:eq(6)').text();
            const parts = tglMasuk.split('-');
            const formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
            $('#no_ro').val(noOrder);
            $('#tanggal_masuk').val(formattedDate);
            $('#jenis_mobil').val(jenisMobil);
            $('#no_kendaraan').val(nopol);
            $('#warna').val(warna);
            $('#tahun').val(tahun);
            $('#asuransi').val(asuransi);
            $('#nama_pemilik').val(customerName);
            $('#repair').modal('hide');
        });

        $('#table-jasa').on('click', '.select-row', function() {
            const kodeJasa = $(this).data('kode');
            const namaJasa = $(this).data('nama');
            const jenisBayar = $(this).data('bayar');
            $('#kode_jasa').val(kodeJasa);
            $('#nama_jasa').val(namaJasa);
            $('#jenis_bayar').val(jenisBayar);
            const modal = bootstrap.Modal.getInstance(document.getElementById('jasa'));
            modal.hide();
        });
    });
</script>





<?= $this->endSection() ?>