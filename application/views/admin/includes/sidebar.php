<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class=" nav-item">
        <a href="<?php echo base_url('admin/dashboard'); ?>"> <i class="fa fa-home"></i> <span class="menu-title" data-i18n="">Dashboard</span> </a>
      </li>
      <li class=" nav-item">
        <a href="javascript:;"> <i class="fa fa-pie-chart"></i> <span class="menu-title" data-i18n="nav.dash.main">Category</span> </a>
        <ul class="menu-content">
          <li><a class="menu-item" href="<?php echo base_url('admin/category/manage_view'); ?>" data-i18n="nav.dash.ecommerce">Add Category</a> </li>
          <li><a class="menu-item" href="<?php echo base_url('admin/category/'); ?>" data-i18n="nav.dash.crypto">View Category</a> </li>
        </ul>
      </li>
      <li class=" nav-item">
        <a href="javascript:;"> <i class="fa fa-heart"></i> <span class="menu-title" data-i18n="nav.dash.main">Ingredients</span> </a>
        <ul class="menu-content">
          <li><a class="menu-item" href="<?php echo base_url('admin/ingredients/manage_view'); ?>" data-i18n="nav.dash.ecommerce">Add Ingredients</a> </li>
          <li><a class="menu-item" href="<?php echo base_url('admin/ingredients/'); ?>" data-i18n="nav.dash.crypto">View Ingredients</a> </li>
        </ul>
      </li>

      <li class=" nav-item">
        <a href="javascript:;"> <i class="fa fa-archive"></i> <span class="menu-title" data-i18n="nav.dash.main">Products</span> </a>
        <ul class="menu-content">
          <li><a class="menu-item" href="<?php echo base_url('admin/products/manage_view'); ?>" data-i18n="nav.dash.ecommerce">Add Products</a> </li>
          <li><a class="menu-item" href="<?php echo base_url('admin/products/'); ?>" data-i18n="nav.dash.crypto">View Products</a> </li>
          <!-- <li><a class="menu-item" href="<?php echo base_url('admin/drinks/manage_view'); ?>" data-i18n="nav.dash.ecommerce">Add Drinks</a> </li> -->
          <li><a class="menu-item" href="<?php echo base_url('admin/drinks/'); ?>" data-i18n="nav.dash.crypto">View Drinks</a> </li>
        </ul>
      </li>

      <li class=" nav-item">
        <a href="javascript:;"> <i class="fa fa-shopping-cart"></i> <span class="menu-title" data-i18n="nav.dash.main">Orders</span> </a>
        <ul class="menu-content">
          <li><a class="menu-item" href="<?php echo base_url('admin/orders/index'); ?>" data-i18n="nav.dash.ecommerce">Orders</a> </li>
        </ul>
      </li>

      <li class=" nav-item">
        <a href="javascript:;"> <i class="fa fa-users"></i> <span class="menu-title" data-i18n="nav.dash.main">Users</span> </a>
        <ul class="menu-content">
          <li><a class="menu-item" href="<?php echo base_url('admin/users/index'); ?>" data-i18n="nav.dash.ecommerce">Users</a> </li>
        </ul>
      </li>

    </ul>
  </div>
</div>