<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_pelanggan
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
        //load data model user
        $this->CI->load->model('user_model');
	}
 
	//fungsi login
	public function login($email,$password){ 

		$check = $this->CI->user_model->login($email,$password);
		//jika ada data usernya, maka create session login
		if($check){
			$email 		= $check->email;
			$password 	= $check->password;
			$nama 		= $check->nama;
			$akses_level = $check->akses_level;
			//create session
			$this->CI->session->set_userdata('nama',$nama);
			$this->CI->session->set_userdata('email',$email);
			$this->CI->session->set_userdata('akses_level',$akses_level);
			//rederect ke halaman admin yang diproteksi
			if($this->CI->session->userdata('akses_level')=="Admin"){
			redirect(base_url('admin/dasbor'),'refresh');
			}else{
				$this->CI->session->set_flashdata('warning', 'Anda belum terdaftar menjadi Administrator!!!');
				redirect(base_url('masuk'),'refresh');
			}

			// $this->CI->response(["pelanggan" => $pelanggan], 200);

		}else{
			//kalau tidak ada (email password salah) suruh login lagi
			$this->CI->session->set_flashdata('warning', 'Email atau password salah');
			redirect(base_url('masuk'),'refresh');
		}
	}
	
	
	//fungsi cek login
	public function cek_loginAdmin(){
		//memeriksa apakah session sudah ada atau belum, jika belum alihkan ke halaman login
		if($this->CI->session->userdata('akses_level') != "Admin"){
			$this->CI->session->set_flashdata('warning', 'Anda belum Login');
			redirect(base_url('masuk'),'refresh');
		}
	}

	
	//end cek login

	
	

	//fungsi logout
	public function logout(){
		//membuang semua session yang telah diset pada saat login
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('email');
		$this->CI->session->unset_userdata('akses_level');
		//setelah session dibuang, maka redirect ke login
		$this->CI->session->set_flashdata('sukses', 'Anda berhasil Logout');
		redirect(base_url('masuk'),'refresh');
	}

	

}

/* End of file Simple_pelanggan.php */
/* Location: ./application/libraries/Simple_pelanggan.php */
