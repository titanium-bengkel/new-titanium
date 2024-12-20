<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Laporan Gudang Sparepart</h3>

<!-- Table Pre-order -->
<section class="section">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header d-flex align-items-center justify-content-start flex-wrap" style="padding: 20px;">
                        <div class="d-flex align-items-center ms-md-auto w-100 w-md-auto">
                            <form action="/preorder/filter" method="get" class="d-flex align-items-center flex-wrap w-100">
                                <fieldset class="form-group me-2 mb-2 mb-md-0">
                                    <ul class="nav nav-tabs" id="gudangTab" role="tablist" style="font-size: 0.75rem;"> <!-- Decreased font size -->
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="gudang1-tab" data-bs-toggle="tab" data-bs-target="#gudang1" type="button" role="tab" aria-controls="gudang1" aria-selected="true" style="padding: 5px 10px;">GUDANG STOK SPAREPART</button> <!-- Reduced padding -->
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="gudang3-tab" data-bs-toggle="tab" data-bs-target="#gudang3" type="button" role="tab" aria-controls="gudang3" aria-selected="false" style="padding: 5px 10px;">GUDANG SUPPLY ASURANSI</button> <!-- Reduced padding -->
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="gudang4-tab" data-bs-toggle="tab" data-bs-target="#gudang4" type="button" role="tab" aria-controls="gudang4" aria-selected="false" style="padding: 5px 10px;">GUDANG WAITING</button> <!-- Reduced padding -->
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="gudang5-tab" data-bs-toggle="tab" data-bs-target="#gudang5" type="button" role="tab" aria-controls="gudang5" aria-selected="false" style="padding: 5px 10px;">GUDANG SALVAGE</button> <!-- Reduced padding -->
                                        </li>
                                    </ul>
                                </fieldset>
                        </div>
                        <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0 mt-2" placeholder="Cari Kode/Nama Barang" style="width: 100%; max-width: 200px;">
                        <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2 mb-2 mb-md-0 mt-2" placeholder="Select date.." style="width: 100%; max-width: 130px;">
                        </form>
                    </div>


                    <!-- Tab Content -->
                    <div class="tab-content" id="gudangTabContent" style="margin: 20px;">
                        <!-- stok -->
                        <div class="tab-pane fade show active" id="gudang1" role="tabpanel" aria-labelledby="gudang1-tab">
                            <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Nama Barang</th>
                                            <th style="text-align: center;">Wo</th>
                                            <th style="text-align: center;">Nopol</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Stok Awal</th>
                                            <th style="text-align: center;">Debit(In)</th>
                                            <th style="text-align: center;">Kredit(Out)</th>
                                            <th style="text-align: center;">Stok Akhir</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($stok)) : ?>
                                            <?php foreach ($stok as $index => $data) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $data['id_kode_barang'] ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['wo'] ?></td>
                                                    <td><?= $data['nopol'] ?></td>
                                                    <td>Rp.<?= number_format($data['harga'], 0, '', '.') ?></td>
                                                    <td><?= $data['stok_awal'] ?></td>
                                                    <td><?= $data['debit'] ?></td>
                                                    <td><?= $data['credit'] ?></td>
                                                    <td><?= $data['stok'] ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#Stok"
                                                            data-kode="<?= $data['id_kode_barang'] ?>"
                                                            data-nama="<?= $data['nama_barang'] ?>"
                                                            data-gudang="<?= $data['gudang'] ?>"
                                                            data-stok="<?= $data['stok'] ?>"
                                                            data-nopol="<?= $data['nopol'] ?>"
                                                            data-harga="<?= $data['harga'] ?>">
                                                            Mutasi
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10">Data tidak tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="5" style="text-align: end;"></th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <!-- Gudang 2 -->
                        <!-- supply -->
                        <div class="tab-pane fade" id="gudang3" role="tabpanel" aria-labelledby="gudang3-tab">
                            <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                                <table class="table table-bordered mb-0">
                                    <!-- Same table structure as Gudang 1 -->
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Nama Barang</th>
                                            <th style="text-align: center;">Nopol</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Stok Awal</th>
                                            <th style="text-align: center;">Debit(In)</th>
                                            <th style="text-align: center;">Kredit(Out)</th>
                                            <th style="text-align: center;">Stok Akhir</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($supply)) : ?>
                                            <?php foreach ($supply as $index => $data) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $data['id_kode_barang'] ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['nopol'] ?></td>
                                                    <td>Rp.<?= number_format($data['harga'], 0, '', '.') ?></td>
                                                    <td><?= $data['stok_awal'] ?></td>
                                                    <td><?= $data['debit'] ?></td>
                                                    <td><?= $data['credit'] ?></td>
                                                    <td><?= $data['stok'] ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#Supply"
                                                            data-kode="<?= $data['id_kode_barang'] ?>"
                                                            data-nama="<?= $data['nama_barang'] ?>"
                                                            data-gudang="<?= $data['gudang'] ?>"
                                                            data-stok="<?= $data['stok'] ?>"
                                                            data-nopol="<?= $data['nopol'] ?>"
                                                            data-harga="<?= $data['harga'] ?>">
                                                            Mutasi
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">Data tidak tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="5" style="text-align: end;"></th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <!-- Gudang 3 -->
                        <!-- waiting -->
                        <div class="tab-pane fade" id="gudang4" role="tabpanel" aria-labelledby="gudang4-tab">
                            <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                                <table class="table table-bordered mb-0">
                                    <!-- Same table structure as Gudang 1 -->
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Nama Barang</th>
                                            <th style="text-align: center;">Nopol</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Stok Awal</th>
                                            <th style="text-align: center;">Debit(In)</th>
                                            <th style="text-align: center;">Kredit(Out)</th>
                                            <th style="text-align: center;">Stok Akhir</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($waiting)) : ?>
                                            <?php foreach ($waiting as $index => $data) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $data['id_kode_barang'] ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['nopol'] ?></td>
                                                    <td>Rp.<?= number_format($data['harga'], 0, '', '.') ?></td>
                                                    <td><?= $data['stok_awal'] ?></td>
                                                    <td><?= $data['debit'] ?></td>
                                                    <td><?= $data['credit'] ?></td>
                                                    <td><?= $data['stok'] ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#Waiting"
                                                            data-kode="<?= $data['id_kode_barang'] ?>"
                                                            data-nama="<?= $data['nama_barang'] ?>"
                                                            data-gudang="<?= $data['gudang'] ?>"
                                                            data-stok="<?= $data['stok'] ?>"
                                                            data-nopol="<?= $data['nopol'] ?>"
                                                            data-harga="<?= $data['harga'] ?>">
                                                            Mutasi
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">Data tidak tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="5" style="text-align: end;"></th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <!-- Gudang 4 -->
                        <!-- salvage -->
                        <div class="tab-pane fade" id="gudang5" role="tabpanel" aria-labelledby="gudang5-tab">
                            <div class="table-responsive text-center" style="font-size: 12px; margin: 20px;">
                                <table class="table table-bordered mb-0">
                                    <!-- Same table structure as Gudang 1 -->
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode Barang</th>
                                            <th style="text-align: center;">Nama Barang</th>
                                            <th style="text-align: center;">Nopol</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Stok Awal</th>
                                            <th style="text-align: center;">Debit(In)</th>
                                            <th style="text-align: center;">Kredit(Out)</th>
                                            <th style="text-align: center;">Stok Akhir</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (!empty($salvage)) : ?>
                                            <?php foreach ($salvage as $index => $data) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $data['id_kode_barang'] ?></td>
                                                    <td><?= $data['nama_barang'] ?></td>
                                                    <td><?= $data['nopol'] ?></td>
                                                    <td>Rp.<?= number_format($data['harga'], 0, '', '.') ?></td>
                                                    <td><?= $data['stok_awal'] ?></td>
                                                    <td><?= $data['debit'] ?></td>
                                                    <td><?= $data['credit'] ?></td>
                                                    <td><?= $data['stok'] ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#Salvage"
                                                            data-kode="<?= $data['id_kode_barang'] ?>"
                                                            data-nama="<?= $data['nama_barang'] ?>"
                                                            data-gudang="<?= $data['gudang'] ?>"
                                                            data-stok="<?= $data['stok'] ?>"
                                                            data-nopol="<?= $data['nopol'] ?>"
                                                            data-harga="<?= $data['harga'] ?>">
                                                            Mutasi
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">Data tidak tersedia</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="5" style="text-align: end;"></th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th>0</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

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


<!-- modal Stok -->
<div class="modal fade" id="Stok" tabindex="-1" aria-labelledby="StokLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="StokLabel">Mutasi Barang Ke Gudang Lain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sparepart/mutasiKeGudang') ?>" method="post">
                <div class="modal-body">
                    <!-- Table inside the modal -->

                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Kode Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="id_kode_barang" name="id_kode_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nopol</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nopol" name="nopol" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Qty</strong></td>
                                <td>
                                    <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                    <div class="form-text">Qty yang akan dimutasi jangan lebih dari saldo akhir, agar data barang tidak minus.</div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dari Gudang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="gudang" name="gudang" value="STOK" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pindah ke Gudang</strong></td>
                                <td>
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Supply -->
<div class="modal fade" id="Supply" tabindex="-1" aria-labelledby="SupplyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SupplyLabel">Mutasi Barang Ke Gudang Lain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sparepart/mutasigudangSupplyKeGudang') ?>" method="post">
                <div class="modal-body">
                    <!-- Table inside the modal -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Kode Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="id_kode_barang" name="id_kode_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nopol</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nopol" name="nopol" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Qty</strong></td>
                                <td>
                                    <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                    <div class="form-text">Qty yang akan dimutasi jangan lebih dari saldo akhir, agar data barang tidak minus.</div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dari Gudang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="gudang" name="gudang" value="STOK" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pindah ke Gudang</strong></td>
                                <td>
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal Waiting -->
<div class="modal fade" id="Waiting" tabindex="-1" aria-labelledby="WaitingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="WaitingLabel">Mutasi Barang Ke Gudang Lain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sparepart/mutasigudangWaitingKeGudang?gudang4=true') ?>" method="post">
                <div class="modal-body">
                    <!-- Table inside the modal -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Kode Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="id_kode_barang" name="id_kode_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nopol</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nopol" name="nopol" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Qty</strong></td>
                                <td>
                                    <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                    <div class="form-text">Qty yang akan dimutasi jangan lebih dari saldo akhir, agar data barang tidak minus.</div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dari Gudang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="gudang" name="gudang" value="STOK" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pindah ke Gudang</strong></td>
                                <td>
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal Salvage -->
<div class="modal fade" id="Salvage" tabindex="-1" aria-labelledby="SalvageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SalvageLabel">Mutasi Barang Ke Gudang Lain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('sparepart/mutasigudangSalvageKeGudang') ?>" method="post">
                <div class="modal-body">
                    <!-- Table inside the modal -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Kode Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="id_kode_barang" name="id_kode_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Barang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nopol</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="nopol" name="nopol" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Qty</strong></td>
                                <td>
                                    <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                    <div class="form-text">Qty yang akan dimutasi jangan lebih dari saldo akhir, agar data barang tidak minus.</div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dari Gudang</strong></td>
                                <td>
                                    <input type="text" class="form-control" id="gudang" name="gudang" value="STOK" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pindah ke Gudang</strong></td>
                                <td>
                                    <select class="form-select form-select-sm" id="gudang_keluar" name="gudang_keluar">
                                        <option>--Pilih--</option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG SUPPLY ASURANSI</option>
                                        <option>GUDANG WAITING</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<script>
    // Menggunakan event listener untuk menangkap event show.bs.modal
    const stokModal = document.getElementById('Stok');
    stokModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik

        // Ambil data dari button yang diklik
        const kodeBarang = button.getAttribute('data-kode');
        const namaBarang = button.getAttribute('data-nama');
        const gudang = button.getAttribute('data-gudang');
        const stok = button.getAttribute('data-stok');
        const harga = button.getAttribute('data-harga');
        const nopol = button.getAttribute('data-nopol');

        // Isi input di modal dengan data yang didapat
        const modalKodeBarang = stokModal.querySelector('#id_kode_barang');
        const modalNamaBarang = stokModal.querySelector('#nama_barang');
        const modalGudang = stokModal.querySelector('#gudang');
        const modalHarga = stokModal.querySelector('#harga');
        const modalNopol = stokModal.querySelector('#nopol');

        modalKodeBarang.value = kodeBarang;
        modalNamaBarang.value = namaBarang;
        modalGudang.value = gudang; // Mengisi nilai gudang
        modalHarga.value = harga;
        modalNopol.value = nopol;
    });
</script>


<script>
    // Menggunakan event listener untuk menangkap event show.bs.modal
    const supplyModal = document.getElementById('Supply');
    supplyModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik

        // Ambil data dari button yang diklik
        const kodeBarang = button.getAttribute('data-kode');
        const namaBarang = button.getAttribute('data-nama');
        const gudang = button.getAttribute('data-gudang');
        const stok = button.getAttribute('data-stok');
        const harga = button.getAttribute('data-harga');
        const nopol = button.getAttribute('data-nopol');

        // Isi input di modal dengan data yang didapat
        const modalKodeBarang = supplyModal.querySelector('#id_kode_barang');
        const modalNamaBarang = supplyModal.querySelector('#nama_barang');
        const modalGudang = supplyModal.querySelector('#gudang');
        const modalHarga = supplyModal.querySelector('#harga');
        const modalNopol = supplyModal.querySelector('#nopol');

        modalKodeBarang.value = kodeBarang;
        modalNamaBarang.value = namaBarang;
        modalGudang.value = gudang; // Nilai untuk dari gudang dapat disesuaikan
        modalHarga.value = harga;
        modalNopol.value = nopol;
    });
</script>

<script>
    // Menggunakan event listener untuk menangkap event show.bs.modal
    const waitingModal = document.getElementById('Waiting');
    waitingModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik

        // Ambil data dari button yang diklik
        const kodeBarang = button.getAttribute('data-kode');
        const namaBarang = button.getAttribute('data-nama');
        const gudang = button.getAttribute('data-gudang');
        const stok = button.getAttribute('data-stok');
        const harga = button.getAttribute('data-harga');
        const nopol = button.getAttribute('data-nopol');

        // Isi input di modal dengan data yang didapat
        const modalKodeBarang = waitingModal.querySelector('#id_kode_barang');
        const modalNamaBarang = waitingModal.querySelector('#nama_barang');
        const modalGudang = waitingModal.querySelector('#gudang');
        const modalHarga = waitingModal.querySelector('#harga');
        const modalNopol = waitingModal.querySelector('#nopol');

        modalKodeBarang.value = kodeBarang;
        modalNamaBarang.value = namaBarang;
        modalGudang.value = gudang; // Nilai untuk dari gudang dapat disesuaikan
        modalHarga.value = harga;
        modalNopol.value = nopol;
    });
