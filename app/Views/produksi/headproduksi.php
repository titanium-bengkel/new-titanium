<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<!-- SweetAlert2 -->
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
<style>
.form-check-inline {
    display: flex;
    align-items: center;
    margin: 10px;
}

.form-check-input {
    display: none;
}

.form-check-input:checked+div {
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 5px;
}

.form-check div {
    cursor: pointer;
    padding: 5px;
    text-align: center;
}

.fa-2x {
    margin-bottom: 5px;
}

@media (max-width: 768px) {
    header {
        padding: 10px 15px;
    }

    .breadcrumb-wrapper {
        font-size: 12px;
    }

    h5.page-title {
        font-size: 16px;
    }

    .table th,
    .table td {
        font-size: 12px;
    }

    .btn {
        padding: 5px 10px;
        font-size: 12px;
    }

    .form-check-inline {
        margin: 5px;
    }

    .form-check-input:checked+div {
        border: 2px solid #007bff;
        border-radius: 5px;
        padding: 3px;
    }

    .fa-2x {
        font-size: 1.5rem;
        margin-bottom: 3px;
    }
}
</style>

<header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
    style="border-color: #6c757d; padding: 15px 20px;">
    <div class="breadcrumb-wrapper" style="font-size: 14px;">
        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
        <span class="breadcrumb-divider text-muted mx-3">/</span>
        <span class="breadcrumb-current text-muted">Head Produksi</span>
    </div>
    <h5 class="page-title mb-0 fw-bold">Head Produksi</h5>
</header>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover mb-0" id="repairOrdersTable">
        <thead class="table-secondary">
            <tr class="text-center">
                <th>#</th>
                <th>No. Klaim</th>
                <th>Tgl. Masuk</th>
                <th>No. Polisi</th>
                <th>Nama Customer</th>
                <th>Jenis Mobil</th>
                <th>Progress</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($repairOrders as $index => $order) : ?>
            <tr class="text-center">
                <td><?= $index + 1 ?></td>
                <td><?= esc($order['id_terima_po']) ?></td>
                <td>
                    <?= $order['tgl_masuk'] ? date('d M Y', strtotime($order['tgl_masuk'])) : '-' ?>
                </td>
                <td><?= esc($order['no_kendaraan']) ?></td>
                <td><?= esc($order['customer_name']) ?></td>
                <td><?= esc($order['jenis_mobil']) ?></td>
                <td><?= esc($order['progres_pengerjaan']) ?></td>
                <td>
                    <button class="btn btn-primary btn-sm"
                        onclick="openModal(<?= $order['id_repair_order'] ?>, '<?= $order['progres_pengerjaan'] ?>')">
                        Update
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="progressModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); overflow-y: auto;">
    <div
        style=" background: rgba(0, 0, 0, 1); margin: 10% auto; padding: 20px; width: 90%; max-width: 500px; text-align: center; border-radius: 10px; color: white;">
        <h5>Update Progress</h5>
        <form method="post" action="/produksi/update-head">
            <?= csrf_field() ?>
            <input type="hidden" name="id_repair_order" id="repairOrderId">
            <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center" style="margin: 20px 0;">
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioKetok"
                        value="Ketok">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-hammer text-primary fa-2x"></i>
                        <span>Ketok</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioDempul"
                        value="Dempul">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-tools text-secondary fa-2x"></i>
                        <span>Dempul</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioEpoxy"
                        value="Epoxy">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-paint-roller text-warning fa-2x"></i>
                        <span>Epoxy</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioCat" value="Cat">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-brush text-info fa-2x"></i>
                        <span>Cat</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioPoles"
                        value="Poles">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-circle-notch text-success fa-2x"></i>
                        <span>Poles</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioBeres"
                        value="Beres Pengerjaan">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-check-circle text-success fa-2x"></i>
                        <span>Beres</span>
                    </div>
                </label>
                <!-- <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioSparepart"
                        value="Menunggu Sparepart Tambahan">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-box-open text-secondary fa-2x"></i>
                        <span>Sparepart</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioComment"
                        value="Menunggu Comment User">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-comment-alt text-primary fa-2x"></i>
                        <span>Comment</span>
                    </div>
                </label>
                <label class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="progres_pengerjaan" id="radioCompleted"
                        value="Data Completed">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-database text-success fa-2x"></i>
                        <span>Completed</span>
                    </div>
                </label> -->
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id, currentProgress) {
    document.getElementById('repairOrderId').value = id;
    const radios = document.getElementsByName('progres_pengerjaan');
    radios.forEach(radio => {
        if (radio.value === currentProgress) {
            radio.checked = true;
        } else {
            radio.checked = false;
        }
    });

    document.getElementById('progressModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('progressModal').style.display = 'none';
}
</script>

<?= $this->endSection() ?>