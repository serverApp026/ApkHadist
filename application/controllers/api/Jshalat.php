<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class jshalat extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
              $jshalat  = $this->db->get('jshalat')->result();
        } else {

            $this->db->where('id', $id);
            $jshalat = $this->db->get('jshalat')->result();
           
        }

        //$this->response($produk, 200);
        $this->response(["jshalat" => $jshalat], 200); //untuk membuat data menjadi array produk
    }

    

}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */