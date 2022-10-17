<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statuskajian extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('statuskajian_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data statuskajian
	public function index()
	{
		$statuskajian = $this->statuskajian_model->listing();
		$data = array('title' => 'Data Status Harian',
					   'statuskajian' => $statuskajian,
						'isi' => 'admin/statuskajian/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah statuskajian
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[statusharian.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat statuskajian baru.']);



			if($valid->run()) {

				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '2400';//dalam kb
				$config['max_width']     = '2024';
				$config['max_height']    = '2024';
	
				$this->load->library('upload', $config);
	
				
				if ( ! $this->upload->do_upload('gambar')){
				
				//end validasi
				$data = array( 'title' => 'Tambah Status Harian',
								'error'		=> $this->upload->display_errors(),
								'isi'   => 'admin/statuskajian/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);
				//masuk data
				}else{
	
				$upload_gambar = array('upload_data' => $this->upload->data());
				//create thumbnail gambar
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
				//lokasi folder thumbnail
				$config['new_image']		= './assets/upload/image/statuskajian/';
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
								'image'				=>$upload_gambar['upload_data']['file_name'],
								'keterangan'		=>$i->post('keterangan'),
								'date_created'		=> date('Y-m-d h:i')
							);
	
					$this->statuskajian_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/statuskajian'),'refresh');
				}
			}
			//end masuk database
			$data = array( 'title' => 'Tambah Status Harian',
							'isi'   => 'admin/statuskajian/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);	
			
	}

	//delete statuskajian
	public function delete($id){
		$data = array('id' => $id);
		$this->statuskajian_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/statuskajian'),'refresh');
	}

	//Edit statuskajian
	public function edit($id)
	{
		//ambil data statuskajian yang akan di edit
		$statuskajian 	= $this->statuskajian_model->detail($id);
		
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
			$data = array( 'title' => 'Edit Status Harian : '.$statuskajian->nama,
							'statuskajian'	=>$statuskajian,
							'error'		=> $this->upload->display_errors(),
							'isi'   => 'admin/statuskajian/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
			}else{

			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/statuskajian/';
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
						  'image'				=>$upload_gambar['upload_data']['file_name'],
						  'keterangan'		    =>$i->post('keterangan')
						);

			$this->statuskajian_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/statuskajian'),'refresh');
			}}else{
				//edit statuskajian tanpa ganti gambar
			$i = $this->input;
			$data = array('id'			=>$id,
					  'nama'         =>$i->post('nama'),
					  'keterangan'		    =>$i->post('keterangan')
					);
			$this->statuskajian_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/statuskajian'),'refresh');
			}}
		//end masuk database
		$data = array( 'title' => 'Edit Status Harian : '.$statuskajian->nama,
						'statuskajian'	=>$statuskajian,
						'isi'   => 'admin/statuskajian/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

}

/* End of file statuskajian.php */
/* Location: ./application/controllers/admin/statuskajian.php */