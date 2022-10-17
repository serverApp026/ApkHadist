<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hadist extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hadist_model');
		$this->load->model('kategorihadist_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data hadist
	public function index()
	{
		$hadist = $this->hadist_model->listing();
		$data = array('title' => 'Data Jadwal Kajian Menu',
					   'hadist' => $hadist,
						'isi' => 'admin/hadist/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah hadist
	public function tambah()
	{
		//Ambil data kategori
		$kategorihadist = $this->kategorihadist_model->listing();
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('arab', 'arab', 'required|trim|is_unique[hadist.arab]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat hadist baru.']);



			if($valid->run()===FALSE) {
			
				//end validasi
				$data = array( 'title' => 'Tambah Hadist',
								'kategorihadist' 	=>$kategorihadist,
								'isi'   => 'admin/hadist/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);
				//masuk data
				}else{
				
				$i = $this->input;
				$data = array('tema'	    =>$i->post('tema'),
							  'arab'	    =>$i->post('arab'),
							  'terjemahan'	    =>$i->post('terjemahan'),
								'keterangan'		=>$i->post('keterangan'),
								'no_hadist'		=>$i->post('no_hadist'),
								'ahli_hadist'		=>$i->post('ahli_hadist'),
								'jenis_hadist'		=>$i->post('jenis_hadist'),
							);
	
					$this->hadist_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/hadist'),'refresh');
				}
			//end masuk database
			
	}

	//delete hadist
	public function delete($id){
		$data = array('id' => $id);
		$this->hadist_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/hadist'),'refresh');
	}

	//Edit hadist
	public function edit($id)
	{
		//ambil data hadist yang akan di edit
		$hadist 	= $this->hadist_model->detail($id);
		
		//Ambil data kategori
		$kategorihadist = $this->kategorihadist_model->listing();
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('arab', 'arab', 'required',
				array('required' => '%s harus diisi'));


			if($valid->run()===FALSE) {
			
				//end validasi
				$data = array( 'title' => 'Edit Hadist',
								'hadist' => $hadist,
								'kategorihadist' 	=>$kategorihadist,
								'isi'   => 'admin/hadist/edit'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);
				//masuk data
				}else{
				
				$i = $this->input;
				$data = array('id'     => $id,
							 'tema'	    =>$i->post('tema'),
							  'arab'	    =>$i->post('arab'),
							  'terjemahan'	    =>$i->post('terjemahan'),
								'keterangan'		=>$i->post('keterangan'),
								'no_hadist'		=>$i->post('no_hadist'),
								'ahli_hadist'		=>$i->post('ahli_hadist'),
								'jenis_hadist'		=>$i->post('jenis_hadist'),
							);
	
					$this->hadist_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/hadist'),'refresh');
				}
			//end masuk database	
	}

}

/* End of file hadist.php */
/* Location: ./application/controllers/admin/hadist.php */