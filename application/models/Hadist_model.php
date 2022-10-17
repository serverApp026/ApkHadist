<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hadist_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}	

		//listing all kategori
		public function listing(){
			$this->db->select('*');
			$this->db->from('hadist');
			$this->db->order_by('id', 'asc');
			$query = $this->db->get();
			return $query->result();
		}

		
		//detail kategori
		public function detail($id){
			$this->db->select('*');
			$this->db->from('hadist');
			$this->db->where('id', $id);
			$this->db->order_by('id', 'desc');
			$query = $this->db->get();
			return $query->row();
		}


		public function tambah($data){
			$this->db->insert('hadist', $data);
		}

		//delete
		public function delete($data){
			$this->db->where('id', $data['id']);
			$this->db->delete('hadist' ,$data);
		}

		//Edit
		public function edit($data){
			$this->db->where('id', $data['id']);
			$this->db->update('hadist' ,$data);
		}
		
		public function hadist(){
			$this->db->select('hadist.*, count(*) AS total_item');
			$this->db->from('hadist');
			$query = $this->db->get();
			return $query->result();
		}


}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */