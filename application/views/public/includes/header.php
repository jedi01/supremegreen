<!DOCTYPE html>
<html>
<head>

	<title><?php echo $title; ?></title>
	<base href="<?php echo base_url();?>">
    <script>
    var base_url = '<?php echo base_url(); ?>';
    </script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="app-assets/plugins/jqueryConfirm/jquery-confirm.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/animate.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
 	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="assets/js/custom/customScript.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.css">
	<link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/toastr.css">
	<script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
	<script src="app-assets/js/scripts/extensions/toastr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="app-assets/plugins/jqueryConfirm/jquery-confirm.min.js"></script>
	<script type="text/javascript">
        
      function toasterOptions() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "3000",
            "hideDuration": "2000",
            "timeOut": "3000",
            "extendedTimeOut": "2000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
      };
      
      toasterOptions();

    </script>
	
</head>
<body class="<?php echo $class; ?>"  id="main">

