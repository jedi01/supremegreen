
<?php if($this->session->flashdata('success')) { ?>
<script type="text/javascript">
  toastr.success('<?php echo $this->session->userdata("success"); ?>');
</script>

<?php } ?>
<?php if($this->session->flashdata('delete')) { ?>
<script type="text/javascript">
  toastr.error('<?php echo $this->session->userdata("delete"); ?>');
</script>

<?php } ?>


<?php if($this->session->flashdata('error')) { ?>
<script type="text/javascript">
  toastr.error('<?php echo $this->session->userdata("error"); ?>');
</script>

<?php } ?>


 <!-- BEGIN PAGE VENDOR JS-->

    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
    <script src="app-assets/data/jvector/visitor-data.js"></script>
        <script src="app-assets/vendors/js/charts/chartist.min.js"></script>
    <script src="app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"></script>
    <script src="app-assets/vendors/js/charts/raphael-min.js"></script>
    <script src="app-assets/vendors/js/charts/morris.min.js"></script>
    <script src="app-assets/vendors/js/timeline/horizontal-timeline.js"></script>
     <!-- BEGIN PAGE VENDOR JS-->
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/tables/jszip.min.js"></script>
    <script src="app-assets/vendors/js/tables/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/vfs_fonts.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.print.min.js"></script>
    <script src="app-assets/vendors/js/tables/buttons.colVis.min.js"></script>
    <script src="app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
    <script src="app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
 <script src="app-assets/js/scripts/forms/checkbox-radio.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/customizer.js"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js"></script>
    <script src="app-assets/js/scripts/forms/validation/form-validation.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="app-assets/js/scripts/forms/form-login-register.js"></script>

 <script src="app-assets/js/scripts/extensions/toastr.js"></script>
 <script src="app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
    <!-- END PAGE LEVEL JS-->
        <!-- BEGIN VENDOR JS-->
       <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
            $(".form").jqBootstrapValidation();


        });

    </script>
  
    <!-- BEGIN VENDOR JS-->

     