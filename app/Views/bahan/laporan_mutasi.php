<!-- File: app/Views/sparepart/permintaan_part.php -->
<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<h3>Laporan Mutasi Gudang Bahan</h3>

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
                                    <select class="form-select form-select-sm" id="basicSelect">
                                        <option>GUDANG BAHAN</option>
                                    </select>
                                </fieldset>
                                <input type="text" name="search" class="form-control form-control-sm me-2 mb-2 mb-md-0" placeholder="Cari Kode/Nama Barang" style="width: 100%; max-width: 200px;">
                                <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2 mb-2 mb-md-0" placeholder="Select date.." style="width: 100%; max-width: 130px;">
                            </form>
                        </div>
                    </div>
                    <!-- table head dark -->
                    <div class="table-responsive" style="text-align: center; font-size: 12px; margin:20px" ;>
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode barang</th>
                                    <th>Nama barang</th>
                                    <th>Harga</th>
                                    <th>Stok awal</th>
                                    <th>Debet</th>
                                    <th>Credit</th>
                                    <th>Stok</th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($bahan)) : ?>
                                    <?php foreach ($bahan as $index => $data) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $data['kode_bahan'] ?></td>
                                            <td><?= $data['nama_bahan'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td><?= $data['stok_awal'] ?></td>
                                            <td><?= $data['debet'] ?></td>
                                            <td><?= $data['credit'] ?></td>
                                            <td><?= $data['stok'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7">Data tidak tersedia</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->

<?= $this->endSection() ?>