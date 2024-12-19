<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Kelola Banner Home Website</h3>

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
                                    <th style="text-align: center;">Id</th>
                                    <th style="text-align: center;">Konten Video</th>
                                    <th style="text-align: center;">Keterangan</th>
                                    <th style="text-align: center;">Tanggal Update</th>
                                    <th style="text-align: center;">User Update</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>Asldkajsdlkj</td>
                                    <td>Kocak</td>
                                    <td>66-66-6666</td>
                                    <td>ina</td>
                                    <td>Ya</td>
                                    <td>
                                        <!-- button edit -->
                                        <button type="button" class="btn btn-primary btn-sm edit-user-btn"><i class="fas fa-edit"></i></button>
                                        <!-- button hapus -->
                                        <button type="button" class="btn btn-danger btn-sm delete-user-btn"><i class="fas fa-trash-alt"></i></button>
                                    </td>
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