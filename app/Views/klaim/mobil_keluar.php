<!-- File: app/Views/klaim/preorder.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Mobil Keluar</h3>


<!-- Table Repair Order -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <div class="buttons d-flex align-items-center">
                            <a href="<?= base_url('order_repair') ?>" class="btn btn-primary mt-3 mr-2" style="width: 100px;">Add</a>
                            <a href="#" class="btn btn-secondary mt-3 mr-2" style="width: 90px; margin-right:50px;">Export</a>
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="Cari Preorder" style="margin-right:15px; width: 150px;">
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="SA" style="width: 150px;">
                            <a href="#" class="btn btn-info btn-sm mt-3 mr-2" style="width: 90px; margin-left:10px;">Show</a>
                            <input type="date" class="form-control flatpickr-range mt-2" placeholder="Select date.." style="margin-left:10px; width: 150px;">
                        </div>
                        <h6 class="mt-2" style="margin-left:10px;">Sort by</h6>
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
                        <div class="form-group mt-3 mr-2" style="margin-left:10px; width: 70px;">
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
                        <div class="form-group mt-3 mr-2" style="margin-left:10px; width: 100px;">
                            <select class="form-control" id="pengerjaan">
                                <option>--selec--</option>
                                <option>Tanggal Klaim</option>
                                <option>Tanggal Masuk</option>
                                <option>Nomor</option>
                                <option>Asuransi</option>
                                <option>Merk Mobil</option>
                            </select>
                        </div>
                        <div class="form-group mt-3 mr-2" style="margin-left:10px; width: 150px;">
                            <select class="form-control" id="progres">
                                <option>--All Progres--</option>
                                <option>Ketok</option>
                                <option>Dempul</option>
                                <option>Epoxy</option>
                                <option>Cat</option>
                                <option>Poles</option>
                                <option>Beres Pengerjaan</option>
                                <option>Menunggu Sparepart Tambahan</option>
                                <option>Menunggu Comment User</option>
                                <option>Data Complete</option>
                            </select>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="text-align: center;" style="margin: 20px;">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>No Klaim</th>
                                    <th>Tanggal klaim</th>
                                    <th>Tanggal Acc</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Progres Pengerjaan</th>
                                    <th>Status Bayar</th>
                                    <th>Est. Keluar</th>
                                    <th>No. Polisi</th>
                                    <th>Jenis Mobil</th>
                                    <th>Asuransi</th>
                                    <th>Nama Pemilik</th>
                                    <th>Harga Estimasi</th>
                                    <th>Harga Acc</th>
                                    <th>Tanggal Keluar</th>
                                    <th>User ID</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td></td>
                                    <td><a href="<?= base_url('order_repair') ?>">T202411010001</a></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <!-- button hapus -->
                                        <button type="button" class="btn btn-danger btn-sm delete-user-btn"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
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
<!-- Table Repair Order end -->

<?= $this->endSection() ?>