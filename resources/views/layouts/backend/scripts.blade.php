<!-- BEGIN: Vendor JS-->
<script src="{{ asset('Assets/Backend/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/pickers/pickadate/picker.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/pickers/pickadate/legacy.js') }}"></script>
<script src="{{ asset('Assets/Backend/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('Assets/Backend/js/core/app-menu.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('Assets/Backend/js/scripts/tables/table-datatables-advanced.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/scripts/forms/form-select2.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/scripts/forms/pickers/form-pickers.js') }}"></script>
<script src="{{ asset('Assets/Backend/js/scripts/components/components-modals.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x.x/dist/js/bootstrap.bundle.min.js"></script>
<!-- CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- END: Page JS-->
<!-- Tambahkan di dalam <head> layout -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    // Inisialisasi CKEditor pada textarea dengan id 'description'
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
