<!DOCTYPE html>
<html class="loading" lang="en">
  <!-- head -->
  <?php $this->load->view("admin/includes/header"); ?>
  <body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    <?php $this->load->view("admin/includes/top"); ?>
    <!-- Sidebar -->
    <?php $this->load->view("admin/includes/sidebar"); ?>


     {_yield} 
   
    <!-- footer -->
    <?php $this->load->view("admin/includes/footer"); ?>
    <?php $this->load->view("admin/includes/scripts"); ?>
  </body>
</html>