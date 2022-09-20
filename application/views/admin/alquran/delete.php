<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?php echo $alquran->id ?>">
  <i class="fas fa-trash"></i>
</button>

<div class="modal fade" id="delete-<?php echo $alquran->id ?>">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-titl text-center">Hapus Data Al-Quran</h4>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <div class="callout callout-warning">
	      	<h4>Peringatan!</h4>
	      	Yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan
	      	
	      </div>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Close</button>
	      <a href="<?php echo base_url('admin/alquran/delete/'.$alquran->id) ?>" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>Ya, Hapus Data Ini</a>
	    </div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
