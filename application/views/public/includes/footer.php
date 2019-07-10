

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



<script>
function openMenu(){
    document.getElementById("mainMenu").style.width="20%";  
     document.getElementById("main").style.marginRight = "20%";  
}
function closeMenu() {
    document.getElementById("mainMenu").style.width = "0";
    document.getElementById("main").style.marginRight= "0";
}

function openHamburger(){
	document.getElementById("mySidenav").style.width="100%";	
}
function openNav() {
    $(document).ready(function () {
  $('.hide').css("display","none");
    })
    document.getElementById("mySidenav").style.width = "20%";
    document.getElementById("main").style.marginLeft = "20%";
}
function closeNav() {
     $(document).ready(function () {
  $('.hide').css("display","block");
    })
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}
function goBack() {
    window.history.go(-1);
}




</script>
</body>
</html>