<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('form_validation');
		//proteksi halaman
		

	}

	//data user
	public function index()
	{
		$user = $this->user_model->listing();
		$data = array('title' => 'Data Pengguna',
					   'user' => $user,
						'isi' => 'admin/user/list'
					);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	//tambah user
	public function tambah()
	{
		//validasi input
		$valid = $this->form_validation;

		$valid->set_rules('nama', 'Nama Lengkap', 'required',
				array('required' => '%s harus diisi'));

		$valid->set_rules('email', 'Email', 'required|is_unique[users.email]',
				array('required' => '%s harus diisi',
						'is_unique'  => '%s sudah ada. Buat Email baru.'));

		$valid->set_rules('password', 'Password', 'required',
				array('required' => '%s harus diisi'));

		
		
				if($valid->run()) {

					$config['upload_path']   = './assets/upload/image/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']      = '2400';//dalam kb
					$config['max_width']     = '4024';
					$config['max_height']    = '4024';
		
					$this->load->library('upload', $config);
		
					
					if ( ! $this->upload->do_upload('gambar')){
					
					//end validasi
					$data = array( 'title' => 'Tambah Data User',
									'error'		=> $this->upload->display_errors(),
									'isi'   => 'admin/user/tambah'
									);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					//masuk data
					}else{
		
					$upload_gambar = array('upload_data' => $this->upload->data());
					//create thumbnail gambar
					$config['image_library']	= 'gd2';
					$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
					//lokasi folder thumbnail
					$config['new_image']		= './assets/upload/image/user/';
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
									'email'		=>$i->post('email'),
									'password'		=>sha1($i->post('email')),
									'image'				=>$upload_gambar['upload_data']['file_name'],
									'telepon'		=>$i->post('telepon'),
									'akses_level'		=>$i->post('akses_level'),
								);
		
						$this->user_model->tambah($data);
						$this->session->set_flashdata('sukses', 'Data telah ditambah');
						redirect(base_url('admin/user'),'refresh');
					}
				}
				//end masuk database
				$data = array( 'title' => 'Tambah Data User',
								'isi'   => 'admin/user/tambah'
									);
					$this->load->view('admin/layout/wrapper', $data, FALSE);	
				
			
	}
	
	//delete user
	public function delete($id_user){
		$data = array('id_user' => $id_user);
		$this->user_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/user'),'refresh');
	}

	//Edit user
	public function edit($id_user)
	{
		$user = $this->user_model->detail($id_user);
		//ambil data user yang akan di edit
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
			$data = array( 'title' => 'Edit Data User : '.$user->nama,
							'user'	=>$user,
							'error'		=> $this->upload->display_errors(),
							'isi'   => 'admin/user/edit'
							);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			//masuk data
			}else{

			$upload_gambar = array('upload_data' => $this->upload->data());
			//create thumbnail gambar
			$config['image_library']	= 'gd2';
			$config['source_image'] 	= './assets/upload/image/'.$upload_gambar['upload_data']['file_name'];
			//lokasi folder thumbnail
			$config['new_image']		= './assets/upload/image/user/';
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio'] 	= TRUE;
			$config['width']         	= 250;//ukuran pixel
			$config['height']       	= 250;//ukuran pixel
			$config['thumb_marker']		= '';

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
			//end create thumbnail
			
			$i = $this->input;
			$data = array('id_user'			=>$id_user,
						'nama'		    =>$i->post('nama'),
						'email'		    =>$i->post('email'),
						'password'		    =>SHA1($i->post('email')),
						'telepon'		    =>$i->post('telepon'),
						//yang disimpan nama file gambar
						'image'				=>$upload_gambar['upload_data']['file_name'],
						'akses_level'		    =>$i->post('akses_level')
						);

			$this->user_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/user'),'refresh');
			}}else{
				//edit user tanpa ganti gambar
			$pass = $this->input->post('password');
			if ($pass !== ''){
				$i = $this->input;
				$data = array('id_user'			=>$id_user,
						'nama'         =>$i->post('nama'),
						'email'         =>$i->post('email'),
						'password'		    =>sha1($i->post('password')),
						'telepon'         =>$i->post('telepon'),
						'akses_level'         =>$i->post('akses_level'),
						);
				$this->user_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/user'),'refresh');
			}else{
				$i = $this->input;
				$data = array('id_user'			=>$id_user,
						'nama'         =>$i->post('nama'),
						'email'         =>$i->post('email'),
						'telepon'         =>$i->post('telepon'),
						'akses_level'         =>$i->post('akses_level'),
						);
				$this->user_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/user'),'refresh');
			}
			}}
			//end masuk database
			$data = array( 'title' => 'Edit Data User : '.$user->nama,
							'user'	=>$user,
							'isi'   => 'admin/user/edit'
								);
				$this->load->view('admin/layout/wrapper', $data, FALSE);		
	}


}

/* End of file User.php */
/* Location: ./application/controllers/admin/User.php */