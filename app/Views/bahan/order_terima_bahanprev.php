<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- Horizontal Input start -->
<section id="horizontal-input">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('terima_bahan') ?>" class="breadcrumb-link text-primary fw-bold">List Penerimaan Bahan</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Penerimaan Bahan</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Penerimaan Bahan</h5>
                </header>
                <div class="card-body">
                    <!-- <h5>ID</h5> -->
                    <form action="<?= base_url('terima_bahan/update') ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nomor">No. Penerimaan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-terima" class="form-control" name="no-terima" value="<?= $terima['id_penerimaan'] ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tgl">Tanggal</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="date" id="tgl" class="form-control" name="tgl" value="<?= $terima['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="supplier">Supplier</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="supplier" class="form-control" name="supplier" value="<?= $terima['supplier'] ?>">
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
                                <input type="date" id="jatuh_tempo" class="form-control" name="jatuh_tempo" value="<?= $terima['jatuh_tempo'] ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="1"><?= $terima['keterangan'] ?></textarea>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="gudang">Gudang</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="gudang" name="gudang">
                                        <option selected><?= $terima['gudang'] ?></option>
                                        <!-- Tambahkan pilihan lain jika ada -->
                                    </select>
                                </fieldset>
                            </div>
                        </div>

                        <h5>Data PO</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nomor">No.PO</label>
                            </div>
                            <div class="col-lg-9 col-7 mb-3">
                                <input type="text" id="nomor" class="form-control" name="nomor" value="<?= $terima['nomor'] ?>">
                            </div>
                            <div class="col-lg-1 col-2 mb-3">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#no-ken">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="kota">Kota</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="kota" class="form-control" name="kota" value="<?= $terima['kota'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $terima['alamat'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="pembayaran">Metode Pembayaran</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="pembayaran" name="pembayaran">
                                        <option value="TRANSFER" <?= ($terima['pembayaran'] == 'REK BCA') ? 'selected' : ''; ?>>TRANSFER</option>
                                        <option value="KREDIT" <?= ($terima['pembayaran'] == 'KREDIT') ? 'selected' : ''; ?>>KREDIT</option>
                                        <option value="CASH" <?= ($terima['pembayaran'] == 'KAS KECIL') ? 'selected' : ''; ?>>CASH</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="ppn">PPN</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="ppn" name="ppn">
                                        <option value="PPN" <?= ($terima['ppn'] == '11') ? 'selected' : ''; ?>>PPN</option>
                                        <option value="Non PPN" <?= ($terima['ppn'] == '0') ? 'selected' : ''; ?>>Non PPN</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="term">Term (days)</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="term" class="form-control" name="term" value="<?= $terima['term'] ?>">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-10 col-9 mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                                <!-- Tombol Batal -->
                                <a href="<?= base_url('terima_bahan'); ?>" class="btn btn-danger btn-sm">Batal</a>
                                <a href="<?= base_url('order_terima_bahan'); ?>" class="btn btn-success btn-sm">Input Baru</a>
                            </div>
                        </div>
                    </form>
                    <!-- <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse" data-bs-target="#collapseDetailTerima" id="toggledetailterimaButton">
                        <i class="fas fa-plus"></i> Tambah
                    </button> -->
                    <!-- <form action="<?= base_url('bahan/createDetailTambah') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="collapse mt-3" id="collapseDetailTerima">
                            <div class="card card-body">
                                <input type="hidden" name="id_penerimaan" value="<?= $terima['id_penerimaan'] ?>">
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
                    </form> -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped -table-hover mb-0" style="font-size: 14px;">
                            <thead class="thead-dark table-secondary">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Disc</th>
                                    <th>Jumlah</th>
                                    <th>No PO</th>
                                    <th>PO id</th>
                                    <th>Pilih</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody id="detail-barang-body" style="text-align: center;">
                                <?php if (!empty($detail_terima)) : ?>
                                    <?php foreach ($detail_terima as $index => $detail) : ?>
                                        <tr>
                                            <td class="text-start"><?= $detail['id_kode_barang'] ?></td>
                                            <td class="text-start"><?= $detail['nama_barang'] ?></td>
                                            <td class="text-start"><?= $detail['kategori'] ?></td>
                                            <td class="text-end"><?= $detail['qty'] ?></td>
                                            <td class="text-start"><?= $detail['satuan'] ?></td>
                                            <td class="text-end"><?= number_format($detail['harga'], 2, ',', '.'); ?></td>
                                            <td class="text-end"><?= number_format($detail['disc'], 2, ',', '.'); ?></td>
                                            <td class="text-end"><?= number_format($detail['jumlah'], 2, ',', '.'); ?></td>
                                            <td class="text-start"><?= $detail['no_po'] ?></td>
                                            <td class="text-center"><?= $index + 1 ?></td>
                                            <td class="text-center"><input type="checkbox" class="form-check-input pilih-checkbox" name="ceklis[]" value="<?= $detail['ceklis']; ?>" <?= $detail['ceklis'] == 1 ? 'checked' : ''; ?> disabled></td>
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11">Tidak ada data barang</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-end" colspan="2">Total Qty</td>
                                    <td style="text-align: end;"><?= $terima['total_qty'] ?></td>
                                    <td class="text-end" colspan="3">Total Jumlah</td>
                                    <td style="text-align: end;"> <?= number_format($terima['total_jumlah'], 2, ',', '.'); ?></td>
                                    <td colspan="5"></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="6">Disc Total</td>
                                    <td style="text-align: end;"> <?= number_format($terima['disc_total'], 2, ',', '.'); ?></td>
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
<div class="modal fade" id="supp" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Cari Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="search-supplier" class="form-label">Cari</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" id="search-supplier" class="form-control" name="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
                            </tr>
                        </thead>
                        <tbody id="supplier-list">
                            <?php if (!empty($supplier)) : ?>
                                <?php foreach ($supplier as $a) : ?>
                                    <tr class="clickable-row" data-kode="<?= $a->kode ?>" data-nama="<?= $a->nama ?>">
                                        <td><?= $a->kode ?></td>
                                        <td><?= $a->nama ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2">Data supplier tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- modal nopol -->
<!-- <div class="modal fade text-left" id="no-ken" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                <th>Tanggal</th>
                                <th>kode suplier</th>
                                <th>Nama</th>
                                <th>Nopol</th>
                                <th>Jumlah PO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
</div> -->
<!-- End -->


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
                            <?php if (!empty($bahan)) : ?>
                                <?php foreach ($bahan as $b) : ?>
                                    <tr data-kode="<?= $b->kode_bahan ?>" data-nama="<?= $b->nama_bahan ?>" data-harga="<?= $b->satuan ?>">
                                        <td><?= $b->kode_bahan ?></td>
                                        <td><?= $b->nama_bahan ?></td>
                                        <td><?= $b->satuan ?></td>
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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