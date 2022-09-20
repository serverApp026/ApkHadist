<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jkajian extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jkajian_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data jkajian
	public function index()
	{
		$jkajian = $this->jkajian_model->listing();
		$data = array('title' => 'Data Jadwal Kajian Menu',
					   'jkajian' => $jkajian,
						'isi' => 'admin/jkajian/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah jkajian
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		
		$valid->set_rules('nama', 'Nama', 'required|trim|is_unique[jkajian.nama]',
				['required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat jkajian baru.']);



			if($valid->run()) {

				$config['upload_path']   = './assets/upload/image/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']      = '2400';//dalam kb
				$config['max_width']     = '2024';
				$config['max_height']    = '2024';
	
				$this->load->library('upload', $config);
	
				
				if ( ! $this->upload->do_upload('gambar')){
				
				//end validasi
				$data = array( 'title' => 'Tambah Jadwal Kajian',
								'error'		=> $this->upload->display_errors(),
								'isi'   => 'admin/jkajian/tambah'
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
				$data = array('nama'	    =>$i->post('nama'),
							  'waktu'	    =>$i->post('waktu'),
							  'tempat'	    =>$i->post('tempat'),
								//yang disimpan nama file gambar
								'gambar'				=>$upload_gambar['upload_data']['file_name'],
								'keterangan'		=>$i->post('keterangan'),
								'status'		=>$i->post('status'),
							);
	
					$this->jkajian_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/jkajian'),'refresh');
				}
			}
			//end masuk database
			$data = array( 'title' => 'Tambah Jadwal Kajian',
							'isi'   => 'admin/jkajian/tambah'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);	
			
	}

	//delete jkajian
	public function delete($id){
		$data = array('id' => $id);
		$this->jkajian_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/jkajian'),'refresh');
	}

	//Edit jkajian
	public function edit($id)
	{
		//ambil data jkajian yang akan di edit
		$jkajian 	= $this->jkajian_model->detail($id);
		
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
			$data = array( 'title' => 'Edit jkajian: '.$jkajian->nama,
							'jkajian'	=>$jkajian,
							'error'		=> $this->upload->display_errors(),
							'isi'   => 'admin/jkajian/edit'
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

			$this->jkajian_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/jkajian'),'refresh');
			}}else{
				//edit jkajian tanpa ganti gambar
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

			$this->jkajian_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/jkajian'),'refresh');
			}}
		//end masuk database
		$data = array( 'title' => 'Edit jkajian: '.$jkajian->nama,
						'jkajian'	=>$jkajian,
						'isi'   => 'admin/jkajian/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}

}

/* End of file jkajian.php */
/* Location: ./application/controllers/admin/jkajian.php */