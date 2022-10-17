<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <div class="container-fluid">
              <!--main utama -->
          <div class="card">
            <div class="card-header">
             <a href="<?php echo base_url('admin/user/tambah') ?>" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"> Tambah Data</i> </a>
            </div>
            <!-- /.card-header -->
          </div>

        <?php

          if($this->session->flashdata('sukses')){
            echo '<p class="alert alert-success">';
            echo  $this->session->flashdata('sukses');
            echo '</<div>';
         
          }

        ?>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>email</th>
                <th>Akses Level</th>
                <th>password</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; 
              foreach($user as $user) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $user->nama ?></td>
                <td><?php echo $user->email ?></td>
                <td><?php echo $user->akses_level ?></td>
                <td><?php echo $user->password ?></td>
                <td>
                <?php include('delete.php') ?>
                
                <?php echo anchor('admin/user/edit/'.$user->id_user, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div> ') ?> 
              </td>

              </tr>
            <?php } ?>
            </tbody>
          </table>

      </div><!-- /.container-fluid -->

</div>
