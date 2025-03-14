<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    if (sessionStorage.getItem('alertShown')) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'info',
            title: 'PEMBERITAHUAN STOK',
            html: `
                <p>JIKA STOK BERWARNA MERAH SEGERA LAKUKAN PEMBELIAN BAHAN.</p>
                <p>SAMAKAN HARGA JUAL DENGAN HARGA BELI.</p>
            `,
            showConfirmButton: false,
            timer: 5000,
            width: '550px',
            padding: '20px',
        });

        // Tandai bahwa alert telah ditampilkan
        sessionStorage.setItem('alertShown', 'true');
    }
</script>

<section class="section">
    <div class="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <header class="d-flex justify-content-between align-items-center border-bottom" style="border-color: #6c757d; padding: 15px 20px;">
                        <div class="breadcrumb-wrapper" style="font-size: 14px;">
                            <a href="<?= base_url('dashboard/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                            <span class="breadcrumb-divider text-muted mx-3">/</span>
                            <span class="breadcrumb-current text-muted">Master Bahan</span>
                        </div>
                        <h5 class="page-title mb-0 fw-bold">Master Bahan</h5>
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
                                <div class="table-responsive" style="margin: 20px; font-size: 14px;">
                                    <table class="table table-bordered table-striped -table-hover mb-0" id="bahanTable">
                                        <thead class="thead-dark table-secondary">
                                            <tr>
                                                <td>No</td>
                                                <th>Aksi</th>
                                                <th>Kode</th>
                                                <th>Nama Bahan</th>
                                                <!-- <th>Kode Group</th> -->
                                                <th>Nama Group</th>
                                                <!-- <th>Kode Kategori</th> -->
                                                <th>Stok</th>
                                                <th>Satuan Pakai</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Stok Min</th>
                                                <th>User Input</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Isi tabel barang di sini -->
                                            <?php foreach ($bahan as $index => $item) : ?>
                                                <tr>
                                                    <td style="display: none;"><?= $item['id_bahan'] ?></td>
                                                    <td class="text-center"><?= $index + 1 ?></td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm"><i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#modalEditData<?= $item['id_bahan'] ?>"></i></button>
                                                        <form action="<?= base_url('deleteBahan/' . $item['id_bahan']) ?>" method="post" class="d-inline">
                                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus bahan ini?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td class="text-start"><?= $item['kode_bahan'] ?></td>
                                                    <td class="text-start"><?= $item['nama_bahan'] ?></td>
                                                    <!-- <td class="text-start"><?= $item['kode_group'] ?></td> -->
                                                    <td class="text-start"><?= $item['nama_group'] ?></td>
                                                    <!-- <td class="text-start"><?= $item['kode_kategori'] ?></td> -->
                                                    <!-- Kondisi untuk warna pada kolom Stok -->
                                                    <td class="text-end" style="background-color: <?= $item['stok'] <= $item['stok_minimal'] ? '#fa0017' : 'transparent'; ?>;">
                                                        <strong><?= $item['stok'] ?></strong>
                                                    </td>
                                                    <td class="text-start"><?= $item['satuan'] ?></td>
                                                    <td class="text-end"><?= number_format($item['harga_beli'], 2, ',', '.') ?></td>
                                                    <td class="text-end"><?= number_format($item['harga_jual'], 2, ',', '.') ?></td>
                                                    <td class="text-end"><?= $item['stok_minimal'] ?></td>
                                                    <td class="text-start"><?= $item['user_id'] ?></td>
                                                    <td class="text-start"><?= $item['tanggal'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.2/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        // Get the table by ID supplierTable
        const table = document.getElementById('bahanTable');

        // Convert the table into a workbook
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Bahan Data"
        });

        // Export the workbook as an Excel file with the name 'Supplier_Data.xlsx'
        XLSX.writeFile(workbook, 'Bahan_Data.xlsx');
    }
</script>



