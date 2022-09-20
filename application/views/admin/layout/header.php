<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  
   <div class="navbar-custom-menu ml-auto">
    <!-- Right navbar links -->
    <ul class="navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu ">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="<?php echo base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image --> 
              <li class="user-header ">
                <img src="<?php echo base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                 <?php echo $this->session->userdata('nama'); ?> - <?php echo $this->session->userdata('akses_level'); ?>
                  <small><?php echo date('d M Y') ?></small>
                </p>
              </li>
             
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="float-left">
                  <a href="#" class="btn btn-default btn-flat" hidden>Profile</a>
                </div>
                <div class="float-right">
                  <a href="<?php echo base_url('masuk/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
    </ul>
  </div>
  </nav>
  <!-- /.navbar -->