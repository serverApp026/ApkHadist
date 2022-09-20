<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class alquran extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
              $alquran  = $this->db->get('alquran')->result();
        } else {

            $this->db->where('id', $id);
            $alquran = $this->db->get('alquran')->result();
           
        }

        //$this->response($produk, 200);
        $this->response(["alquran" => $alquran], 200); //untuk membuat data menjadi array produk
    }

    

}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */