<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Repair Material Jasa</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <div class="buttons d-flex align-items-center">
                            <a href="<?= base_url('material_jasaadd') ?>" class="btn btn-primary mt-3 mr-2" style="width: 100px; margin-right:10px;">Add</a>
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="Nama Suplier" style="margin-right:10px; width: 150px;">
                            <a href="#" class="btn btn-info btn-sm mt-3 mr-2" style="width: 90px; margin-left:10px;">Show</a>
                            <input type="date" class="form-control flatpickr-range mt-2" placeholder="Select date.." style="margin-left:50px; width: 250px;">
                        </div>
                        <div class="mt-2 mr-2" style="margin-left:10px; width: 100px;">
                            <select class="form-control" id="selectMonth">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="mt-2 mr-2" style="margin-left:10px; width: 100px;">
                            <select class="form-control" id="selectYear">
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                                <!-- Tambahkan pilihan tahun sesuai kebutuhan -->
                            </select>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="margin:20px" ;>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nomor</th>
                                    <th style="text-align: center;">Tanggal</th>
                                    <th style="text-align: center;">No. Order</th>
                                    <th style="text-align: center;">Tanggal Order</th>
                                    <th style="text-align: center;">Jenis Mobil</th>
                                    <th style="text-align: center;">Nopol</th>
                                    <th style="text-align: center;">Tahun</th>
                                    <th style="text-align: center;">Warna</th>
                                    <th style="text-align: center;">Nama Pemilik</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Subtotal</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php if (!empty($jasa)): ?>
                                    <?php foreach ($jasa as $index => $data): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><a href="<?= base_url('material_jasaprev/' . $data['id_jasa']); ?>">
                                                    <?= $data['id_jasa'] ?>
                                                </a></td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['no_ro'] ?></td>
                                            <td><?= $data['tanggal_masuk'] ?></td>
                                            <td><?= $data['jenis_mobil'] ?></td>
                                            <td><?= $data['nopol'] ?></td>
                                            <td><?= $data['tahun'] ?></td>
                                            <td><?= $data['warna'] ?></td>
                                            <td><?= $data['nama_pemilik'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td class="subtotal"><?= $data['total'] ?></td>
                                            <td><?= $data['username'] ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="14">Data tidak ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="11" style="text-align: end;">Total</th>
                                    <th style="text-align: center;" id="total-subtotal"></th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                        </table>
                        <div class="card-body">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-primary">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    // Menghitung total subtotal dari tabel
    document.addEventListener('DOMContentLoaded', function() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(function(element) {
            total += parseFloat(element.innerText) || 0;
        });
        document.getElementById('total-subtotal').innerText = total;
    });
</script>
<!-- Table head options end -->
<?= $this->endSection() ?>