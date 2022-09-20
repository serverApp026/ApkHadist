<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}	

		//listing all user
		public function listing(){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->order_by('id_user', 'desc');
			$query = $this->db->get();
			return $query->result();
		}

 
		//login user
		public function login($email,$password){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where(array('email' => $email,
							 		'password' => SHA1($password)));
			$this->db->order_by('id_user', 'desc');
			$query = $this->db->get();
			return $query->row();
		}

		//detail user
		public function detail($id_user){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('id_user', $id_user);
			$this->db->order_by('id_user', 'desc');
			$query = $this->db->get();
			return $query->row();
		}

		public function tambah($data){
			$this->db->insert('users', $data);
		}

		//delete
		public function delete($data){
			$this->db->where('id_user', $data['id_user']);
			$this->db->delete('users' ,$data);
		}

		//Edit
		public function edit($data){
			$this->db->where('id_user', $data['id_user']);
			$this->db->update('users' ,$data);
		}
		
		public function Jpegawai(){
		    $this->db->select('users.*, count(*) AS total_item');
			$this->db->from('users');
			$query = $this->db->get();
			return $query->result();
		}


}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */