<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<section class="section">
    <div class="">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 ms-3 mb-3">MASTER BAHAN</h4>
                <div class="card">
                    <div class="card-header d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                            Entry Data
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="exportToExcel()">Export to Excel</button>
                        <h6 class="mb-0 ms-auto">List Data Bahan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-section active" id="tableLeft">
                                <div class="table-responsive" style="margin: 20px; font-size: 14px;">
                                    <table class="table table-bordered mb-0" id="bahanTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td>No</td>
                                                <th>Aksi</th>
                                                <th>Kode</th>
                                                <th>Nama Bahan</th>
                                                <th>Kode Group</th>
                                                <th>Kode Kategori</th>
                                                <th>Satuan Pakai</th>
                                                <!-- <th>Isi_K</th> -->
                                                <!-- <th>Sat_T</th>
                                                <th>Isi_T</th>
                                                <th>Sat_B</th>
                                                <th>Isi_B</th> -->
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <!-- <th>Harga Jual Baru</th> -->
                                                <th>Stok Min</th>
                                                <!-- <th>Stok Max</th> -->
                                                <th>User Input</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <!-- Isi tabel barang di sini -->
                                            <?php foreach ($bahan as $index => $item) : ?>
                                                <tr>
                                                    <td style="display: none;"><?= $item['id_bahan'] ?></td>
                                                    <td><?= $index + 1 ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm"><i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#modalEditData<?= $item['id_bahan'] ?>"></i></button>
                                                        <form action="<?= base_url('deleteBahan/' . $item['id_bahan']) ?>" method="post" class="d-inline">
                                                            <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus bahan ini?');">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td><?= $item['kode_bahan'] ?></td>
                                                    <td><?= $item['nama_bahan'] ?></td>
                                                    <td><?= $item['kode_group'] ?></td>
                                                    <td><?= $item['kode_kategori'] ?></td>
                                                    <td><?= $item['sat_k'] ?></td>
                                                    <!-- <td><?= $item['isi_k'] ?></td> -->
                                                    <!-- <td><?= $item['sat_t'] ?></td>
                                                    <td><?= $item['isi_t'] ?></td>
                                                    <td><?= $item['sat_b'] ?></td>
                                                    <td><?= $item['isi_b'] ?></td> -->
                                                    <td><?= number_format($item['harga_beli'], 0, ',', '.') ?></td>
                                                    <td><?= $item['harga_jualawal'] ?></td>
                                                    <!-- <td><?= $item['harga_jualbaru'] ?></td> -->
                                                    <td><?= $item['stok_minimal'] ?></td>
                                                    <!-- <td><?= $item['stok_maksimal'] ?></td> -->
                                                    <td><?= $item['user_id'] ?></td>
                                                    <td><?= $item['tanggal'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
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
                                <select class="form-select" id="kode_group" name="kode_group">
                                    <?php foreach ($groups as $group) : ?>
                                        <option value="<?= $group['kodegroup'] ?>"><?= $group['kodegroup'] ?> - <?= $group['namagroup'] ?></option>
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
                                    <label for="sat_k" class="form-label">Satuan Pakai</label>
                                    <input type="text" class="form-control" id="sat_k" name="sat_k">
                                </div>
                                <!-- <div class="col-md-6">
                                    <label for="isi_k" class="form-label">Isi</label>
                                    <input type="text" class="form-control" id="isi_k" name="isi_k">
                                </div> -->
                            </div>
                            <!-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sat_t" class="form-label">Satuan Tengah</label>
                                    <input type="text" class="form-control" id="sat_t" name="sat_t">
                                </div>
                                <div class="col-md-6">
                                    <label for="isi_t" class="form-label">Isi Tengah</label>
                                    <input type="text" class="form-control" id="isi_t" name="isi_t">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="sat_b" class="form-label">Satuan Besar</label>
                                    <input type="text" class="form-control" id="sat_b" name="sat_b">
                                </div>
                                <div class="col-md-6">
                                    <label for="isi_b" class="form-label">Isi Besar</label>
                                    <input type="text" class="form-control" id="isi_b" name="isi_b">
                                </div>
                            </div> -->

                            <!-- Input tambahan -->
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control" id="harga_beli" name="harga_beli">
                            </div>
                            <div class="mb-3">
                                <label for="harga_jualawal" class="form-label">Harga Jual</label>
                                <input type="text" class="form-control" id="harga_jualawal" name="harga_jualawal">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="harga_jualbaru" class="form-label">Harga Jual Baru</label>
                                <input type="text" class="form-control" id="harga_jualbaru" name="harga_jualbaru">
                            </div> -->
                            <div class="mb-3">
                                <label for="stok_minimal" class="form-label">Stok Minimal</label>
                                <input type="text" class="form-control" id="stok_minimal" name="stok_minimal">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="stok_maksimal" class="form-label">Stok Maksimal</label>
                                <input type="text" class="form-control" id="stok_maksimal" name="stok_maksimal">
                            </div> -->
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
                                    <label for="kode_group<?= $b['id_bahan'] ?>" class="form-label">Kode Group</label>
                                    <select class="form-select" id="kode_group<?= $b['id_bahan'] ?>" name="kode_group">
                                        <?php foreach ($groups as $group) : ?>
                                            <option value="<?= $group['kodegroup'] ?>" <?= $group['kodegroup'] == $b['kode_group'] ? 'selected' : '' ?>>
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
                                        <label for="sat_k<?= $b['id_bahan'] ?>" class="form-label">Satuan Kecil</label>
                                        <input type="text" class="form-control" id="sat_k<?= $b['id_bahan'] ?>" name="sat_k" value="<?= $b['sat_k'] ?>">
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <label for="isi_k<?= $b['id_bahan'] ?>" class="form-label">Isi Kecil</label>
                                        <input type="text" class="form-control" id="isi_k<?= $b['id_bahan'] ?>" name="isi_k" value="<?= $b['isi_k'] ?>">
                                    </div> -->
                                </div>
                                <!-- <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="sat_t<?= $b['id_bahan'] ?>" class="form-label">Satuan Tengah</label>
                                        <input type="text" class="form-control" id="sat_t<?= $b['id_bahan'] ?>" name="sat_t" value="<?= $b['sat_t'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="isi_t<?= $b['id_bahan'] ?>" class="form-label">Isi Tengah</label>
                                        <input type="text" class="form-control" id="isi_t<?= $b['id_bahan'] ?>" name="isi_t" value="<?= $b['isi_t'] ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="sat_b<?= $b['id_bahan'] ?>" class="form-label">Satuan Besar</label>
                                        <input type="text" class="form-control" id="sat_b<?= $b['id_bahan'] ?>" name="sat_b" value="<?= $b['sat_b'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="isi_b<?= $b['id_bahan'] ?>" class="form-label">Isi Besar</label>
                                        <input type="text" class="form-control" id="isi_b<?= $b['id_bahan'] ?>" name="isi_b" value="<?= $b['isi_b'] ?>">
                                    </div>
                                </div> -->

                                <!-- Input tambahan -->
                                <div class="mb-3">
                                    <label for="harga_beli<?= $b['id_bahan'] ?>" class="form-label">Harga Beli</label>
                                    <input type="text" class="form-control" id="harga_beli<?= $b['id_bahan'] ?>" name="harga_beli" value="<?= $b['harga_beli'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jualawal<?= $b['id_bahan'] ?>" class="form-label">Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jualawal<?= $b['id_bahan'] ?>" name="harga_jualawal" value="<?= $b['harga_jualawal'] ?>">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="harga_jualbaru<?= $b['id_bahan'] ?>" class="form-label">Harga Jual Baru</label>
                                    <input type="text" class="form-control" id="harga_jualbaru<?= $b['id_bahan'] ?>" name="harga_jualbaru" value="<?= $b['harga_jualbaru'] ?>">
                                </div> -->
                                <div class="mb-3">
                                    <label for="stok_minimal<?= $b['id_bahan'] ?>" class="form-label">Stok Minimal</label>
                                    <input type="text" class="form-control" id="stok_minimal<?= $b['id_bahan'] ?>" name="stok_minimal" value="<?= $b['stok_minimal'] ?>">
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="stok_maksimal<?= $b['id_bahan'] ?>" class="form-label">Stok Maksimal</label>
                                    <input type="text" class="form-control" id="stok_maksimal<?= $b['id_bahan'] ?>" name="stok_maksimal" value="<?= $b['stok_maksimal'] ?>">
                                </div> -->
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