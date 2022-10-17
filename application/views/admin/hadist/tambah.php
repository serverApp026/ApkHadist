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
				echo form_open_multipart(base_url('admin/hadist/tambah'), ' class="form_horizontal"');
				 ?>
					 <div class="card">
            			<div class="card-header">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Tema</label>
								<div class="col-md-5">
								  <input type="text" name="tema" class="form-control"  placeholder="Tema" value="<?php echo set_value('tema') ?>" required>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-md-2 col-form-label">Arab</label>
								<div class="col-md-5">
								  <textarea  name="arab" id="arab" class="form-control"  placeholder="tulisan Arabnya" value="<?php echo set_value('arab') ?>" rows="10" required></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Terjemahan</label>
								<div class="col-md-5">
								  <textarea  name="terjemahan" id="terjemahan" class="form-control"  placeholder="Terjemahan" value="<?php echo set_value('terjemahan') ?>" rows="10" required></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Keterangan</label>
								<div class="col-md-5">
								  <textarea  name="keterangan" id="keterangan" class="form-control"  placeholder="Keterangan Hadist" value="<?php echo set_value('keterangan') ?>" rows="10" required></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-md-2 col-form-label">Nomor Hadist</label>
								<div class="col-md-5">
								  <input type="text" name="no_hadist" class="form-control"  placeholder="Nomor Hadist" value="<?php echo set_value('no_hadist') ?>" required>
								</div>
							</div>

							
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Ahli Hadist</label>
								<div class="col-md-5">
								  <select name="ahli_hadist" class="form-control">
								  	<?php foreach ($kategorihadist as $kategorihadist) { ?>
								  		<option value="<?php echo $kategorihadist->nama ?>">
								  			<?php  echo $kategorihadist->nama ?>
								  		</option>
								  	<?php } ?>
								  	
								  </select>
								</div>
							</div>


							<div class="form-group row">
								<label class="col-md-2 col-form-label">Jenis Hadist</label>
								<div class="col-md-5">
								<select name="jenis_hadist" class="form-control">
								  		<option value="Belum Selesai">
								  			Tidak Ada
								  		</option>
								  		<option value="Selesai">
								  			Shahih
								  		</option>
								  		<option value="Selesai">
								  			Hasan
								  		</option>
								  		<option value="Selesai">
								  			Dhaif
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
