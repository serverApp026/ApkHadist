<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

require APPPATH . 'libraries/REST_Controller.php';

class Statuskajian extends REST_Controller {
	 function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
              $statuskajian  = $this->db->get('statusharian')->result();
        } else {

            $this->db->where('id', $id);
            $statuskajian = $this->db->get('statusharian')->result();
           
        }

        //$this->response($produk, 200);
        $this->response(["statuskajian" => $statuskajian], 200); //untuk membuat data menjadi array produk
    }

    

}

/* End of file Produk.php */
/* Location: ./application/controllers/api/Produk.php */