<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('createbahan') ?>" method="post">
                    <div class="row">
                        <!-- Form input -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kode_bahan" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode_bahan" name="kode_bahan">
                            </div>
                            <div class="mb-3">
                                <label for="nama_bahan" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama_bahan" name="nama_bahan">
                            </div>
                            <div class="mb-3">
                                <label for="kode_group" class="form-label">Kode Group</label>
                                <select class="form-select" id="kode_group" name="kode_group" required>
                                    <?php foreach ($groups as $group): ?>
                                        <option value="<?= $group['kodegroup'] . ' - ' . $group['namagroup'] ?>">
                                            <?= $group['kodegroup'] ?> - <?= $group['namagroup'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kode_kategori" class="form-label">Kode Kategori</label>
                                <select class="form-select" id="kode_kategori" name="kode_kategori">
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value="<?= $kat['kode'] ?>"><?= $kat['kode'] ?> - <?= $kat['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Sejajarkan Satuan dan Isi -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="satuan" class="form-label">Satuan Pakai</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan">
                                </div>
                            </div>


                            <!-- Input tambahan -->
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control" id="harga_beli" name="harga_beli">
                            </div>
                            <div class="mb-3">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                            </div>
                            <div class="mb-3">
                                <label for="stok_minimal" class="form-label">Stok Minimal</label>
                                <input type="text" class="form-control" id="stok_minimal" name="stok_minimal">
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <p>jika bahan memiliki stok input disini, jika tidak biarkan kosong</p>
                                <input type="text" class="form-control" id="stok" name="stok">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
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


<?php foreach ($bahan as $b) : ?>
    <!-- Modal untuk Edit Data Barang -->
    <div class="modal fade" id="modalEditData<?= $b['id_bahan'] ?>" tabindex="-1" aria-labelledby="modalEditDataLabel<?= $b['id_bahan'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditDataLabel<?= $b['id_bahan'] ?>">Edit Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('updatebahan/' . $b['id_bahan']) ?>" method="post">
                        <div class="row">
                            <!-- Form input yang terisi data -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kode_bahan<?= $b['id_bahan'] ?>" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode_bahan<?= $b['id_bahan'] ?>" name="kode_bahan" value="<?= $b['kode_bahan'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama_bahan<?= $b['id_bahan'] ?>" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama_bahan<?= $b['id_bahan'] ?>" name="nama_bahan" value="<?= $b['nama_bahan'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="kode_group" class="form-label">Kode Group</label>
                                    <select class="form-select" id="kode_group" name="kode_group" required>
                                        <?php foreach ($groups as $group): ?>
                                            <option value="<?= $group['kodegroup'] . ' - ' . $group['namagroup'] ?>">
                                                <?= $group['kodegroup'] ?> - <?= $group['namagroup'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kode_kategori<?= $b['id_bahan'] ?>" class="form-label">Kode Kategori</label>
                                    <select class="form-select" id="kode_kategori<?= $b['id_bahan'] ?>" name="kode_kategori">
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['kode'] ?>" <?= $kat['kode'] == $b['kode_kategori'] ? 'selected' : '' ?>>
                                                <?= $kat['kode'] ?> - <?= $kat['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Sejajarkan Satuan dan Isi -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="satuan<?= $b['id_bahan'] ?>" class="form-label">Satuan Kecil</label>
                                        <input type="text" class="form-control" id="satuan<?= $b['id_bahan'] ?>" name="satuan" value="<?= $b['satuan'] ?>">
                                    </div>
                                </div>

                                <!-- Input tambahan -->
                                <div class="mb-3">
                                    <label for="harga_beli<?= $b['id_bahan'] ?>" class="form-label">Harga Beli</label>
                                    <input type="text" class="form-control" id="harga_beli<?= $b['id_bahan'] ?>" name="harga_beli" value="<?= $b['harga_beli'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jual<?= $b['id_bahan'] ?>" class="form-label">Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jual<?= $b['id_bahan'] ?>" name="harga_jual" value="<?= $b['harga_jual'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="stok_minimal<?= $b['id_bahan'] ?>" class="form-label">Stok Minimal</label>
                                    <input type="text" class="form-control" id="stok_minimal<?= $b['id_bahan'] ?>" name="stok_minimal" value="<?= $b['stok_minimal'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <p>jika bahan memiliki stok input disini, jika tidak biarkan kosong</p>
                                    <input type="text" class="form-control" id="stok<?= $b['stok'] ?>" name="stok" value="<?= $b['stok'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal<?= $b['id_bahan'] ?>" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal<?= $b['id_bahan'] ?>" name="tanggal" value="<?= $b['tanggal'] ?>" onkeydown="return false" onclick="this.showPicker()">
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        var year = today.getFullYear();
        var todayString = year + '-' + month + '-' + day;

        document.getElementById('tanggal').value = todayString;
    });
</script>


<?= $this->endSection() ?>