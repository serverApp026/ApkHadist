<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategorihadist extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategorihadist_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data kategorihadist
	public function index()
	{
		$kategorihadist = $this->kategorihadist_model->listing();
		$data = array('title' => 'Data Kategori Hadist',
					   'kategorihadist' => $kategorihadist,
						'isi' => 'admin/kategorihadist/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah kategorihadist
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[kategorihadist.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat kategorihadist baru.']);


		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Tambah Kategori Hadist',
							'isi'   => 'admin/kategorihadist/tambah'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('nama'	    =>$i->post('nama'),
							'sejarah'	    =>$i->post('sejarah')
					);
			$this->kategorihadist_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/kategorihadist'),'refresh');
		}
		//end masuk data	
	}

	//delete kategorihadist
	public function delete($id){
		$data = array('id' => $id);
		$this->kategorihadist_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/kategorihadist'),'refresh');
	}

	//Edit kategorihadist
	public function edit($id)
	{
		$kategorihadist = $this->kategorihadist_model->detail($id);

		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama', 'Nama', 'required',
				array('required' => '%s harus diisi'));

		

		if($valid->run()===FALSE) {
			//end validasi
			$data = array( 'title' => 'Edit jadwal shalat',
							'kategorihadist' => $kategorihadist,
							'isi'   => 'admin/kategorihadist/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
		}else{
			$i = $this->input;
			$data = array('id'		    =>$id,
						  'nama'	    =>$i->post('nama'),
						  'sejarah'	    =>$i->post('sejarah')
					);
			$this->kategorihadist_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/kategorihadist'),'refresh');
		}
		//end masuk data	
	}



}

/* End of file kategorihadist.php */
/* Location: ./application/controllers/admin/kategorihadist.php */