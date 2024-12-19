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

<section id="horizontal-input">
    <div class="row">
        <form action="<?= base_url('updateAccAsuransi/' . $data['id_terima_po']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="card">
                    <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3" style="border-color: #6c757d; padding: 15px 20px;">
                        <div class="breadcrumb-wrapper" style="font-size: 14px;">
                            <a href="<?= base_url('/orderlist_asuransi') ?>" class="breadcrumb-link text-primary fw-bold">List Acc Asuransi</a>
                            <span class="breadcrumb-divider text-muted mx-3">/</span>
                            <span class="breadcrumb-current text-muted">Update Acc Asuransi</span>
                        </div>
                        <h5 class="page-title mb-0 fw-bold">Update Acc Asuransi</h5>
                    </header>
                    <div class="card-body">
                        <input type="hidden" id="id-terima-po" name="id_terima_po" value="<?= isset($data['id_terima_po']) ? esc($data['id_terima_po']) : '' ?>">
                        <h5>ID</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-acc">No. Acc</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-acc" class="form-control" name="no-acc" value="<?= isset($data['id_acc_asuransi']) ? esc($data['id_acc_asuransi']) : '' ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="id_terima_po">No. Order</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="id_terima_po" class="form-control" name="id_terima_po" value="<?= isset($data['id_terima_po']) ? esc($data['id_terima_po']) : '' ?>" readonly>
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tgl-acc">Tanggal Acc</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="date" id="tgl-acc" class="form-control" name="tgl_acc" value="<?= isset($data['tgl_acc']) ? esc($data['tgl_acc']) : '' ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Data Kendaraan</h5>
                        <div class="form-group row align-items-center">
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-kendaraan">No. Kendaraan</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="no-kendaraan" class="form-control" name="no_kendaraan" value="<?= isset($data['no_kendaraan']) ? esc($data['no_kendaraan']) : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="jenis-mobil">Jenis Mobil</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="jenis-mobil" class="form-control" name="jenis_mobil" value="<?= isset($data['jenis_mobil']) ? esc($data['jenis_mobil']) : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="warna">Warna</label>
                            </div>
                            <div class="col-lg-10 col-7 mb-3">
                                <input type="text" id="warna" class="form-control" name="warna" value="<?= isset($data['warna']) ? esc($data['warna']) : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="customer-name">Customer Name</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="customer-name" class="form-control" name="customer_name" value="<?= isset($data['customer_name']) ? esc($data['customer_name']) : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="no-contact">No Contact</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="no-contact" class="form-control" name="no_contact" value="<?= isset($data['no_contact']) ? esc($data['no_contact']) : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3 mb-3">
                                <label class="col-form-label" for="tahun-mobil">Tahun Mobil</label>
                            </div>
                            <div class="col-lg-10 col-9 mb-3">
                                <input type="text" id="tahun-mobil" class="form-control" name="tahun_mobil" value="<?= isset($data['tahun_kendaraan']) ? esc($data['tahun_kendaraan']) : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Asuransi</h5>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="asuransi">Asuransi</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="asuransi" class="form-control" name="asuransi" value="<?= isset($data['asuransi']) ? esc($data['asuransi']) : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-12">
                                <label class="col-form-label" for="tgl-masuk">Tanggal Masuk</label>
                            </div>
                            <div class="col-lg-4 col-12">
                                <input type="date" id="tgl-masuk" class="form-control" name="tgl_masuk" value="<?= isset($data['tgl_masuk']) ? esc($data['tgl_masuk']) : '' ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                            <div class="col-lg-2 col-12">
                                <label class="col-form-label" for="tgl-estimasi">Tanggal Estimasi</label>
                            </div>
                            <div class="col-lg-4 col-12">
                                <input type="date" id="tgl-estimasi" class="form-control" name="tgl_estimasi" value="<?= isset($data['tgl_estimasi']) ? esc($data['tgl_estimasi']) : '' ?>" onkeydown="return false" onclick="this.showPicker()">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="jasa">Biaya Jasa</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="jasa" class="form-control" name="biaya_jasa" value="<?= isset($data['biaya_jasa']) ? number_format(esc($data['biaya_jasa']), 0, ',', '.') : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="sparepart">Biaya Sparepart</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="sparepart" class="form-control" name="biaya_sparepart" value="<?= isset($data['biaya_sparepart']) ? number_format(esc($data['biaya_sparepart']), 0, ',', '.') : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="total-biaya">Total Biaya</label>
                            </div>
                            <div class="col-lg-10 col-9">
                                <input type="text" id="total-biaya" class="form-control" name="biaya_total" value="<?= isset($data['biaya_total']) ? number_format(esc($data['biaya_total']), 0, ',', '.') : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="nilai-or">Nilai OR</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="text" id="nilai-or" class="form-control" name="nilai_or" value="<?= isset($data['nilai_or']) ? number_format(esc($data['nilai_or']), 0, ',', '.') : '' ?>">
                            </div>
                            <div class="col-lg-2 col-3">
                                <label class="col-form-label" for="qty-or">Qty OR</label>
                            </div>
                            <div class="col-lg-4 col-9">
                                <input type="text" id="qty-or" class="form-control" name="qty_or" value="<?= isset($data['qty_or']) ? esc($data['qty_or']) : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-12">
                                <label class="col-form-label" for="keterangan">Keterangan</label>
                            </div>
                            <div class="col-lg-10 col-12">
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="2"><?= isset($data['keterangan']) ? esc($data['keterangan']) : '' ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-2 col-12">
                                <label class="col-form-label" for="fileSPK">Upload File SPK</label>
                            </div>
                            <div class="col-lg-10 col-12">
                                <input type="file" class="form-control" id="fileSPK" name="file_lampiran" accept=".pdf, .jpg, .jpeg, .png">
                                <?php if (isset($data['file_lampiran'])): ?>
                                    <small class="form-text text-muted">File Saat Ini:
                                        <a href="<?= base_url('uploads/acc-asuransi/' . esc($data['file_lampiran'])); ?>" target="_blank">
                                            <?= esc($data['file_lampiran']); ?>
                                        </a>
                                    </small>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <a href="<?= base_url('/orderlist_asuransi') ?>" class="btn btn-danger btn-sm me-2">Batal</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>



<!-- Modal for Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF or Image preview -->
                <iframe id="modalPreviewFile" src="" frameborder="0" style="width: 100%; height: 500px; display: none;"></iframe>
                <img id="modalPreviewImage" src="" style="width: 100%; height: auto; display: none;">
            </div>
        </div>
    </div>
</div>


<script>
    function calculateTotal() {
        const jasa = parseFloat(document.getElementById('jasa').value.replace(/\./g, '').replace(',', '.')) || 0;
        const sparepart = parseFloat(document.getElementById('sparepart').value.replace(/\./g, '').replace(',', '.')) || 0;
        const total = jasa + sparepart;
        document.getElementById('total-biaya').value = total.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).replace(/,/g, '.').replace('.', ',');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('jasa').addEventListener('input', calculateTotal);
        document.getElementById('sparepart').addEventListener('input', calculateTotal);
    });
</script>

<script>
    function previewFile() {
        const fileInput = document.getElementById('fileSPK');
        const file = fileInput.files[0];

        // Determine file type
        if (file) {
            const fileURL = URL.createObjectURL(file);
            const modalPreviewFile = document.getElementById('modalPreviewFile');
            const modalPreviewImage = document.getElementById('modalPreviewImage');

            // Show the modal
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));

            // Check file type and update the preview
            if (file.type.includes('pdf')) {
                modalPreviewFile.src = fileURL;
                modalPreviewFile.style.display = 'block';
                modalPreviewImage.style.display = 'none';
            } else if (file.type.includes('image')) {
                modalPreviewImage.src = fileURL;
                modalPreviewImage.style.display = 'block';
                modalPreviewFile.style.display = 'none';
            } else {
                modalPreviewFile.style.display = 'none';
                modalPreviewImage.style.display = 'none';
            }

            previewModal.show();
        }
    }

    <?= $this->endSection(); ?>