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
		
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama', 'Nama', 'required',
				array('required' => '%s harus diisi'));
		if($valid->run()) {
			//check jika gambar diganti
			if(!empty($_FILES['gambar']['name'])){

			
			$config['upload_path']   = './assets/upload/image/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '2400';//dalam kb
			$config['max_width']     = '2024';
			$config['max_height']    = '2024';

			$this->load->library('upload', $config);

			
			if ( ! $this->upload->do_upload('gambar')){
			
			//end validasi
			$data = array( 'title' => 'Edit hadist: '.$hadist->nama,
							'hadist'	=>$hadist,
							'error'		=> $this->upload->display_errors(),
							'isi'   => 'admin/hadist/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
			}else{

			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/jadwalkajian/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//ukuran pixel
			$config['height']       	= 250;//ukuran pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail
			
			$i = $this->input;
			$data = array('id'			=>$id,
						  'nama'		    =>$i->post('nama'),
						  'waktu'				=>$i->post('waktu'),
						  'tempat'				=>$i->post('tempat'),
						  //yang disimpan nama file gambar
						  'gambar'				=>$upload_gambar['upload_data']['file_name'],
						  'keterangan'		=>$i->post('keterangan'),
						  'status'		=>$i->post('status')
						);

			$this->hadist_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/hadist'),'refresh');
			}}else{
				//edit hadist tanpa ganti gambar
			$i = $this->input;
			$data = array('id'			=>$id,
					  'nama'         =>$i->post('nama'),
					  'waktu'				=>$i->post('waktu'),
					  'tempat'		    =>$i->post('tempat'),
					  'keterangan'		    =>$i->post('keterangan'),
					  //yang disimpan nama file gambar(gambar tidak diganti)
					  //'gambar'				=>$upload_gambar['upload_data']['file_name'],
					  'status'		=>$i->post('status')
					);

			$this->hadist_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/hadist'),'refresh');
			}}
		//end masuk database
		$data = array( 'title' => 'Edit hadist: '.$hadist->nama,
						'hadist'	=>$hadist,
						'isi'   => 'admin/hadist/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

}

/* End of file hadist.php */
/* Location: ./application/controllers/admin/hadist.php */