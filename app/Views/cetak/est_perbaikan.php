<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="application/pdf">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimasi Perbaikan Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .logo img {
            width: 120px;
        }

        .header-info {
            text-align: right;
            font-size: 12px;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-border {
            border: none;
        }

        .section-title {
            margin-top: 30px;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo" style="text-align: left;">
            <img src="<?= base_url('dist/assets/img/kop.png') ?>" alt="Logo Perusahaan" style="width: 250px; height: auto;">
        </div>


        <div class="header-info">
            <p><strong>TITANIUM AUTO BODY REPAIR</strong></p>
            <p>Jl. Puspowarno Tengah No. 3, Semarang</p>
            <p>Telp: 024-7318330 / 08121574152</p>
            <p>Email: titanium_autobodyrepair@yahoo.com</p>
        </div>
    </header>

    <div class="title">ESTIMASI PERBAIKAN KENDARAAN</div>

    <section>
        <table style="border: none; width: 100%;">
            <tr>
                <td style="border: none; width: 15%;">Kepada</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $po['asuransi'] ?? '-' ?></td>
                <td style="border: none; width: 15%;">No. Rangka</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $po['no_rangka'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">No. Estimasi</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['id_po'] ?? '-' ?></td>
                <td style="border: none;">Merk/Type</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['jenis_mobil'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">No. Polis</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['no_polis'] ?? '-' ?></td>
                <td style="border: none;">Nopol</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['no_kendaraan'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Tertanggung</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['customer_name'] ?? '-' ?></td>
                <td style="border: none;">Warna</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['warna'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Alamat</td>

                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['alamat'] ?? '-' ?></td>
                <td style="border: none;">No. Telp</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $po['no_contact'] ?? '-' ?></td>
            </tr>
        </table>
    </section>


    <h4 class="section-title">A. Jasa</h4>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Jasa</th>
                <th style="text-align: center;">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarPengerjaan as $index => $pengerjaan): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $pengerjaan['nama_pengerjaan'] ?></td>
                    <td>Rp <?= number_format($pengerjaan['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="2">Total Harga Jasa</td>
                <td>Rp <?= number_format($totalHargaJasa, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <h4 class="section-title">B. Sparepart</h4>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;"">No</th>
                <th style=" text-align: center;"">Sparepart</th>
                <th style="text-align: center;"">Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarSparepart as $index => $sparepart): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $sparepart['nama_sparepart'] ?></td>
                    <td>Rp <?= number_format($sparepart['harga'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class=" total-row">
                <td colspan="2">Total Harga Sparepart</td>
                <td>Rp <?= number_format($totalHargaSparepart, 0, ',', '.') ?></td>
            </tr>
            </tbody>
    </table>

    <div class="subtotal-section">
        <table class="subtotal-table">
            <thead>
                <tr>
                    <th colspan="2">Rincian Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Biaya Jasa</td>
                    <td style="text-align: right;">Rp <?= number_format($totalHargaJasa, 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <td>Total Biaya Sparepart</td>
                    <td style="text-align: right;">Rp <?= number_format($totalHargaSparepart, 0, ',', '.') ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Grand Total</strong></td>
                    <td style="text-align: right;"><strong>Rp <?= number_format($totalHargaJasa + $totalHargaSparepart, 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>


    <div class="footer">
        <p>Demikian penawaran harga dari kami.</p>
        <p>Untuk kejelasan lebih lanjut dapat menghubungi Bapak Deny Suwignyo.</p>
        <p>Atas perhatian dan kerja samanya, kami ucapkan terima kasih.</p>
    </div>
    <div class="signature-section" style="margin-top: 50px; display: flex; justify-content: space-between;">
        <div class="left-signature" style="text-align: center; width: 40%;">
            <p>Kepala Bengkel</p>
            <div style="height: 80px;"></div> <!-- Space untuk tanda tangan -->
            <p><strong>(__________________)</strong></p>
        </div>
        <div class="right-signature" style="text-align: center; width: 40%;">
            <p>Service Advisor</p>
            <div style="height: 80px;"></div> <!-- Space untuk tanda tangan -->
            <p><strong>(__________________)</strong></p>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>