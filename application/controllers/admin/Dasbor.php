<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//proteksi halaman 
		//load model
		
		$this->load->model('hadist_model');
		
	}
   
	public function index()
	{
		$hadist = $this->hadist_model->hadist();
		// $Jmeja = $this->meja_model->jMeja();
		// $Jmenu = $this->produk_model->Jmenu();
		// $Jpegawai = $this->user_model->Jpegawai();

		$data = array ('title' => 'Dashboard',
					  'hadist'=> $hadist,
					//   'Jmeja'=> $Jmeja,
					//   'Jmenu'			 => $Jmenu,
					//   'Jpegawai'			 => $Jpegawai,
						'isi'  => 'admin/dasbor/list'

						);
		$this->load->view('admin/layout/wrapper', $data);
		
	}

}

/* End of file Dasbor.php */
/* Location: ./application/controllers/admin/Dasbor.php */