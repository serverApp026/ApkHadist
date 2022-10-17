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
              <li class="breadcrumb-item active">Data kategori Hadist</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <div class="container-fluid">
              <!--main utama -->

		        <?php 
			//Notofikasi Error
				echo validation_errors('<div class="alert alert-warning">', '</div>');

				//form open
				echo form_open(base_url('admin/kategorihadist/edit/'.$kategorihadist->id), ' class="form_horizontal"');
				 ?>
					 <div class="card">
            			<div class="card-header">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Nama Ahli Hadist</label>
								<div class="col-md-5">
								  <input type="text" name="nama" class="form-control"  placeholder="Nama Ahli Hadist" value="<?php echo $kategorihadist->nama ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Sejarah</label>
								<div class="col-md-5">
								  <textarea  name="sejarah" id="sejarah" class="form-control"  placeholder="Keterangan Hadist" value="<?php echo $kategorihadist->sejarah ?>" rows="10" required><?php echo $kategorihadist->sejarah ?></textarea>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-md-2 col-form-label"></label>
								<div class="col-md-5">
								  <button class="btn btn-success btn-lg" name="submit" type="submit">
								  	<i class="fas fa-save"></i>  Simpan
								  </button>
								   <button class="btn btn-info btn-lg" name="reset" type="reset">
								  	<i class="fas fa-times"></i>  Reset
								  </button>
								</div>
							</div>

					 	</div>
					 </div>
		 		<?php echo form_close(); ?>

      </div><!-- /.container-fluid -->



      </div>
    </div>
  </div>
</div>
</div>

<script>
     CKEDITOR.replace( 'sejarah' );
 </script>