</script>

<script>
    // Menggunakan event listener untuk menangkap event show.bs.modal
    const salvageModal = document.getElementById('Salvage');
    salvageModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Tombol yang diklik

        // Ambil data dari button yang diklik
        const kodeBarang = button.getAttribute('data-kode');
        const namaBarang = button.getAttribute('data-nama');
        const gudang = button.getAttribute('data-gudang');
        const stok = button.getAttribute('data-stok');
        const harga = button.getAttribute('data-harga');
        const nopol = button.getAttribute('data-nopol');

        // Isi input di modal dengan data yang didapat
        const modalKodeBarang = salvageModal.querySelector('#id_kode_barang');
        const modalNamaBarang = salvageModal.querySelector('#nama_barang');
        const modalGudang = salvageModal.querySelector('#gudang');
        const modalHarga = salvageModal.querySelector('#harga');
        const modalNopol = salvageModal.querySelector('#nopol');

        modalKodeBarang.value = kodeBarang;
        modalNamaBarang.value = namaBarang;
        modalGudang.value = gudang; // Nilai untuk dari gudang dapat disesuaikan
        modalHarga.value = harga;
        modalNopol.value = nopol;
    });
</script>

<!-- Table head options end -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        const now = new Date();
        const currentMonth = now.getMonth() + 1; // Months are 0-based in JavaScript
        const currentYear = now.getFullYear();

        // Set the current month in the select
        const monthSelect = document.getElementById('selectMonth');
        monthSelect.value = currentMonth;

        // Set the current year and populate the year select
        const yearSelect = document.getElementById('selectYear');
        for (let year = 2020; year <= 2030; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.text = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }
    });
</script>
<?= $this->endSection() ?>