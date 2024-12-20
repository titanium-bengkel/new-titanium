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
                        <a href="<?= base_url('/terima_part') ?>" class="breadcrumb-link text-primary fw-bold">List Penerimaan Sparepart</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Add Penerimaan Sparepart</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Add Penerimaan Sparepart NON-SUPPLY</h5>
                </header>
                <div class="card-body">
                    <h5>ID</h5>
                    <form action="<?= base_url('sparepart/update/' . $sparepart['id_penerimaan']) ?>" method="post">
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_penerimaan">No. Penerimaan</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_penerimaan" class="form-control" name="id_penerimaan" value="<?= $sparepart['id_penerimaan'] ?>" readonly>
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
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="supplier" class="form-control" name="supplier" value="<?= $sparepart['supplier'] ?>">
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
                                        <option <?= ($sparepart['gudang'] == 'GUDANG STOK SPAREPART') ? 'selected' : ''; ?>>GUDANG STOK SPAREPART</option>
                                        <option <?= ($sparepart['gudang'] == 'GUDANG SUPPLY DARI ASURANSI') ? 'selected' : ''; ?>>GUDANG SUPPLY DARI ASURANSI</option>
                                        <option <?= ($sparepart['gudang'] == 'GUDANG WAITING(MOBIL BELUM DATANG)') ? 'selected' : ''; ?>>GUDANG WAITING(MOBIL BELUM DATANG)</option>
                                        <option <?= ($sparepart['gudang'] == 'GUDANG SALVAGE') ? 'selected' : ''; ?>>GUDANG SALVAGE</option>
                                    </select>
                                </fieldset>
                            </div>
                        </div>


                        <h5>Data</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no_preor">No. PO/Nopol</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="no_preor" class="form-control" name="no_preor" value="<?= $sparepart['no_preor'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="alamat">Alamat</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="alamat" class="form-control" name="alamat" value="<?= $sparepart['alamat'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="nopol">Nopol</label>
                            </div>
                            <div class="col-lg-4 col-9 mb-3">
                                <input type="text" id="nopol" class="form-control" name="nopol" value="<?= $sparepart['nopol'] ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="pembayaran">Metode Pembayaran</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="pembayaran" name="pembayaran">
                                        <option value="TRANSFER" <?= ($sparepart['pembayaran'] == 'TRANSFER') ? 'selected' : ''; ?>>TRANSFER</option>
                                        <option value="KREDIT" <?= ($sparepart['pembayaran'] == 'KREDIT') ? 'selected' : ''; ?>>KREDIT</option>
                                        <option value="CASH" <?= ($sparepart['pembayaran'] == 'CASH') ? 'selected' : ''; ?>>CASH</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="ppn">PPN</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" id="ppn" name="ppn">
                                        <option value="PPN" <?= ($sparepart['ppn'] == '11') ? 'selected' : ''; ?>>PPN</option>
                                        <option value="Non PPN" <?= ($sparepart['ppn'] == '0') ? 'selected' : ''; ?>>Non PPN</option>
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
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>ID Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Disc</th>
                                        <th>Jumlah</th>
                                        <th>No PO</th>
                                        <th>PO ID</th>
                                        <!-- <th>Pilih</th> -->
                                        <!-- <th>Pasang</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-barang-body" style="text-align: center;">
                                    <?php if (!empty($detail_terima)) : ?>
                                        <?php foreach ($detail_terima as $index => $detail) : ?>
                                            <tr>
                                                <td>
                                                    <?= $detail['id_kode_barang'] ?>
                                                </td>
                                                <td>
                                                    <?= $detail['nama_barang'] ?>
                                                <td>
                                                    <?= $detail['qty'] ?>
                                                </td>
                                                <td>
                                                    <?= $detail['satuan'] ?>
                                                </td>
                                                <td>
                                                    <?= number_format($detail['harga'], 0, ',', '.') ?>
                                                </td>
                                                <td>
                                                    <?= number_format($detail['disc'], 0, ',', '.') ?>
                                                </td>
                                                <td>
                                                    <?= number_format($detail['jumlah'], 0, ',', '.') ?>
                                                </td>
                                                <td>
                                                    <?= $detail['no_po'] ?>
                                                </td>
                                                <td><?= $index + 1 ?></td>
                                                <!-- <td>
                                                    <div class="ms-auto">
                                                        <?php if ($detail['is_pasang'] == 0): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" id="pasangPart" data-id="<?= $detail['id'] ?>">
                                                                Pasang
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-success btn-sm" disabled>
                                                                Terpasang
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td> -->
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="12">Tidak ada data barang.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total Qty</td>
                                        <td style="text-align: center;"><?= $total_qty; ?></td>
                                        <td colspan="3">Total Jumlah</td>
                                        <td style="text-align: center;"><?= number_format($total_jumlah, 0, ',', '.'); ?></td>
                                        <td colspan="5"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-10 col-9 mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Update Data</button>
                                <a href="<?= base_url('terima_part'); ?>" class="btn btn-danger btn-sm">Batal</a>
                                <a href="<?= base_url('order_pos_terimapart'); ?>" class="btn btn-success btn-sm">Input Baru</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Horizontal Input end -->

<script>
    document.getElementById('pasangPart').addEventListener('click', function() {
        const button = this; // Referensi tombol
        const id = button.getAttribute('data-id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Sparepart akan terpasang dan data tidak dapat kembali setelah dikonfirmasi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya, Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const url = '/pasangSparepartv2/' + encodeURIComponent(id);

                fetch(url, {
                        method: 'POST', // Menggunakan POST
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            mobilId: 123
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Sparepart Terpasang!',
                                data.message,
                                'success'
                            );

                            // Ubah tombol menjadi "Terpasang" dan matikan
                            button.textContent = 'Terpasang';
                            button.classList.add('btn-success'); // Tambahkan kelas success untuk indikasi
                            button.disabled = true; // Nonaktifkan tombol
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message,
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Terjadi Kesalahan', 'Gagal mengirim data ke server', 'error');
                    });
            } else if (result.isDismissed) {
                Swal.fire(
                    'Aksi Dibatalkan!',
                    'Tidak ada perubahan yang dilakukan.',
                    'error'
                );
            }
        });
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
<script>
    document.querySelectorAll('input[name="qty[]"], input[name="harga[]"], input[name="disc[]"]').forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            const qty = row.querySelector('input[name="qty[]"]').value || 0;
            const harga = parseInt(row.querySelector('input[name="harga[]"]').value.replace(/\./g, '') || 0);
            const disc = parseInt(row.querySelector('input[name="disc[]"]').value.replace(/\./g, '') || 0);

            const jumlah = (harga - disc) * qty;
            row.querySelector('input[name="jumlah[]"]').value = new Intl.NumberFormat().format(jumlah);
        });
    });
</script>



<?= $this->endSection() ?>