<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	//Login Pelanggan
	public function index()
	{
		//validasi  
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email',
				 array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('password', 'Password', 'required',
				 array('required' => '%s harus diisi'));

		if ($this->form_validation->run()) {
			# code...
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			//proses ke simple login
			$this->simple_pelanggan->login($email,$password);
		}
		//End validasi

		$data = array('title' 	=> 'Login'

					);
		$this->load->view('login/list', $data, FALSE);
		
	}

	// Logout
	public function logout(){
		//ambil fungsi logout di Simple_Pelanggan yang sudah diset di autoload libraries
		$this->simple_pelanggan->logout();
	}

}

/* End of file Masuk.php */
/* Location: ./application/controllers/Masuk.php */