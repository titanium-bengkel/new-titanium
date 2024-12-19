app/Views/klaim/bayar_piutang.php app/Views/klaim/invoice_or.php app/Views/klaim/kwitansi_piutang.php app/Views/klaim/kwitansi.php app/Views/klaim/order_pos_as.php app/Views/klaim/order_pos.php app/Views/klaim/order_postV2.php app/Views/klaim/orderlist_asuransi.php app/Views/klaim/orderlist_pending.php app/Views/klaim/preorder.php app/Views/klaim/repair_order.php<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>Repair Order</h3>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Kendaraan</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="pre-order-id">Pre-Order ID</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="pre-order-id" class="form-control" name="pre-order-id" disabled>
                        </div>
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
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#merk-mobil">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna">Warna</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="warna" class="form-control" name="warna">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#jenis-warna">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-polis">No Polis</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-polis" class="form-control" name="no-polis">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-rangka">No Rangka</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-rangka" class="form-control" name="no-rangka">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tahun-kendaraan">Tahun Kendaraan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="tahun-kendaraan" class="form-control" name="tahun-kendaraan">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-contact">No Contact</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-contact" class="form-control" name="no-contact">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Customer</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="customer-name">Customer Name</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="customer-name" class="form-control" name="customer-name">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="alamat">Alamat</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="alamat" class="form-control" name="alamat">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="kota">Kota</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="kota" class="form-control" name="kota">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Asuransi</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="asuransi">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="asuransi" class="form-control" name="asuransi">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal-masuk">Tanggal Masuk</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal-masuk" class="form-control" name="tanggal-masuk" onkeydown="return false" onclick="this.showPicker()">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tanggal-estimasi">Tanggal Estimasi </label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tanggal-estimasi" class="form-control" name="tanggal-estimasi" onkeydown="return false" onclick="this.showPicker()">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="harga-estimasi">Harga Estimasi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="harga-estimasi" class="form-control" name="harga-estimasi">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="keterangan">Keterangan</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <textarea class="form-control" id="keterangan" rows="1"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Pengerjaan</th>
                                    <th>Pengerjaan</th>
                                    <th>Harga</th>
                                    <th>ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-bold-500">
                                        <!-- button modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPengerjaan">
                                            Pengerjaan
                                        </button>
                                    </td>
                                    <td>0</td>
                                    <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sperpat -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Kode pengerjaan</th>
                                    <!-- <th>Q_PO</th>
                                    <th>Q_Beli</th>
                                    <th>Q_Trpsang</th> -->
                                    <th>ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-bold-500">
                                        <!-- button modal -->
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sparepart">
                                            Sparepart
                                        </button>
                                    </td>
                                    <td>0</td>
                                    <th>0</th>
                                    <th>0</th>
                                    <!-- <th>0</th>
                                    <th>0</th>
                                    <th>0</th> -->
                                    <td><a href="#"><i class="fas fa-trash-alt"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- bukti gambar -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>keterangan</th>
                                    <th>Foto</th>
                                    <th>Deskripsi</th>
                                    <th>ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checklist -->

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Checklist Proses Klaim</h5>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="ketok">
                            <label class="form-check-label" for="ketok">Ketok</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="dempul">
                            <label class="form-check-label" for="dempul">Dempul</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="epoxy">
                            <label class="form-check-label" for="epoxy">Epoxy</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="cat">
                            <label class="form-check-label" for="cat">Cat</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="poles">
                            <label class="form-check-label" for="poles">Poles</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="beres-pengerjaan">
                            <label class="form-check-label" for="batal-mobil-masuk">Beres Pengerjaan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="menunggu-sparepart">
                            <label class="form-check-label" for="batal-mobil-masuk">Menunggu SparePart Tambahan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="comment user">
                            <label class="form-check-label" for="batal-mobil-masuk">Menunggu Comment User</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger">Batal</button>
                        <button type="button" class="btn btn-success" style="margin-left: 20px  ;">Cetak Estimasi</button>
                        <button type="button" class="btn btn-success">Cetak SPK B</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->

<!-- modal pengerjaan -->
<div class="modal fade text-left" id="modalPengerjaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">masukan pengerjaan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Nama jasa</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode biaya</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">ket biaya</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode alokasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">ket alokasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Keterangan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

<!-- modal sparepart -->
<div class="modal fade text-left" id="sparepart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Masukan Sparepart</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Nama jasa</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode biaya</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">ket biaya</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Kode alokasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">ket alokasi</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Keterangan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal" class="form-control" name="fname">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
<!-- end -->


<!-- modal Search no.kendaraan -->
<div class="modal fade text-left" id="no-ken" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel3"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
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
                            <tr>
                                <th>No. Kendaraan</th>
                                <th>Nama Pemilik</th>
                                <th>No. Kontak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

<!-- modal jenis mobil -->
<div class="modal fade text-left" id="merk-mobil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

<!-- modal warna -->
<div class="modal fade text-left" id="jenis-warna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel3"></h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
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
                                <th>Kode</th>
                                <th>Warna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

<?= $this->endSection() ?>