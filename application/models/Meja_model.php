<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}	

		//listing all meja
		public function listing(){
			$this->db->select('*');
			$this->db->from('meja');
			$this->db->order_by('id_meja', 'Asc');
			$query = $this->db->get();
			return $query->result();
		}

		
		//detail meja
		public function detail($id_meja){
			$this->db->select('*');
			$this->db->from('meja');
			$this->db->where('id_meja', $id_meja);
			$this->db->order_by('id_meja', 'Asc');
			$query = $this->db->get();
			return $query->row();
		}

		

		public function tambah($data){
			$this->db->insert('meja', $data);
		}

		//delete
		public function delete($data){
			$this->db->where('id_meja', $data['id_meja']);
			$this->db->delete('meja' ,$data);
		}

		//Edit
		public function edit($data){
			$this->db->where('id_meja', $data['id_meja']);
			$this->db->update('meja' ,$data);
		}
		
		public function jMeja(){
		    $this->db->select('meja.*, count(*) AS total_item');
			$this->db->from('meja');
			$query = $this->db->get();
			return $query->result();
		}


}

/* End of file Meja_model.php */
/* Location: ./application/models/Meja_model.php */