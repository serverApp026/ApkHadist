<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET,POST, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class Produk extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id_produk = $this->get('id_produk');
        if ($id_produk == '') {
              $this->db->select('produk.*,
              kategori.nama_kategori');
              $this->db->from('produk');
              //JOIN
              $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
              //END JOIN 
              $this->db->where('produk.status_produk', 'Publish');
              $this->db->group_by('produk.id_produk');
              $produk  = $this->db->get()->result();
        } else {

            //$this->db->where('id_produk', $id_produk);
            //$produk = $this->db->get('produk')->result();
            $this->db->select('produk.*,
            kategori.nama_kategori');
            $this->db->from('produk');
            //JOIN
            $this->db->join('kategori', 'kategori.id_kategori = produk.id_kategori', 'left');
            //END JOIN 
            $this->db->where('id_produk', $id_produk);
            $this->db->where('produk.status_produk', 'Publish');
            $this->db->group_by('produk.id_produk');
            $this->db->order_by('id_produk', 'desc');
            $produk  = $this->db->get()->result();
        }

        //$this->response($produk, 200);
        $this->response(["menu" => $produk], 200); //untuk membuat data menjadi array produk
    }

   

}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */