<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<style>
.lottie-container {
    width: 100px;
    height: 100px;
    margin: auto;
}

.modal-body {
    text-align: center;
}
</style>
<div class="container mt-3">
    <h1 class="text-center">Kelola Produksi</h1>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID Terima PO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ro as $item): ?>
                <tr>
                    <td>
                        <!-- ID yang bisa diklik -->
                        <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal"
                            data-bs-target="#modalUpdate<?= $item['id_terima_po'] ?>">
                            <?= $item['id_terima_po'] ?>
                        </button>
                    </td>
                </tr>

                <!-- Modal untuk update progres pengerjaan -->
                <div class="modal fade" id="modalUpdate<?= $item['id_terima_po'] ?>" tabindex="-1"
                    aria-labelledby="modalLabel<?= $item['id_terima_po'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $item['id_terima_po'] ?>">Update Progres
                                    Pengerjaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Animasi Lottie berdasarkan progres -->
                                <div class="lottie-container" id="lottie<?= $item['id_terima_po'] ?>"></div>

                                <p class="mt-3"><strong>Progres Saat Ini:</strong>
                                    <?= $item['progres_pengerjaan'] ?: 'Belum Ada' ?></p>

                                <!-- Form update progres pengerjaan -->
                                <form action="/produksi/updateProgres" method="post">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_terima_po" value="<?= $item['id_terima_po'] ?>">

                                    <div class="mb-3">
                                        <label for="progresPengerjaan" class="form-label">Update Progres</label>
                                        <select name="progres_pengerjaan" class="form-select" required>
                                            <option value="">Pilih Progres</option>
                                            <option value="Ketok"
                                                <?= $item['progres_pengerjaan'] == 'Ketok' ? 'selected' : '' ?>>Ketok
                                            </option>
                                            <option value="Dempul"
                                                <?= $item['progres_pengerjaan'] == 'Dempul' ? 'selected' : '' ?>>Dempul
                                            </option>
                                            <option value="Epoxy"
                                                <?= $item['progres_pengerjaan'] == 'Epoxy' ? 'selected' : '' ?>>Epoxy
                                            </option>
                                            <option value="Cat"
                                                <?= $item['progres_pengerjaan'] == 'Cat' ? 'selected' : '' ?>>Cat
                                            </option>
                                            <option value="Poles"
                                                <?= $item['progres_pengerjaan'] == 'Poles' ? 'selected' : '' ?>>Poles
                                            </option>
                                            <option value="Beres Pengerjaan"
                                                <?= $item['progres_pengerjaan'] == 'Beres Pengerjaan' ? 'selected' : '' ?>>
                                                Beres Pengerjaan</option>
                                            <option value="Menunggu Sparepart Tambahan"
                                                <?= $item['progres_pengerjaan'] == 'Menunggu Sparepart Tambahan' ? 'selected' : '' ?>>
                                                Menunggu Sparepart Tambahan</option>
                                            <option value="Menunggu Comment User"
                                                <?= $item['progres_pengerjaan'] == 'Menunggu Comment User' ? 'selected' : '' ?>>
                                                Menunggu Comment User</option>
                                            <option value="Data Completed"
                                                <?= $item['progres_pengerjaan'] == 'Data Completed' ? 'selected' : '' ?>>
                                                Data Completed</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                $('#modalUpdate<?= $item['id_terima_po'] ?>').on('shown.bs.modal', function() {
                    var animation<?= $item['id_terima_po'] ?> = lottie.loadAnimation({
                        container: document.getElementById('lottie<?= $item['id_terima_po'] ?>'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: <?= json_encode(
                            match ($item['progres_pengerjaan']) {
                                'Ketok' => '../public/path/to/ketok.json',
                                'Dempul' => '../public/path/to/dempul.json',
                                'Epoxy' => './public/path/to/epoxy.json',
                                'Cat' => './public/path/to/cat.json',
                                'Poles' => './public/path/to/poles.json',
                                'Beres Pengerjaan' => './public/path/to/beres.json',
                                'Menunggu Sparepart Tambahan' => '../public/path/to/menunggu-sparepart.json',
                                'Menunggu Comment User' => '../public/path/to/comment-user.json',
                                'Data Completed' => '../public/path/to/completed.json',
                                default => '/path/to/default.json'
                            }
                        ) ?>
                    });
                });
                </script>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>





<?= $this->endSection() ?>