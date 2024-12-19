<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>


<section class="section">
    <div class="">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 ms-3 mb-3">MASTER SPAREPART</h4>
                <div class="card">
                    <div class="card-header d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                            Entry Data
                        </button>
                        <h6 class="mb-0 ms-auto">List Data Sparepart</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-section active" id="tableLeft">
                                <!-- Tabel Kiri -->
                                <div class="table-responsive" style="margin: 10px; font-size: 14px;">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td><button class="btn btn-link slide-button" data-target="#tableRight">#</button></td>
                                                <th class="small">Kode Sparepart</th>
                                                <th class="small">Nama Sparepart</th>
                                                <th class="small">Kode Group</th>
                                                <th class="small">Kode Kategori</th>
                                                <th class="small">Satuan</th>
                                                <th class="small">Isi</th>
                                                <th class="small">Harga Beli Awal</th>
                                                <th class="small">Harga Beli Baru</th>
                                                <th class="small">Harga Jual Awal</th>
                                                <th class="small">Harga Jual Baru</th>
                                                <th class="small">Stok</th>
                                                <th class="small">User Input</th>
                                                <th class="small">Tanggal</th>
                                                <th class="small">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach ($sparepart as $index => $item) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="small"><?= $item['kode_part'] ?></td>
                                                    <td class="small"><?= $item['nama_part'] ?></td>
                                                    <td class="small"><?= $item['kode_group'] ?></td>
                                                    <td class="small"><?= $item['kode_kategori'] ?></td>
                                                    <td class="small"><?= $item['satuan'] ?></td>
                                                    <td class="small"><?= $item['isi'] ?></td>
                                                    <td class="small"><?= $item['harga_beliawal'] ?></td>
                                                    <td class="small"><?= $item['harga_belibaru'] ?></td>
                                                    <td class="small"><?= $item['harga_jualawal'] ?></td>
                                                    <td class="small"><?= $item['harga_jualbaru'] ?></td>
                                                    <td class="small"><?= $item['stok'] ?></td>
                                                    <td class="small"></td>
                                                    <td class="small"><?= $item['tanggal'] ?></td>
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
                                <div class="col-md-6">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan">
                                </div>
                                <div class="col-md-6">
                                    <label for="isi" class="form-label">Isi</label>
                                    <input type="text" class="form-control" id="isi" name="isi">
                                </div>
                            </div>

                            <!-- Input tambahan -->
                            <div class="mb-3">
                                <label for="harga_beliawal" class="form-label">Harga Beli Awal</label>
                                <input type="text" class="form-control" id="harga_beliawal" name="harga_beliawal">
                            </div>
                            <div class="mb-3">
                                <label for="harga_belibaru" class="form-label">Harga Beli Baru</label>
                                <input type="text" class="form-control" id="harga_belibaru" name="harga_belibaru">
                            </div>
                            <div class="mb-3">
                                <label for="harga_jualawal" class="form-label">Harga Jual Awal</label>
                                <input type="text" class="form-control" id="harga_jualawal" name="harga_jualawal">
                            </div>
                            <div class="mb-3">
                                <label for="harga_jualbaru" class="form-label">Harga Jual Baru</label>
                                <input type="text" class="form-control" id="harga_jualbaru" name="harga_jualbaru">
                            </div>
                            <div class="mb-3">
                                <label for="stok_minimal" class="form-label">Stok </label>
                                <input type="text" class="form-control" id="stok_minimal" name="stok_minimal">
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
                                <div class="mb-3">
                                    <label for="kode_group<?= $s['id_part'] ?>" class="form-label">Kode Group</label>
                                    <select class="form-select" id="kode_group<?= $s['id_part'] ?>" name="kode_group">
                                        <?php foreach ($groups as $group) : ?>
                                            <option value="<?= $group['kodegroup'] ?>" <?= $group['kodegroup'] == $s['kode_group'] ? 'selected' : '' ?>>
                                                <?= $group['kodegroup'] ?> - <?= $group['namagroup'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kode_kategori<?= $s['id_part'] ?>" class="form-label">Kode Kategori</label>
                                    <select class="form-select" id="kode_kategori<?= $s['id_part'] ?>" name="kode_kategori">
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['kode'] ?>" <?= $kat['kode'] == $s['kode_kategori'] ? 'selected' : '' ?>>
                                                <?= $kat['kode'] ?> - <?= $kat['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Sejajarkan Satuan dan Isi -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="satuan<?= $s['id_part'] ?>" class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="satuan<?= $s['id_part'] ?>" name="satuan" value="<?= $s['satuan'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="isi<?= $s['id_part'] ?>" class="form-label">Isi</label>
                                        <input type="text" class="form-control" id="isi<?= $s['id_part'] ?>" name="isi" value="<?= $s['isi'] ?>">
                                    </div>
                                </div>

                                <!-- Input tambahan -->
                                <div class="mb-3">
                                    <label for="harga_beliawal<?= $s['id_part'] ?>" class="form-label">Harga Beli Awal</label>
                                    <input type="text" class="form-control" id="harga_beliawal<?= $s['id_part'] ?>" name="harga_beliawal" value="<?= $s['harga_beliawal'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_belibaru<?= $s['id_part'] ?>" class="form-label">Harga Beli Baru</label>
                                    <input type="text" class="form-control" id="harga_belibaru<?= $s['id_part'] ?>" name="harga_belibaru" value="<?= $s['harga_belibaru'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jualawal<?= $s['id_part'] ?>" class="form-label">Harga Jual Awal</label>
                                    <input type="text" class="form-control" id="harga_jualawal<?= $s['id_part'] ?>" name="harga_jualawal" value="<?= $s['harga_jualawal'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jualbaru<?= $s['id_part'] ?>" class="form-label">Harga Jual Baru</label>
                                    <input type="text" class="form-control" id="harga_jualbaru<?= $s['id_part'] ?>" name="harga_jualbaru" value="<?= $s['harga_jualbaru'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="stok_minimal<?= $s['id_part'] ?>" class="form-label">Stok Minimal</label>
                                    <input type="text" class="form-control" id="stok_minimal<?= $s['id_part'] ?>" name="stok_minimal" value="<?= $s['stok'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal<?= $s['id_part'] ?>" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal<?= $s['id_part'] ?>" name="tanggal" value="<?= $s['tanggal'] ?>">
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



<?= $this->endSection() ?>