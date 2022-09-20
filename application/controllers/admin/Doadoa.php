<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doadoa extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('doadoa_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data doadoa
	public function index()
	{
		$doadoa = $this->doadoa_model->listing();
		$data = array('title' => 'Data Doa Sehari - Hari',
					   'doadoa' => $doadoa,
						'isi' => 'admin/doadoa/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah doadoa
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[doadoa.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat doadoa baru.']);



			if($valid->run()) {

				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '2400';//dalam kb
				$config['max_width']     = '4024';
				$config['max_height']    = '4024';
	
				$this->load->library('upload', $config);
	
				
				if ( ! $this->upload->do_upload('gambar')){
				
				//end validasi
				$data = array( 'title' => 'Tambah Doa Sehari - Hari',
								'error'		=> $this->upload->display_errors(),
								'isi'   => 'admin/doadoa/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);
				//masuk data
				}else{
	
				$upload_gambar = array('upload_data' => $this->upload->data());
				//create thumbnail gambar
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
				//lokasi folder thumbnail
				$config['new_image']		= './assets/upload/image/doaseharihari/';
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width']         	= 250;//ukuran pixel
				$config['height']       	= 250;//ukuran pixel
				$config['thumb_marker']		= '';
	
				$this->load->library('image_lib', $config);
	
				$this->image_lib->resize();
				//end create thumbnail
				$i = $this->input;
				$data = array('nama'	    =>$i->post('nama'),
								//yang disimpan nama file gambar
								'image'				=>$upload_gambar['upload_data']['file_name']
							);
	
					$this->doadoa_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/doadoa'),'refresh');
				}
			}
			//end masuk database
			$data = array( 'title' => 'Tambah Status Kajian',
							'isi'   => 'admin/doadoa/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);	
			
	}

	//delete doadoa
	public function delete($id){
		$data = array('id' => $id);
		$this->doadoa_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/doadoa'),'refresh');
	}

	//Edit doadoa
	public function edit($id)
	{
		//ambil data doadoa yang akan di edit
		$doadoa 	= $this->doadoa_model->detail($id);
		
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
			$config['max_width']     = '4024';
			$config['max_height']    = '4024';

			$this->load->library('upload', $config);

			
			if ( ! $this->upload->do_upload('gambar')){
			
			//end validasi
			$data = array( 'title' => 'Edit Doa  : '.$doadoa->nama,
							'doadoa'	=>$doadoa,
							'error'		=> $this->upload->display_errors(),
							'isi'   => 'admin/doadoa/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
			}else{

			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/doaseharihari/';
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
						  //yang disimpan nama file gambar
						  'image'				=>$upload_gambar['upload_data']['file_name']
						);

			$this->doadoa_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/doadoa'),'refresh');
			}}else{
				//edit doadoa tanpa ganti gambar
			$i = $this->input;
			$data = array('id'			=>$id,
					  'nama'         =>$i->post('nama')
					);
			$this->doadoa_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/doadoa'),'refresh');
			}}
		//end masuk database
		$data = array( 'title' => 'Edit Status Kajian : '.$doadoa->nama,
						'doadoa'	=>$doadoa,
						'isi'   => 'admin/doadoa/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

}

/* End of file doadoa.php */
/* Location: ./application/controllers/admin/doadoa.php */