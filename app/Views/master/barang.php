<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<style>
    .table-container {
        overflow: hidden;
        width: 100%;
    }

    .table-section {
        display: none;
    }

    .table-section.active {
        display: block;
    }

    .slide-button {
        cursor: pointer;
    }
</style>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-0 ms-3 mb-3">Barang</h4>
                <div class="card">
                    <div class="card-header d-flex align-items-center gap-3">
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                            Entry Data
                        </button>
                        <h6 class="mb-0 ms-auto">List Data Barang</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-section active" id="tableLeft">
                                <!-- Tabel Kiri -->
                                <div class="table-responsive" style="margin: 20px; font-size: 14px;">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td><button class="btn btn-link slide-button" data-target="#tableRight">#</button></td>
                                                <th>Aksi</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kode Group</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>Kode Kategori</th>
                                                <th>Nama Kategori</th>
                                                <th>Stok</th>
                                                <th>User Input</th>
                                                <th>Stok Minimal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <!-- Isi tabel barang di sini -->
                                            <?php foreach ($barang as $index => $item) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm"><i class="fas fa-edit"></i></button>
                                                    </td>
                                                    <td><?= $item['kode'] ?></td>
                                                    <td><?= $item['nama'] ?></td>
                                                    <td><?= $item['kode_group'] ?></td>
                                                    <td><?= $item['harga_beli'] ?></td>
                                                    <td><?= $item['harga_jual'] ?></td>
                                                    <td><?= $item['kode_kategori'] ?></td>
                                                    <td><?= $item['nama_kategori'] ?></td>
                                                    <td><?= $item['stok'] ?></td>
                                                    <td><?= $item['username'] ?></td>
                                                    <td><?= $item['stok_minimal'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="table-section" id="tableRight">
                                <!-- Tabel Kanan -->
                                <div class="table-responsive" style="margin: 20px; font-size: 14px;">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td><button class="btn btn-link slide-button" data-target="#tableLeft"><strong>Stok Min</strong></button></td>
                                                <th>Stok Max</th>
                                                <th>Sat_B</th>
                                                <th>Isi_B</th>
                                                <th>Sat_T</th>
                                                <th>Isi_T</th>
                                                <th>Sat_K</th>
                                                <th>Tanggal</th>
                                                <th>Tahun</th>
                                                <th>Periode</th>
                                                <th>UPD</th>
                                                <th>Harga Jual</th>
                                                <th>Harga Beli</th>
                                                <th>Aktif</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php foreach ($barang as $item) : ?>
                                                <tr>
                                                    <td><?= $item['stok_minimal'] ?></td>
                                                    <td><?= $item['stok_maksimal'] ?></td>
                                                    <td><?= $item['sat_B'] ?></td>
                                                    <td><?= $item['isi_B'] ?></td>
                                                    <td><?= $item['sat_T'] ?></td>
                                                    <td><?= $item['isi_T'] ?></td>
                                                    <td><?= $item['sat_K'] ?></td>
                                                    <td><?= $item['tgl'] ?></td>
                                                    <td><?= $item['tahun'] ?></td>
                                                    <td><?= $item['periode'] ?></td>
                                                    <td><?= $item['upd'] ?></td>
                                                    <td><?= $item['harga_jual'] ?></td>
                                                    <td><?= $item['harga_beli'] ?></td>
                                                    <td><?= $item['aktif'] ?></td>
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


<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="modalTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('createBar') ?>" method="post">
                    <div class="row">
                        <!-- Bagian kiri -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="kode" name="kode">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
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
                        </div>
                        <!-- Bagian kanan -->
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="sat_kecil" class="form-label">Satuan Kecil</label>
                                    <select class="form-select" id="sat_kecil" name="sat_B">
                                        <option value="PCS">PCS</option>
                                        <option value="ROLL">ROLL</option>
                                        <option value="KLG">KLG</option>
                                        <option value="KG">KG</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="isi_kecil" class="form-label">Isi Kecil</label>
                                    <input type="text" class="form-control" id="isi_kecil" name="isi_B">
                                </div>
                                <div class="col">
                                    <label for="sat_tengah" class="form-label">Satuan Tengah</label>
                                    <select class="form-select" id="sat_tengah" name="sat_T">
                                        <option value="PCS">PCS</option>
                                        <option value="ROLL">ROLL</option>
                                        <option value="KLG">KLG</option>
                                        <option value="KG">KG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="isi_tengah" class="form-label">Isi Tengah</label>
                                    <input type="text" class="form-control" id="isi_tengah" name="isi_T">
                                </div>
                                <div class="col">
                                    <label for="sat_besar" class="form-label">Satuan Besar</label>
                                    <select class="form-select" id="sat_besar" name="sat_K">
                                        <option value="PCS">PCS</option>
                                        <option value="ROLL">ROLL</option>
                                        <option value="KLG">KLG</option>
                                        <option value="KG">KG</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="isi_besar" class="form-label">Isi Besar</label>
                                    <input type="text" class="form-control" id="isi_besar" name="isi_Besar">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="text" class="form-control" id="harga_beli" name="harga_beli">
                            </div>
                            <div class="mb-3">
                                <label for="stok_minimal" class="form-label">Stok Minimal</label>
                                <input type="text" class="form-control" id="stok_minimal" name="stok_minimal">
                            </div>
                            <div class="mb-3">
                                <label for="stok_maksimal" class="form-label">Stok Maksimal</label>
                                <input type="text" class="form-control" id="stok_maksimal" name="stok_maksimal">
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



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Script untuk menampilkan SweetAlert Toast
    <?php if (session()->getFlashdata('alert')) : ?>
        $(document).ready(function() {
            const alert = <?= json_encode(session()->getFlashdata('alert')) ?>;
            Swal.fire(alert);
        });
    <?php endif; ?>

    // Script untuk slide tabel
    document.querySelectorAll('.slide-button').forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            document.querySelectorAll('.table-section').forEach(section => {
                section.classList.remove('active');
            });
            document.querySelector(target).classList.add('active');
        });
    });
</script>

<?= $this->endSection() ?>