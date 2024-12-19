<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>Repair Material Supply</h3>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tambahkan form action -->
                    <form action="<?= base_url('sparepart/updaterepair') ?>" method="post">
                        <h6>ID</h6>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_material">Nomor (auto)</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_material" name="id_material" class="form-control form-control-sm" value="<?= $repair['id_material'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control form-control-sm" name="tanggal" value="<?= $repair['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_keluar">Gudang Keluar</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option selected><?= $repair['gudang_keluar'] ?></option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG REPAIR(MOBIL SUDAH ADA)</option>
                                        <option>GUDANG SUPPLY DARI ASURANSI</option>
                                        <option>GUDANG WAITING(MOBIL BELUM DATANG)</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang_masuk">Gudang Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="gudang_masuk" name="gudang_masuk" class="form-control form-control-sm" value="<?= $repair['gudang_masuk'] ?>">
                            </div>
                        </div>

                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_repair">No. Repair Order</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_repair" class="form-control form-control-sm" name="no_repair" value="<?= $repair['no_repair'] ?>">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#repair">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal_masuk">Tanggal Masuk</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal_masuk" class="form-control form-control-sm" name="tanggal_masuk" value="<?= $repair['tanggal_masuk'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control form-control-sm" name="nopol" value="<?= $repair['nopol'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis_mobil">Jenis mobil</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="jenis_mobil" class="form-control form-control-sm" name="jenis_mobil" value="<?= $repair['jenis_mobil'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="warna" class="form-control form-control-sm" name="warna" value="<?= $repair['warna'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun">Tahun</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun" class="form-control form-control-sm" name="tahun" value="<?= $repair['tahun'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nama_pemilik">Pemilik</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="nama_pemilik" class="form-control form-control-sm" name="nama_pemilik" value="<?= $repair['nama_pemilik'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="keterangan" class="form-control form-control-sm" name="keterangan" value="<?= $repair['keterangan'] ?>">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mt-3">
                            <div class="col-lg-10 col-9">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                <a href="<?= base_url('repair_material_part'); ?>" class="btn btn-danger btn-sm">Batal</a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2 my-table-class">
                            <thead>
                                <tr>
                                    <th>Kode barang</th>
                                    <th>Nama barang</th>
                                    <th>Qty</th>
                                    <th>Sat</th>
                                    <th>HPP</th>
                                    <th>Nilai</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="repair_material_detail">
                                <?php if (!empty($detail_repair)) : ?>
                                    <?php foreach ($detail_repair as $item): ?>
                                        <tr>
                                            <td><?= $item['id_kode_barang'] ?></td>
                                            <td><?= $item['nama_barang'] ?></td>
                                            <td><?= $item['qty_B'] ?></td>
                                            <td><?= $item['sat_B'] ?></td>
                                            <td><?= number_format($item['hpp'], 0, ',', '.'); ?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>

                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center">Data Tidak Ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td><?= $total_qty_B ?></td>
                                    <td></td>
                                    <td><?= number_format($total_hpp, 0, ',', '.'); ?></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Akhir dari form action -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->

<!-- modal asuransi -->
<div class="modal fade text-left" id="supply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-input">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-input" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
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
                    <button type="button" class="btn" data-dismiss="modal">
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

<!-- modal RP -->
<div class="modal fade text-left" id="repair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-input">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-input" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No.Order</th>
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
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl').value = todayString;
        document.getElementById('tgl-masuk').value = todayString;
    });
</script>




<?= $this->endSection() ?>