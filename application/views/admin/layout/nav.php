<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url() ?>assets/admin/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminMyResto </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU NAVIGATION</li>

           <!-- menu dashboard -->
           <li class="nav-item">
            <a href="<?php echo base_url('admin/dasbor') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <!-- menu dashboard -->
         

        <!-- tambah menu -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/statuskajian') ?>" class="nav-link">
              <i class="fas fa-table nav-icon"></i>
              <p>Data Status Kajian</p>
            </a>
          </li>
        <!-- end tambah menu -->
         
        <!-- tambah kategori menu -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/jkajian') ?>" class="nav-link">
              <i class="fas fa-calendar nav-icon"></i>
              <p>Jadwal Kajian</p>
            </a>
          </li>
        <!-- end tambah kategori menu -->
        
        <!-- tambah meja --> 
          <li class="nav-item">
            <a href="<?php echo base_url('admin/jshalat') ?>" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Jadwal Shalat
              </p>
            </a>
          </li>
        <!-- end tambah menu -->
     

          <!-- menu Data doa seharihari -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/doadoa') ?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Doa Sehari-Hari
              </p>
            </a>
          </li>

        
          <!-- end data -->

          <!-- menu Alquran -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/alquran') ?>" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Alquran
              </p>
            </a>
          </li>

        
          <!-- end data -->

        <!-- menu Users -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/user') ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>

        
          <!-- end menu user -->

         

          

          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  