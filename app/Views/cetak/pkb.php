<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="application/pdf">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perintah Kerja Bengkel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
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
            font-size: 14px;
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
    <div class="title">PERINTAH KERJA BENGKEL</div>
    <section>
        <table style="border: none; width: 100%; line-height: 0.1;">
            <tr>
                <td style="border: none; width: 15%;">No. Order</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $ro['id_terima_po'] ?? '-' ?></td>
                <td style="border: none; width: 15%;">Nopol</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $ro['no_kendaraan'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Tgl. Order</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['tgl_masuk'] ?? '-' ?></td>
                <td style="border: none;">Merk/Type</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['jenis_mobil'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">SA</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['user_id'] ?? '-' ?></td>
                <td style="border: none;">No. Rangka</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['no_rangka'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Est. Produksi</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['tgl_masuk'] ?? '-' ?></td>
                <td style="border: none;">Customer</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['customer_name'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Est. Selesai</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['tgl_keluar'] ?? '-' ?></td>
                <td style="border: none;">Alamat</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['alamat'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Asuransi</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['asuransi'] ?? '-' ?></td>
                <td style="border: none;">Telp.</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['no_contact'] ?? '-' ?></td>
            </tr>
        </table>
    </section>

    <div style="border: none; width: 100%; line-height: 0.1;">
        <!-- Tabel pertama (Order Pekerjaan) -->
        <div class="row">
            <div class="col-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: center; border: 1px solid #000;">No.</th>
                            <th style="text-align: center; border: 1px solid #000;">Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengerjaan as $index => $p): ?>
                            <tr>
                                <td style="text-align: center; border: 1px solid #000;"><?= $index + 1 ?></td>
                                <td style="border: 1px solid #000;"><?= $p['nama_pengerjaan'] ?? '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel tambahan -->
        <div style="margin-top: 20px;">
            <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
                <!-- Baris Keluhan dan Permintaan -->
                <tr>
                    <td style="width: 50%; border: 1px solid #000; padding: 20px; height: 50px; vertical-align: top;">
                        <u>Keluhan Customer:</u><br><br><br>
                    </td>
                    <td style="width: 50%; border: 1px solid #000; padding: 20px; height: 50px; vertical-align: top;">
                        <u>Permintaan Customer:</u><br><br><br>
                    </td>
                </tr>

                <!-- Baris Catatan -->
                <tr>
                    <td colspan="2" style="border: 1px solid #000; padding: 20px; height: 20px; vertical-align: top;">
                        Catatan:<br><br><br>
                    </td>
                </tr>

                <!-- Baris Tanda Tangan -->
                <tr>
                    <td style="border: 1px solid #000; text-align: center; height: 80px; vertical-align: bottom;">
                        <?= $ro['customer_name'] ?? '-' ?><br><br><br><br><br>
                    </td>
                    <td style="border: 1px solid #000; text-align: center; height: 80px; vertical-align: bottom;">
                        <?= $ro['user_id'] ?? '-' ?><br><br><br><br><br>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>