<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<!-- Table Repair Selesai -->
<section id="horizontal-input">
    <div style=" margin-top: 15px; margin-bottom: 10px; font-size: 12px; padding: 10px 20px; border-radius: 8px; display: inline-block;">
        <div style="font-size: 14px; font-weight: bold;">
            <a href="<?= base_url('/index') ?>" style="text-decoration: none; color: #007bff;">Dashboard</a>
            <span style="color: #6c757d; margin: 0 8px;">/</span>
            <span style="color: #6c757d; font-weight: 500;">Repair Selesai</span>
        </div>
    </div>
    <div class="col-12">
        <div class="row" id="table-head">
            <div class="card">
                <header class="mb-3 mt-4" style="border-bottom: 2px solid #6c757d; padding-bottom: 10px;">
                    <h5 class="ms-3">Repair Selesai</h5>
                </header>
                <div class="card-header d-flex align-items-center " style="padding: 20px;">
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-secondary btn-sm" style="width: 80px;">Export</a>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <form action="/preorder/filter" method="get" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari Preorder" style="width: 130px;">
                            <input type="date" name="date" class="form-control form-control-sm flatpickr-range me-2" placeholder="Select date.." style="width: 130px;">
                            <select name="month" class="form-control form-control-sm me-2" id="selectMonth" style="width: 100px;">
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
                            <select name="year" class="form-control form-control-sm" id="selectYear" style="width: 100px;">
                                <!-- Tahun akan diisi otomatis -->
                            </select>
                        </form>
                        <div class="form-group mt-3 ms-2" style="width: 100px;">
                            <select class="form-control form-control-sm" id="pengerjaan">
                                <option>--selec--</option>
                                <option>Tanggal Klaim</option>
                                <option>Tanggal Masuk</option>
                                <option>Nomor</option>
                                <option>Asuransi</option>
                                <option>Merk Mobil</option>
                            </select>
                        </div>
                        <div class="form-group mt-3 ms-2" style="width: 150px;">
                            <select class="form-control form-control-sm" id="progres">
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
                </div>
                <!-- table head dark -->
                <div class="table-responsive" style="text-align: center; margin: 20px; font-size: 12px;">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>No Klaim</th>
                                <th>Tgl. Klaim</th>
                                <th>Tgl. Acc</th>
                                <th>Tgl. Masuk</th>
                                <th>Progres Pengerjaan</th>
                                <th>Status Bayar</th>
                                <th>Est. Keluar</th>
                                <th>Nopol</th>
                                <th>Jenis Mobil</th>
                                <th>Asuransi</th>
                                <th>Customer</th>
                                <th>Harga Estimasi</th>
                                <th>Harga Acc</th>
                                <th>Tgl. Keluar</th>
                                <th>User ID</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td colspan="17">Data not available</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Repair Order end -->

<?= $this->endSection() ?>