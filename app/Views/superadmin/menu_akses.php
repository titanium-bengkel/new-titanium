<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <h4 class="ms-3 mb-4">Pengelolaan Menu</h4>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <!-- Tombol Tambah -->
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLevelModal">
                        <i class="fas fa-plus"></i>
                    </button>
                    <!-- Filter By -->
                    <div class="d-flex align-items-center gap-2 flex-grow-1 mr-3">
                        <label for="filterby" class="mb-0"><strong>FilterBy</strong></label>
                        <select class="form-select" id="filterby" name="filterby">
                            <option value="-">All Level</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <h6 class="mb-0">List Data Level</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="levelTable" class="table table-bordered mb-0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>ID Level</th>
                                    <th>Nama Group</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if (!empty($levels)) : ?>
                                    <?php foreach ($levels as $level) : ?>
                                        <tr>
                                            <td><?= $level['id']; ?></td>
                                            <td><?= $level['keterangan']; ?></td>
                                            <td><?= $level['status']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm edit-level-btn" data-bs-toggle="modal" data-bs-target="#editLevelModal" data-id="<?= $level['id']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data level yang tersedia.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Adding Level -->
<div class="modal fade" id="addLevelModal" tabindex="-1" role="dialog" aria-labelledby="addLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLevelModalLabel">Tambah Level Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addLevelForm" action="<?= base_url('/supercontroller/createLevel'); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateby" class="form-label">Update By</label>
                        <input type="text" class="form-control" id="updateby" name="updateby" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="-">-</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Editing Level -->
<div class="modal fade" id="editLevelModal" tabindex="-1" role="dialog" aria-labelledby="editLevelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLevelModalLabel">Edit Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editLevelForm" action="<?= base_url('/supercontroller/updateLevel'); ?>" method="post">
                <input type="hidden" id="edit_level_id" name="edit_level_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" name="keterangan" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_updateby" class="form-label">Update By</label>
                        <input type="text" class="form-control" id="edit_updateby" name="updateby" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="-">-</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script>
    $(document).ready(function() {
        $('#levelTable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [5, 10, 25, 50],
            "pageLength": 10,
            "order": [
                [1, 'asc']
            ]
        });

        // Mengisi data pada form edit saat tombol edit ditekan
        $('#editLevelModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var levelId = button.data('id');
            var modal = $(this);

            // Mengisi nilai pada form edit
            modal.find('#edit_level_id').val(levelId);
            modal.find('#edit_keterangan').val(button.closest('tr').find('td:eq(1)').text().trim());
            modal.find('#edit_updateby').val(button.closest('tr').find('td:eq(3)').text().trim());
            modal.find('#edit_status').val(button.closest('tr').find('td:eq(4)').text().trim());
        });
    });
</script>

<?= $this->endSection() ?>