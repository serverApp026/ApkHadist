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

		        <?php
		        //error upload
		        if(isset($error)) {
		        	echo '<p class="alert alert-warning">';
		        	echo $error;
		        	echo '</p>';
		        } 

			//Notofikasi Error
				echo validation_errors('<div class="alert alert-warning">', '</div>');

				//form open
				echo form_open_multipart(base_url('admin/jkajian/tambah'), ' class="form_horizontal"');
				 ?>
					 <div class="card">
            			<div class="card-header">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Nama Jadwal</label>
								<div class="col-md-5">
								  <input type="text" name="nama" class="form-control"  placeholder="Nama Jadwal" value="<?php echo set_value('nama') ?>" required>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-md-2 col-form-label">Waktu Kajian</label>
								<div class="col-md-5">
								  <input type="datetime-local" name="waktu" class="form-control"  placeholder="Waktu Kajian" value="<?php echo set_value('waktu') ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Tempat Kajian</label>
								<div class="col-md-5">
								  <input type="text" name="tempat" class="form-control"  placeholder="Tempat Kajian" value="<?php echo set_value('tempat') ?>" required>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Upload Gambar</label>
								<div class="col-md-5">
								 <input type="file" name="gambar" class="form-control p-1" required="required">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Keterangan</label>
								<div class="col-md-5">
								  <textarea  name="keterangan" id="keterangan" class="form-control"  placeholder="Keterangan Jadwal Kajian" value="<?php echo set_value('keterangan') ?>" rows="10" required></textarea>
								</div>
							</div>

							
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Status</label>
								<div class="col-md-5">
								<select name="status" class="form-control">
								  		<option value="Belum Selesai">
								  			Belum Selesai
								  		</option>
								  		<option value="Selesai">
								  			Selesai
								  		</option>
								  	
								  </select>
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
