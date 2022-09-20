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
              <li class="breadcrumb-item active">Data Jadwal Kajian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <div class="container-fluid">
              <!--main utama -->
          <div class="card">
            <div class="card-header">
             <a href="<?php echo base_url('admin/jkajian/tambah') ?>" class="btn btn-primary btn-lg"><i class="fa fa-plus-circle"> Tambah Data</i> </a>
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
                <th>Waktu</th>
                <th>Tempat</th>
                <th>Gambar</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; 
              foreach($jkajian as $jkajian) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $jkajian->nama?></td>
                <td><?php echo date('d F Y, h:i A', strtotime($jkajian->waktu))?></td>
                <td><?php echo $jkajian->tempat?></td>
                <td><img src="<?php echo base_url('assets/upload/image/jadwalkajian/'.$jkajian->gambar) ?>" class="img img-responsive img-thumbnail" width="80" height="80"></td>
                <td><?php echo $jkajian->keterangan?></td>
                <td><?php echo $jkajian->status ?></td>
                <td>
                    <?php include('delete.php') ?>

                  <?php echo anchor('admin/jkajian/edit/'.$jkajian->id, '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div> ') ?> </td>

              </tr>
            <?php } ?>
            </tbody>
          </table>

      </div><!-- /.container-fluid -->

</div>
