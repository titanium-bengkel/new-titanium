<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>

<table class="table">
    <thead>
        <tr>
            <th>ID Terima PO</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ro as $order): ?>
        <tr>
            <td><?= $order['id_terima_po']; ?></td>
            <td>
                <button class="btn btn-primary" onclick="showUpdateForm('<?= $order['id_terima_po']; ?>')">Update
                    Progress</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="updateForm" style="display:none;">
    <h3>Update Progress</h3>
    <form action="<?= base_url('produksi/update'); ?>" method="post">
        <input type="hidden" name="id_terima_po" id="id_terima_po">
        <div class="form-group">
            <label for="progress">Progress</label>
            <input type="text" name="progress" id="progress" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-secondary" onclick="hideUpdateForm()">Cancel</button>
    </form>
</div>




<?= $this->endSection() ?>