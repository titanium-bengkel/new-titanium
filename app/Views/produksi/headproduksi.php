<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<table>
    <thead>
        <tr>
            <th>ID Terima PO</th>
            <th>Progres Pengerjaan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ro as $item): ?>
        <tr>
            <td><?= $item['id_terima_po'] ?></td>
            <td><?= $item['progres_pengerjaan'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>




<?= $this->endSection() ?>