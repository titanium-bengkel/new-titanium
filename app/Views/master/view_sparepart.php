<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Data Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Data Sparepart</h5>
                </header>
                <div class="card-header d-flex align-items-center gap-3">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                        Entry Data
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</button>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <div class="table-section active" id="tableLeft">
                            <div class="table-responsive" style="margin: 10px; font-size: 12px;">
                                <table class="table table-bordered table-hover table-striped mb-0" id="sparepartTable">
                                    <thead class="thead-dark table-secondary">
                                        <tr>
                                            <td class="text-center">No</td>
                                            <th class="text-center">Kode Sparepart</th>
                                            <th class="text-center">Nama Sparepart</th>
                                            <th class="text-center">Stok</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Harga Beli</th>
                                            <th class="text-center">Harga Jual</th>
                                            <th class="text-center">User ID</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php foreach ($sparepart as $index => $item) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td style="text-align: left;"><?= $item['kode_part'] ?></td>
                                                <td style="text-align: left;"><?= $item['nama_part'] ?></td>
                                                <td><?= $item['stok'] ?></td>
                                                <td><?= $item['satuan'] ?></td>
                                                <td><?= number_format($item['harga_beliawal'], 0, ',', '.') ?></td>
                                                <td><?= number_format($item['harga_jualawal'], 0, ',', '.') ?></td>
                                                <td></td>
                                                <td><?= $item['tanggal'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditSparepart<?= $item['id_part'] ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <!-- Tombol Hapus dengan Icon Trash -->
                                                    <form action="<?= base_url('deletesparepart/' . $item['id_part']) ?>" method="post" class="d-inline">
                                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sparepart ini?');">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" style="text-align: end;">Total</td>
                                            <td style="text-align: center;"><?= $totalPart ?></td>
                                            <td colspan="6"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>



<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('createsparepart') ?>" method="post">
                    <div class="row">
                        <!-- Form input -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kode_part" class="form-label">Kode sparepart </label>
                                <input type="text" class="form-control" id="kode_part" name="kode_part">
                            </div>
                            <div class="mb-3">
                                <label for="nama_part" class="form-label">Nama Sparepart</label>
                                <input type="text" class="form-control" id="nama_part" name="nama_part">
                            </div>
                            <div class="mb-3">
                                <label for="stok_minimal" class="form-label">Stok </label>
                                <input type="text" class="form-control" id="stok_minimal" name="stok_minimal">
                            </div>
                            <!-- Sejajarkan Satuan dan Isi -->
                            <div class="    mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan">
                            </div>

                            <!-- Input tambahan -->
                            <div class="mb-3">
                                <label for="harga_beliawal" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control" id="harga_beliawal" name="harga_beliawal">
                            </div>
                            <div class="mb-3">
                                <label for="harga_jualawal" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control" id="harga_jualawal" name="harga_jualawal">
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($sparepart as $s) : ?>
    <!-- Modal untuk Edit Data Sparepart -->
    <div class="modal fade" id="modalEditSparepart<?= $s['id_part'] ?>" tabindex="-1" aria-labelledby="modalEditSparepartLabel<?= $s['id_part'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSparepartLabel<?= $s['id_part'] ?>">Edit Data Sparepart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('updatesparepart/' . $s['id_part']) ?>" method="post">
                        <div class="row">
                            <!-- Form input yang terisi data -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kode_part<?= $s['id_part'] ?>" class="form-label">Kode Sparepart</label>
                                    <input type="text" class="form-control" id="kode_part<?= $s['id_part'] ?>" name="kode_part" value="<?= $s['kode_part'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_part<?= $s['id_part'] ?>" class="form-label">Nama Sparepart</label>
                                    <input type="text" class="form-control" id="nama_part<?= $s['id_part'] ?>" name="nama_part" value="<?= $s['nama_part'] ?>">
                                </div>



                                <!-- Sejajarkan Satuan dan Isi -->

                                <div class="mb-3">
                                    <label for="stok_minimal<?= $s['id_part'] ?>" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="stok_minimal<?= $s['id_part'] ?>" name="stok_minimal" value="<?= $s['stok'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="satuan<?= $s['id_part'] ?>" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuan<?= $s['id_part'] ?>" name="satuan" value="<?= $s['satuan'] ?>">
                                </div>


                                <!-- Input tambahan -->
                                <div class="mb-3">
                                    <label for="harga_beliawal<?= $s['id_part'] ?>" class="form-label">Harga Beli</label>
                                    <input type="text" class="form-control" id="harga_beliawal<?= $s['id_part'] ?>" name="harga_beliawal" value="<?= $s['harga_beliawal'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jualawal<?= $s['id_part'] ?>" class="form-label">Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jualawal<?= $s['id_part'] ?>" name="harga_jualawal" value="<?= $s['harga_jualawal'] ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal<?= $s['id_part'] ?>" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal<?= $s['id_part'] ?>" name="tanggal" value="<?= $s['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sparepartTable').DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthMenu": [20, 50, 100, -1],
            "ordering": true,
            "language": {
                "lengthMenu": "Show _MENU_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "info": "Showing _START_ to _END_ of _TOTAL_ entries"
            },
            "pagingType": "full_numbers"
        });
    });

    function exportToExcel() {
        const table = document.getElementById('sparepartTable');
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Sparepart Data"
        });
        XLSX.writeFile(workbook, 'Sparepart_Data.xlsx');
    }
</script>
<?= $this->endSection() ?>