<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo base_url() ?>assets/admin/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MyAdmin </span>
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
            <a href="<?php echo base_url('admin/kategorihadist') ?>" class="nav-link">
              <i class="fas fa-table nav-icon"></i>
              <p>Kategori Hadist</p>
            </a>
          </li>
        <!-- end tambah menu -->
         
        <!-- tambah kategori menu -->
          <li class="nav-item">
            <a href="<?php echo base_url('admin/hadist') ?>" class="nav-link">
              <i class="fas fa-book nav-icon"></i>
              <p>Hadist</p>
            </a>
          </li>
        <!-- end tambah kategori menu -->
        

      

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

  