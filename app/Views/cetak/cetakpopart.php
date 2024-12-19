<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Data Pemesanan Sparepart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            position: relative;
        }

        h1 {
            text-align: center;
        }

        .content {
            position: relative;
            z-index: 1;
            padding: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            /* Jarak antara kop surat dan konten */
        }

        .kop-surat img {
            max-width: 100%;
            /* Sesuaikan ukuran gambar dengan lebar kontainer */
            height: auto;
            /* Menjaga rasio aspek gambar */
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="kop-surat">
            <img src="<?= base_url('../dist/assets/compiled/png/KopSurat.png'); ?>" alt="Kop Surat" />
        </div>
        <h1>Data Pemesanan Sparepart</h1>
        <div class="row">
            <div class="col-md-6 header-section">
                <p>No. Pemesanan: <?= $no_penerima; ?></p>
                <p>Tanggal: <?= $tanggal; ?></p>
                <p>Supplier: <?= $supplier; ?></p>
            </div>
            <div class="col-md-6 data-section">
                <p>No. Repair Order: <?= $no_repair_order; ?></p>
                <p>Asuransi: <?= $asuransi; ?></p>
                <p>Jenis Mobil: <?= $jenis_mobil; ?></p>
                <p>Warna: <?= $warna; ?></p>
                <p>Nopol: <?= $nopol; ?></p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item['id_kode_barang']; ?></td>
                        <td><?= $item['nama_barang']; ?></td>
                        <td><?= $item['qty']; ?></td>
                        <td><?= $item['satuan']; ?></td>
                        <td><?= number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><?= number_format($item['jumlah'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="text-align: right;">Total</td>
                    <td><?= number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>