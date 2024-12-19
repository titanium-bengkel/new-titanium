<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Laporan Laba Rugi</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center" style="width: fit-content;">
                        <div class="buttons d-flex align-items-center">
                            <a href="<?= base_url('order_pos') ?>" class="btn btn-primary mt-2 mr-2" style="width: 150px;">Add</a>
                            <a href="#" class="btn btn-secondary mt-2 mr-2" style="width: 150px;">Export</a>
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="Cari Preorder" style="margin-right:5px;">
                            <input type="text" id="helperText" class="form-control mt-2" placeholder="SA" style="margin-left:5px;">
                            <input type="date" class="form-control flatpickr-range mt-2" placeholder="Select date.." style="margin-left:10px;">
                        </div>
                        <h6 class="mt-2" style="margin-left:10px;">Sort by</h6>
                    </div>
                    <!-- table head dark -->
                    <div style="text-align: center; background-color: #007bff; color: white; padding: 20px; margin: 20px;">
                        <h1 style="margin: 0;">TITANIUM CAR REPAIR</h1>
                        <div style="text-align: center; background-color: #fff; color: black; padding: 20px;">
                            <p style="margin: 5px 0;">Laba rugi (Income Statement)</p>
                            <p style="margin: 5px 0;">Account : 20102</p>
                            <p style="margin: 5px 0;">Periode 2024-07-01 s/d 2024-07-15</p>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin:20px" ;>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="text-align: center;">Pendapatan</th>
                                    <th style="text-align: center;">Hasil</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <tr>
                                    <td>300 - Pendapatan</td>
                                    <td>14,516,827</td>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" style="margin:20px" ;>

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