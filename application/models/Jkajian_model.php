<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jkajian_model extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}	

		//listing all kategori
		public function listing(){
			$this->db->select('*');
			$this->db->from('jkajian');
			$this->db->order_by('id', 'asc');
			$query = $this->db->get();
			return $query->result();
		}

		
		//detail kategori
		public function detail($id){
			$this->db->select('*');
			$this->db->from('jkajian');
			$this->db->where('id', $id);
			$this->db->order_by('id', 'desc');
			$query = $this->db->get();
			return $query->row();
		}


		public function tambah($data){
			$this->db->insert('jkajian', $data);
		}

		//delete
		public function delete($data){
			$this->db->where('id', $data['id']);
			$this->db->delete('jkajian' ,$data);
		}

		//Edit
		public function edit($data){
			$this->db->where('id', $data['id']);
			$this->db->update('jkajian' ,$data);
		}
		
		public function jkajian(){
			$this->db->select('jkajian.*, count(*) AS total_item');
			$this->db->from('jkajian');
			$query = $this->db->get();
			return $query->result();
		}


}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */