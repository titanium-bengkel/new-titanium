<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '<?= session()->getFlashdata('error') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php endif; ?>
</script>
<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/pembelian') ?>" class="breadcrumb-link text-primary fw-bold">Pembelian Sparepart dan Material</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Prev Pembelian</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Preview Pembelian</h5>
                </header>
                <div class="card-body">
                    <h5>ID</h5>
                    <form action="<?= base_url('keuangan/updatepembelian') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_pembelian">No. Penerimaan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_pembelian" class="form-control" name="id_pembelian" value="<?= $sparepart['no_faktur'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tanggal">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tanggal" class="form-control" name="tanggal" value="<?= $sparepart['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="supplier">Supplier</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="supplier" class="form-control" name="supplier" value="<?= $sparepart['supplier'] ?>">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#supp">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jatuh_tempo">Jatuh Tempo</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" value="<?= $sparepart['jatuh_tempo'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= $sparepart['keterangan'] ?></textarea>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang">Gudang</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="gudang" name="gudang">
                                        <option selected><?= $sparepart['gudang'] ?></option>
                                        <option>GUDANG STOK SPAREPART </option>
                                        <option>GUDANG REPAIR(MOBIL SUDAH ADA)</option>
                                        <option>GUDANG SUPPLY DARI ASURANSI</option>
                                        <option>GUDANG WAITING(MOBIL BELUM DATANG)</option>
                                        <option>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>

                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_preor">No. PO/Nopol</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="no_preor" class="form-control" name="no_preor" value="<?= $sparepart['no_preor'] ?>">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-ken">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $sparepart['alamat'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="pembayaran">Metode Pembayaran</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="pembayaran" name="pembayaran">
                                        <option selected><?= $sparepart['pembayaran'] ?></option>
                                        <option>TRANSFER</option>
                                        <option>KREDIT</option>
                                        <option>CASH</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="ppn">PPN</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="ppn" name="ppn">
                                        <option selected><?= $sparepart['ppn'] ?></option>
                                        <option>PPN</option>
                                        <option>Non PPN</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="term">Term</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="term" class="form-control" name="term" value="<?= $sparepart['term'] ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-10 col-9 mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                                <!-- Tombol Batal -->
                                <a href="<?= base_url('terima_part'); ?>" class="btn btn-danger btn-sm">Batal</a>
                                <a href="<?= base_url('order_pos_terimapart'); ?>" class="btn btn-success btn-sm">Input Baru</a>
                                <button type="button" class="btn btn-success btn-sm">Cetak Permintaan</button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseDetailTerima" id="toggledetailterimaButton">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <form action="<?= base_url('keuangan/createDetailTambah') ?>" method="post">
                        <?= csrf_field() ?>
                        <!-- Form input fields as provided before -->
                        <div class="collapse mt-3" id="collapseDetailTerima">
                            <div class="card card-body">
                                <input type="hidden" name="id_pembelian" value="<?= $sparepart['no_faktur'] ?>">
                                <div class="row mb-1">
                                    <div class="col-lg-2 mb-3">
                                        <label for="kode_barang" class="form-label">Kode Barang</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Kode Barang" id="kode_barang" name="id_kode_barang" data-bs-toggle="modal" data-bs-target="#kodeBarangModal" readonly>
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nama Barang" id="nama_barang" name="nama_barang" readonly>
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="qty" class="form-label">Qty</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Qty" id="qty" name="qty">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Satuan" id="satuan" name="satuan">
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Harga" id="harga" name="harga">
                                    </div>
                                    <div class="col-lg-1 mb-3">
                                        <label for="disc" class="form-label">Disc</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Disc" id="disc" name="disc">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn-sm btn btn-primary">Submit</button>
                                        <button type="reset" class="btn-sm btn btn-danger">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-2 my-table-class">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Disc</th>
                                    <th>Jumlah</th>
                                    <th>No PO</th>
                                    <th>PO id</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="detail-barang-body" style="text-align: center;">
                                <?php if (!empty($detail_terima)) : ?>
                                    <?php foreach ($detail_terima as $detail) : ?>
                                        <tr>
                                            <td><?= $detail['id_kode_barang'] ?></td>
                                            <td><?= $detail['nama_barang'] ?></td>
                                            <td><?= $detail['qty'] ?></td>
                                            <td><?= $detail['satuan'] ?></td>
                                            <td><?= number_format($detail['harga'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($detail['disc'], 0, ',', '.'); ?></td>
                                            <td><?= number_format($detail['jumlah'], 0, ',', '.'); ?></td>
                                            <td><?= $detail['no_po'] ?></td>
                                            <td><?= $detail['po_id'] ?></td>
                                            <td>
                                                <form action="<?= base_url('/keuangan/delete_detailpembelian/' . $detail['id']) ?>" style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="10">Tidak ada data barang</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total Qty</td>
                                    <td style="text-align: center;"><?= $total_qty; ?></td>
                                    <td colspan="3">Total Jumlah</td>
                                    <td style="text-align: center;"> <?= number_format($total_jumlah, 0, ',', '.'); ?></td>
                                    <td colspan="5"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Horizontal Input end -->


<!-- modal supplier -->
<div class="modal fade text-left" id="supp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
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
                                <td>1</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </div>
    </div>
</div>


<!-- modal detail barang -->
<div class="modal fade" id="kodeBarangModal" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Cari Bahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-barang" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-barang" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($barang)) : ?>
                                <?php foreach ($barang as $b) : ?>
                                    <tr data-kode="<?= $b->kode ?>" data-nama="<?= $b->nama ?>" data-harga="<?= $b->hargabeli_B ?>">
                                        <td><?= $b->kode ?></td>
                                        <td><?= $b->nama ?></td>
                                        <td><?= $b->hargabeli_B ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">Data supplier tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if (session()->has('message')): ?>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '<?= session('message') ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>
    });
</script>
<!-- js tgl -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tgl').value = todayString;
    });


    // modal supplier
    document.addEventListener('DOMContentLoaded', function() {
        // Function to filter supplier list based on search input
        document.getElementById('search-supplier').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#supplier-list tr');

            rows.forEach(row => {
                const kode = row.getAttribute('data-kode').toLowerCase();
                const nama = row.getAttribute('data-nama').toLowerCase();

                if (kode.includes(searchValue) || nama.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Function to handle row click and set value to input
        document.querySelectorAll('#supplier-list .clickable-row').forEach(row => {
            row.addEventListener('click', function() {
                const nama = this.getAttribute('data-nama');
                document.getElementById('supplier').value = nama; // Set the name to the input field

                // Close the modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('supp'));
                modal.hide();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('#kodeBarangModal tbody tr');

        tableRows.forEach(row => {
            row.addEventListener('click', function() {
                const kode = this.getAttribute('data-kode');
                const nama = this.getAttribute('data-nama');
                const harga = this.getAttribute('data-harga');

                document.getElementById('kode_barang').value = kode;
                document.getElementById('nama_barang').value = nama;
                document.getElementById('harga').value = harga;

                // Jika perlu, tutup modal setelah memilih barang
                var modal = bootstrap.Modal.getInstance(document.getElementById('kodeBarangModal'));
                modal.hide();
            });
        });
    });
</script>



<?= $this->endSection() ?>