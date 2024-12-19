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
    <!-- <header>
        <div class="logo" style="text-align: left;">
            <img src="<?= base_url('dist/assets/img/kop.png') ?>" alt="Logo Perusahaan" style="width: 250px; height: auto;">
        </div>
        <div class="header-info">
            <p><strong>TITANIUM AUTO BODY REPAIR</strong></p>
            <p>Jl. Puspowarno Tengah No. 3, Semarang</p>
            <p>Telp: 024-7318330 / 08121574152</p>
            <p>Email: titanium_autobodyrepair@yahoo.com</p>
        </div>
    </header> -->

    <div class="title">PERINTAH KERJA BENGKEL</div>

    <section>
        <table style="border: none; width: 100%;">
            <tr>
                <td style="border: none; width: 15%;">No. RO</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $ro['id_terima_po'] ?? '-' ?></td>
                <td style="border: none; width: 15%;">Nopol</td>
                <td style="border: none; width: 1%;">:</td>
                <td style="border: none; width: 34%;"><?= $ro['no_kendaraan'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Asuransi</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['asuransi'] ?? '-' ?></td>
                <td style="border: none;">Merk/Type</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['jenis_mobil'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Tgl. SPK</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= date('d-m-Y') ?></td>
                <td style="border: none;">Nopol</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['no_kendaraan'] ?? '-' ?></td>
            </tr>
            <tr>
                <td style="border: none;">Warna</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['warna'] ?? '-' ?></td>
                <td style="border: none;">Service Advisor</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $ro['username'] ?? '-' ?></td>
            </tr>
            <tr>

            </tr>
        </table>
    </section>

    <h4 class="section-title">A. Jasa</h4>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Jasa</th>
                <th style="text-align: center;">K</th>
                <th style="text-align: center;">C</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengerjaan as $index => $p): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $p['nama_pengerjaan'] ?? '-' ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="section-title">B. Sparepart</h4>
    <table>
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Sparepart</th>
                <th style="text-align: center;">Tgl Part Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sparepartPesanan as $index => $sp): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $sp['nama_sparepart'] ?? '-' ?></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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