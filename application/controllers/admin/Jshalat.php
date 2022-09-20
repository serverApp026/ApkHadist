<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jshalat extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jshalat_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data jshalat
	public function index()
	{
		$jshalat = $this->jshalat_model->listing();
		$data = array('title' => 'Data Jadwal Shalat',
					   'jshalat' => $jshalat,
						'isi' => 'admin/jshalat/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah jshalat
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[jshalat.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat jshalat baru.']);


		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Tambah Jadwal Shalat',
							'isi'   => 'admin/jshalat/tambah'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('nama'	    =>$i->post('nama'),
						  'waktu'	    =>$i->post('waktu')
					);
			$this->jshalat_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/jshalat'),'refresh');
		}
		//end masuk data	
	}

	//delete jshalat
	public function delete($id){
		$data = array('id' => $id);
		$this->jshalat_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/jshalat'),'refresh');
	}

	//Edit jshalat
	public function edit($id)
	{
		$jshalat = $this->jshalat_model->detail($id);

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama', 'Nama', 'required',
				array('required' => '%s harus diisi'));

		

		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Edit jadwal shalat',
							'jshalat' => $jshalat,
							'isi'   => 'admin/jshalat/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('id'		    =>$id,
						  'nama'	    =>$i->post('nama'),
						  'waktu'	    =>$i->post('waktu')
					);
			$this->jshalat_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/jshalat'),'refresh');
		}
		//end masuk data	
	}



}

/* End of file jshalat.php */
/* Location: ./application/controllers/admin/jshalat.php */