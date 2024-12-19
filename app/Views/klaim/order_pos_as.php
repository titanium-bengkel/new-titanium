<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>Asuransi</h3>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>ID</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-acc">No. Acc</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-acc" class="form-control" name="no-acc" disabled>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tgl-acc">Tanggal Acc</label>
                        </div>
                        <div class="col-lg-10 col-7 mb-3">
                            <input type="date" id="tgl-acc" class="form-control" name="tgl-acc" onkeydown="return false" onclick="this.showPicker()">
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
                            <label class="col-form-label" for="no-kendaraan">No. Kendaraan</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="no-kendaraan" class="form-control" name="no-kendaraan">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-ken">
                                <i class="fas fa-search"></i>
                            </button>
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
                    <h5>Asuransi</h5>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="tgl-masuk">Tanggal Masuk</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="date" id="tgl-masuk" class="form-control" name="tgl-masuk" onkeydown="return false" onclick="this.showPicker()">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="tgl-estimasi">Tanggal Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="date" id="tgl-estimasi" class="form-control" name="tgl-estimasi" onkeydown="return false" onclick="this.showPicker()">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="jasa">Jasa</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="text" id="jasa" class="form-control" name="jasa">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="sparepart">Sparepart</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="text" id="sparepart" class="form-control" name="sparepart">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="nilai-total">Nilai Total</label>
                        </div>
                        <div class="col-lg-10 col-9">
                            <input type="text" id="nilai-total" class="form-control" name="nilai-total">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-3">
                            <label class="col-form-label" for="nilai-or">Nilai OR</label>
                        </div>
                        <div class="col-lg-4 col-9">
                            <input type="text" id="nilai-or" class="form-control" name="nilai-or">
                        </div>
                        <div class="col-lg-1 col-3">
                            <label class="col-form-label" for="qty-or">Qty OR</label>
                        </div>
                        <div class="col-lg-5 col-9">
                            <input type="text" id="qty-or" class="form-control" name="qty-or">
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
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">File SPK</label>
                        </div>
                        <div class="col-lg-10 col-4 mb-3">
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
                        </div>
                    </div>
                    <div class="col-lg-2 col-3"></div>
                    <div class="col-lg-10 col-4">
                        <button type="button" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->

<!-- modal pengerjaan -->
<div class="modal fade text-left" id="no-ken" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width: 60%" ;>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">masukan pengerjaan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-10 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <label for="search-input">Cari</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="search-input" class="form-control" name="search">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Mobil</th>
                                <th>Tanggal</th>
                                <th>Type mobil</th>
                                <th>Nopol</th>
                                <th>Warna</th>
                                <th>Tahun</th>
                                <th>Asuransi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- js tgl -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl-acc').value = todayString;
    });
</script>

<?= $this->endSection() ?>