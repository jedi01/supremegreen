
    <?php $this->load->view("admin/includes/header"); ?>
     <body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0 pb-0">
                                <div class="card-title text-center">
                                    <img src="app-assets/images/logo/logo-dark.png" alt="branding logo">
                                </div>
                               
                            </div>
                            <div class="card-content">
               
                                
                                <div class="card-body">
                                    <form class="form-horizontal" method="POST" action="<?php echo base_url('authenticate'); ?>" novalidate>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email Address" required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                            <div class="form-control-position">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </fieldset>
                                        <input type="hidden" name="role" value="<?php echo $role; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-block"><i class="ft-unlock"></i> Login</button>
                                    </form>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
</body>
   <?php $this->load->view("admin/includes/scripts"); ?>