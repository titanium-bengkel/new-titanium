<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div id="mobileWarning" class="mobile-warning">
    <p>Tampilan ini hanya dapat diakses melalui PC. Mohon gunakan PC untuk melanjutkan.</p>
</div>
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <header class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3"
                    style="border-color: #6c757d; padding: 15px 20px;">
                    <div class="breadcrumb-wrapper" style="font-size: 14px;">
                        <a href="<?= base_url('/index') ?>" class="breadcrumb-link text-primary fw-bold">Dashboard</a>
                        <span class="breadcrumb-divider text-muted mx-3">/</span>
                        <span class="breadcrumb-current text-muted">Pengaturan Role</span>
                    </div>
                    <h5 class="page-title mb-0 fw-bold">Pengaturan Role</h5>
                </header>
                <div class="card-content" style="margin: 20px; font-size: 12px;"></div>
                <div class="table-responsive">
                    <div class="container">
                        <?php if (session()->getFlashdata('message')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('message'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th class="text-center">Level Role</th>
                                    <th class="text-center">Fitur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($label as $ind_l => $l) { ?>
                                    <tr>
                                        <td class="text-center"><?= $l['id'] ?></td>
                                        <td class="text-center"><?= $l['label'] ?></td>
                                        <td>
                                            <section>
                                                <div class="container">
                                                    <form method="POST"
                                                        action="<?= site_url('role/update_permissions/' . $l['id']); ?>">
                                                        <?= csrf_field(); ?>
                                                        <div class="form-container">
                                                            <div class="form-check my-4 gap-2">
                                                                <div class="d-flex gap-4 mb-4">
                                                                    <div>
                                                                        <input type="checkbox" id="dashboard<?= $l['id'] ?>"
                                                                            name="dashboard"
                                                                            <?= in_array('Dashboard', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label
                                                                            for="dashboard<?= $l['id'] ?>">Dashboard</label>
                                                                    </div>

                                                                    <!-- SUPER ADMIN -->
                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="superadmin<?= $l['id'] ?>" name="superadmin"
                                                                            class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Super Admin', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="superadmin<?= $l['id'] ?>">Super
                                                                            Admin</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kelolauser<?= $l['id'] ?>"
                                                                                    name="kelolauser"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kelola User', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="kelolauser<?= $l['id'] ?>">Kelola
                                                                                    User</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kelolamenu<?= $l['id'] ?>"
                                                                                    name="kelolamenu"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kelola Menu', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="kelolamenu<?= $l['id'] ?>">Kelola
                                                                                    Menu</label>
                                                                            </div>
                                                                            <!-- <div>
                                                                            <input type="checkbox"
                                                                                id="registeradminonly<?= $l['id'] ?>"
                                                                                name="registeradminonly"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Tambah User', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="registeradminonly<?= $l['id'] ?>">Tambahan
                                                                                User</label>
                                                                        </div> -->
                                                                        </div>
                                                                    </div>
                                                                    <!-- END SUPER ADMIN -->

                                                                    <!-- PRODUK -->
                                                                    <div>
                                                                        <input type="checkbox" id="produkp<?= $l['id'] ?>"
                                                                            name="produkp" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Produksi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="produkp<?= $l['id'] ?>">Produk</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="headprodukp<?= $l['id'] ?>"
                                                                                    name="headprodukp"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Head Produksi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="headprodukp<?= $l['id'] ?>">Head
                                                                                    Produk</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="memberprodukp<?= $l['id'] ?>"
                                                                                    name="memberprodukp"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kelola Produksi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="memberprodukp<?= $l['id'] ?>">Kelola
                                                                                    Produk</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END PRODUK -->

                                                                    <!-- KLAIM -->
                                                                    <div>
                                                                        <input type="checkbox" id="klaim<?= $l['id'] ?>"
                                                                            name="klaim" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Klaim', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="klaim<?= $l['id'] ?>">Klaim</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="estperbaikan<?= $l['id'] ?>"
                                                                                    name="estperbaikan"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pre Order', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="estperbaikan<?= $l['id'] ?>">Pre Order</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="orderlist_asuransi<?= $l['id'] ?>"
                                                                                    name="orderlist_asuransi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Asuransi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="orderlist_asuransi<?= $l['id'] ?>">Asuransi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="repair_order<?= $l['id'] ?>"
                                                                                    name="repair_order"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Repair Order', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="repair_order<?= $l['id'] ?>">Repair Order</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="orderlist_pending<?= $l['id'] ?>"
                                                                                    name="orderlist_pending"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pending Invoice', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="orderlist_pending<?= $l['id'] ?>">Pending
                                                                                    Invoice</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kwitansi<?= $l['id'] ?>"
                                                                                    name="kwitansi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kwitansi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="kwitansi<?= $l['id'] ?>">Kwitansi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="bayar_piutang<?= $l['id'] ?>"
                                                                                    name="bayar_piutang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Payment', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="bayar_piutang<?= $l['id'] ?>">Payment</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kwitansi_piutang<?= $l['id'] ?>"
                                                                                    name="kwitansi_piutang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pending Payment', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="kwitansi_piutang<?= $l['id'] ?>">Pending Payment</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="mobilmasuk<?= $l['id'] ?>"
                                                                                    name="mobilmasuk"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Mobil Status', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="mobilmasuk<?= $l['id'] ?>">Mobil
                                                                                    Masuk</label>
                                                                                <div class="ms-3">
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            id="batalmasuk<?= $l['id'] ?>"
                                                                                            name="batalmasuk"
                                                                                            onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                            <?= in_array('Batal Masuk', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                        <label
                                                                                            for="batalmasuk<?= $l['id'] ?>">Batal
                                                                                            Masuk</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            id="batalsuransi<?= $l['id'] ?>"
                                                                                            name="batalsuransi"
                                                                                            onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                            <?= in_array('Batal Asuransi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                        <label
                                                                                            for="batalsuransi<?= $l['id'] ?>">Batal
                                                                                            Asuransi</label>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            id="mobilselesai<?= $l['id'] ?>"
                                                                                            name="mobilselesai"
                                                                                            onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                            <?= in_array('Selesai', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                        <label
                                                                                            for="mobilselesai<?= $l['id'] ?>">Batal
                                                                                            Asuransi</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END KLAIM -->

                                                                    <!-- BAHAN -->
                                                                    <div>
                                                                        <input type="checkbox" id="bahan<?= $l['id'] ?>"
                                                                            name="bahan" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Bahan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="bahan<?= $l['id'] ?>">Bahan</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="po_bahan<?= $l['id'] ?>"
                                                                                    name="po_bahan"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pemesanan Bahan (PO)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="po_bahan<?= $l['id'] ?>">Pemesanan
                                                                                    Bahan
                                                                                    (PO)</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="terima_bahan<?= $l['id'] ?>"
                                                                                    name="terima_bahan"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Penerimaan Barang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="terima_bahan<?= $l['id'] ?>">Penerimaan
                                                                                    Barang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="repair_material<?= $l['id'] ?>"
                                                                                    name="repair_material"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Repair Material', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="repair_material<?= $l['id'] ?>">Repair
                                                                                    Material</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="laporan_mutasi<?= $l['id'] ?>"
                                                                                    name="laporan_mutasi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Laporan Mutasi Gudang Bahan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="laporan_mutasi<?= $l['id'] ?>">Laporan
                                                                                    Mutasi
                                                                                    Gudang Bahan</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END BAHAN -->


                                                                    <!-- SPAREPART -->
                                                                    <div>
                                                                        <input type="checkbox" id="sparepart<?= $l['id'] ?>"
                                                                            name="sparepart" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label
                                                                            for="sparepart<?= $l['id'] ?>">Sparepart</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="permintaan_part<?= $l['id'] ?>"
                                                                                    name="permintaan_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Permintaan Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="permintaan_part<?= $l['id'] ?>">Permintaan
                                                                                    Sparepart</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="pesan_part<?= $l['id'] ?>"
                                                                                    name="pesan_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pemesanan Sparepart (PO)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="pesan_part<?= $l['id'] ?>">Pemesanan
                                                                                    Sparepart
                                                                                    (PO)</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="terima_part<?= $l['id'] ?>"
                                                                                    name="terima_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Penerimaan Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="terima_part<?= $l['id'] ?>">Penerimaan
                                                                                    Sparepart</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="minta_part_supp<?= $l['id'] ?>"
                                                                                    name="minta_part_supp"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Permintaan Sparepart Supply', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="minta_part_supp<?= $l['id'] ?>">Permintaan
                                                                                    Sparepart Supply</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="supp_asuransi<?= $l['id'] ?>"
                                                                                    name="supp_asuransi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Supply Asuransi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="supp_asuransi<?= $l['id'] ?>">Supply
                                                                                    Asuransi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="repair_material_part<?= $l['id'] ?>"
                                                                                    name="repair_material_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Repair Material Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="repair_material_part<?= $l['id'] ?>">Repair
                                                                                    Material Sparepart</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="mutasi_gudang_part<?= $l['id'] ?>"
                                                                                    name="mutasi_gudang_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Laporan Mutasi Gudang Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="mutasi_gudang_part<?= $l['id'] ?>">Laporan
                                                                                    Mutasi Gudang Sparepart</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="waiting_part<?= $l['id'] ?>"
                                                                                    name="waiting_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart Dalam Pemesanan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="waiting_part<?= $l['id'] ?>">Sparepart
                                                                                    Dalam
                                                                                    Pemesanan</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="sparepart_masuk<?= $l['id'] ?>"
                                                                                    name="sparepart_masuk"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart Sudah Diterima', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="sparepart_masuk<?= $l['id'] ?>">Sparepart
                                                                                    Sudah
                                                                                    Diterima</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="part_salvage<?= $l['id'] ?>"
                                                                                    name="part_salvage"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart Salvage', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="part_salvage<?= $l['id'] ?>">Sparepart
                                                                                    Salvage</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="part_pasang<?= $l['id'] ?>"
                                                                                    name="part_pasang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart Terpasang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="part_pasang<?= $l['id'] ?>">Sparepart
                                                                                    Terpasang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="part_sisa<?= $l['id'] ?>"
                                                                                    name="part_sisa"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart Sisa', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="part_sisa<?= $l['id'] ?>">Sparepart
                                                                                    Sisa</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="stok_part<?= $l['id'] ?>"
                                                                                    name="stok_part"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kartu Stok Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="stok_part<?= $l['id'] ?>">Kartu
                                                                                    Stok
                                                                                    Sparepart</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END SPAREPART -->
                                                                </div>

                                                                <div class="d-flex gap-4 mb-4">
                                                                    <!-- KEUANGAN -->
                                                                    <div>
                                                                        <input type="checkbox" id="keuangan<?= $l['id'] ?>"
                                                                            name="keuangan" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Keuangan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label
                                                                            for="keuangan<?= $l['id'] ?>">Keuangan</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="hutang<?= $l['id'] ?>" name="hutang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Hutang Per Supplier', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="hutang<?= $l['id'] ?>">Hutang
                                                                                    Per
                                                                                    Supplier</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="bayar_hutang<?= $l['id'] ?>"
                                                                                    name="bayar_hutang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pembayaran Hutang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="bayar_hutang<?= $l['id'] ?>">Pembayaran
                                                                                    Hutang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="pembelian<?= $l['id'] ?>"
                                                                                    name="pembelian"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pembelian', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="pembelian<?= $l['id'] ?>">Pembelian</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kas_bank<?= $l['id'] ?>"
                                                                                    name="kas_bank"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kas & Bank', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="kas_bank<?= $l['id'] ?>">Kas &
                                                                                    Bank</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kas_kecil<?= $l['id'] ?>"
                                                                                    name="kas_kecil"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kas Kecil', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="kas_kecil<?= $l['id'] ?>">Kas
                                                                                    Kecil</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="keluar_kasbesar<?= $l['id'] ?>"
                                                                                    name="keluar_kasbesar"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pengeluaran Kas Besar', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="keluar_kasbesar<?= $l['id'] ?>">Pengeluaran
                                                                                    Kas
                                                                                    Besar</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kas_masuk<?= $l['id'] ?>"
                                                                                    name="kas_masuk"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kas Masuk', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="kas_masuk<?= $l['id'] ?>">Kas
                                                                                    Masuk</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kas_keluar<?= $l['id'] ?>"
                                                                                    name="kas_keluar"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kas Keluar', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="kas_keluar<?= $l['id'] ?>">Kas
                                                                                    Keluar</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="ro_list<?= $l['id'] ?>"
                                                                                    name="ro_list"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Repair Order List', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="ro_list<?= $l['id'] ?>">Repair
                                                                                    Order
                                                                                    List</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="material_jasa<?= $l['id'] ?>"
                                                                                    name="material_jasa"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Repair Material Jasa', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="material_jasa<?= $l['id'] ?>">Repair
                                                                                    Material
                                                                                    Jasa</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END KEUANGAN -->

                                                                    <!-- REPORT -->
                                                                    <div>
                                                                        <input type="checkbox" id="report<?= $l['id'] ?>"
                                                                            name="report" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Report', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="report<?= $l['id'] ?>">Report</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="report_jurnal<?= $l['id'] ?>"
                                                                                    name="report_jurnal"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Report Jurnal', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="report_jurnal<?= $l['id'] ?>">Report
                                                                                    Jurnal</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="buku_besar<?= $l['id'] ?>"
                                                                                    name="buku_besar"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('General Ledger (Buku Besar)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="buku_besar<?= $l['id'] ?>">General
                                                                                    Ledger
                                                                                    (Buku
                                                                                    Besar)</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="laba_rugi<?= $l['id'] ?>"
                                                                                    name="laba_rugi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Income Statment (Laba Rugi)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="laba_rugi<?= $l['id'] ?>">Income
                                                                                    Statment
                                                                                    (Laba
                                                                                    Rugi)</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="neraca<?= $l['id'] ?>" name="neraca"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Balance Sheet (Neraca)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="neraca<?= $l['id'] ?>">Balance
                                                                                    Sheet
                                                                                    (Neraca)</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END REPORT -->

                                                                    <!-- MASTER -->
                                                                    <div>
                                                                        <input type="checkbox" id="master<?= $l['id'] ?>"
                                                                            name="master" class="label<?= $l['id'] ?>"
                                                                            onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                            <?= in_array('Master', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                        <label for="master<?= $l['id'] ?>">Master</label>
                                                                        <div class="ms-3">
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="kategoribarang<?= $l['id'] ?>"
                                                                                    name="kategoribarang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Kategori Barang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="kategoribarang<?= $l['id'] ?>">Kategori
                                                                                    Barang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="grupbarang<?= $l['id'] ?>"
                                                                                    name="grupbarang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Grup Barang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="grupbarang<?= $l['id'] ?>">Grup
                                                                                    Barang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="msparepart<?= $l['id'] ?>"
                                                                                    name="msparepart"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Sparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="msparepart<?= $l['id'] ?>">Sparepart</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="bahanm<?= $l['id'] ?>" name="bahanm"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Bahan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="bahanm<?= $l['id'] ?>">Bahan</label>
                                                                            </div>

                                                                            <!-- <div>
                                                                            <input type="checkbox"
                                                                                id="car<?= $l['id'] ?>" name="car"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Car', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label for="car<?= $l['id'] ?>">Car</label>
                                                                            <div class="ms-3">
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="class<?= $l['id'] ?>"
                                                                                        name="class"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Class', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="class<?= $l['id'] ?>">Class</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="merk<?= $l['id'] ?>"
                                                                                        name="merk"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Merk', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="merk<?= $l['id'] ?>">Merk</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="model<?= $l['id'] ?>"
                                                                                        name="model"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Model', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="model<?= $l['id'] ?>">Model</label>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->

                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="pengerjaan<?= $l['id'] ?>"
                                                                                    name="pengerjaan"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Pengerjaan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="pengerjaan<?= $l['id'] ?>">Pengerjaan</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="jasarm<?= $l['id'] ?>" name="jasarm"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Jasa RM', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="jasarm<?= $l['id'] ?>">Jasa
                                                                                    RM</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="asuransi<?= $l['id'] ?>"
                                                                                    name="asuransi"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Asuransi', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="asuransi<?= $l['id'] ?>">Asuransi</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="gudang<?= $l['id'] ?>" name="gudang"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Gudang', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="asuransi<?= $l['id'] ?>">Gudang</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="coa<?= $l['id'] ?>" name="coa"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Chart of Account', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label for="coa<?= $l['id'] ?>">Chart of
                                                                                    Account</label>
                                                                            </div>
                                                                            <div>
                                                                                <input type="checkbox"
                                                                                    id="supplier<?= $l['id'] ?>"
                                                                                    name="supplier"
                                                                                    onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                    <?= in_array('Supplier', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                <label
                                                                                    for="supplier<?= $l['id'] ?>">Supplier</label>
                                                                            </div>
                                                                            <!-- <div>
                                                                            <input type="checkbox"
                                                                                id="customer<?= $l['id'] ?>"
                                                                                name="customer"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Customer', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="customer<?= $l['id'] ?>">Customer</label>
                                                                        </div> -->

                                                                            <!-- <div>
                                                                            <input type="checkbox"
                                                                                id="pengerjaan<?= $l['id'] ?>"
                                                                                name="pengerjaan"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Pengerjaan', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="pengerjaan<?= $l['id'] ?>">Pengerjaan</label>
                                                                            <div class="ms-3">
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="job<?= $l['id'] ?>"
                                                                                        name="job"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Job', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="job<?= $l['id'] ?>">Job</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="job_subblet<?= $l['id'] ?>"
                                                                                        name="subblet"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Subblet', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="job_subblet<?= $l['id'] ?>">Subblet</label>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->

                                                                            <!-- <div>
                                                                            <input type="checkbox"
                                                                                id="masterbahan<?= $l['id'] ?>"
                                                                                name="masterbahan"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Material', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="masterbahan<?= $l['id'] ?>">Material</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="mekanik<?= $l['id'] ?>"
                                                                                name="mekanik"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Mekanik', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="mekanik<?= $l['id'] ?>">Mekanik</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="msparepart<?= $l['id'] ?>"
                                                                                name="msparepart"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Msparepart', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="msparepart<?= $l['id'] ?>">Sparepart</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="supplier<?= $l['id'] ?>"
                                                                                name="supplier"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Supplier', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="supplier<?= $l['id'] ?>">Supplier</label>
                                                                        </div>
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="foreman<?= $l['id'] ?>"
                                                                                name="foreman"
                                                                                onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Foreman', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="foreman<?= $l['id'] ?>">Foreman</label>
                                                                        </div>
                                                                    </div> -->
                                                                        </div>
                                                                        <!-- END MASTER -->

                                                                        <!-- MONITORING -->
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="monitoring<?= $l['id'] ?>"
                                                                                name="monitoring"
                                                                                class="label<?= $l['id'] ?>"
                                                                                onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Monitoring', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="monitoring<?= $l['id'] ?>">Monitoring</label>
                                                                            <div class="ms-3">
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="monitoring_history<?= $l['id'] ?>"
                                                                                        name="monitoring_history"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Histori Edit', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="monitoring_history<?= $l['id'] ?>">Histori
                                                                                        Edit</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="monitoring_jadwal_keluar<?= $l['id'] ?>"
                                                                                        name="monitoring_jadwal_keluar"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Jadwal Mobil Keluar', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="monitoring_jadwal_keluar<?= $l['id'] ?>">Jadwal
                                                                                        Mobil Keluar</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="monitoring_tracking_unit<?= $l['id'] ?>"
                                                                                        name="monitoring_tracking_unit"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Tracking Unit', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="monitoring_tracking_unit<?= $l['id'] ?>">Traking
                                                                                        Unit</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END MONITORING -->

                                                                        <!-- WEBSITE -->
                                                                        <div>
                                                                            <input type="checkbox"
                                                                                id="website<?= $l['id'] ?>" name="website"
                                                                                class="label<?= $l['id'] ?>"
                                                                                onchange="handleUbah(event, '<?= $l['id'] ?>')"
                                                                                <?= in_array('Website', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                            <label
                                                                                for="website<?= $l['id'] ?>">Website</label>
                                                                            <div class="ms-3">
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="video_home<?= $l['id'] ?>"
                                                                                        name="video_home"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Video Home', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="video_home<?= $l['id'] ?>">Video
                                                                                        Home</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="tentang_kami<?= $l['id'] ?>"
                                                                                        name="tentang_kami"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Tentang Kami (About Us)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="tentang_kami<?= $l['id'] ?>">Tentang
                                                                                        Kami
                                                                                        (About
                                                                                        Us)</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="layanan<?= $l['id'] ?>"
                                                                                        name="layanan"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Layanan (Service)', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="layanan<?= $l['id'] ?>">Layanan
                                                                                        (Service)</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="gallery<?= $l['id'] ?>"
                                                                                        name="gallery"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Gallery', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="gallery<?= $l['id'] ?>">Gallery</label>
                                                                                </div>
                                                                                <div>
                                                                                    <input type="checkbox"
                                                                                        id="testimoni_konsumen<?= $l['id'] ?>"
                                                                                        name="testimoni_konsumen"
                                                                                        onchange="handleUbahAnak(event, '<?= $l['id'] ?>')"
                                                                                        <?= in_array('Testimoni Konsumen', $l['fiturnya']) ? 'checked' : '' ?>>
                                                                                    <label
                                                                                        for="testimoni_konsumen<?= $l['id'] ?>">Testimoni
                                                                                        Konsumen</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- END WEBSITE -->
                                                                    </div>

                                                                    <div>
                                                                        <input type="checkbox"
                                                                            id="pengaturan_role<?= $l['id'] ?>"
                                                                            name="mpengaturan_role"
                                                                            <?= in_array('Role', $l['fiturnya']) ? 'checked' : '' ?>
                                                                            <?= session()->get('role_label') !== 'super admin' ? 'disabled' : '' ?>
                                                                            onclick="handleRoleChange(event, '<?= session()->get('role_label') ?>')">
                                                                        <label
                                                                            for="pengaturan_role<?= $l['id'] ?>">Pengaturan
                                                                            Role</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary mt-2">Simpan</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </section>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function handleUbah(parent, id_label) {
        const idNameElm = parent.target.name;
        const anak = document.querySelectorAll('input[name="' + parent.target.name + '"].label' + id_label +
            ' ~ .ms-3 input');
        anak.forEach(element => {
            element.checked = parent.target.checked
        });
    }

    function handleUbahAnak(anak) {
        if (anak.target.checked) {
            const parent = anak.target.parentNode.parentNode.parentNode.children[0];
            parent.checked = true;
        }
    }

    function handleRoleChange(event, roleLabel) {
        if (roleLabel !== 'super admin') {
            event.preventDefault();
            alert("Maaf, role Anda bukan Dewa Boss!");
            const message = document.createElement('div');
            message.textContent = 'Maaf, role Anda bukan Dewa Boss!';
            message.style.color = 'red';
            message.style.fontWeight = 'bold';
            document.body.appendChild(message);
            const checkbox = event.target;
            checkbox.style.border = '2px solid red';
            setTimeout(() => {
                checkbox.style.border = '';
            }, 2000);
        }
    }

    function checkDevice() {
        const width = window.innerWidth;
        if (width <= 768) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            const mobileWarning = document.getElementById('mobileWarning');
            mobileWarning.style.display = 'block';
            setTimeout(function() {
                window.location.href = '/index';
            }, 5000);
        } else {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'block';
            });
            const mobileWarning = document.getElementById('mobileWarning');
            mobileWarning.style.display = 'none';
        }
    }

    window.onload = checkDevice;
    window.onresize = checkDevice;
</script>


<?= $this->endSection(); ?>