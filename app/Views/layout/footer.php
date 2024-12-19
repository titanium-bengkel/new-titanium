<footer>
    <div class="footer clearfix text-muted w-100" style="text-align: center; width: 100%; color: white;">
        <p>2024 &copy; Titanium</p>
    </div>

</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<!-- Perfect Scrollbar -->
<script src="<?= base_url('../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>

<!-- Apexcharts -->
<script src="<?= base_url('../dist/assets/extensions/apexcharts/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('../dist/assets/static/js/pages/dashboard.js'); ?>"></script>

<!-- Dark Mode -->
<script src="<?= base_url('../dist/assets/static/js/components/dark.js'); ?>"></script>

<!-- App JS -->
<script src="<?= base_url('../dist/assets/compiled/js/app.js'); ?>"></script>

<!-- Flatpickr -->
<script src="<?= base_url('../dist/assets/extensions/flatpickr/flatpickr.min.js'); ?>"></script>
<script src="<?= base_url('../dist/assets/static/js/pages/date-picker.js'); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
function toggleDropdown(event) {
    event.preventDefault();
    const submenuDropdown = event.target.nextElementSibling;

    // Mengecek dan mengubah display dropdown
    if (submenuDropdown.style.display === "none" || submenuDropdown.style.display === "") {
        submenuDropdown.style.display = "block";
    } else {
        submenuDropdown.style.display = "none";
    }
}
</script>