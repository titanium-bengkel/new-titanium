<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>History Edit User</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <div class="buttons d-flex align-items-center">
                            <a href="#" class="btn btn-secondary mt-2 mr-2" style="width: 150px;">Export</a>
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="Cari Preorder" style="margin-right:5px;">
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="SA" style="margin-left:5px;">
                            <input type="date" class="form-control flatpickr-range mt-2" placeholder="Select date.." style="margin-left:10px;">
                        </div>
                        <h6 class="mt-2" style="margin-left:10px;">Sort by</h6>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="margin:20px" ;>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">User</th>
                                    <th style="text-align: center;">Nama Progres</th>
                                    <th style="text-align: center;">Nomor RO/No Jurnal/PO/Pembelian</th>
                                    <th style="text-align: center;">Tanggal Edit</th>
                                    <th style="text-align: center;">Di Edit Oleh</th>
                                    <th style="text-align: center;">Nilai Sebelum Edit</th>
                                    <th style="text-align: center;">Nilai Sesudah Edit</th>
                                    <th style="text-align: center;">Keterangan Sebelum Edit</th>
                                    <th style="text-align: center;">Keterangan Sesudah Edit</th>
                                    <th style="text-align: center;">Analisis</th>
                                </tr>
                            </thead>
                            
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>ina</td>
                                    <td>Edit pengeluaran kas kecil</td>
                                    <td>01.01.07.CJ24000711</td>
                                    <td>2024-07-12 06:15:31</td>
                                    <td>ina</td>
                                    <td>120,500</td>
                                    <td>99,500</td>
                                    <td>RING PLAT, 5 LBR AMPLAS NORTON (GALIH), KARET U/ MOULDING (ALDI)</td>
                                    <td>RING PLAT, 5 LBR AMPLAS NORTON (GALIH), KARET U/ MOULDING (ALDI)</td>
                                    <td>User Mengedit nominal</td>
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
<!-- Table head options end -->
<?= $this->endSection() ?>