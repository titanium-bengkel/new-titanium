<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<h3>Add Penerimaan Sparepart</h3>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>ID</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="nomor">Nomor (auto)</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-acc" class="form-control" name="no-acc" value="<?= $sparepart['id_penerimaan'] ?>" disabled>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="tgl-acc">Tanggal</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="date" id="tgl" class="form-control" name="tgl" onkeydown="return false" onclick="this.showPicker()" value="<?= $sparepart['tanggal'] ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jasa">Supplier</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="jasa" class="form-control" name="jasa" value="<?= $sparepart['supplier'] ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#supply">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="sparepart">Gudang</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="sparepart" class="form-control" name="sparepart" value="<?= $sparepart['gudang'] ?>">
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>Data</h5>
                    <div class="form-group row align-items-center">
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-kendaraan">No. Repair Order</label>
                        </div>
                        <div class="col-lg-9 col-7 mb-3">
                            <input type="text" id="no-kendaraan" class="form-control" name="no-kendaraan" value="<?= $sparepart['no_repair_order'] ?>">
                        </div>
                        <div class="col-lg-1 col-2 mb-3">
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#repair">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="jenis-mobil">Asuransi</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="jenis-mobil" class="form-control" name="jenis-mobil" value="<?= $sparepart['asuransi'] ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna">Jenis mobil</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="warna" class="form-control" name="warna" value="<?= $sparepart['jenis_mobil'] ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="pemilik">Nama pemilik</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-3">
                            <input type="text" id="pemilik" class="form-control" name="pemilik" value="<?= $sparepart['nama_pemilik'] ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="warna-mobil">Warna</label>
                        </div>
                        <div class="col-lg-4 col-9 mb-3">
                            <input type="text" id="warna-mobil" class="form-control" name="warna-mobil" value="<?= $sparepart['warna'] ?>">
                        </div>
                        <div class="col-lg-2 col-3 mb-3">
                            <label class="col-form-label" for="no-contact">Nopol</label>
                        </div>
                        <div class="col-lg-10 col-9 mb-3">
                            <input type="text" id="no-contact" class="form-control" name="no-contact" value="<?= $sparepart['nopol'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>Kode barang</th>
                                    <th>Nama barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($detail_terima)) : ?>
                                    <?php foreach ($detail_terima as $detail) : ?>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="id_kode_barang[]" value="<?= $detail['id_kode_barang'] ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="nama_barang[]" value="<?= $detail['nama_barang'] ?>" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" name="qty[]" value="<?= $detail['qty'] ?>" min="0" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="satuan[]" value="<?= $detail['satuan'] ?>" required>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="form-check-input pilih-checkbox" name="is_sent[]" value="<?= $detail['is_sent']; ?>" <?= $detail['is_sent'] == 1 ? 'checked disabled' : ''; ?>>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11">Tidak ada data barang.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-10 col-9">
                            <button type="button" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
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




<?= $this->endSection() ?>