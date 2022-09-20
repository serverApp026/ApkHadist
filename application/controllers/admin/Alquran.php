<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alquran extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('alquran_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data alquran
	public function index()
	{
		$alquran = $this->alquran_model->listing();
		$data = array('title' => 'Data Al-Quran',
					   'alquran' => $alquran,
						'isi' => 'admin/alquran/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah alquran
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[alquran.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat alquran baru.']);


		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Tambah Data Al-Quran',
							'isi'   => 'admin/alquran/tambah'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('nama'	    =>$i->post('nama'),
						  'jumlahayat'	    =>$i->post('jumlahayat'),
						  'jumlahayat'	    =>$i->post('jumlahayat'),
						  'surahKe'	    =>$i->post('surahKe'),
					);
			$this->alquran_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/alquran'),'refresh');
		}
		//end masuk data	
	}

	//delete alquran
	public function delete($id){
		$data = array('id' => $id);
		$this->alquran_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/alquran'),'refresh');
	}

	//Edit alquran
	public function edit($id)
	{
		$alquran = $this->alquran_model->detail($id);

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama', 'Nama', 'required',
				array('required' => '%s harus diisi'));

		

		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Edit Data Al-Quran',
							'alquran' => $alquran,
							'isi'   => 'admin/alquran/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('id'		    =>$id,
						  'nama'	    =>$i->post('nama'),
						  'jumlahayat'	    =>$i->post('jumlahayat'),
						  'surahKe'	    =>$i->post('surahKe')
					);
			$this->alquran_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/alquran'),'refresh');
		}
		//end masuk data	
	}



}

/* End of file alquran.php */
/* Location: ./application/controllers/admin/alquran.php */